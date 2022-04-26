<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // Get all files in the storage/posts/ directory
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

    return view('welcome', compact('posts'));
});

Route::get('/posts/{path}', function ($path) {
    $contents = File::get(storage_path("posts/$path.md"));

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

    $metadata['date'] = Carbon::parse($metadata['date']);

    $content = substr($contents, strpos($contents, '---') + 3);

    return view('post', compact('metadata', 'content'));
})->name('posts.show');
