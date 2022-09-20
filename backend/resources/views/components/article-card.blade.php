<h1>
    <a {{ $attributes->merge() }}>
        {{ $article->title }}
    </a>

</h1>

Posted: <x-timestamp :timestamp="$article->created_at"></x-timestamp>



<p {{ $attributes->merge() }}>
    {{ $article->content }}</p>


{{ $slot }}
