@extends('layouts.base')

@section('content')
    <br>
    <div class="container">
        <center>
            <h1>Category</h1>
        </center>
        <br>
        <div class="d-flex justify-content-center">
            @foreach ($category as $item)
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->category }}</h5>

                        <a href="{{ route('category-filter', ['id'=>$item->slug]) }}" class="btn btn-primary">Category Filter</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
