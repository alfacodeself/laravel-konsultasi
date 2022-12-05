<?php

namespace App\Http\Controllers;

use App\Http\Middleware\KonselingChatMiddleware;
use App\Models\Admin;
use App\Models\Schedule;
use Illuminate\Http\Request;

class KonselingChatController extends Controller
{
    
    // For User
    public function userChat(Schedule $schedule)
    {
        $chats = $schedule->chats->map(function($chat) {
            $chat->type = $chat->chatable instanceof Admin ? 'admin' : 'user';
            return $chat;
        });
        // dd($chats);
        return view('user.konseling.show', compact('chats', 'schedule'));
    }
    public function userChatStore(Schedule $schedule, Request $request)
    {
        $request->validate([
            'pesan' => 'required'
        ], [
            'pesan.required' => 'Pesan tidak boleh kosong'
        ]);
        if ($schedule->status == 'selesai') {
            return back()->with('error', 'Konseling telah selesai');
        }
        if ($schedule->user->id != auth('user')->id()) {
            abort(401, 'Anda tidak memiliki akses');
        }
        $user = auth('user')->user();
        // dd($user);
        try {
            $user->chats()->create(['schedule_id' => $schedule->id, 'pesan' => $request->pesan]);
            return redirect()->back();
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function adminChat(Schedule $schedule)
    {
        $chats = $schedule->chats->map(function($chat) {
            $chat->type = $chat->chatable instanceof Admin ? 'admin' : 'user';
            return $chat;
        });
        // dd($chats);
        return view('admin.konseling.chat', compact('chats', 'schedule'));
    }
    public function adminChatStore(Schedule $schedule, Request $request)
    {
        $request->validate([
            'pesan' => 'required'
        ], [
            'pesan.required' => 'Pesan tidak boleh kosong'
        ]);
        if ($schedule->status == 'selesai') {
            return back()->with('error', 'Konseling telah selesai');
        }
        // dd($request->all());
        $admin = auth('admin')->user();
        try {
            $admin->chats()->create(['schedule_id' => $schedule->id, 'pesan' => $request->pesan]);
            return redirect()->back();
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
