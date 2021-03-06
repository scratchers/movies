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

## Groups and Access Control

The system has an admin group out of the box with some policies:

* Only users that are a member of the admin group can create and edit groups.
* Only admins can create and edit movies.
* Only admins can create and edit group-user and group-movie relationships.

If a movie belongs to a group, then it can only be browsed by
a user that is a member of the same group.

Some common groups would be:

* grownups

On installation, you will need to register a new user like normal, but then you
will need to manually add them to the `admin` group because no other admin yet
exists. The easiest method is probably to use artisan tinker:

    php artisan tinker

Then find your user, the `admin` group, and attach it to the user's groups.

```php
>>> $jeff = App\User::find(1)
=> App\User {#690
     id: 1,
     name: "jeff",
     email: "jeff@example.com",
     created_at: "2017-02-19 20:13:22",
     updated_at: "2017-02-19 20:13:22",
   }

>>> $admin = App\Group::find(1)
=> App\Group {#706
     id: 1,
     created_at: null,
     updated_at: null,
     name: "admin",
     deleted_at: null,
   }

>>> $jeff->groups()->attach($admin)
```

## Tags

Users can create their own custom tags and attach them to movies:

* summer-sports
* LOL

Out of the box, users are seeded with a couple common custom tags:

* watched
* blocked
* starred

These, like all tags, can be renamed or deleted.

## Genres

Administrators can create and attach genres to movies visible to everyone.
These are like global movie tags, such as:

* drama
* comedy
* animated
* sci-fi
* wonky-whateverness

## Ratings

Users can rate movies on an integer scale of 0-100.

## Entity Relationship Diagram

This is the conceptual diagram used for planning.
The actual database schema will vary.

[![ERD](./docs/images/erd.png)][1]

## Guess It

This application takes advantage of the python project [guessit-io/guessit-rest][2]
in order to extract as much information as possible from a filename.
While this is *not required*, it should improve automatic searching
and populating of movie metadata.

The preferred method is to run a [docker][3] service.

    docker run -d -p 127.0.0.1:5000:5000 --name guessit guessit/guessit-rest

And then set the URL key in `.env`

    GUESSIT_URL='http://127.0.0.1:5000'

Or you could use http://v2.api.guessit.io/ but it's currently unencrypted and
unregulated so reliability is not guaranteed. Again, this is not required, but
should improve your experience.

<p align="center">
    <a href="https://laravel.com/">
        <img src="https://laravel.com/assets/img/components/logo-laravel.svg" />
    </a>
</p>

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

[1]:https://www.lucidchart.com/documents/edit/71db6d9b-3e8c-4e9a-923f-01e76c6836fd
[2]:https://github.com/guessit-io/guessit-rest
[3]:https://www.docker.com/
