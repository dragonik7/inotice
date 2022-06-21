@extends('layouts.main')
@section('content')
    <head>
        <meta name="csrf-token" content="{{csrf_token()}}">
    </head>
    <form method="post" action="{{route('user.registration')}}" enctype="multipart/form-data" class="">
        <div class class="flex-column d-sm-flex ">
            @csrf
            <div class="mb-3 align-items-sm-center">
                <div class="text-left"><label class="">Name</label></div>
                <div><input type="text" name="name" class="form-control" id="name"></div>
                @error('name')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3 align-items-sm-center">
                <div class="text-left"><label class="">Email</label></div>
                <div><input type="email" name="email" class="form-control" id="email"></div>
                @error('email')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3 align-items-sm-center">
                <div class="text-left"><label class="">Avatar</label></div>
                <div><input type="file" name="avatar" class="form-control" id="avatar"></div>
                @error('avatar')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3 align-items-sm-center">
                <div class="text-left"><label class="">Password</label></div>
                <div><input type="password" name="password" class="form-control" id="password"></div>
                @error('password')
                <p>{{$message}}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success">Register</button>
        <a href="{{route('note.list')}}">
            <button type="button" class="btn btn-secondary">Back</button>
        </a>
    </form>
@endsection
