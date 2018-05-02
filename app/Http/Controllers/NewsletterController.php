<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

use Auth;
class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Newsletter', 'l')){
            return view('permissions.no');
        }
        $data['newsletters'] = DB::table('newsletters')
            ->orderBy('id', 'desc')
            ->where('active', 1)
            ->paginate(18);
        return view('newsletters.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Newsletter', 'i')){
            return view('permissions.no');
        }
        return view('newsletters.create');
    }
    // save new newsletter
    public function save(Request $r)
    {
        if(!Right::check('Newsletter', 'i')){
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'email' => $r->email,
        );
        $sms = "The new newsletter has been created successfully.";
        $sms1 = "Fail to create the new newsletter, please check again!";
        $i = DB::table('newsletters')->insert($data);

        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/newsletter/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/newsletter/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Newsletter', 'd')){
            return view('permissions.no');
        }
        DB::table('newsletters')->where('id', $id)->update(['active'=>0]);
        return redirect('/newsletter');
    }

    public function edit($id)
    {
        if(!Right::check('Newsletter', 'u')){
            return view('permissions.no');
        }
        $data['newsletter'] = DB::table('newsletters')
            ->where('id',$id)->first();
        return view('newsletters.edit', $data);
    }

    public function update(Request $r)
    {
        if(!Right::check('Newsletter', 'u')){
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'email' => $r->email
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('newsletters')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/newsletter/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/newsletter/edit/'.$r->id);
        }
    }
}

