<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notice\FavoriteRequest;
use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    protected $message;

    public function create(FavoriteRequest $request)
    {
        $data = $request->input();
        $data['user_id'] = Auth::id();
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

    public function list()
    {
        $userId = Auth::id();
        $noteslist = Note::query()
            ->rightJoin('favorites', 'notes.id', '=', 'favorites.note_id')
            ->selectRaw("notes.*,case when notes.id = favorites.note_id and favorites.user_id = $userId then true else false end as is_selected")
            ->orderBy('notes.id', 'asc')
            ->get();
        return FavoriteResource::collection($noteslist);
    }
}
