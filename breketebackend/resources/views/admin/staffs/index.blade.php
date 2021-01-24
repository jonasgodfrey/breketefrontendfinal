@extends('layouts.app')
@push('page_css')
   <link rel="stylesheet" href="{{ asset('css/dash-table.css') }}" />

    <!-- causes toggle error in navbar -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->

    <!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->

@endpush
@section('third_party_stylesheets')
    <style type="text/css">
        .dataTable>tbody>tr>td,
        .dataTable>tbody>tr>th,
        .dataTable>tfoot>tr>td,
        .dataTable>tfoot>tr>th,
        .dataTable>thead>tr>td,
        .dataTable>thead>tr>th {
            padding: 12px!important;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">

<section class="content">
      <div class="container-fluid">
<br>

            <div class="row">
                {{-- Flash message --}}
                <div id="alert">
                @include('admin.partials.flash')
                </div>
                {{-- Flash message end--}}
            <div class="col-xl-12">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card"  style="width:100%">
                    <div class="card-header ">
                                                <h4 class="mb-0" style="float:left">All Staffs</h4>

                        <a href="{{'/admin/staffs/create/'}}" class="btn btn-primary" style="float:right">ADD NEW</a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                @if (count($staffs ) > 0)
                                 @foreach ($staffs as $staff)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$staff->name}}</td>
                                        <td>{{$staff->email}}</td>
                                        <td>{{$staff->phone_number}}</td>
                                        <td>
                                          {{$staff->position}}
                                        </td>
                                        <td>

                                <div class="row">
                            <div class="col-md-6">

                                <a href="{{'/admin/staffs/edit/'. $staff->id}}"><i class="fa fa-edit primary" ></i></a>

                            </div>
                            <!--modal begin-->

                            <div class="col-md-6">

                            <i class="fa fa-trash" data-toggle="modal" data-target="{{'#exampleModal'. $staff->id}}" style="color: red"></i>

                            <div class="modal fade" id="{{'exampleModal' . $staff->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure???</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                Deleting <strong>{{$staff->name}}</strong> from Staffs
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <form action="{{'/admin/staffs/delete/'. $staff->id}}" method="post" >
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                </div>
                                </div>
  </div>
</div>
                                                    </div>
                                                    </div>


                                        </td>

                                </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
        <!-- ============================================================== -->
                <!-- end data table  -->
        <!-- ============================================================== -->
    </div>
</div>
            </div>
                              </section>

</div>
@endsection
@section('third_party_scripts')

@endsection

