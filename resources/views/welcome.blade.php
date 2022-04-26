<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Robin Martijn</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-800 to-black min-h-full">

<div class="text-gray-300 container mx-auto p-8 overflow-hidden md:rounded-lg md:px-10 lg:px-12 py-32 md:py-40">
    <h1 class="font-sans text-4xl font-bold text-gray-200 max-w-5xl lg:text-7xl lg:pr-24 md:text-6xl">
        Hi there, beautiful!
    </h1>

    <x-paragraph>
        You just landed on my special place on the internet. This is my personal website. A place to share my thoughts
        and experiment.
    </x-paragraph>

    <x-paragraph>
        I mainly write about web development here. During the day I work as a freelance Laravel developer. I prefer to
        keep my
        tech stack simple and clean: If you can't find it in the Laravel documentation, I'm probably not using it on a
        day to day basis.
    </x-paragraph>

    <x-paragraph>
        This website is a work in progress. You can find the source code on <a href="#" class="underline">GitHub</a>.
    </x-paragraph>

    <x-paragraph>
        If you have any questions, feel free to contact me. Just shoot me a message on <a
            href="https://twitter.com/RobinMartijn/" target="_blank" class="underline">Twitter</a>!
    </x-paragraph>

    <h2 class="font-sans text-2xl font-bold text-gray-200 max-w-3xl lg:text-5xl lg:pr-24 md:text-4xl pt-24">
        Recent posts
    </h2>

    <div class="container max-w-2xl">
        @foreach($posts as $post)
            <div class="mt-8">
                <h3 class="font-sans text-lg font-bold text-gray-200 lg:text-2xl md:text-xl">
                    <a href="{{ route('posts.show', $post['path']) }}" class="underline">
                        {{ $post['title'] }}
                        : {{ $post['subtitle'] }}
                    </a>
                </h3>
                <span class="text-gray-400">
                    {{ $post['date']->format('d F Y') }}
                </span>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
