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
