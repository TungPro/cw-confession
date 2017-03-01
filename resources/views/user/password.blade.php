@extends('layouts.app')

@section('content')
{!! Form::open(['action' => ['UserController@savePassword', $user->id] , 'method' => 'POST']) !!}
    <div class="form-group">
        <label for="exampleTextarea">Mật khẩu mới</label>
        {!! Form::text('password', null, ['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
@stop