<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use App\Http\Requests\Notice\CreateTagRequest;
use App\Http\Resources\TagListResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{

    protected $stdClass;

    public function __construct(){
        $this->stdClass = new \stdClass();

    }



    public function create(CreateTagRequest $request){

        $stdClass = new \stdClass();
        $data = $request->input();

        $newTagObj = Tag::query()
            ->create($data);

        if ($newTagObj->exists()){

            $this->stdClass->message = 'Успешно создано';
            return $this->stdClass;
        }

        $this->stdClass->message = 'Ошибка создания';
        return $this->stdClass;

    }



    public function list(Request $request){
        $userId = $request->get('user_id');


        $tagList = Tag::query()
            ->where('user_id', $userId)
            ->get();

        return TagListResource::collection($tagList);

    }
}
