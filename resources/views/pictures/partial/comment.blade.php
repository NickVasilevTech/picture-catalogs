<div class="w-75 mt-4 border border-2 pt-2 px-2" style="background: rgba(0,0,0,0.1);">
    <a class="link-secondary fw-bold" href="{{ route('profile.view', ['username' => $comment->authorName]) }}" style="text-decoration: none;">{{$comment->authorName}}</a>
    on <span class="fw-semibold fst-italic">{{ Carbon\Carbon::parse($comment->created_at)->format('d M Y h:i:s')}}</span>
    <hr class="w-100 mt-1">
    <div class="ps-1 text-wrap text-break">{!!$comment->body!!}</div>
</div>
