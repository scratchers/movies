# Movies

PHP 7 Laravel 5.4 media player web application.

## Linking to Files

Create the symlink `public/mnt/movies` pointing to local file system folder.

    cd public/mnt
    ln -s /filesystem/path/to/movies movies

Add the `PATH_TO_MOVIES` variable to your `.env`

    PATH_TO_MOVIES='/filesystem/path/to/movies'

Apache users **note** that there is an included `.htaccess` file
which contains `Options +Indexes` to allow index browsing.
You can explicitly forbid this override in the virtual host configuration.

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
