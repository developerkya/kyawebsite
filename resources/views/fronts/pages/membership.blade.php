@extends('layouts.front')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <p></p>
            <h4 class="default-color my-4">
                Member Registration Form
            </h4>
            <hr>
            
            @if(Session::has('sms'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('sms')}}
                    </div>
                </div>
            @endif
            @if(Session::has('sms1'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('sms1')}}
                    </div>
                </div>
            @endif
        </div>
    </div> 
     <form 
            action="{{url('/front/membership/save')}}" 
            class="form-horizontal" 
            method="post"
            enctype="multipart/form-data"  
        >   
        {{csrf_field()}}
       
        <div class="row text-primary">
            <div class="col-sm-6">
                <p>
                    <b>Khmer First Name <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" name="khmer_first_name" required placeholder="Khmer First Name">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>Khmer Family Name <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" name="khmer_family_name" required placeholder="Khmer Fimily Name">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>English First Name <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" name="english_first_name" required placeholder="English First Name">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>English Family Name <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" name="english_family_name" required placeholder="English Fimily Name">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>Date of Birth <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" name="date_of_birth" required placeholder="Date of Birth">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>gender <span class="text-danger">*</span></b>
                    <select class="form-control" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>Current Address <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" required name="current_address" placeholder="Current Address">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>Place of Birth  <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" required name="place_of_birth" placeholder="Place of Birth">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>Phone Nubmer <span class="text-danger">*</span></b>
                    <input type="number" class="form-control" required name="phone" placeholder="Phone Number">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>E-mail <span class="text-danger">*</span></b>
                    <input type="email" class="form-control" name="email" required placeholder="E-mail">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>Do you want to receive our newsletter? <span class="text-danger">*</span></b>
                    <select class="form-control" name="receive_newsletter" required> 
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </p>
                <p><b>Social URL</b>
                        <input type="text" class="form-control" name="social_url">
                </p>
                <p>
                    <input type="submit" class="btn btn-primary" value="Register Now" name="send">
                </p>
            </div>

            <div class="col-sm-6">
                <p>
                    <b>Photo <span class="text-danger">(4x6)</span> <span class="text-danger">*</span></b>
                    <input type="file" name="photo" required accept="image/*" id="photo" class="form-control" onchange="loadFile(event)">
                </p>
                <p>
                    <img src="{{asset('public/uploads/members/member.png')}}"  width="120" alt="" id="img">
                </p>
            </div>
        </div>   
    </form>
</div>
<p><br></p>
<script type="text/javascript">
    function loadFile(e)
    {
        var output = document.getElementById('img');
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script> 
@endsection