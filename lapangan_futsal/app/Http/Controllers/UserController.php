<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('tes.user.index', ['users' => $users]); // arahkan ke halaman data user
    }

    public function create()
    {
        $roles = Role::all();
        return view('tes.user.create', ['roles' => $roles]); // arahkan ke halaman form tambah user
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,',
            'phone_number' => 'required|string|max:15',
            'role_id' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(); // arahkan kembali ke form tambah user
        }

        $validated = $validator->validated();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password' => '112233',
            'role_id' => $validated['role_id']
        ]);
        catat_log('create', 'Membuat user baru');

        return redirect('/users'); // arahkan ke halaman data user
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('tes.user.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'phone_number' => 'required|string|max:15',
            'role_id' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(); // arahkan kembali ke form edit user
        }

        $validated = $validator->validated();

        $user = User::find($id);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'role_id' => $validated['role_id']
        ]);

        catat_log('update', 'Mengubah data user');

        return redirect('/users'); // arahkan ke halaman data user
    }

    public function destroy(string $id)
    {
        if (Auth::id() == $id) {
            return redirect('/users')->with('error', 'Akun diri sendiri tidak dapat dihapus'); // arahkan kembali ke halaman data user dengan pesan bahwa akun diri sendiri tidak dapat dihapus
        }

        $user = User::findOrFail($id);

        try {
            $user->delete();

            catat_log('delete', 'Menghapus data user');

            return redirect('/users')->with('success', 'Data berhasil dihapus'); // arahkan ke halaman data user
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect('/users')->with('error', 'Data tidak dapat dihapus karena memiliki data yang terkait'); // arahkan kehalaman data user dengan pesan bahwa data tidak dapat dihapus karena memiliki data yang terkait
            }

            return redirect('/users')->with('error', 'Ada kesalahan'); // arahkan kehalaman data user dengan pesan bahwa ada kesalahan
        }
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('tes.profile.index', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$user->id",
            'phone_number' => 'required|string|max:15',
            'old-password' => 'nullable',
            'new-password' => 'nullable|min:8',
            'password_confirmation' => 'same:new-password'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(); // arahkan kembali ke halaman profil
        }

        $validated = $validator->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone_number = $validated['phone_number'];

        if ($validated['old-password']) {
            if (!Hash::check($validated['old-password'], $user->password)) {
                return redirect()->back()->with('error', 'Password lama tidak sesuai'); // arahkan kembali ke halaman profil
            }
        }

        if ($validated['new-password']) {
            $user->password = Hash::make($validated['new-password']);
        }

        $user->save();

        catat_log('update', 'Mengubah data profil');

        return redirect()->back()->with('success', 'Data berhasil diperbarui'); // arahkan kembali ke halaman profil
    }
}
