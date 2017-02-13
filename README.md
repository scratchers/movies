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

## Access Control

The system has an admin group and user out of the box with some policies:

* Only users that are a member of the admin group can create and edit groups.
* Only admins can create and edit movies.
* Only admins can create and edit group-user and group-movie relationships.

If a movie belongs to a group, then it can only be browsed by
a user that is a member of the same group.

Some common groups would be:

* grownups

## Tags and Ratings

Tags belonging to the admin user_id 1 are attachable by anyone:

* watched
* blocked
* starred

Users can create their own custom tags and attach them to movies:

* summer-sports
* LOL

Tags attached to movies by the admin user_id 1 are visible to everyone.
These are global movie tags, such as genres:

* drama
* comedy
* animated
* sci-fi

Users can rate movies on an integer scale of 0-100.

<p align="center">
    <a href="https://www.lucidchart.com/documents/view/71db6d9b-3e8c-4e9a-923f-01e76c6836fd">
        <img src="https://www.lucidchart.com/publicSegments/view/6eb89c27-54b0-4e17-b092-254f6a5540c9/image.png" />
    </a>
</p>

<p align="center">
    <a href="https://laravel.com/">
        <img src="https://laravel.com/assets/img/components/logo-laravel.svg" />
    </a>
</p>

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
