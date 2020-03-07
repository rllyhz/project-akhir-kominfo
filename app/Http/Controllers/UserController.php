<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.users.index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->nama;
        $user->role_id = intval($request->role);

        if ($user->save()) {
            return redirect()->route('admin.manage.users.index')->with('info', [
                'status' => 'success',
                'pesan' => 'Berhasil mengubah data user!',
            ]);
        } else {
            return redirect()->route('admin.manage.users.index')->with('info', [
                'status' => 'warning',
                'pesan' => 'Telah terjadi kesalahan saat mengubah data user!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return redirect()->route('admin.manage.users.index')->with('info', [
                'status' => 'success',
                'pesan' => 'Berhasil menghapus data user!',
            ]);
        } else {
            return redirect()->route('admin.manage.users.index')->with('info', [
                'status' => 'warning',
                'pesan' => 'Gagal nenghapus data user!',
            ]);
        }
    }
}
