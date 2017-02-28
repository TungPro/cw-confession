@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Action</th>
                <th>ID</th>
                <th>Name</th>
                <th>Content</th>
                <th>Created At</th>
                @if(Auth::user()->email == 'mr.nttung@gmail.com')
                    <th>IP</th>
                    <th>Agent</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($confessions as $confession)
                <tr>
                    <td>
                        @if (!$confession->status)
                        <a href="{{ action('ListController@send', [$confession->id]) }}" onclick="return confirm('Are you sure?');">
                            <i class="glyphicon glyphicon-send" aria-hidden="true"></i>
                        </a>
                        @else
                            <i class="glyphicon glyphicon-ok" aria-hidden="true"></i>
                        @endif
                            &nbsp;&nbsp;
                        <a href="{{ action('ListController@delete', [$confession->id]) }}" onclick="return confirm('Are you sure?');">
                            <i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td scope="row">{{ $confession->id }}</td>
                    <td>{{ $confession->name }}</td>
                    <td>{{ $confession->content }}</td>
                    <td>{{ $confession->created_at }}</td>
                    @if(Auth::user()->email == 'mr.nttung@gmail.com')
                        <td>{{ $confession->ip }}</td>
                        <td>{{ $confession->agent }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>


    {{ $confessions->links() }}
@endsection
