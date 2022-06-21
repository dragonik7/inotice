<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">Notes</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('note.list')}}">List</a></li>
                        <li><a class="dropdown-item" href="{{route('note.create')}}">Create new</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{Str::words(\Illuminate\Support\Facades\Auth::user()->name, 2,'')}}
                            <img src="{{\Illuminate\Support\Facades\Auth::user()->avatar}}" class="rounded-3"
                                 height="30px" width="30px">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('user.logout')}}">Logout</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item ms-auto">

                    </li>
                    <li class="nav-item ms-auto">

                    </li>
                @else
                    <li class="nav-item ms-auto"><a class="navbar-text nav-link active" href="{{route('user.login')}}">
                            <button class="btn btn-primary">login</button>
                        </a></li>
                    <li class="nav-item ms-auto"><a class="navbar-text nav-link active" href="{{route('user.reg')}}">
                            <button class="btn btn-primary">Sing up</button>
                        </a></li>
                @endif
            </ul>
        </div>
    </nav>
    @yield('content')
</div>
</body>
</html>
