<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PasienAdminController extends Controller
{
    public function index()
    {
        $pasien = User::paginate(10);
        return view('admin.user.index', compact('pasien'));
    }
    public function store(UserRequest $request)
    {
        try {
            if ($request->hasFile('foto')) {
                $ext = $request->file('foto')->extension();
                $imageName = 'user-' . time() . '.' . $ext;
                $store = $request->file('foto')->storeAs('public/img/user', $imageName);
                $path = Storage::url($store);
            }else {
                $path = null;
            }
            User::create([
                'uuid' => Str::uuid(),
                'foto' => $path,
                'nama' => $request->nama,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => bcrypt($request->password)
            ]);
            return redirect()->route('admin.pasien.index')->with('success', 'Berhasil menambahkan pasien!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.pasien.index')->with('error', 'Gagal menambahkan pasien! ' . $th->getMessage());
        }
    }
    public function update(User $user, Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);
        try {
            $user->update(['password' => bcrypt($request->password)]);
            return redirect()->route('admin.pasien.index')->with('success', 'Berhasil mengganti password akun pasien!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.pasien.index')->with('error', 'Gagal mengganti password akun pasien! ' . $th->getMessage());
        }
    }
    public function destroy(User $user)
    {
        try {
            if ($user->foto != null) @unlink(public_path($user->foto));
            foreach ($user->psycholog_users as $psycholog_user) {
                $psycholog_user->delete();
            }
            $user->delete();
            return redirect()->route('admin.pasien.index')->with('success', 'Berhasil menghapus akun pasien!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.pasien.index')->with('error', 'Gagal menghapus akun pasien! ' . $th->getMessage());
        }
    }
}
