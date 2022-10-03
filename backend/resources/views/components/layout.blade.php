<!DOCTYPE html>

<a href="{{ route('home') }}">
    LevelUp Blog
</a>
<a name="Top"></a>

@isset($head)

    <head>
        {{ $head }}
    </head>

@endisset



<body>
    {{ $slot }}
</body>

<a href="#Top">Back to top</a>
