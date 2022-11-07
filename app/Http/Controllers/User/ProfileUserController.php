<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileUserController extends Controller
{
    public function index()
    {
        return view('user.pengaturan.profile');
    }
    public function store(Request $request)
    {
        auth('user')->user()->foto == null ? $rule = 'required' : $rule = 'nullable';
        $request->validate([
            'foto' => $rule . '|image|mimes:png,jpg,jpeg,gif|max:5000',
            'nama' => 'required',
            'email' => 'required'
        ]);
        // dd($request->all());
        try {
            if ($request->hasFile('foto')) {
                if (auth('user')->user()->foto != null) @unlink(public_path(auth('user')->user()->foto));
                $ext = $request->file('foto')->extension();
                $imageName = 'user-' . time() . '.' . $ext;
                // dd($imageName);
                $store = $request->file('foto')->storeAs('public/img/user', $imageName);
                $path = Storage::url($store);
            }else {
                $path = auth('user')->user()->foto;
            }
            auth('user')->user()->update([
                'foto' => $path,
                'nama' => $request->nama,
                'email' => $request->email
            ]);
            return redirect()->route('user.pengaturan.profil.index')->with('success', 'Berhasil mengubah profil!');
        } catch (\Throwable $th) {
            return redirect()->route('user.pengaturan.profil.index')->with('error', 'Gagal mengubah profil! ' . $th->getMessage());
        }
    }
    public function setAccount(Request $request)
    {
        $valid = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed'
        ], [
            'old_password.required' => 'Password lama harus di isi!',
            'new_password.required' => 'Password baru harus di isi!',
            'new_password.min' => 'Password baru minimal 8 karakter!',
            'new_password.confirmed' => 'Konfirmasi Password tidak sama!',
        ]);
        $profil = auth('user')->user();
        if (!Hash::check($valid['old_password'], $profil->password)) {
            return back()->withErrors(['old_password' => 'Password lama anda salah!']);
        }
        try {
            $profil->update([
                'password' => bcrypt($valid['new_password'])
            ]);
            return redirect()->route('user.pengaturan.profil.index')->with('success', 'Berhasil mengubah password!');
        } catch (\Throwable $th) {
            return redirect()->route('user.pengaturan.profil.index')->with('danger', 'Berhasil mengubah password! ' . $th->getMessage());
        }
    }
}
