<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\notice\CreateNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CreateNoteRequest $request)
    {
        $data = $request->validated();
        Note::create($data);
    }
}
