@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                <a href="#">{{$thread->creator->name}}</a> posted: 
                    {{process($thread->title, $thread->variables)}}
                </div>

                <div class="panel-body">
                    <div class="body">{{ process($thread->body, $thread->variables) }}</div>
                </div>
            </div>

            @foreach($replies as $reply)
                @include('partials.reply')
            @endforeach

            {!!$replies->links()!!}

            @if(auth()->check())
                <form method="POST" action="{{ $thread->path().'/replies'}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input class="form-control" name="body" id="body" placeholder="Say something..." rows="5" />
                    </div>
                    <div class="form-group">
                        <button type="submit" role="button" class="btn btn-default">
                            Submit
                        </button>
                    </div>   

                </form>
                @else
                <p>
                    Please signin to post
                </p>
            @endif
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>
                        This thread was published {{$thread->created_at->diffForHumans()}} by
                        <a href="#">{{$thread->creator->name}}</a> and currently has {{$thread->replies_count}} {{str_plural('comment', $thread->replies_count)}}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
