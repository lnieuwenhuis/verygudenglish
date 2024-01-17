<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function score(Request $request)
    {
//        dd($request);

        if (!$request->user_id) {
            return response(null, 204);
        }

        return response(null, 204);

        $user = User::findOrFail($request->get('user_id'));
    }
}
