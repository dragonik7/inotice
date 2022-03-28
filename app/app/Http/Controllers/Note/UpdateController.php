<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notice\UpdateNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateNoteRequest $request, Note $note)
    {
        $data = $request->validated();
        $note->update($data);
    }
}
