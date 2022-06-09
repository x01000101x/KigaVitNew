@extends('layouts.base')

@section('css')
@endsection

@section('content')
    <div class="container">

        <center>
            <h1><b>Add Category</b></h1>
        </center>
        <form action="{{ route('store-category') }}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="input-group mb-3">

                <input type="text" class="form-control" placeholder="Name Category" aria-label="category" name="category"
                    aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
                <span class="input-group-text">Desc</span>
                <textarea name="description" class="form-control" aria-label="With textarea"></textarea>
            </div>
            <br>


            <div class="mb-3">
                <label for="formFile" class="form-label">Thumb</label>
                <input class="form-control" type="file" name="thumb" id="formFile">
            </div>
            <center>
                <button type="submit" class="btn btn-success">Send !</button>
            </center>
            <br>
            <br>
        </form>

    </div>

@endsection
