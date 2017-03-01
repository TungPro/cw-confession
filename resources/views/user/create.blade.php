@extends('layouts.app')

@section('content')
{!! Form::open(['action' => ['UserController@store'] , 'method' => 'POST']) !!}
    <div class="form-group">
        <label for="exampleTextarea">Tên</label>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="exampleTextarea">Email</label>
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="exampleTextarea">Mật khẩu</label>
        {!! Form::text('password', null, ['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
@stop