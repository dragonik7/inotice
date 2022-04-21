<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notice\SubscriberRequest;
use App\Http\Requests\Notice\UserRequest;
use App\Http\Resources\SubscriberResource;
use App\Http\Resources\UserResource;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(UserRequest $request)
    {
        $name = $request->get('name');
        $userList = User::query()->where('name', 'ilike', "$name%")->get();
        return SubscriberResource::collection($userList);
    }

    public function createSub(SubscriberRequest $request)
    {
        $data = $request->input();
        $is_exist = Subscriber::where('subscriber_id', '=', $data['subscriber_id'])
            ->where('user_id', '=', $data['user_id'])
            ->exists();
        if (!$is_exist) {
            Subscriber::create($data);
            return true;
        } else {
            return false;
        }
    }

    public function destroySub(SubscriberRequest $request)
    {
        $data = $request->input();
        $pole = Subscriber::where('subscriber_id', '=', $data['subscriber_id'])
            ->where('user_id', '=', $data['user_id']);
        $is_exist = $pole->exists();
        if ($is_exist) {
            $pole->delete();
            return true;
        } else {
            return false;
        }
    }

    public function detail(Request $request)
    {
        $userId = $request->get('id');
        $user = User::find($userId);
        return new SubscriberResource($user);
    }

    public function update(UserRequest $request)
    {
        $data = $request->input();
        $data['avatar'] = json_encode(env('APP_URL') . '/storage' . $request->file('avatar')
                ->store('avatar_user', 'public'));
        $user = User::find($request->get('id'))->update($data);
        dd($user);
    }
}
