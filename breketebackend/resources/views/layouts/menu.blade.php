<!-- need to remove -->
<li class="nav-item">
    <a href="/admin" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-header brand-link">COMPLAINTS SECTION</li>

<li class="nav-item">
    <a href="{{ route('complaints') }}" class="nav-link ">
       <i class="nav-icon fas fa-th"></i>
        <p>All Complaints</p>
        <span class="right badge badge-success">{{$complaints ?? '0'}}</span>
    </a>
</li>

@can('awaiting')
<li class="nav-item">
    <a href="{{ route('awaiting') }}" class="nav-link ">
       <i class="nav-icon fas fa-th"></i>
        <p>Awaiting Review</p>
        <span class="right badge badge-info">{{$awaiting ?? '0'}}</span>
    </a>
</li>
@endcan

@can('resolve')
<li class="nav-item">
    <a href="/admin/pending" class="nav-link ">
       <i class="nav-icon fas fa-th"></i>
        <p>Pending Complaints</p>
        <span class="right badge badge-warning">{{$pending ?? '0'}}</span>
    </a>
</li>

<li class="nav-header brand-link">RESOLVED COMPLAINTS</li>

<li class="nav-item">
    <a href="/admin/resolved" class="nav-link ">
       <i class="nav-icon fas fa-th"></i>
        <p>Resolved Complaints</p>
        <span class="right badge badge-success">{{$resolved ?? '0'}}</span>
    </a>
</li>
@endcan
@can('manage-users')
<li class="nav-header brand-link">OTHER COMPLAINTS</li>

<li class="nav-item">
    <a href="/admin/flagged" class="nav-link ">
       <i class="nav-icon fas fa-th"></i>
        <p>Flagged Complaints</p>
        <span class="right badge badge-danger">{{$flagged ?? '0'}}</span>
    </a>
</li>

<li class="nav-header brand-link">TESTIMONIALS SECTION</li>

<li class="nav-item">
    <a href="/admin/testimonials" class="nav-link ">
       <i class="nav-icon fas fa-th"></i>
        <p>Testimonials</p>
        <span class="right badge badge-primary">{{$testimonial ?? '0'}}</span>
    </a>
</li>


<li class="nav-header brand-link">ADMIN SETUP</li>

<li class="nav-item">
    <a href="{{ route('users.view') }}" class="nav-link ">
       <i class="nav-icon fas fa-users"></i>
        <p>Users</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('staffs.view') }}" class="nav-link ">
       <i class="nav-icon fas fa-users"></i>
        <p>Staffs</p>
    </a>
</li>

@can('total-control')
<li class="nav-item">
    <a href="{{ route('users.view') }}" class="nav-link ">
       <i class="nav-icon fas fa-th"></i>
        <p>Settings</p>
    </a>
</li>
@endcan
@endcan

<li class="nav-header brand-link">USER PROFILE</li>

<li class="nav-item">
    <a href="{{ route('profile.index') }}" class="nav-link ">
        <i class="nav-icon fas fa-user"></i>
        <p>Profile</p>
    </a>
</li>
