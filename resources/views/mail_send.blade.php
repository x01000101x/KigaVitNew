{{--
1.the given style must not exceed the scope of the section, for example styling the body
2.remember the styles and js that are uploaded to the website will be 1 in 1 file so you can make this section have 1 main style
3.Even if you don't set the section height to 100vh, in the preview later each section will fill the screen (full screen) and if the tag exceeds that, it will be removed.
4.(bug / error) convetti animation or animation like that will apply to all section
5.

--}}

{{-- <style>
	section {
		width: 100%;
		height: 100vh;
		background-color: aqua;
	}
</style> --}}

{{-- <section> --}}
	{{-- here you create a template and create new section for new page --}}
	{{-- <h1 style="text-align: center;line-height: 100%;">Thanks KigaVit</h1>
</section> --}}

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add or Remove Input Fields Dynamically using jQuery - MyNotePaper</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="container"style="max-width: 700px;">

        <div class="text-center" style="margin: 20px 0px 20px 0px;">

            <span class="text-secondary">Send Bulk Email</span>
        </div>

        <form method="post" action="">
            <div class="form-group">
            <div class="row">
                <div class="col-lg-12">
                    <div id="inputFormRow">
                        <label for="email[]">Send to </label>
                        <div class="input-group mb-3">
                            <input type="text" name="email[]" class="form-control m-input" placeholder="Enter email" autocomplete="off">
                            <div class="input-group-append">
                                <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                    </div>

                    <div id="newRow"></div>
                    <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                </div>
            </div>
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
        </form>
    </div>

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
</body>
</html>










{{--
@extends('layouts.base')

@section('content') --}}



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



    {{-- <form method="POST" action="/go_email">
        @csrf

        <div class="row">
            <div class="col-lg-12">
                <div id="inputFormRow">
                    <div class="input-group mb-3">
                        <input type="text" name="title[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">
                        <div class="input-group-append">
                            <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                        </div>
                    </div>
                </div>

                <div id="newRow"></div>
                <button id="addRow" type="button" class="btn btn-info">Add Row</button>
            </div>
        </div> --}}

{{--
      <label for="email">Send to : </label>
      <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required> --}}
    {{-- <div class="form-group">
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
  </form> --}}

  {{-- @endsection
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
</script> --}}

