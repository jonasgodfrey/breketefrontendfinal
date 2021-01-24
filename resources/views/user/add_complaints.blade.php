@extends('adminlte::page')

@section('title', 'Add Complaints')

@section('content_header')
           <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add Complaints</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/user') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add Complaints</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
@stop

@section('content')
        <div class="wrapper wrapper--w900">
                                <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data">

            <div class="card card-6">
               
                <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="name">Complaint Type</div>
                            <div class="value">
                                <select class="input--style-6 form-control" name="complaint_type" required>
                                    <option value=""  style="display:none">Select Complaint Type</option>
                                     @foreach ($complaint_types as $complaint_type)
                                    <option value="{{ $complaint_type->name }}">{{ $complaint_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Complaint Description</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="complaint" placeholder="Describe your case here" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Gender</div>
                            <div class="value">
                                <select class="input--style-6 form-control" name="gender"  required>
                                    <option value=""  style="display:none">Select Gender</option>                                    
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Marital Status</div>
                            <div class="value">
                                <select class="input--style-6 form-control" name="name" required>
                                    <option value="" style="display:none">Select your Marital Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Widower">Widower</option>
                                <option value="Engaged">Engaged</option>                                    
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="name">Residential Address</div>
                             <div class="value">
                                <input type="text" class="input--style-6 form-control" name="address" placeholder="Your Residential address" required >                                 
                                
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">State of Residence</div>
                            <div class="value">
                                <select class="input--style-6 form-control" name="state" required>
                                    <option value="" style="display:none">Select your State of Residence <option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->name }}">{{ $state->name }}</option>
                                    @endforeach                                   
                                </select>
                            </div>
                        </div>

                        

                        <div class="form-row">
                            <div class="name">Country</div>
                            <div class="value">
                                <select class="input--style-6 form-control" name="country" required>
                                <option value="" style="display:none">Select Country of Residence<option>  
                                @foreach ($countries as $country)
                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                @endforeach                                  
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Occupation</div>
                            <div class="value">
                                <select class="input--style-6 form-control" name="occupation" required>
                                <option value=""  style="display:none">Select Occupation<option>
                                      <option value="Student">Student</option>
                                    <option value="Employed">Employed</option>
                                    <option value="Unemployed">Unemployed</option>
                                    <option value="Retired">Retired</option>                           
                                </select>
                            </div>
                        </div>                       
                        
                        <div class="form-row">
                            <div class="name">Upload Affidavit</div>
                            <div class="value">
                                <div class="input-group js-input-file">
                                    <input class="input-file form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" type="file" name="affidavit" id="file" required>
                                    <label class="label--file" for="file">Choose file</label>
                                    <span class="input-file__info">No file chosen</span>
                                    @if ($errors->has('passport'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passport') }}</strong>
                                    </span>
                                @endif
                                   </div>
                                <div class="label--desc">Upload your Affidavit</div>
                                @error('affidavit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-row">
                            <div class="name">Upload Passport</div>
                            <div class="value">
                                <div class="input-group js-input-file2">
                                    <input class="input-file2 form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" type="file" name="passport" id="file2" required>
                                    <label class="label--file2" for="file2">Choose file</label>

                                    <span class="input-file__info2">No file chosen</span>
                                </div>
                                <div class="label--desc">Upload your passport</div>
                                 @error('passport')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-row">
                            <div class="name">Upload Other </div>
                            <div class="value">
                                <div class="input-group js-input-file3">
                                    <input class="input-file3 form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" multiple="multiple" type="file" name="others[]" id="file3" required>
                                    <label class="label--file" for="file3">Choose file</label>
                                    @error('role')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                    @enderror

                                    <span class="input-file__info3">No file chosen</span>
                                </div>
                                <div class="label--desc">Upload Other documents</div>
                            </div>
                        </div>
                   
                </div>
                <div class="card-footer">
                    <button class="btn btn--radius-2 btn--blue-2" name="submit" type="submit">Submit Complaint</button>
                </div>
                 </form>
            </div>
        </div>
   
    @stop

@section('css')
    <link href="/css/css.css" rel="stylesheet">
@stop

@section('js')
  @if (Session::has('flash_message'))
             <script>
                 $(window).bind("load", function() {
                 swal("Congratulations!", "{{ Session::get('flash_message') }}", "success");
                });
            </script>
     @endif
    <script src="/js/global.js"></script>
@stop