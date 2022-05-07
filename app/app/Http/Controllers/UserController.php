<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notice\SubscriberRequest;
use App\Http\Resources\SubscriberResource;
use App\Http\Resources\UserResource;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->get('name');
        $userList = User::query()->where('name', 'ilike', "%$name%")->get();
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

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|max:50',
            'email' => 'email',
            'avatar' => 'image',
            'password' => 'current_password'
        ]);
        $data['avatar'] = json_encode(env('APP_URL') . '/storage' . $request->file('avatar')
                ->store('avatar_user', 'public'));
        $user = User::find($request->get('id'))->update($data);
        return new UserResource($user);
    }

    public function registration(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|max:50',
            'email' => 'email',
            'password' => 'string|min:8'
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['remember_token'] = Str::random(10);
        $data['avatar'] = json_encode(env('APP_URL') . '/storage' . $request->file('avatar')
                ->store('avatar_user', 'public'));
        $user = User::create($data);
        return new UserResource($user);
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Неправильный email'],
            ]);
        }
        return $user->createToken($request->device_name)->plainTextToken;
//        $credentials = $request->validate([
//            'email' => ['required', 'email'],
//            'password' => 'required',
//        ]);
//        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
//            $user = Auth::user();
//            $user->createToken($credentials['password']);
//            return new UserResource($user);
//        }
    }
}
