
    <style>
        .comment__item
        {
            border: solid;
            margin-bottom: 10px;

        }

        .comment__item-text
        {
            color: green;
            font-size: 25px;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .comment__item-info
        {
            color: green;
            font-size: 15px;
            text-decoration: underline;
            padding-top: 5px;
            padding-bottom: 5px;
        }
    </style>


<div class="comment__item">

    <div class="comment__item-text">
        {{ $comment->content }}
    </div>

    <div class="comment__item-info">
        Posted: <x-timestamp :timestamp="$comment->created_at"></x-timestamp> by
        <a href="{{ route('api.users.show', ['user' => $comment->user]) }}">
            {{ $comment->user->name }}
        </a>
    </div>

</div>




{{ $slot }}
