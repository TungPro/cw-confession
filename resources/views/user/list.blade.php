@extends('layouts.app')

@section('content')

    <a href="{{ action('UserController@create') }}" class="btn btn-primary">Tạo tài khoản</a> <br/>
    <table class="table">
        <thead>
            <tr>
                <th>Action</th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <a href="{{ action('UserController@changePassword', [$user->id]) }}">
                            <span class="glyphicon glyphicon-lock"></span>
                        </a>
                    </td>
                    <td scope="row">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href="{{ action('UserController@status', [$user->id]) }}" onclick="return confirm('Bạn có chắc không đấy?');">
                        @if ($user->active)
                            <span class="label label-success">Activated</span>
                        @else
                            <span class="label label-warning">Not activated</span>
                        @endif
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    {{ $users->links() }}
@endsection
