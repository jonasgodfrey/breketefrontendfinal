<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
</head>
<body>

<div class="container">
<div class="card text-center w-75 p-3 mx-auto shadow-lg mt-20 mb-5 bg-white rounded">
  <div class="card-header">
    Commplaint Details
  </div>
  <div class="card-body">
    @if(count($details) < 1)
    <p class="card-text text-danger">Invalid tracking code, check code and try again! </p>
    @endif
    @foreach($details as $detail)
    <h5 class="card-title">Hello, {{$detail->name}}</h5>
    <p class="card-text">Your complaint Status: {{$detail->complaint_status}}.</p>
    <p class="card-text">Your Tracking code: {{$detail->tracking_code}}</p>

    @if($detail->complaint_status == 'pending')
    <p class="card-text">Message: Please wait for the admins to contact you, your complaint is in progress</p>
    @endif

    @if($detail->complaint_status === 'resolved')
    <p class="card-text">Message: This complaint has been resolved</p>
    @endif

    <p class="card-text">Date Complaint was Logged: {{$detail->created_at}} </p>
  </div>
@endforeach
  <div class="card-footer text-muted">
  <a href="{{ route('home') }}" class="btn btn-primary">Go Back</a>
  </div>
</div>
</div>


</body>
</html>