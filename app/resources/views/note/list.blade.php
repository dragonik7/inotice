@extends('layouts.main')
@section('content')
<div class="">
    <div class="d-sm-grid-col3">
        @foreach ($notesList as $note)

            <div class="col mb-3 list-group">
                <a href="{{route('note.detail',['id'=>$note->id])}}" class="btn">
                    <div class="text-center ">
                        <h4>
                            {{Str::limit($note->title,15)}}
                        </h4>
                    </div>
                    <div class="text-center">
                        <p>
                            {{Str::limit($note->text, 20)}}
                        </p>
                    </div>
                    <div class="m0-auto flex-column">
                        <img src="{{$note->photos["0"]}}" height="200px" width="200px">
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
