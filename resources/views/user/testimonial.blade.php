@extends('adminlte::page')

@section('title', 'Testimonials')

@section('content_header')
           <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Submit Testimonials</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/user') }}">Home</a></li>
                            <li class="breadcrumb-item active">Submit Testimonial</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
@stop

@section('content')
        <div class="wrapper wrapper--w900">
                                <form method="POST" action="{{ route('testimonial.save') }}" enctype="multipart/form-data">

            <div class="card card-6">
               
                <div class="card-body">
                        @csrf
                      
                        <div class="form-row">
                            <div class="name">Testimony</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="testimony" placeholder="Your Testimony" required></textarea>
                                </div>
                            </div>
                        </div>

                       
                        
                        <div class="form-row">
                            <div class="name">Residential Address</div>
                             <div class="value">
                                <input type="text" class="input--style-6 form-control" name="address" placeholder="Your address" required >                                 
                                
                            </div>
                        </div>                    
                       </div>
                <div class="card-footer">
                    <button class="btn btn--radius-2 btn--blue-2" name="submit" type="submit">Submit Testimonial</button>
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