<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $roles = Role::all();
            return view('profile.index', ['user' => $user, 'roles' => $roles]);
        }

        return redirect()->back()->with('info', [
            'status' => 'warning',
            'pesan' => 'Maaf, anda tidak diizinkan mengakses halaman ini!',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        if ($user) {
            $roles = Role::all();
            return view('profile.edit', ['user' => $user, 'role' => $roles]);
        }

        return redirect()->back()->with('info', [
            'status' => 'warning',
            'pesan' => 'Maaf, anda tidak diizinkan mengakses halaman ini!',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required'],
        ]);

        $userLogin = Auth::user();

        if ($userLogin) {
            $user = User::findOrFail($userLogin->id);
            $user->name = $request->nama;

            if ($user->save()) {
                return redirect()->route('profile.index')->with('info', [
                    'status' => 'success',
                    'pesan' => 'Berhasil mengubah profile!',
                ]);
            } else {
                return redirect()->route('profile.index')->with('info', [
                    'status' => 'warning',
                    'pesan' => 'Telah terjadi kegagalan saat mengubah profile.',
                ]);
            }
        }

        return redirect()->back()->with('info', [
            'status' => 'warning',
            'pesan' => 'Maaf, anda tidak diizinkan mengakses halaman ini!',
        ]);
    }
}
