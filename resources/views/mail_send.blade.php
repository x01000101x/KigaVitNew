@extends('layouts.base')

@section('content')

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

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
        <div id="inputFormRow">
            <div class="input-group mb-3">
                <input type="text" name="title[]" class="form-control m-input" placeholder="Enter title" autocomplete="off" required>
                <div class="input-group-append">
                    <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                </div>
            </div>
        </div>
        <div id="newRow"></div>
        <button id="addRow" type="button" class="btn btn-info">Add Row</button>

    </div>
{{--
      <label for="email">Send to : </label>
      <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required> --}}
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

<script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="title[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>

