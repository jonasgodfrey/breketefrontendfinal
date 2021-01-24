@extends('layouts.app')
@push('page_css')
    <title>Brekete - Edit Profile</title>
@endpush
@section('third_party_stylesheets')

@endsection

@section('content')
    <div class="container-fluid">
        {{-- Flash message --}}
        <div id="alert">
            @include('backend.partials.flash')
        </div>
        {{-- Flash message end--}}
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0" style="float:left"> EDIT PROFILE PAGE</h4>
                                <a href="{{'/admin/user/profile/'}}" class="btn btn-primary" style="float:right">Back</a>
                                <p></p>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class=" rounded-0 mt-3 border-primary">
                                        <div class=" border-primary">

                                        </div>
                                        <!-- edit profile tab content -->
                                        <!-- Modal -->
                                        <div class="" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-body">
                                                <center>
                                                    <img src="{{$user->image}}" alt="{{$user->name . '\'s image'}}" style="height:250px; width:250px; border-radius: 100%" class="img-fluid img-circle" ><br>
                                                    <br>
                                                    <br>
                                                    <h3 class="media-heading bg-primary">{{$user->name}}</h3>

                                                </center>
                                                <hr>
                                            </div>
                                            <form method="POST" action="{{'/admin/profile/edit/' . $user->id}}"  class="px-3 mt-2" enctype="multipart/form-data" id="update_user">
                                                @method('put')
                                                @csrf

                                                <label for="image">upload picture</label>
                                                <input id="image" name="image" type="file" value="{{$user->image}}">



                                                <div class="form-group n-0">
                                                    <label for="name" class="m-1">Name</label>
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group row">
                                                    <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                                    <div class="col-md-6">
                                                        <select name="gender" class="form-control" required>
                                                            <option value=""  style="display:none">Select Gender</option>
                                                            <option value="{{'male'}}">Male</option>
                                                            <option value="{{'female'}}">Female</option>

                                                        </select>
                                                        @error('gender')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group n-0">
                                                    <label for="phone_number" class="m-1">phone_number</label>
                                                    <input id="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{$user->phone_number}}" required autocomplete="phone_number" autofocus>
                                                    @error('phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>


                                                <div class="form-group mt-2">
                                                    <input type="submit" name="profile_update" value="{{ __('Update') }}" form="update_user" class="btn btn-danger btn-block" id="ProfileUpdateBtn">
                                                </div>
                                            </form>



                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- edit profile tab content ends -->

                        </div>
                        <div>


                        </div>
                    </div>
                </div>
    </div>
@endsection
@section('third_party_scripts')

@endsection

