@extends('layouts.main')
@section('content')
    <div>
        <div><h1>{{$note->title}}</h1></div>
        <div><p>{{$note->text}}</p></div>
        <div><p>Создатель: {{$userName}}</p></div>
        <div><p>Тег: {{$tagName}}</p></div>
        <div class="m0-auto flex-row">
            @for($i=0; $i < count($note->photos);$i++)
                <div class="mx-sm-4"><img src="{{$note->photos["$i"]}}" height="400px" width="400px"></div>
            @endfor
        </div>
    </div>
@endsection
