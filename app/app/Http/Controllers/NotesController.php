<?php

namespace App\Http\Controllers;

use App\Http\Filters\NoteFilter;
use App\Http\Requests\Notice\FilterNoteRequest;
use App\Http\Requests\Notice\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller {
    protected $message;

    public function list() {
        $notesList = Note::paginate(12);
        return view('note.list', compact('notesList'));
    }

    public function detail(NoteRequest $request) {
        $noteId = $request->get('id');
        $note = Note::find($noteId);
        $userName = $note->users->name;
        $tagName = $note->tags->name;
        $note = new NoteResource($note);
        return view('note.detail', compact('note', 'userName', 'tagName'));
    }

    public function store(NoteRequest $request) {
        $data = $request->input();
        if ($request->hasFile('photos')) {
            $paths = array();
            foreach ($request->file('photos') as $photo) {
                $paths[] = 'storage/' . $photo->store('photos_notes', 'public');
            }
            $data['photos'] = json_encode($paths);
        }
        $data['user_id'] = Auth::id();
        Note::create($data);
        return redirect()->route('note.list');
    }

    public function create() {
        $tags = Tag::all();
        return view('note.create', compact('tags'));
    }

    public function edit(NoteRequest $request) {
        $tags = Tag::all();
        $post = Note::find($request->get('id'));
        return view('post.edit', compact('tags', 'post'));
    }

    public function update(NoteRequest $request) {
        $data = $request->input();
        Note::find($request->get('id'))->update($data);

    }

    public function destroy(NoteRequest $request) {
        $note = $request->get('id');
        Note::find($note)->delete();
    }

    public function filter(FilterNoteRequest $request) {
        $data = $request->input();
        $filter = app()->make(NoteFilter::class, ['queryParams' => array_filter($data)]);
        $note = Note::filter($filter)->get();
        dd($note);
    }
}
