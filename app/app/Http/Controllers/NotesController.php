<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notice\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotesController extends Controller
{
    protected $message;

    public function list(NoteRequest $request)
    {
        $userId = $request->get('user_id');
        $noteslist = Note::query()->where('user_id', $userId)->get();
        return NoteResource::collection($noteslist);
    }

    public function detail(NoteRequest $request)
    {
        $noteId = $request->get('id');
        $note = Note::find($noteId);
        return new NoteResource($note);
    }

    public function store(NoteRequest $request)
    {
//        dd($request->photos[1]);
        $data = $request->input();
        foreach ($request->file('photos') as $photo) {
            $paths[] = env('APP_URL') . 'storage/' . $photo->store('photos_notes', 'public');
        }
        $data['photos'] = json_encode($paths);
        Note::create($data);
    }

    public function update(NoteRequest $request)
    {
        $data = $request->input();
        Note::find($request->get('id'))->update($data);

    }

    public function destroy(NoteRequest $request)
    {
        $note = $request->get('id');
        Note::find($note)->delete();
    }
}
