@extends('layouts.main')
@section('content')
    <form method="post" action="{{route('note.store')}}" enctype="multipart/form-data" class="">
        <div class class="flex-column d-sm-flex ">
            @csrf
            <div class="mb-3 align-items-sm-center">
                <div class="text-left"><label class="">Title</label></div>
                <div><input type="text" name="title" class="form-control" id="title"></div>
                @error('title')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3 align-items-sm-center">
                <div class="text-left"><label class="">text</label></div>
                <div><input type="text" name="text" class="form-control" id="text"></div>
                @error('text')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3 align-items-sm-center">
                <div class="text-left"><label class="">Photo</label></div>
                <div><input type="file" name="photos" class="form-control" id="photos"></div>
                @error('photos')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3 align-items-sm-center">
                <div class="text-left"><label class="">Tag</label></div>
                <div><input type="number" name="tag_id" class="form-control" id="tag_id"></div>
                @error('tag_id')
                <p>{{$message}}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{route('note.list')}}"><button type="button"  class="btn btn-secondary">Back</button></a>
    </form>
@endsection
