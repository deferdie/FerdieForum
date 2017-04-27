@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Thread</div>

                <div class="panel-body">
                    <form method="post" action="/threads">
                        {{csrf_field()}}
    
                        <div class="form-group">
                            <label for="channel_id">Choose a Channel</label>
                            <select name="channel_id" id="channel_id" class="form-control" required>
                                @foreach($channels as $channel)
                                    <option value="{{$channel->id}}" {{old('channel_id') == $channel->id ? 'selected' : ''}}>
                                        {{$channel->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Title" value="{{ old('title') }}" required />
                        </div>

                        <div class="form-group">
                            <textarea type="text" name="body" class="form-control" placeholder="Body" rows="5" required>{{ old('body') }}</textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" role="button" type="submit">
                                Create
                            </button>
                        </div>
                    </form>

                    <div class="col-md-12">
                        @if(count($errors))
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{$error}}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
