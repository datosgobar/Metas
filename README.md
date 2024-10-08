# Plataforma de seguimiento de metas

La siguiente plataforma esta basada en [Participes](https://github.com/DemocraciaEnRed/participes-app) y esta pensada para ser utilizada por gobiernos e instituciones que deseen publicar sus metas y compromisos, facilitando el seguimiento de avances y la transparencia activa.

Participes es una plataforma digital para gobiernos e instituciones que permite la publicación de metas y compromisos, facilitando el seguimiento de avances y la transparencia activa.

![image](https://user-images.githubusercontent.com/8771166/215751657-244b7d63-0345-4432-900d-d7843795e3e5.png)

## Changelog

### (2023-07-11)

> No migration in this version. 

* In the views of the administration panels for objectives, goals, and reports, both for a coordinator and a reporter, there is now a message displayed at the top of the view indicating the role associated with the objective (as a reminder to the user of what they can do).
* The "Settings" access in the report administration panel menu has been hidden, where the reporter had the option to delete a report (although this action was never allowed as the server returned a message stating that it was not permitted).
* The description of what happens when a report is deleted has been corrected in the "Settings" option of the report administration panel menu.
* Added the ability for a coordinator or reporter to delete files uploaded to a report's repository.
* Added the ability for a coordinator to delete files uploaded to an objective's repository.
* New notifications in the logbook of an objective:
- When a coordinator or reporter uploads a new image to a report's album.
- When a coordinator or reporter uploads a new file to a report's repository.
- When a coordinator or reporter deletes an image from a report's album.
- When a coordinator or reporter deletes a file from a report's repository.
- When a coordinator uploads a file to the objective's repository.
- When a coordinator deletes a file from the objective's repository.
- When a coordinator changes the cover image of an objective.

> After pulling the new code in the make sure to run the followings: (As described in DEPLOY.md)

```bash
php artisan clear-compiled
php artisan view:clear
php artisan config:clear
php artisan optimize
composer dump-autoload -o
php artisan queue:restart
```

### (2023-07-05)

* Fixed some harcoded texts that said "Participes" in email templates.

### (2023-04-13)

> **NOTE**: There is a new package in this version, make sure to run `composer install` in the root directory of the project. In production you should run `composer install --no-dev` to avoid any errors.

> **NOTE**: There is a new migration with this version, make sure to run it. You can do this by running `php artisan migrate` in the root directory of the project. In production you should run `php artisan migrate --force` to avoid any errors.
> 
> As always, we recommend you to make a backup of your database before running the migrations.

* Fixed deleting a frequent question in the admin panel
* Removed "Hitos" admin in the goal admin panel
* Removed "Hitos" from "Nueva meta del objetivo" form
* Removed "No milestones" notification from the dashboard of the goal view.
* Removed tab "Reporte de Hito" in the Report form component.
* Added doctrine/dbal to the composer.json file for the migrations to work.
* Added the migration to change the "description" column in the "Organizaciones" table to allow null values.
* Changed create/edit organization form to allow null values in the "description" field.


### (2023-03-15)
"Mi Argentina" login has been implemented, following the recommended implementation for PHP (https://argob.github.io/mi-argentina-docs/doc/plataformas.html#php)

> **NOTE**: There is a new migration with this version, make sure to run it. You can do this by running `php artisan migrate` in the root directory of the project. In production you should run `php artisan migrate --force` to avoid any errors.
> 
> As always, we recommend you to make a backup of your database before running the migrations.

**THIS IS IMPORTANT** There are 3 new ENV variables to set up in the .env file.

```
OIDC_URL=
OIDC_CLIENT_ID=
OIDC_CLIENT_SECRET=
```

As requested, email register and login keeps available in the system

The way it works is:

```
User logs in.
--- If through Mi Argentina, user sign in with Mi Argentina and does the callback to `/auth/miargentina`
------ Check if there is a user with the oidc_id that comes from MiArgentina
--------- If TRUE (the user is already registered) 
------------- Update email, name, surname that comes from the profile data from MiArgentina (this is done with every login)
------------- Log in the uer
--------- If FALSE (the user is not found with the oidc_id)
------------- Check if the email (from miArgentina) is in use
----------------- IF TRUE (the user is registered with an email account)
--------------------- Reject the register with MiArgentina
----------------- IF FALSE (no user is using that email, which means, new account)
--------------------- Create the new user
--------------------- Automatically the email is validated (by MiArgentina)
--------------------- Automatically Log in the user
```

There are other checks when a user:
- Registers with email: If the user with the email already exists and its oidc_id is not null, means the user has registered with MiArgentina and the system tells the user to log in with MiArgentina
- Forgot password: If the user with the email already exists and its oidc_id is not null, means the user has registered with MiArgentina and it cannot "restore" a password (it is forbidden)
- If a user goes to their panel, and they log in using MiArgentina, they are not allowed to change email nor password. The panel view tells to change it in MiArgentina if the want to.
- For email users, change email and password panels are available as normal.

There are other changes introduced in this branch
* Emails styling: Now its more in shape with Argentina's CSS
* Email titles now uses `APP_NAME` env variable.
* Some styling tweaks for auth views (Login, Register, Forgot password, Reset password, Verify email, etc)
* Changed "Frecuencia del indicador" to "Fecha de cierre", as requested for the client.
* Fixed pagination not using bootstrap (Laravel's shenanigans) 
* Tags wont show if no tags are linked to the objective


### (2023-02-03)
* No new version. Just a small fix in the README.md file.
* Added DEPLOY.md file with instructions to deploy the project in a LAMP/LEMP server.

### v2.3 (2023-02-01)

* There is a new migration with this version, make sure to run it. You can do this by running `php artisan migrate` in the root directory of the project. In production you should run `php artisan migrate --force` to avoid any errors.
* As always, we recommend you to make a backup of your database before running the migrations.
* Fixed some bugs with the admin panel for maps (nothing critical)
* New "homepage" admin panel. Now you have in one place all the customizations you can do to the homepage. Inside we included a few ones:
  * You can show/hide the latest published reports
  * You can show/hide the graph of reports published in the last 15 days
  * You can "move" the latest published reports after the "latest objectives updated"
  * You can show/hide the categories selector.
  * Moved the "subtitle" of the homepage to the admin panel
* New "SEO & Analytics" admin panel. Nothing new, but all the cusotmizations you can do to the SEO and Analytics are now in one place.
* Fixed "Limpiar cache" button in the admin panel. Now it works as expected.
* Fixed some "boolean" casts in the Settings model.
* New component "Category selector" which is a carrousel component of the categories of the system. When you click in a category, it takes you to the catalog of objectives.
* Some changes in some views:
  * In the objective view, if the following attributes are empty, they wont be shown: "Miembros del equipo", "Organizciones", "Metas"
  * In the goal view, if the following attributes are empty, they wont be shown: "Hitos"
* Some secondary fixes (Demo data had a bug when creating generic organizations)


### v2.2 (2023-02-01)

* No migrations in this version
* Major update in mapbox GL JS from 1.11.1 to 2.4.1, with this update we are able to use the new mapbox styles and the new mapbox studio.
* Updated mapbox-gl-draw plugin from 1.0.9 to 1.4.0.
* NOTE: You should use the Style URL mapbox://styles/mapbox/light-v11 instead of the old style url mapbox://styles/mapbox/light-v10
* Fixed some maps not getting the Mapbox API Key

### v2.1 (2023-02-01)

* There is a new migration with this version, make sure to run it. You can do this by running `php artisan migrate` in the root directory of the project. In production you should run `php artisan migrate --force` to avoid any errors.
* As always, we recommend you to make a backup of your database before running the migrations.
* Added Map & Georeference admin to the admin panel. Now instead of setting the map and georeference in the .env file, you can do it in the admin panel.
* The env vars `MAPBOX_API_KEY` & `MAPBOX_MAP_STYLE` are no longer required in the .env file. If you are planning to update to this version, make sure that after the update you set the api key and map style in the admin panel.
* You can also hide the map from the homepage
* If maps & georeference are disabled, the map will not be shown in the homepage and reports wont have a map. The report panel also wont show the "Map" option in the menu.

#### v2.0 (2023-01-18)

* New migrations are being added for the new Laravel version. If you installed Participes before 2023, you should run the new migrations. You can do this by running `php artisan migrate` in the root directory of the project. In production you should run `php artisan migrate --force` to avoid any errors.
* As always, we recommend you to make a backup of your database before running the migrations.
* Participes has been updated to Laravel 8. It requires PHP 7.4 or higher.
* The env vars `ANALYTICS_PROVIDER`, `ANALYTICS_PROVIDER`, `ANALYTICS_TRACKING_ID` are no longer required in the .env file. From now on you can use the admin panel to set up Google Analytics 4 by inserting the tracking ID.
* Removed fzaninotto/faker dependency for the sake of Laravel 8. Faker 


## Deployment instructions 

Please check out [DEPLOY.md](DEPLOY.md) file

---

## Development

First, make sure you have instaled:

- PHP +7.4
- Imagemagick
- MySQL
- Node + NPM (For local development and building)

You can use phpbrew to install PHP and composer to install the dependencies.
```
phpbrew install 7.4 +default +mysql
phpbrew use 7.4
phpbrew ext install gd
phpbrew ext install imagick
```

Clone the Repo.

Open a terminal in the root of the project:

```
$ composer install
```

With the `$ composer install` a `.env` file should've been created. 

> From [Laravel Docs](https://laravel.com/docs/7.x/installation): If you installed Laravel via Composer or the Laravel installer, this key has already been set for you by the `php artisan key:generate command`.(...) If the application key is not set, your user sessions and other encrypted data will not be secure!

So Look and configure the following env variables (others vars, dont worry) 

```

APP_NAME=Partícipes
APP_ENV=local
APP_KEY= # Run php artisan key:generate and use the output!
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=participes
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

QUEUE_CONNECTION=sync

NOCAPTCHA_SECRET=
NOCAPTCHA_SITEKEY=

MAPBOX_API_KEY=
MAPBOX_MAP_STYLE=mapbox://styles/mapbox/light-v10
```

Now create a new MySQL database. You can create a `participes` mysql database, if you want to use another name, change it in `DB_DATABASE`. It should be `'charset' => 'utf8mb4' // 'collation' => 'utf8mb4_unicode_ci'`

Now run the first migration. Its the init DB.

```
php artisan migration
php artisan db:seed
```

Your tables should've been created with demo data.

Now you can enter with:
```
User: admin@admin.com
Pass: participes
```

## Little Consideration

#### config/app.php
Check your `php.ini` settings. You might want to check the file upload configurations and maybe the timezone settings.

In your app, by default the timezone is defined like this. Change it if you need to.

```
'timezone' => 'America/Argentina/Buenos_Aires',
```

#### Available roles

**Role: user**

By default, any new registered user gets the `user` role

**Role: admin**

Those who want to manage the platform should have the `admin` role, which gives them access to a few views and other things.
These should be managed manually. An admin should be able to add other admins.

Just to clarify: We follow this philosophy:
**Admins are not human entities: They are one, and many at the same time. They share the same decisions. They work together. They have concensum. They dont make mistakes.**

With this in mind, we give answers to a few questions:

- *Can an admin delete other admins?* Yes.
- *Can an admin delete content other admins created?* Yes.

They are amazing, right?

## Using REDIS as queue manager

Imagine sending 50 new report emails to subscriptors in one process... it will take like a minute or more for the process to contact the SMTP and it will block the user experience, stuck in the same page, for a minute or more. If we dont want this on production, we need to set up Queues and Workers.

> **NOTE**: If you still want to be blocked by this jobs, you can just use the `sync` option in the `QUEUE_CONNECTION` in the `.env` file like this: `QUEUE_CONNECTION=sync`

In production, we will need to use a complementary service called Redis for queueing jobs. This will accelerate async jobs like mailing and other stuff.

> Why use Redis for your Laravel queue connection? Redis offers clustering and rate limiting. Let’s look at an example of rate limiting and why that might be important. - [https://voltagead.com/the-basics-of-laravel-queues-using-redis-and-horizon/](https://voltagead.com/the-basics-of-laravel-queues-using-redis-and-horizon/)

For development, we need to have REDIS installed. So you should have redis installed locally or just use a docker container.

```
$ docker run -d --name redis -p 6379:6379 redis
```

Useful docker redis commands:
```
$ docker start redis

$ docker stop redis
```

Now in .env, use this env variables:
```
# QUEUE_CONNECTION=sync -- we dont need this
QUEUE_CONNECTION=redis
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_QUEUE=mailer,default
```

Now in another terminal, run the following in the root directory:

```
$ php artisan queue:work redis --queue=mailer,default
```

Here, one process will work both queues at the same time.
If you prefer to have two different processes for each job queue, you can open two terminal and do: 

```
// Terminal 1
$ php artisan queue:work redis --queue=mailer
```
```
// Terminal 2
$ php artisan queue:work redis --queue=default
```

## Files - Storage Link

Run the following command

```
php artisan storage:link
```

## Run PHP Server

```
php artisan server:run
```


## Build JS and CSS

We are using Mix by Laravel to build the javascript and the css of the app.

Start by doing 

```
$ npm install
```

Now if you are going to make changes in the `.scss`, `.vue` or `.js` files and build the js in "real time", you will have to do:

```
$ npm run watch
```

If you just want to build in development mode, use: 
```
$ npm run development
```

If you want to build the files for production, run:

```
$ npm run production
```
