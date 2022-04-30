<x-layout :title="$metadata['title']" :subtitle="$metadata['subtitle']">

    <div class="text-gray-500 dark:text-gray-300 container mx-auto p-8 overflow-hidden md:rounded-lg md:px-10 lg:px-12 py-32 md:py-40">
        <h1 class="font-sans text-4xl font-bold text-gray-600 dark:text-gray-200 max-w-5xl lg:text-7xl lg:pr-24 md:text-6xl" style="margin: 0;">
            {{ $metadata['title'] }}
        </h1>
        <h2 class="font-sans text-2xl font-bold text-gray-500 dark:text-gray-400 max-w-5xl lg:text-5xl lg:pr-24 md:text-4xl mt-4 md:mt-8" style="margin-bottom: 0;">
            {{ $metadata['subtitle'] }}
        </h2>
        <div class="mt-4 md:mt-8">
            <p class="text-gray-400 font-sans text-xl md:text-3xl">
                {{ $metadata['date']->format('d F Y') }}
            </p>
        </div>

        <div class="container max-w-4xl">
            <x-markdown class="mt-16 md:mt-16 lg:mt-24 dark-code" theme="one-dark-pro">
                {!! $content !!}
            </x-markdown>

            <x-markdown class="mt-16 md:mt-16 lg:mt-24 light-code" theme="material-lighter">
                {!! $content !!}
            </x-markdown>
        </div>
    </div>

</x-layout>
