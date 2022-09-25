<x-layout>

    <style>
        .commet__list
        {
            color: rgb(5, 83, 5);
            font-size: 10px;
        }
    </style>


    <x-article-card class="article" :article="$article"></x-article-card>

    <div class="comment__list">
        <h2>Comments:</h2>
    </div>

    @foreach ($comments = $article->comments as $comment)

<x-comment-card
    :comment="$comment"
   class="comment">
</x-comment-card>
@endforeach

</x-layout>
