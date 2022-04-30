<x-layout title="Homepage">

    <div class="text-gray-300 container mx-auto p-8 overflow-hidden md:rounded-lg md:px-10 lg:px-12 py-32 md:py-40">
        <h1 class="font-sans text-4xl font-bold text-gray-600 dark:text-gray-200 max-w-5xl lg:text-7xl lg:pr-24 md:text-6xl" style="margin: 0;">
            Hi there, beautiful!
        </h1>

        <x-paragraph>
            You just landed on my special place on the internet. This is my personal website. A place to share my
            thoughts
            and experiment.
        </x-paragraph>

        <x-paragraph>
            I mainly write about web development here. During the day I work as a freelance Laravel developer. I prefer
            to
            keep my
            tech stack simple and clean: If you can't find it in the Laravel documentation, I'm probably not using it on
            a
            day to day basis.
        </x-paragraph>

        <x-paragraph>
            This website is a work in progress. You can find the source code on <a href="#" class="underline">GitHub</a>.
        </x-paragraph>

        <x-paragraph>
            If you have any questions, feel free to contact me. Just shoot me a message on <a
                href="https://twitter.com/RobinMartijn/" target="_blank" class="underline">Twitter</a>!
        </x-paragraph>

        <h2 class="font-sans text-3xl font-bold text-gray-600 dark:text-gray-200 max-w-3xl lg:text-5xl lg:pr-24 md:text-4xl pt-16 md:pt-24" style="margin: 0;">
            Recent posts
        </h2>

        <div class="container max-w-2xl">
            @foreach($posts as $post)
                <div class="mt-8">
                    <h3 class="font-sans text-lg font-bold text-gray-500 dark:text-gray-200 lg:text-2xl md:text-xl" style="margin: 0;">
                        <a href="{{ route('posts.show', $post['path']) }}" class="underline">
                            {{ $post['title'] }}: {{ $post['subtitle'] }}
                        </a>
                    </h3>
                    <span class="text-gray-400">
                    {{ $post['date']->format('d F Y') }}
                </span>
                </div>
            @endforeach
        </div>
    </div>

</x-layout>
