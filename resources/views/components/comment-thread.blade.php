<div class="ml-{{ $level * 4 }} mt-2 p-2 border-left">
    <strong>{{ $comment->user->name }}</strong>
    <small>{{ $comment->created_at->diffForHumans() }}</small>
    <p>{{ $comment->comment }}</p>

    @if ($comment->user_id == Auth::id())
        <button class="btn btn-sm btn-outline-primary btn-edit" value="{{ $comment->id }}">Edit</button>
    @endif

    <button class="btn-reply btn btn-sm btn-outline-secondary" data-id="{{ $comment->id }}">Reply</button>

    <div id="reply-form-{{ $comment->id }}" style="display:none;">
        <textarea id="reply-text-{{ $comment->id }}" class="form-control mb-2" placeholder="Write a reply..."></textarea>
        <button class="btn btn-primary btn-sm submit-reply" data-id="{{ $comment->id }}">Submit</button>
        <button class="btn btn-light btn-sm cancel-reply" data-id="{{ $comment->id }}">Cancel</button>
    </div>
    @foreach ($comment->replies as $reply)
        @include('components.comment-thread', ['comment' => $reply, 'level' => $level + 1])
    @endforeach
</div>
