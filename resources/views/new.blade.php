@extends('layouts.app')

@section('content')
{!! Form::open(['action' => 'ConfessionController@store']) !!}
    <div class="form-group">
        <label for="exampleTextarea">Nickname (Hem cần nhập cũng được :3)</label>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="exampleTextarea">Lời tâm sự của bạn :v</label>
        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Send!', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
@stop