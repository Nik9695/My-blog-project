{{--

Showing list of all comments in the data base.

Used by index() method of CommentController.

 --}}

@foreach ($comments as $comment)
<x-comment-card
    :comment="$comment"
   >
</x-comment-card>
@endforeach
