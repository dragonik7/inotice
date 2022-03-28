@extends('layouts.main')
@section('content')
    @foreach($notes as $note)
        <div>
            <div>{{$note->title}}</div>
            <div>{{$note->text}}</div>
            <div><img src="{{$note->image}}" height="200px" width="200px"></div>
        </div>
    @endforeach
@endsection
