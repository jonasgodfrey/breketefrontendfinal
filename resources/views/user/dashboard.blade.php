@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
       <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/user') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
@stop

@section('content')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                  {{$complaints}}
                                </h3>

                                <p>Total Complaints</p>
                            </div>
                            <a href="">
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="/users/complaint/view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <!-- ./col -->
                    <div class="col-lg-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>
                                {{$resolved}}
                               </h3>

                                <p>Resolved Cpmplaints</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="/users/complaint/view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


            <div class="col-xl-12">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card"  style="width:100%">
                    <div class="card-header ">
                                                <h4 class="mb-0" style="float:left">All Complaints</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id='data'  class="table table-striped table-bordered second" style="width:100%"">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Complaint Type</th>
                                        <th>Tracking Code</th>                                                                                
                                        <th>Staff Assigned</th>
                                        <th>Date Lodged</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($complaint)>0)

                                    @foreach ($complaint as $complaint)
                                    <tr>
                                    <td>{{ $loop->iteration }}</td>                                    
                                    <td>{{ $complaint->complaint_type }}</td>
                                    <td>{{ $complaint->tracking_code }}</td>
                                    <td>{{ $complaint->staff_assigned }}</td>
                                  <td>{{ $complaint->created_at }}</td>
                                  <td><span class="right badge badge-success">{{ $complaint->complaint_status }}</span></td>
                                    <td>
                                    <!--modal begin-->

                                        <button class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="{{ '#Modal' . $complaint->id }}" >View</button>

                                    <div class="modal fade" id="{{ 'Modal' . $complaint->id }}" tabindex="-1" role="dialog"
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
                <dt class="col-sm-4">Staff Assigned</dt>
                  <dd class="col-sm-8">{{ $complaint->staff_assigned }}</dd>
                  <dt class="col-sm-4">Address</dt>
                  <dd class="col-sm-8">{{ $complaint->address }}</dd>
                  <dt class="col-sm-4">State</dt>
                  <dd class="col-sm-8">{{ $complaint->state }}</dd>
                  <dt class="col-sm-4">Country</dt>
                  <dd class="col-sm-8">{{ $complaint->country }}</dd>
                  <dt class="col-sm-4">Complaint</dt>
                  <dd class="col-sm-8"><textarea class="form-control" readonly>{{ $complaint->complaint }} </textarea></dd>
                  <dt class="col-sm-4">Complaint Type</dt>
                  <dd class="col-sm-8">{{ $complaint->complaint_type }}</dd>
                  <dt class="col-sm-4">Tracking Code</dt>
                  <dd class="col-sm-8">{{ $complaint->tracking_code }}</dd>
                  <dt class="col-sm-4">Status</dt>
                  <dd class="col-sm-8">{{ $complaint->complaint_status }}</dd>
                  <dt class="col-sm-4">Date Lodged</dt>
                  <dd class="col-sm-8">{{ $complaint->created_at }}</dd>
                  <dt class="col-sm-4">Attachements</dt>
                  <dd class="col-sm-8"><button class="btn btn-secondary">view attachments</button></dd>
                     <figure>
                        {{-- <img src="<?php echo "admin/".$row['image']; ?>" class="img-fluid" alt="" data-lightbox="portfolio">
                       --}}
      			    </figure>

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

                        <!-- /.info-box -->
                    </div>
                    <!-- /.col --success
                  </div>
                  <!-- /.row -->
                    <!-- Main row -->

                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
        </section>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
 @if (Session::has('flash_message'))
             <script>
                 $(window).bind("load", function() {
                 swal("Congratulations!", "{{ Session::get('flash_message') }}", "success");
                });
            </script>
@endif
<script>
   $('#data').DataTable();
</script>
@stop