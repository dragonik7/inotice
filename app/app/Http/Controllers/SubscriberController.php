<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notice\SubscriberRequest;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller {
    public function createSub(SubscriberRequest $request) {
        $data = $request->input();
        $data['subscriber_id'] = Auth::id();
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

    public function destroySub(SubscriberRequest $request) {
        $data = $request->input();
        $data['subscriber_id'] = Auth::id();
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
}
