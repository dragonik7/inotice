@extends('layouts.main')
@section('content')
    <form method="post" action="{{route('note.store')}}" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Title</label>
            <input value="" type="text" name="title">
            @error('title')
            <p>{{$message}}</p>
            @enderror
        </div>
        <div>
            <label>Text</label>
            <input value="" type="text" name="text">
            @error('text')
            <p>{{$message}}</p>
            @enderror
        </div>
        <div>
            <label>photo</label>
            <input value="" type="file" name="photos">
            @error('photos')
            <p>{{$message}}</p>
            @enderror
        </div>
        <div>
            <label>tag_id</label>
            <input value="" type="text" name="tag_id">
            @error('tag_id')
            <p>{{$message}}</p>
            @enderror
        </div>
        <button type="submit">Create</button>
    </form>
@endsection

