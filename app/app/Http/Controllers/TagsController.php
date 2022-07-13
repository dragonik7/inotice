<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notice\TagRequest;
use App\Http\Resources\TagListResource;
use App\Models\Tag;
use http\Env\Response;
use Illuminate\Http\Request;
use stdClass;

class TagsController extends Controller {
    public function create(Request $request) {

        $stdClass = new stdClass();
        $data = $request->validate([
            'name' => 'string|max:50|required',

        ]);
    }
    public function list() {
        $tagList = Tag::all();

        return TagListResource::collection($tagList);
    }
    public function detail($tagName){

        return Tag::query()->where('name','=',$tagName)->get();
    }
}
