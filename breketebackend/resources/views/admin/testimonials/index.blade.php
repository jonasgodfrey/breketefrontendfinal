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
                                    <h4 class="mb-0" style="float:left">Testimonials</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id='data'  class="table table-striped table-bordered second" style="width:100%"">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Testimony</th>
                                            <th>Date Testified</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (count($testimonials1)>0)

                                            @foreach ($testimonials1 as $testimony)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $testimony->name }}</td>
                                                    <td>{{ $testimony->phone_number }}</td>
                                                    <td>{{ $testimony->address }}</td>
                                                    <td>{{ $testimony->response }}</td>
                                                    <td>{{ $testimony->created_at }}</td>
                                                    <!-- <td><span class="right badge badge-success">{{ $testimony->complaint_status }}</span></td> -->
                                                    <td>
                                                        <!--modal begin-->

                                                        <button class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="{{ '#Modal' . $testimony->id }}" >View</button>

                                                        <div class="modal fade" id="{{ 'Modal' . $testimony->id }}" tabindex="-1" role="dialog"
                                                             aria-labelledby="ModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">Testimony
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
                                                                                    <dd class="col-sm-8">{{ $testimony->name}}.</dd>
                                                                                    <dt class="col-sm-4">Phone Number</dt>
                                                                                    <dd class="col-sm-8">{{ $testimony->phone_number }}</dd>  
                                                                                    <dt class="col-sm-4">Address</dt>                                                                                 
                                                                                    <dd class="col-sm-8">{{ $testimony->address }}</dd>
                                                                                    <dt class="col-sm-4">Testimony</dt>
                                                                                    <dd class="col-sm-8"><textarea class="form-control" readonly>{{ $testimony->response }} </textarea></dd>
                                                                                    <dt class="col-sm-4">Date Testified</dt>
                                                                                    <dd class="col-sm-8">{{ $testimony->created_at }}</dd>                                                                                    

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

