@extends('layouts.base')

@section('content')
    <div class="container">

        <center>
            <h1><b>Create Template</b></h1>

            <a href="{{ route('download-format') }}" class="btn btn-outline-info" style="width:100%"><i
                    class="fa fa-download"></i>
                IMPORTANT ! Download Format </a>
        </center>
        <br>
        <br>
        <form action="{{ route('store-template') }}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="input-group mb-3">

                <input type="text" class="form-control" placeholder="title" aria-label="title" name="title"
                    aria-describedby="basic-addon1" required>
            </div>
            <div class="input-group mb-3">

                <input type="text" class="form-control" placeholder="author" aria-label="author" name="author"
                    aria-describedby="basic-addon1" required>
            </div>

            <div class="input-group mb-3">

                <input type="text" class="form-control" placeholder="price" aria-label="price" name="price"
                    aria-describedby="basic-addon1" required>
            </div>
            <div class="input-group mb-3">
                <select class="form-select" name="category" aria-label="Default select example">
                    <option value="" selected>Choose...</option>
                    @foreach (App\Models\Category::all() as $category)
                        <option value="{{ $category->slug }}">{{ $category->category }}</option>
                    @endforeach
                </select>

            </div>


            <div class="input-group mb-3">

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="premium" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Check if this template premium or
                        not</label>
                </div>
            </div>


            <div class="input-group">
                <span class="input-group-text">Desc</span>
                <textarea name="description" class="form-control" aria-label="With textarea" required></textarea>
            </div>

            <br>


            <div id="inputFormRow">
                <div class="input-group mb-3">
                    <input type="text" name="section[]" class="form-control m-input"
                        placeholder="Enter Section just section without head or body like <section>bla bla bla</section>"
                        autocomplete="off" required>
                    <div class="input-group-append">

                    </div>
                </div>
            </div>

            <div id="newRow"></div>

            <center>

                <button id="addRow" type="button" class="btn btn-info">Add Row</button>

            </center>
            <br>




            <br>

            <div class="mb-3">
                <label for="formFile" class="form-label">Thumb</label>
                <input class="form-control" type="file" name="thumb" id="formFile">
            </div>


            <div class="mb-3">
                <label for="formFile" class="form-label">IMG / Video File</label>
                <input class="form-control" type="file" name="media[]" multiple>
            </div>


            <div class="mb-3">
                <label for="formFile" class="form-label">Css File</label>
                <input class="form-control" type="file" name="attachment[]" multiple>
            </div>

            {{-- <div class="input-group mb-3">
                <input type="file" class="form-control" name="attachment[]" multiple id="inputGroupFile02">
                <label class="input-group-text" for="inputGroupFile02">Upload CSS File</label>
            </div> --}}
            <div class="input-group mb-3">

                <input type="text" class="form-control"
                    placeholder="add css meta / cdn , just link like https://blablabla" aria-label="css_url" name="css_url"
                    aria-describedby="basic-addon1">
            </div>





            <div class="mb-3">
                <label for="formFile" class="form-label">Js File</label>
                <input class="form-control" type="file" name="jsfile[]" multiple>
            </div>

            <div class="input-group mb-3">

                <input type="text" class="form-control"
                    placeholder="add js script online / cdn , just link like https://blablabla" aria-label="js_url"
                    name="js_url" aria-describedby="basic-addon1">
            </div>



            <center>
                <button type="submit" class="btn btn-success">Send !</button>
            </center>
            <br>
            <br>
        </form>

    </div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init()

            setTimeout(function() {
                $('#preloaderbody').fadeOut(); // or fade, css //display however you'd like.
            }, 2500);
        });



        // add row
        $("#addRow").click(function() {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html +=
                '<input type="text" name="section[]" class="form-control m-input" placeholder="Enter Section code" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });


        $(document).on('click', '#removeRow', function() {
            $(this).closest('#inputFormRow').remove();
        });
    </script>
@endsection
