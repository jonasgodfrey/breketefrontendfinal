@extends('layouts.app')
@push('page_css')

@endpush
@section('third_party_stylesheets')

@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- flash messages  -->
            <!-- ============================================================== -->
                @include('admin.partials.flash')
             <!-- ============================================================== -->
            <!-- end flash messages  -->
            <!-- ============================================================== -->

            <div class="row">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <br>
                            <div class="card">
                                <div class="card-header text-center"><h5>{{ __('Update User') }}</h5></div>
                                <div class="card-body">
                                    <form method="POST" action="{{'/admin/staffs/edit/' . $staff->id}}" id="update_user">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $staff->name }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $staff->email }}" required autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                            <div class="col-md-6">
                                                <input id="phonenumber" type="tel" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ $staff->phone_number }}" required autocomplete="phonenumber">

                                                @error('phonenumber')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Organizational Position') }}</label>

                                            <div class="col-md-6">
                                                <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ $staff->position }}" required autocomplete="position">

                                                @error('position')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-4 offset-md-4">
                                                <input type="submit" class="btn btn-primary" form="update_user" value="{{ __('Update') }}">
                                            </div>

                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('third_party_scripts')
    <script>
      $(function(){
          $('select.styled').customSelect();
           $('#myTable').DataTable();
      });

    $(document).ready( function () {

    } );
</script>
@endsection
