<div class="panel panel-default">
    <div class="panel-heading">
{{--         <a href="">
        {{ $reply->owner->name }}
        </a> said {{ $reply->created_at->diffForHumans() }} --}}
        <div class="level">
        <h5 class="flex">
            <a href="">
            {{ $reply->owner->name }}
            </a> said {{ $reply->created_at->diffForHumans() }} ...
        </h5>

            <div>
                <form action="/replies/{{ $reply->id }}/favorites" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-primary" type="submit" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                    {{ $reply->favorites()->count() }}   {{ str_plural('  favorite', $reply->favorites()->count()) }}
                    </button>

                </form>
            </div>
        </div>
    </div>
    <div class="panel-body">
        {{  $reply->body }}
    </div>
</div>
