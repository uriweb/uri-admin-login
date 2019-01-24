# Setting Up

Running gulp and PHP Code Sniffer requires a few prerequsites.

## <a name="gulp"></a>Set up gulp

Source files live in the `src` directory and are compiled with [gulp.js](https://gulpjs.com/).  You'll need to install gulp and the JavaScript modules specified in the devDependencies field of [`package.json`](https://github.com/uriweb/uri-plugin-template/blob/master/package.json).

You might need to first remove any previous versions of gulp you may have installed globally:

```shell
$ npm rm -g gulp
```

Then install gulp-cli globally:

```shell
$ npm install -g gulp-cli
```

Finally, install gulp locally, along with dependencies:

```shell
# Hop into your project dir (if you're not there already)
$ cd <project_dir>

# Install gulp
$ npm install gulp

# Install gulp dependencies
$ npm install --save-dev
```

Run gulp to make sure everything worked:
```shell
$ gulp
```

## <a name="testing"></a>Set up code sniffing (optional)

Code sniffing is accomplished with PHP Code Sniffer.  Sniffing is optional (you can skip this setup harmlessly), but it's recommended to be in compliance with WordPress code standards.

You'll need to install some prerequisites:

* [Composer](https://getcomposer.org), which is used to install PHP CodeSniffer
* [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer), which is used to test code locally
* [WordPress Coding Standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards#installation), a collection of PHP CodeSniffer rules for WordPress

### Install Composer

There are a lot of PHP dependency managers out there, so if you have one you like or are already using, feel free to [install PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer#installation) that way.

For this guide, we'll use Composer.  Here's how to [install it](https://getcomposer.org/download/).

To make the `composer` command available, run:

```shell
# You may need to run with sudo
$ mv composer.phar /usr/local/bin/composer
```

### Install PHP CodeSniffer

Install PHP CodeSniffer using their [instructions for Composer](https://github.com/squizlabs/PHP_CodeSniffer#composer).

Essentially, this involves running:

```shell
$ composer global require "squizlabs/php_codesniffer=*"
```

This will install PHP CodeSniffer globally and add a dependency in your `composer.json` file (it'll create it too, if it doesn't exist)

Then, hop into your `.composer` directory and make sure everything is up to date:

```shell
$ cd .composer
$ composer update
$ vendor/bin/phpcs --version
```

#### Make PHP CodeSniffer available system-wide

Right now, you won't be able to run PHP CodeSniffer from your project directory.  You'll have to run it from `~/.composer` and use absolute paths to any files and directories you want to test.  This will get old fast.

To use `phpcs` and `phpcbf` as global commands, symlink to them in `/usr/local/bin`:

```shell
# Replace <username> with yours
$ sudo ln -s /Users/<username>/.composer/vendor/bin/phpcs /usr/local/bin
$ sudo ln -s /Users/<username>/.composer/vendor/bin/phpcbf /usr/local/bin
```

You should be able to run `phpcs -h` and `phpcbf -h` from anywhere now.

### Install WordPress Coding Standards

Now install the WordPress ruleset for PHP CodeSniffer using their [instructions for Composer](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards#installation).

Essentially, this involves running:

```shell
# In the .composer directory:
$ composer create-project wp-coding-standards/wpcs --no-dev
```

Now we need to tell PHP CodeSniffer about the new rules.  If you're using the `phpcs` and `phpcbf` commands globally, you'll need to use the absolute path to the `wpcs` directory:
```shell
$ phpcs --config-set installed_paths /Users/<username>/.composer/wpcs
```

Verify that the new rules have been added (you should see a bunch of WordPress standards in there now):
```shell
$ phpcs -i
```

### Using PHP CodeSniffer

PHP CodeSniffer is run automatically by gulp via the `.sniff` bash script whenever there's a php file change, so you don't need to worry about doing anything manually.

You can learn more about PHP CodeSniffer on their [wiki](https://github.com/squizlabs/PHP_CodeSniffer/wiki).
