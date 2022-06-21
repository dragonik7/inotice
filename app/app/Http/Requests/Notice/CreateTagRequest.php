<?php

namespace App\Http\Requests\Notice;

use App\Http\Requests\ApiRequest;

class CreateTagRequest extends ApiRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'string|max:50|required',
            'user_id' => 'integer|exists:users,id|required'
        ];
    }
}
