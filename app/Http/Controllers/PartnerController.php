<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Donor', 'l'))
        {
            return view('permissions.no');
        }
        $data['partners'] = DB::table('partners')
            ->where('active',1)
            ->paginate(18);
        return view('partners.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Donor', 'i'))
        {
            return view('permissions.no');
        }
        return view('partners.create');
    }
    // save new category
    public function save(Request $r)
    {
        if(!Right::check('Donor', 'i'))
        {
            return view('permissions.no');
        }
        $file_name = '';
        if($r->logo) {
            $file = $r->file('logo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'partners/';
            $file->move($destinationPath, $file_name);
        }
        $data = array(
            'name' => $r->name,
            
            'logo' => $file_name,
            'sequence' => $r->sequence,
            'url' => $r->url
        );
       
        $i = DB::table('partners')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', "Upload success!");
            return redirect('/donor/create');
        }
        else
        {
            $r->session()->flash('sms1', "Fail to upload new donor logo!");
            return redirect('/donor/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Donor', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('partners')->where('id', $id)->update(['active'=>0]);
        return redirect('/donor');
    }
    public function edit($id)
    {
        if(!Right::check('Donor', 'i'))
        {
            return view('permissions.no');
        }
        $data['partner'] = DB::table('partners')
            ->where('id', $id)->first();
        return view('partners.edit', $data);
    }
    // update partner 
    public function update(Request $r)
    {
        if(!Right::check('Donor', 'u'))
        {
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'sequence' => $r->sequence,
            'url' => $r->url
        );
        if ($r->logo) {
            $file = $r->file('logo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'partners/';
            $file->move($destinationPath, $file_name);
            $data = array(
                'logo' => $file_name
            );
        } 
       
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('partners')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/donor/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/donor/edit/'.$r->id);
        }
    }
}
