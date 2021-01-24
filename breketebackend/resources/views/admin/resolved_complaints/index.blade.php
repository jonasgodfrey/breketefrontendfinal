@extends('layouts.app')
@push('page_css')

@endpush
@section('third_party_stylesheets')

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
                                    <h4 class="mb-0" style="float:left">Resolved Complaints</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id='data'  class="table table-striped table-bordered second" style="width:100%"">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Staff Assigned</th>
                                            <th>Complaint Type</th>
                                            <th>Date Lodged</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (count($resolvedt)>0)

                                            @foreach ($resolvedt as $resolve)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $resolve->name }}</td>
                                                    <td>{{ $resolve->phone_number }}</td>
                                                    <td>{{ $resolve->staff_assigned }}</td>
                                                    <td>{{ $resolve->complaint_type }}</td>
                                                    <td>{{ $resolve->created_at }}</td>
                                                    <td><span class="right badge badge-success">{{ $resolve->complaint_status }}</span></td>
                                                    <td>
                                                        <!--modal begin-->

                                                        <button class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="{{ '#Modal' . $resolve->id }}" >View</button>

                                                        <div class="modal fade" id="{{ 'Modal' . $resolve->id }}" tabindex="-1" role="dialog"
                                                             aria-labelledby="ModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">Complaints Review
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="card-title">
                                                                                    <i class="fas fa-text-width"></i>

                                                                                </h3>
                                                                            </div>
                                                                            <!-- /.card-header -->
                                                                            <div class="card-body">
                                                                                <dl class="row">
                                                                                    <dt class="col-sm-4">Name</dt>
                                                                                    <dd class="col-sm-8">{{ $resolve->name}}.</dd>
                                                                                    <dt class="col-sm-4">Phone Number</dt>
                                                                                    <dd class="col-sm-8">{{ $resolve->phone_number }}</dd>
                                                                                    <dt class="col-sm-4">Email</dt>
                                                                                    <dd class="col-sm-8">{{ $resolve->email }}</dd>
                                                                                    <dt class="col-sm-4">Gender</dt>
                                                                                    <dd class="col-sm-8">{{ $resolve->gender }}</dd>
                                                                                    <dt class="col-sm-4">Address</dt>
                                                                                    <dd class="col-sm-8">{{ $resolve->address }}</dd>
                                                                                    <dt class="col-sm-4">Country</dt>
                                                                                    <dd class="col-sm-8">{{ $resolve->country }}</dd>
                                                                                    <dt class="col-sm-4">Complaint</dt>
                                                                                    <dd class="col-sm-8"><textarea class="form-control" readonly>{{ $resolve->complaint }} </textarea></dd>
                                                                                    <dt class="col-sm-4">Complaint Type</dt>
                                                                                    <dd class="col-sm-8">{{ $resolve->complaint_type }}</dd>
                                                                                    <dt class="col-sm-4">Status</dt>
                                                                                    <dd class="col-sm-8">{{ $resolve->complaint_status }}</dd>
                                                                                    <dt class="col-sm-4">Date Lodged</dt>
                                                                                    <dd class="col-sm-8">{{ $resolve->created_at }}</dd>
                                                                                    <dt class="col-sm-4">Attachements</dt>
                                                                                    <dd class="col-sm-8"><button class="btn btn-secondary">view attachments</button></dd>

                                                                                </dl>
                                                                            </div>
                                                                            <!-- /.card-body -->
                                                                        </div>
                                                                        <!-- /.card -->

                                                                        <div class="modal-footer">
                                                                            <p>
                                                                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                    </td>
                                                </tr>
                                            @endforeach

                                        @endif

                                        </tbody>
                                        <tfoot>

                                        </tfoot>
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

