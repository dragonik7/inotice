<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notice\User\LoginRequest;
use App\Http\Requests\Notice\User\RegistrationRequest;
use App\Http\Resources\SubscriberResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller {
    public function search(Request $request) {
        $name = $request->get('name');
        $userList = User::query()->where('name', 'ilike', "%$name%")->get();
        return SubscriberResource::collection($userList);
    }

    public function detail(Request $request) {
        $userId = $request->get('id');
        $user = User::find($userId);
        return new SubscriberResource($user);
    }

    public function update(Request $request) {
        $data = $request->validate([
            'name' => 'String|max:50',
            'email' => 'Email',
            'avatar' => 'Image',
            'password' => 'Current_password'
        ]);
        $data['avatar'] = json_encode('/storage' . $request->file('avatar')
                ->store('avatar_user', 'public'));
        $user = User::find($request->get('id'))->update($data);
        return new UserResource($user);
    }

    public function reg() {
        if (Auth::check()) {
            return redirect(route('note.list'));
        }
        return view('user.registration');
    }

    public function registration(RegistrationRequest $request) {
        $data = $request->validated();
        if (User::query()->where('email', $data['email'])->exists()) {
            redirect(route('user.registration'))->withErrors([
                'email' => 'Такой пользователь зарегестрирован',
            ]);
        }
        $data['password'] = Hash::make($data['password']);
        $data['remember_token'] = Str::random(10);
        $data['avatar'] = json_encode('storage/' . $request->file('avatar')
                ->store('avatar_user', 'public'));
        $data['role_id'] = User::ROLE_USER;
        $user = User::create($data);
        if ($user) {
            Auth::login($user);
            return redirect()->route('note.list');
        }
        return redirect(route(('user.login')))->withErrors([
            'formErrors' => 'Произошла ошибка при сохранении пользователя'
        ]);
    }


    public function auth() {
        if (Auth::check()) {
            return redirect(route('note.list'));
        }
        return view('user.auth');
    }

    public function login(LoginRequest $request) {
        $data = $request->only(['email', 'password']);
        if (!Auth::attempt($data)) {
            return response()->json('Credentials not match', 401);
        }
        return redirect(route('note.list',))->withCookie('token', Auth::user()->createToken($data['email'])->plainTextToken,50000);
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('user.auth'));
    }
}
