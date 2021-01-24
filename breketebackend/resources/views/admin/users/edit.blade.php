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
                                    <form method="POST" action="{{'/admin/users/edit/' . $user->id}}" id="update_user">
                                        @method('put')
                                        @csrf

                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>
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
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        @can('admin')
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                                            <div class="col-md-6">
                                                <select name="role_id" class="form-control">
                                                    @isset($user->roles)
                                                        <option value="{{implode(', ', $user->roles->pluck('id')->toArray())}}"  style="display:none">{{implode(', ', $user->roles->pluck('name')->toArray())}}</option>
                                                    @endisset
                                                    @empty($user->roles)
                                                        <option value=""  style="display:none">Select Role</option>
                                                    @endempty
                                                        <<option value="3">Complaint Attendant</option>
                                                        <option value="4">Resolution Attendant</option>
                                                </select>
                                                @error('role')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                         @endcan
                                        @can('total-control')
                                            <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                                            <div class="col-md-6">
                                                <select name="role_id" class="form-control">
                                                    @isset($user->roles)
                                                        <option value="{{implode(', ', $user->roles->pluck('id')->toArray())}}"  style="display:none">{{implode(', ', $user->roles->pluck('name')->toArray())}}</option>
                                                    @endisset
                                                    @empty($user->roles)
                                                        <option value=""  style="display:none">Select Role</option>
                                                    @endempty
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('role')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endcan
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                                            <div class="col-md-6">
                                                <select name="status_id" class="form-control">
                                                    @isset($user->status->id)
                                                        <option value="{{$user->status->id}}"  style="display:none">{{$user->status->name}}</option>
                                                    @endisset
                                                    @empty($user->status->id)
                                                        <option value=""  style="display:none">Select Status</option>
                                                    @endempty
                                                    @foreach ($status as $status)
                                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status')
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

                                            <div class="col-md-4">
                                                <a class="btn btn-warning " data-toggle="modal" data-target="#exampleModal">{{ __('Change Password') }}
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--modal begin-->
                        <div class="col-md-6">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New Password</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{'/admin/users/change_password/' . $user->id}}" method="post" id="change_password" >
                                            <div class="form-group">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                                            </div>

                                            <div class="form-group">
                                                <input id="password-confirm" type="password" class="form-control" placeholder="Repeat your password" name="password_confirmation" required autocomplete="new-password">
                                            </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            @csrf
                                            <input type="submit" class="btn btn-danger changePass" value="Change" id="changePass">
                                        </div>
                                            </form>
                                    </div>
                                </div>
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
