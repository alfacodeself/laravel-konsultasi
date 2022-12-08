<?php

namespace App\Http\Controllers;

use App\Http\Middleware\KonselingChatMiddleware;
use App\Models\Admin;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KonselingChatController extends Controller
{
    public function index(Schedule $schedule)
    {
        $chats = $schedule->chats->map(function ($chat) {
            $chat->type = $chat->chatable instanceof Admin ? 'admin' : 'user';
            if (auth('admin')->check()) {
                $chat->level = 'admin';
            }elseif (auth('user')->check()) {
                $chat->level = 'user';
            }
            return $chat;
        });
        return view('read')->with(compact('chats'));
    }
    public function chat(Schedule $schedule)
    {
        return view('chat', compact('schedule'));
    }
    public function store(Schedule $schedule, Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'pesan' => 'required'
            ], [
                'pesan.required' => 'Pesan tidak boleh kosong'
            ]);
            if ($schedule->status == 'selesai') {
                return response()->json(['message' => 'Konseling telah selesai'], Response::HTTP_EXPECTATION_FAILED);
            }
            if (auth('user')->check()) {
                if ($schedule->user->id != auth('user')->id()) {
                    return response()->json(['message' => 'Anda tidak memiliki akses!'], Response::HTTP_UNAUTHORIZED);
                }
                $model = auth('user')->user();
            }
            elseif (auth('admin')->check()) {
                $model = auth('admin')->user();
            }
            try {
                $model->chats()->create(['schedule_id' => $schedule->id, 'pesan' => $request->pesan]);
                return response()->json(['message' => 'Success'], Response::HTTP_CREATED);
            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }
}
