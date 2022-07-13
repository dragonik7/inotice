@extends('layouts.main')
@section('content')
    <div class="">
        <div class="d-sm-grid-col3">
            @foreach ($notesList as $note)
                <div class="col mb-3 list-group">
                    <a href="{{route('note.detail',['id'=>$note->id])}}" class="">
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
                            @if(count($note->photos)>0)
                                <img src="{{$note->photos[0]}}" height="200px" width="200px">
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="">{{$notesList->links()}}</div>
    </div>
@endsection
