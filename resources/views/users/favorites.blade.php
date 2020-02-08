@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            @include('users.card', ['user' => $user])
        </aside>
        <div class="col-sm-8">
            @include('users.navtabs', ['user' => $user])
            @if (count($favorites) > 0)
                <ul class="list-unstyled">
                    @foreach ($microposts as $micropost)

                        <li class="media">
                            <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
                            <div class="media-body">
                                <div>
                                    {!! link_to_route('users.show', $micropost->user->name, ['id' => $micropost->user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                                </div>
                                <div>
                                    <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                                </div>
                                <div>
                                    <p>{!! link_to_route('users.show', 'View profile', ['id' => $user->id]) !!}</p>
                                </div>
                                <div class="btn-group">
                                    <div class="mr-1">
                                        {!! Form::open(['route' => ['favorites.removeFavorite', $micropost->id], 'method' => 'delete']) !!}
                                            {!! Form::submit('Unfavorite', ['class' => 'btn btn-success btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                    <div>
                                        @if (Auth::id() == $micropost->user_id)
                                            {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>

                    @endforeach
                </ul>
                {{ $favorites->links('pagination::bootstrap-4') }}
            @endif
        </div>
    </div>
@endsection