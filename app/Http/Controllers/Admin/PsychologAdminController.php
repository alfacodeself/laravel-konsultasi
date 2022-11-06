<?php

namespace App\Http\Controllers\Admin;

use App\Models\Psycholog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PsychologRequest;
use Illuminate\Support\Facades\Storage;

class PsychologAdminController extends Controller
{
    public function index()
    {
        $psychologs = Psycholog::withCount('questions', 'psycholog_users')->get();
        // dd($psychologs);
        return view('admin.psikologi.index', compact('psychologs'));
    }
    public function store(PsychologRequest $request)
    {
        try {
            $ext = $request->file('gambar')->extension();
            $imageName = 'psycholog-thumb-' . time() . '.' . $ext;
            $store = $request->file('gambar')->storeAs('public/img/psycholog', $imageName);
            $path = Storage::url($store);

            Psycholog::create([
                'uuid' => Str::uuid(),
                'gambar' => $path,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'status' => 'aktif',
                'harga' => $request->harga
            ]);

            return redirect()->route('admin.psycholog.index')->with('success', 'Berhasil menambah tes psikologi baru');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menambah tes psikologi baru!' . $th->getMessage());
        }
    }
    public function update(Psycholog $psycholog, PsychologRequest $request)
    {
        try {
            if ($request->hasFile('gambar')) {
                if ($psycholog->gambar != null) @unlink(public_path($psycholog->gambar));
                $ext = $request->file('gambar')->extension();
                $imageName = 'psycholog-thumb-' . time() . '.' . $ext;
                $store = $request->file('gambar')->storeAs('public/img/psycholog', $imageName);
                $path = Storage::url($store);
            }else {
                $path = $psycholog->gambar;
            }
            $psycholog->update([
                'gambar' => $path,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga
            ]);
            return redirect()->route('admin.psycholog.index')->with('success', 'Berhasil mengubah tes psikologi');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal mengubah tes psikologi!' . $th->getMessage());
        }
    }
    public function status(Psycholog $psycholog)
    {
        try {
            $psycholog->status == 'aktif' ? $data = 'nonaktif' : $data = 'aktif';
            $psycholog->updateOrFail(['status' => $data]);
            return redirect()->route('admin.psycholog.index')->with('success', 'Berhasil mengubah status tes psikologi');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal mengubah status tes psikologi!' . $th->getMessage());
        }
    }
}
