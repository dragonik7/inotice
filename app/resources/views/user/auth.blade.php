@extends('layouts.main')
@section('content')
    <form method="post" action="{{route('user.auth')}}" enctype="multipart/form-data" class="">
        <div class class="flex-column d-sm-flex ">
            @csrf
            <div class="mb-3 align-items-sm-center">
                <div class="text-left"><label class="">Email</label></div>
                <div><input type="email" name="email" class="form-control" id="email"></div>
                @error('email')
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
        <button type="submit" class="btn btn-success">Login</button>
        <a href="{{route('note.list')}}">
            <button type="button" class="btn btn-secondary">Back</button>
        </a>
    </form>
    <script>
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.post('/user/login', {email: this.email, password: this.password}).then(r =>
                console.log(r)
            );
        });
    </script>
@endsection
