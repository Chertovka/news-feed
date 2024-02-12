<?php

namespace App\Http\Controllers\LK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view("lk.auth.login");
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => ["required", "email", "string"],
            "password" => ["required"]
        ]);

        if (auth("lk")->attempt($data)) {
            return redirect(route("lk.comments.index"));
        }

        return redirect(route("lk.login"))->withErrors(["email" => "Пользователь не найден, либо данные введены не верно"]);
    }

    public function logout()
    {
        auth("lk")->logout();

        return redirect(route("home"));
    }
}
