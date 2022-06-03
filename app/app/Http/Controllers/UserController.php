<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notice\SubscriberRequest;
use App\Http\Resources\SubscriberResource;
use App\Http\Resources\UserResource;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'name' => 'string|max:50|required',
            'email' => 'email|required',
            'password' => 'string|min:8|required'
        ]);
        if (User::query()->where('email', $data['email'])->exists()){
            redirect(route('user.registration'))->withErrors([
                'email' => 'Такой пользователь зарегестрирован',
            ]);
        }
        $data['password'] = Hash::make($data['password']);
        $data['remember_token'] = Str::random(10);
        $data['avatar'] = json_encode(env('APP_URL') . '/storage' . $request->file('avatar')
                ->store('avatar_user', 'public'));
        $user = User::create($data);
        if ($user){
            Auth::login($user);
            return redirect()->route('note.list');
        }
        return redirect(route(('user.login')))->withErrors([
            'formErrors'=>'Произошла ошибка при сохранении пользователя'
        ]);
    }

    public function login(Request $request)
    {
        $formData = $request->only([
            'email',
            'password',
        ]);


        if (Auth::attempt($formData)) {
            $qwer = Auth::user();
            return redirect()->intended(route('note.list'));
        }else {
            throw ValidationException::withMessages([
                'email' => ['Неправильный email'],
                'password' => ['Неправильный password'],
            ]);
        }
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('user.login'));

    }
}
