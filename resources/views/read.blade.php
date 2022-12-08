@foreach ($chats as $chat)
    @if ($chat->level == 'admin')
        <li class="{{ $chat->type == 'user' ? 'odd' : '' }}">
    @else
        <li class="{{ $chat->type == 'admin' ? 'odd' : '' }}">
    @endif
    <div class="message-list">
        <div class="chat-avatar">
            <img src="{{ asset($chat->chatable->foto) }}" alt="">
        </div>
        <div class="conversation-text">
            <div class="ctext-wrap">
                <span class="user-name text-capitalize font-16">{{ $chat->chatable->nama }}</span>
                <p class="font-14">
                    {{ $chat->pesan }}
                </p>
            </div>
            <span class="time">{{ $chat->created_at->diffForHumans() }}</span>
        </div>
    </div>
    </li>
@endforeach
