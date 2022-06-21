@extends('layouts.main')
@section('content')
    <div>
        <div><h1>{{$note->title}}</h1></div>
        <div><p>{{$note->text}}</p></div>
        <div><p>Создатель: {{$userName}}</p></div>
        <div><p>Тег: {{$tagName}}</p></div>
        <div class="m0-auto flex-row">
            @foreach($note->photos as $photo)
                <div class="mx-sm-4"><img src="{{$photo}}" height="400px" width="400px"></div>
            @endforeach
        </div>
        <div class=''>
            <a href="{{route('note.list')}}">
                <button class="btn btn-secondary">
                    back
                </button>
            </a>
            <a href="{{route('note.edit',['id'=>$note->id])}}">
                <button class="btn btn-primary">
                    edit
                </button>
            </a>
            <a href="{{route('note.destroy',['id'=>$note->id])}}">
                <button class="btn btn-danger">
                    delete
                </button>
            </a>
        </div>
    </div>
@endsection
