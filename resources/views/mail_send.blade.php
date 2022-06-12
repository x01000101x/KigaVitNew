@extends('layouts.base')

@section('content')

{{-- <!DOCTYPE html>
<html>
<head>
    <title>Hello World </title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>

    <p>Thank you</p>
</body>
</html> --}}



    <form method="POST" action="/go_email">
        @csrf
    <div class="form-group">
      <label for="email">Send to : </label>
      <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
    </div>
    <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" name="subject" class="form-control" id="subject" placeholder="Wedding Invitation" required>
      </div>
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="John and Jane Wedding" required>
      </div>
      <div class="form-group">
        <label for="body">Details</label>
        <textarea type="text" name="body" class="form-control" id="body" rows="3" placeholder="Link, place, time, blabla" required></textarea>
      </div>
      <button class="btn btn-primary" type="submit">Send</button>
  </form>

  @endsection
