<x-layout>
    <form action="{{ route('articles.store') }}" method="post">
        @csrf

        <br>
        <label>Title</label>
        {!! Form::text('title', request()->old('title'), ['required' => true, 'placeholder' => 'title goes here']) !!}

        <br>

        <label>Content</label>
        <input
            for="content"
            name="content"
            placeholder="content goes here"
            required
            value="{{ request()->old('content') }}">

        <br>

        <label>Summary</label>
        <input
            for="summary"
            name="summary"
            placeholder="content goes here"

            value="{{ request()->old('summary') }}">

        <br>

        {!! Form::submit('create') !!}
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-layout>
