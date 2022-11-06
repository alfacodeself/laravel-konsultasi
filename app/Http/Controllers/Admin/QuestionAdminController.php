<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Psycholog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionAdminController extends Controller
{
    public function index(Psycholog $psycholog)
    {
        return view('admin.psikologi.show', [
            'questions' => $psycholog->questions->load('answers'),
            'psycholog_id' => $psycholog->uuid,
            'psycholog' => $psycholog->judul
        ]);
    }
    public function create(Psycholog $psycholog)
    {
        return view('admin.psikologi.create', ['psycholog_id' => $psycholog->uuid]);
    }
    public function store(Request $request, Psycholog $psycholog)
    {
        $request->validate([
            'pertanyaan' => 'required',
        ]);
        foreach ($request->jawaban as $key => $jawaban) {
            if ($jawaban == null) {
                return back()->withErrors(['jawaban' => 'Jawaban ke '. $key + 1 .' kosong! Harap isi']);
            }
        }
        foreach ($request->poin as $key => $poin) {
            if ($poin == null) {
                return back()->withErrors(['poin' => 'Poin ke '. $key + 1 .' kosong! Harap berikan poin pada jawaban']);
            }
        }
        try {
            $soal = Question::create([
                'uuid' => Str::uuid(),
                'psycholog_id' => $psycholog->id,
                'soal' => $request->pertanyaan
            ]);
            foreach ($request->jawaban as $key => $jawaban ) {
                Answer::create([
                    'uuid' => Str::uuid(),
                    'question_id' => $soal->id,
                    'jawaban' => $jawaban,
                    'poin' => $request->poin[$key]
                ]);
            }
            return redirect()->route('admin.psycholog.question.create', $psycholog->uuid)->with('success', 'Berhasil menambah soal');
        } catch (\Throwable $th) {
            return redirect()->route('admin.psycholog.question.create', $psycholog->uuid)->with('error', 'Gagal menambah soal! ' . $th->getMessage());
        }
    }
    public function edit(Psycholog $psycholog, Question $question)
    {
        return view('admin.psikologi.edit', [
            'question' => $question,
            'psycholog_id' => $psycholog->uuid
        ]);
    }
    public function update(Psycholog $psycholog, Question $question, Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
        ]);
        foreach ($request->jawaban as $key => $jawaban) {
            if ($jawaban == null) {
                return back()->withErrors(['jawaban' => 'Jawaban ke '. $key + 1 .' kosong! Harap isi']);
            }
        }
        foreach ($request->poin as $key => $poin) {
            if ($poin == null) {
                return back()->withErrors(['poin' => 'Poin ke '. $key + 1 .' kosong! Harap berikan poin pada jawaban']);
            }
        }
        try {
            $question->update([
                'soal' => $request->pertanyaan
            ]);
            if ($request->has('jawaban')) {
                foreach ($question->answers as $answer) {
                    $answer->delete();
                }
                foreach ($request->jawaban as $key => $jawaban ) {
                    Answer::create([
                        'uuid' => Str::uuid(),
                        'question_id' => $question->id,
                        'jawaban' => $jawaban,
                        'poin' => $request->poin[$key]
                    ]);
                }
            }
            return redirect()->route('admin.psycholog.question.index', $psycholog->uuid)->with('success', 'Berhasil mengubah soal');
        } catch (\Throwable $th) {
            return redirect()->route('admin.psycholog.question.edit', $psycholog->uuid)->with('error', 'Gagal mengubah soal! ' . $th->getMessage());
        }
    }
    public function destroy(Psycholog $psycholog, Question $question)
    {
        try {
            foreach ($question->answers as $answer) {
                $answer->delete();
            }
            $question->delete();
            return redirect()->route('admin.psycholog.question.index', $psycholog->uuid)->with('success', 'Berhasil menghapus soal');
        } catch (\Throwable $th) {
            return redirect()->route('admin.psycholog.question.index', $psycholog->uuid)->with('error', 'Gagal menghapus soal! ' . $th->getMessage());
        }
    }
}
