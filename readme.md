# O2s/Users

This is a Laravel 5 based package that will provide user management capabilities.

Building on the default Users and Authentication Laravel 5 ships with, this package provides a simple user management interface.  When the database seeding step is done, the users table is cleared and the default *admin* account is set up.  Once logged in, the admin user can create, edit, or remove user accounts, including resetting passwords.  You can re-use the admin views if needed to create a page for users to edit their own data.

Default credentials are:
- name: admin
- email: admin@example.com
- password: password

Log in as the admin user and modify these values at your earliest convenience.

Access the user administration pages via http://localhost:8000/admin/users (changing the host and port to match your setup).

## Recent Changes
- *16 Jul, 2015* - Added a hashid column to the users table.  This allows a non-database ID to be used to reference a user.  (i.e. application key for user account).  The App\User model needs to be changed to ensure this is populated as well.

- *Jul 3, 2015* - the security system has been enhanced to address a security bug.  When used in an application, any user could view the user management pages.  This was known, but it became inconvenient.  The security was changed to allow only the admin user to access the user management pages.  This means that a user cannot edit their own details at the moment, but we feel that is a small issue compared to the larger security hole.


## Warnings

While this package is pretty light weight, it may affect some things you wouldn't expect.  Specifically:

- The database seed routine will truncate the users table.  Anytime the seed is run, all existing users will be removed and the users table will be restored to the expected default setting.  This means your seeding should not happen very often.

- The first user record (ID # 1) is considered the administrative account.  The rudimentary security implemented in the O2s\Users\UserFormRequest object will allow this account to access user management.


## Installation / Configuration

Set up Laravel as you normally would, with a valid database configuration.

require the package:
```
composer require o2s/users dev-develop
```

*Note: change dev-develop to a suitable stable version if/when one exists*

Add the service provider to the end of the providers list in `config/app.php`
```
'O2s\Users\UsersServiceProvider',
```

Publish the package assets:
```
php artisan vendor:publish --provider="O2s\Users\UsersServiceProvider"
```

Adjust your `database/seeds/DatabaseSeeder.php` file to ensure the UsersTableSeeder class is called.  The default file already has the required line, but it needs to be un-commented:
```
<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');	// <-- Uncomment this line
	}

}
```

Migrate and seed your database.  Only run the db:seed once, or when the database is reset.  Otherwise your user table will be cleared and restored to have the admin account only.  If you run into troubles about the UsersTableSeeder class not being found then regenerate your autoload to capture the new files.  The first line below covers this:

```
composer dump-autoload -o
php artisan migrate 
php artisan db:seed
```

Edit the config file if needed.  This is very simple and defines the layout to be used for the admin views.  The config file is stored in the `config/o2suser.php` file.
```
	'layout' => 'app',
```
Change the `app` part to match your desired layout.  (i.e. "layouts.master" is a common layout setting)

Finally, register the Admin middleware that prevents access to the user management interfaces by anyone other than the administrator.  Edit the `app/http/Kernel.php` file and add the following line to the end of the $routeMiddleware array

```
	'admin' => \O2s\Users\Middleware\Admin::class,
```

Done.

## Usage

Manage your users by pointing your browser to the `/admin/users` url.  Click a user to edit them.  Click the New User button to make new users.  When editing an existing user you can click the Remove button to remove that user.

Point your users to `/admin/users/{{ ID }}/edit` to edit their account and/or set their password.  Replace the "{{ ID }}" with the user's database ID.



