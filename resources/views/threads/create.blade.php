@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a Thread </div>

                <div class="panel-body">
                    <form method="POST" action="/threads">
                        {{ csrf_field() }}
                        <!-- Channel_id Form Input -->
                            <div class="form-group">
                                <label for="channel_id">Choose a Channel </label>
                                <select required class="form-control" id="channel_id" name="channel_id">
                                    <option value="">Choose one...</option>
                                    @foreach($channels as $channel )
                                        <option value="{{ $channel->id  }}" {{ old('channel_id') == $channel->id ? 'selected' : ''  }}> {{ $channel->name  }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Title Form Input -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input required value="{{ old('title') }}" type="text" class="form-control" id="title" name="title" placeholder="your Title">
                        </div>
                        <!-- Body Form Input -->
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea required name="body" id="body" class="form-control" placeholder="Have something to say?" rows="8">{{ old('body') }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </div>
                        @if ( count($errors) )
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
