<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="robots" content="index, follow"/>

    <title>@isset($title){{ $title }} | @endisset Robin Martijn</title>

    <meta property="og:url" content="https://robinmartijn.nl/">
    <meta property="og:image" content="https://actionless.app/facebook/{{ base64_encode(request()->url()) }}"/>
    <meta name="twitter:card" content="summary"></meta>
    <meta property="twitter:image" content="https://actionless.app/twitter/{{ base64_encode(request()->url()) }}"/>

    @isset($title)
        <meta name="description" content="{{ $title }}@isset($subtitle): {{ $subtitle }} @endisset"/>
        <meta property="og:title" content="{{ $title }}"/>

        @isset($subtitle)
            <meta property="og:description" content="{{ $subtitle }}"/>
        @endisset
    @else
        <meta property="og:title" content="Robin Martijn"/>
        <meta name="description"
              content="Robin Martijn is a freelance Laravel developer, writing about projects he's building and experiments he's running."/>
        <meta property="og:description"
              content="Robin Martijn is a freelance Laravel developer, writing about projects he's building and experiments he's running."/>
@endisset

<!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-200 to-white dark:from-gray-800 dark:to-black min-h-full">

<div class="container mx-auto pt-8 overflow-hidden md:rounded-lg md:px-10 lg:px-12 px-8">
    <nav class="flex">
        <div class="py-4 flex-1">
            <a href="/" class="text-gray-600 dark:text-gray-300 font-bold text-xl md:text-2xl">Robin Martijn</a>
        </div>
        <div class="py-4">
            <a href="https://twitter.com/RobinMartijn/" target="_blank" aria-label="Twitter">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                     class="h-8 ml-4 md:ml-8 fill-gray-600 hover:fill-gray-800 dark:fill-gray-300 dark:hover:fill-white">
                    <path
                        d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/>
                </svg>
            </a>
        </div>
        <div class="py-4">
            <a href="https://github.com/Bowero" target="_blank" aria-label="GitHub">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"
                     class="h-8 ml-4 md:ml-8 fill-gray-600 hover:fill-gray-800 dark:fill-gray-300 dark:hover:fill-white">
                    <path
                        d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"/>
                </svg>
            </a>
        </div>
        <div class="py-4" id="light-icon">
            <a href="#" aria-label="Enable light mode" onclick="toggleDarkMode()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                     class="h-8 ml-4 md:ml-8 fill-gray-600 hover:fill-gray-800 dark:fill-gray-300 dark:hover:fill-white">
                    <path
                        d="M256 159.1c-53.02 0-95.1 42.98-95.1 95.1S202.1 351.1 256 351.1s95.1-42.98 95.1-95.1S309 159.1 256 159.1zM509.3 347L446.1 255.1l63.15-91.01c6.332-9.125 1.104-21.74-9.826-23.72l-109-19.7l-19.7-109c-1.975-10.93-14.59-16.16-23.72-9.824L256 65.89L164.1 2.736c-9.125-6.332-21.74-1.107-23.72 9.824L121.6 121.6L12.56 141.3C1.633 143.2-3.596 155.9 2.736 164.1L65.89 256l-63.15 91.01c-6.332 9.125-1.105 21.74 9.824 23.72l109 19.7l19.7 109c1.975 10.93 14.59 16.16 23.72 9.824L256 446.1l91.01 63.15c9.127 6.334 21.75 1.107 23.72-9.822l19.7-109l109-19.7C510.4 368.8 515.6 356.1 509.3 347zM256 383.1c-70.69 0-127.1-57.31-127.1-127.1c0-70.69 57.31-127.1 127.1-127.1s127.1 57.3 127.1 127.1C383.1 326.7 326.7 383.1 256 383.1z"/>
                </svg>
            </a>
        </div>
        <div class="py-4" id="dark-icon">
            <a href="#" aria-label="Enable dark mode" onclick="toggleDarkMode()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                     class="h-8 ml-4 md:ml-8 fill-gray-600 hover:fill-gray-800 dark:fill-gray-300 dark:hover:fill-white">
                    <path
                        d="M32 256c0-123.8 100.3-224 223.8-224c11.36 0 29.7 1.668 40.9 3.746c9.616 1.777 11.75 14.63 3.279 19.44C245 86.5 211.2 144.6 211.2 207.8c0 109.7 99.71 193 208.3 172.3c9.561-1.805 16.28 9.324 10.11 16.95C387.9 448.6 324.8 480 255.8 480C132.1 480 32 379.6 32 256z"/>
                </svg>
            </a>
        </div>
    </nav>
</div>

{{ $slot }}

<script>
    // Initialize dark mode based on cookie
    if (document.cookie.indexOf('dark-mode=true') > -1 ||
        window.matchMedia('(prefers-color-scheme: dark)').matches) {
        setDarkMode();
    } else if (document.cookie.indexOf('dark-mode=false') > -1 ||
        window.matchMedia('(prefers-color-scheme: light)').matches) {
        setLightMode();
    }

    function toggleDarkMode() {
        if (document.documentElement.classList.contains('dark')) {
            setLightMode(true);
        } else {
            setDarkMode(true);
        }
    }

    function setDarkMode(set_cookie = false) {
        document.documentElement.classList.add('dark');
        document.getElementById('light-icon').classList.remove('hidden');
        document.getElementById('dark-icon').classList.add('hidden');

        if (set_cookie) {
            document.cookie = 'dark-mode=true; path=/';
        }

        // Update the code snippets
        var codeBlocks = document.getElementsByClassName('light-code');
        for (var i = 0; i < codeBlocks.length; i++) {
            codeBlocks[i].classList.add('hidden');
        }

        var codeBlocks = document.getElementsByClassName('dark-code');
        for (var i = 0; i < codeBlocks.length; i++) {
            codeBlocks[i].classList.remove('hidden');
        }
    }

    function setLightMode(set_cookie = false) {
        document.documentElement.classList.remove('dark');
        document.getElementById('light-icon').classList.add('hidden');
        document.getElementById('dark-icon').classList.remove('hidden');

        if (set_cookie) {
            document.cookie = 'dark-mode=false; path=/';
        }

        // Update the code snippets
        var codeBlocks = document.getElementsByClassName('light-code');
        for (var i = 0; i < codeBlocks.length; i++) {
            codeBlocks[i].classList.remove('hidden');
        }

        var codeBlocks = document.getElementsByClassName('dark-code');
        for (var i = 0; i < codeBlocks.length; i++) {
            codeBlocks[i].classList.add('hidden');
        }
    }
</script>

</body>
</html>
