<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notice\FavoriteRequest;
use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;


class FavoriteController extends Controller
{
    protected $message;

    public function create(FavoriteRequest $request)
    {
        $data = $request->input();
        $is_exist = Favorite::where('note_id', '=', $data['note_id'])
            ->where('user_id', '=', $data['user_id'])
            ->exists();
        if (!$is_exist) {
            Favorite::create($data);
            $this->message = 'Добавлен';
            return true;
        } else {
            $this->message = 'уже создан';
            return false;
        }

    }

    public function list(FavoriteRequest $request)
    {
        $data = $request->get('user_id');
        $noteslist = Note::query()
            ->leftJoin('favorites', 'notes.id', '=', 'favorites.note_id')
            ->selectRaw("notes.*,case when notes.id = favorites.note_id and favorites.user_id = $data then true else false end as is_selected")
            ->orderBy('notes.id', 'asc')
            ->get();
//        dd($noteslist);
        return FavoriteResource::collection($noteslist);
    }
}
