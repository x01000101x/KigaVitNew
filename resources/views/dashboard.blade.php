@extends('layouts.base')

@section('content')
    <div class="container">
        @if(!empty($successMsg))
  <div class="alert alert-success"> {{ $successMsg }}</div>
@endif
        <br>

        <center>
            <h1><b>Template Design</b></h1>
        </center>
        <br>
        @if (!is_null($filter))
            <nav>
                <style>
                    ol li {
                        display: inline;
                    }
                </style>
                <ol>
                    <li><a href="/"><b>Home</b></a></li>
                    <li> / </li>
                    <li> <b>Category</b> </li>
                    <li> / </li>
                    <li><b>{{ $filter }}</b></li>
                </ol>
            </nav>
        @endif

        <div class="d-flex justify-content-center">
            @foreach ($template as $item)
                <div class="card" style="width: 18rem;">
                    @if (is_null($item->thumb))
                        <img style="width: 300px;height:200px;" src="https://png.pngtree.com/thumb_back/fw800/back_our/20190619/ourmid/pngtree-hand-held-illustration-wedding-wedding-invitation-background-template-image_132223.jpg"
                            class="card-img-top" alt="Card image cap">
                    @else
                        <img style="width: 300px;height:200px;" src="{{ url('/thumb/' . $item->thumb) }}" alt="Card image cap">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ $item->description }}</p>


                        <a href="{{ route('template-details', ['id'=>$item->id  ]) }}" class="btn btn-primary">Customize</a>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            @if (Auth::id())
                                @if (\App\Models\Bookmark::where(['template_id' => $item->id, 'user_id' => Auth::user()->id])->exists())
                                    <button type="button" class="btn btn-info"><i class="fas fa-bookmark"></i></button>
                                @else
                                    <a href="{{ route('add-bookmarks', ['id'=> $item->id ]) }}" class="btn btn-info"><i
                                            class="far fa-bookmark"></i></a>
                                @endif

                                @if (\App\Models\Like_template::where(['template_id' => $item->id, 'user_id' => Auth::user()->id])->exists())
                                    <a href="{{ route('like-template', ['id'=>$item->id]) }}" class="btn btn-danger"><i
                                            class="fas fa-heart"></i></a>
                                @else
                                    <a href="{{ route('like-template', ['id'=>$item->id]) }}" class="btn btn-danger"><i
                                            class="far fa-heart"></i></a>
                                @endif
                            @endif


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#preloaderbody').fadeOut(); // or fade, css //display however you'd like.
            }, 2500);
        });
    </script>
    <script>
        (function($) {

            'use strict';

            var $filters = $('.filter [data-filter]'),
                $boxes = $('.boxes [data-category]');

            $filters.on('click', function(e) {
                e.preventDefault();
                var $this = $(this);

                $filters.removeClass('active');
                $this.addClass('active');

                var $filterColor = $this.attr('data-filter');

                if ($filterColor == 'all') {
                    $boxes.removeClass('is-animated')
                        .fadeOut().promise().done(function() {
                            $boxes.addClass('is-animated').fadeIn();
                        });
                } else {
                    $boxes.removeClass('is-animated')
                        .fadeOut().promise().done(function() {
                            $boxes.filter('[data-category = "' + $filterColor + '"]')
                                .addClass('is-animated').fadeIn();
                        });
                }
            });

        })(jQuery);
    </script>
@endsection

