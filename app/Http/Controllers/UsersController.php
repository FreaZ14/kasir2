<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $users = Users::all();
        return view('pages.users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ];

        $messages = [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter'
        ];

        $request->validate($rules, $messages);

        $datarow = $request->all();

        $datarow['password'] = bcrypt($request->password);

        $user = Users::create($datarow);
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(Users $user)
    {
        return view('pages.users.edit', [
            'users' => $user
        ]);
    }

    public function update(Request $request, Users $user)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6'
        ];

        $messages = [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email sudah digunakan',
            'password.min' => 'Password minimal 6 karakter'
        ];

        $request->validate($rules, $messages);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy(Users $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
