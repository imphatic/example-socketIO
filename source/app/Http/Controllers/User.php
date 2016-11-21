<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    /**
     * @return mixed
     *
     * returns the name of the user or null
     */
    public static function getUserName()
    {
        return session('user');
    }

    /**
     * @param Request $request
     * @return redirect headers
     *
     * sets the username and redirects to chat
     */
    public function setUserName(Request $request)
    {
        session(['user' => $request->input('name')]);

        return redirect('/');
    }
}
