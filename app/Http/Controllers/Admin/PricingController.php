<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pricing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PricingRequest;

class PricingController extends Controller
{
    public function index()
    {
        $pricings = Pricing::query();
        if (request()->has('search')) {
            $pricings = $pricings->where('nama_paket', 'like', '%' . request()->search . '%');
        }
        $pricings = $pricings->get()->map(function($paket){
            $paket->fitur_paket = explode('|', $paket->fitur_paket);
            return $paket;
        });
        return view('admin.paket.index', compact('pricings'));
    }
    public function store(PricingRequest $request)
    {
        try {
            Pricing::create([
                'uuid' => Str::uuid(),
                'nama_paket' => $request->nama_paket,
                'sesi' => $request->sesi,
                'harga_paket' => $request->harga_paket,
                'fitur_paket' => implode('|', $request->fitur)
            ]);
            return redirect()->route('admin.pricing.index')->with('success', 'Berhasil membuat paket sesi baru.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.pricing.index')->with('error', 'Gagal membuat paket sesi baru!' . $th->getMessage());
        }
    }
    public function update(Pricing $pricing, PricingRequest $request)
    {
        try {
            $pricing->update([
                'nama_paket' => $request->nama_paket,
                'sesi' => $request->sesi,
                'harga_paket' => $request->harga_paket,
                'fitur_paket' => implode('|', $request->fitur)
            ]);
            return redirect()->route('admin.pricing.index')->with('success', 'Berhasil mengubah paket sesi.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.pricing.index')->with('error', 'Gagal mengubah paket sesi!' . $th->getMessage());
        }
    }
    public function destroy(Pricing $pricing)
    {
        try {
            $pricing->status == 'aktif' ? $data = 'nonaktif' : $data = 'aktif';
            $pricing->updateOrFail(['status' => $data]);
            return redirect()->route('admin.pricing.index')->with('success', 'Berhasil mengubah status paket sesi.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.pricing.index')->with('error', 'Gagal mengubah status paket sesi!' . $th->getMessage());
        }
    }
}
