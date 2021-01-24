@extends('adminlte::page')

@section('title', 'My Profile')

@section('content_header')
<section class="content-header">
      <h1>
        My Profile
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary">
            <div class="card-body card-profile">
              <img class="profile-user-img img-responsive img-circle pull-left" src="/image/logo.png" alt="User profile picture">

              <h3 class="profile-username">Nina Mcintire</h3>

              <p class="text-muted">Software Engineer</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
        </div>
        <!-- /.col -->
        <div class="col-md-9 card-body">        
            <div class="tab-pane" id="settings">
            <h3>Change Password</h3>
                <form class="form-horizontal">
                  <!-- <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div> -->
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>                 
                 
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">New Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputSkills" placeholder="****">
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
           
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>