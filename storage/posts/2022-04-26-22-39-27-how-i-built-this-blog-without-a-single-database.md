title: How I built this blog without a single database
subtitle: Stealing the Jekyll way
date: 2022-04-27
published: true
---

This is not the first time I have started a blog. Nor the second time. Probably not the tenth time either. And it won't be the last time either. I don't know why I start a blog so often. I guess I'm too perfectionist for it.

I have used several blogging platforms, such as [WordPress](https://wordpress.com/) and [Hashnode](https://hashnode.com/), but this time I created my own blogging platform. A platform is probably too big a word. It's a (very) simple Laravel application that displays Markdown files. That's it.

The application has no database, only a directory of markdown files. This makes it much easier and more approachable for me to write than a full platform. The result? Hopefully, I'll actually write more.

One of the things about existing platforms is that code is hard to use. It works with vague plugins that have poor support for modern techniques, or it just looks ugly. I don't understand any of that. How can this be so difficult?

In this blog post, I will discuss how I wrote this blog. In doing so, I have chosen to include certain excerpts. The full application - which is obviously ongoing - [can be found on my GitHub]((https://github.com/Bowero/blog).

# Creating a custom command to create new posts
So, I decided I wanted to work with Markdown files. This also immediately eliminated the need to use another database. I can just loop over the Markdown files and parse them. This is also the way [Jekyll](https://jekyllrb.com/) works.

I started by creating a new Laravel project with Composer.

```bash
$ composer create-project laravel/laravel blog
```

My first step in this new project, was to set up a `Command` to be able to create new posts. For this I also needed a stub.

```markdown
# storage/templates/post.md

title: {{title}}
subtitle: {{subtitle}}
date: {{date}}
published: false
---

{{title}}
```

At the top of this file I have some metadata. For now, I have chosen to keep this as simple as possible. For the record, I decided at 11pm that I wanted to develop this, and I wanted to get to bed a little early. As I write this, it's 1am, so that worked out well.

The next part was writing the command itself. Again, this became a simple implementation. I ask two questions: the title of the article and the subtitle. The date and time, of course, I can determine automatically. Based on this data I can fill in the stub and create the file in `storage/posts`.

The command is as follows.

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Str;

class CreateNewPostCommand extends Command
{
    protected $signature = 'post:new';

    protected $description = 'Create a new post';

    public function handle()
    {
        $title = $this->ask('What is the title of the post?');
        $subtitle = $this->ask('What is the subtitle of the post?');
        $date = date('Y-m-d');

        $title_slug = Str::slug($title);

        // Create a new file in storage/posts/
        $filename = date('Y-m-d-H-i-s') . '-' . $title_slug . '.md';
        $filepath = storage_path('posts/' . $filename);

        // Create the file from the template in storage/templates/post.md
        $template = file_get_contents(storage_path('templates/post.md'));
        $template = str_replace('{{title}}', $title, $template);
        $template = str_replace('{{subtitle}}', $subtitle, $template);
        $template = str_replace('{{date}}', $date, $template);
        file_put_contents($filepath, $template);

        // Tell the user what happened
        $this->info("Created $filepath");

        return 0;
    }
}
```

# Fetching all posts
The next step, of course, was to retrieve all the files. There is no pagination of any kind on it for now. This is just an MVP. That means that large amounts of blog posts can become very tedious at this point. That's a nice problem for another time.

I do the fetching of files with the built-in Laravel `File` model. I have not created any models for this application myself. In fact, I have removed the default `User` model.

```php
$posts = collect(
        File::allFiles(storage_path('posts'))
    )
```

Now that we have the files, we need to loop over them to extract the metadata. We need these to show an overview of posts on the home page.

This also shows one of the disadvantages of this system: you have to open all the files every time. Of course, you can cache this, but hey, this is only an MVP. In a future post, I will discuss caching.

So now that we have all the posts, we need to get the metadata. We also need to cast these in order to actually get something out of them. The result of this looks like this.

```php
$posts = collect(
        File::allFiles(storage_path('posts'))
    )
        ->reverse()
        ->map(function ($file) {

            // Get the file contents
            $contents = File::get($file);

            // Set $path to the path of the file without .md
            $path = str_replace('.md', '', $file->getRelativePathname());

            // Get the metadata from the contents of the file
            $metadata = substr($contents, 0, strpos($contents, '---'));
            $metadata = collect(explode("\n", $metadata))
                ->filter(function ($line) {
                    return ! empty($line);
                })
                ->mapWithKeys(function ($item) {
                    list($key, $value) = explode(':', $item);

                    return [trim($key) => trim($value)];
                })
                ->all();

            return [
                'path' => $path,
                'title' => $metadata['title'],
                'subtitle' => $metadata['subtitle'],
                'published' => $metadata['published'],
                'date' => Carbon::parse($metadata['date'])
            ];
        })
        ->filter(function ($post) {
            return $post['published'] === 'true';
        });
```

Yes, there is certainly something to be said for this code. Feel free to [tweet at me with suggestions](https://twitter.com/RobinMartijn)!

# Showing a single post
Now that we have an overview of all posts, we still need to be able to retrieve a single post. I chose to use the filename as a slug in the URL. So an endpoint is, for example: 

```
/posts/2022-04-26-22-39-27-how-i-built-this-blog-without-a-single-database
```

You're reading that one right now!

Therefore, retrieving such a post is not very complicated. Now that we know the filename, we can retrieve the contents of the file directly from the file.

```php
$contents = File::get(storage_path("posts/$path.md"));
```

The retrieval of the metadata we have also covered, and is actually identical to the way we do it when retrieving multiple files. Now we also need the Markdown content, however.

Fortunately, that's not exciting.

```php
$content = substr($contents, strpos($contents, '---') + 3);
```

The more interesting part is how we then parse the Markdown into correct HTML. At least, it should be. Unfortunately, the gentlemen at Spatie have made that boring for us too.

I am using [`Laravel-markdown`](https://spatie.be/docs/laravel-markdown/v1/introduction), a package from Spatie. Installation of the package is tremendously straightforward:

```bash
$ composer require spatie/laravel-markdown
```

Its use is at least as simple:

```blade
<x-markdown>
    {!! $content !!}
</x-markdown>
```

All that is left then is to design the website itself.

# Everything is Tailwind
I have not written any custom CSS. Everything you're looking at now is standard, out of the box, Tailwind. Installation of Tailwind on Laravel is incredibly easy and in many cases already done for you (for example, if you use Laravel Jetstream).

There were some styles I had to `@apply' because the HTML that came out of Markdown was not as nice as the rest of my outstanding design skills.

I did this by assigning additional styles to the HTML tags in the app.css:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    body {
        @apply text-xl md:text-2xl;
    }

    p {
        @apply mb-8;
    }

    ol {
        @apply mb-8 list-decimal pl-5;
    }

    ul {
        @apply mb-8 list-disc pl-5;
    }

    pre {
        @apply mb-8 p-5 overflow-x-auto text-lg;
    }

    a {
        @apply underline;
    }

    h1 {
        @apply text-4xl md:text-5xl font-bold mb-8 mt-16;
    }

    h2 {
        @apply text-3xl md:text-4xl font-bold mb-8 mt-16;
    }

    h3 {
        @apply text-2xl md:text-3xl font-bold mb-8 mt-16;
    }

    h4 {
        @apply text-xl md:text-2xl font-bold mb-8 mt-16;
    }
}
```

Don't forget to compile this yet!

```bash
$ npm run dev
```

And voilà! The result is the website (and blog post) you're looking at now!

# There is still a lot to be done
This application was created in 2 hours and it took me almost longer to write this blog post than it took me to write the application. As a result, there are still many things I didn't do.

One important one I already mentioned is caching the blog posts. Once a post is published, it's not likely to change again anytime soon, much less regularly.

Something else is that you can't go back to my homepage now that you've finished reading. I couldn't figure this out quickly design-wise, so I chose to leave it out.

[If you still want to go back, you can click here.](/)

However, these are things I will play with over time. This project is for my personal use only. If you want to publish a blog with it yourself: feel free! If you just want to look at the code to learn something from it, or to be able to criticize me on Twitter: [it's on GitHub](https://github.com/Bowero/blog).
