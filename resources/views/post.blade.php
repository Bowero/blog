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
        {{ $metadata['title'] }}
    </h1>
    <h2 class="font-sans text-2xl font-bold text-gray-400 max-w-5xl lg:text-5xl lg:pr-24 md:text-4xl mt-8">
        {{ $metadata['subtitle'] }}
    </h2>
    <div class="mt-8">
        <p class="text-gray-400 font-sans text-xl md:text-3xl">
            {{ $metadata['date']->format('d F Y') }}
        </p>
    </div>
</div>

</body>
</html>
