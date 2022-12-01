<?php

namespace App\Http\Controllers\Admin;

use App\Models\Psycholog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PsychologicalTestResult;

class PsychologicalTestResultAdminController extends Controller
{
    public function index(Psycholog $psycholog)
    {
        // dd($psycholog, $psycholog->psychological_test_results);
        return view('admin.psikologi.result', [
            'psycholog' => $psycholog,
        ]);
    }
    public function store(Psycholog $psycholog, Request $request)
    {
        // dd($psycholog->psychological_test_results);
        $request->validate([
            'minimum.*' => 'required|numeric|min:0',
            'maksimum.*' => 'required|numeric|min:0',
            'keterangan.*' => 'required',
        ]);
        try {
            foreach ($psycholog->psychological_test_results as $result) {
                $result->delete();
            }
            foreach ($request->minimum as $key => $req) {
                PsychologicalTestResult::create([
                    'psycholog_id' => $psycholog->id,
                    'uuid' => Str::uuid(),
                    'poin_minimum' => $request->minimum[$key],
                    'poin_maksimum' => $request->maksimum[$key],
                    'keterangan' => $request->keterangan[$key],
                ]);
            }
            return redirect()->route('admin.psycholog.index')->with('success', 'Berhasil submit hasil tes psikolog');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
