<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {!! Html::style('css/app.css') !!}
    {!! Html::script('js/app.js') !!}
</head>
<body>
    <div class="container">
        <div class="row">
            @if ($errors->any() || session()->has('message') || session()->has('error'))
                <div class="alert alert-dismissible {{ session()->has('message') ? 'alert-success' : 'alert-danger' }}" id="alert-message">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    @foreach ($errors->all() as $message)
                        <p>{!! $message !!}</p>
                    @endforeach
                    @if (session()->has('message'))
                        <p>{!! session('message') !!}</p>
                    @endif
                    @if (session()->has('error'))
                        <p>{!! session('error') !!}</p>
                    @endif
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>