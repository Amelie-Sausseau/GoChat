<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     * @return \App\Models\User
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editUser()
    {
        return view('auth.modify');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $updateUser = User::findOrFail($id);

        $this->validate($request, [
            "pseudo" => 'required|string',
            "email" => 'required|email'
        ]);

        $updateUser->update([
            'pseudo' => $request->pseudo,
            'email' => $request->email,
        ]);

        return back()
            ->with('success', 'Les informations ont bien été modifiées');
    }

}
