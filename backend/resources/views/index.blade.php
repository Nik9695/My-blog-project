<x-layout>

    <x-slot:head>
        <style>
            .title {
                color: gray;
                background: white;
                font-family: monospace;
            }

            .first-title {
                color: rgb(76, 4, 90);
            }

        </style>
    </x-slot:head>



    @foreach ($articles as $article)
        <x-article-card

            :article="$article"
            href="{{ route('articles.show', ['article' => $article]) }}"
            class="{{ $loop->first ? 'first-title' : 'title' }}">
        </x-article-card>

    @endforeach



</x-layout>
