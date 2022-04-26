# Blog

This repository contains the code for a Laravel blog that doesn't have a database. It works with static Markdown files that you can edit. I'm currently working on it. You are welcome to use it, but don't expect it to be complete. It is not.

## Installation

After cloning the repository, you'll just have to set up the project like any other Laravel project.

```bash
git clone https://github.com/Bowero/blog
composer install
cp .env.example .env
php artisan key:generate
```

## Usage

You can create a new Markdown file with a custom command:

```bash
php artisan post:new
```

This will launch the questions that are needed to generate the Markdown file. This will be stored in `storage/posts`.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

Just kidding, there are no tests (yet).
