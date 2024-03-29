PHP 5.2 Autoloading for Composer
================================

** THIS IS A FORK OF https://bitbucket.org/xrstf/composer-php52 to get and fix full compatibility on PHP 5.2 and also
to have the repo hosted on GITHUB **

This package provides a an easy way to get a PHP 5.2 compatible autoloader out of Composer. The generated autoloader is fully compatible to the original and is written into separate files, each ending with `_52.php`.

*Note:* Currently, updating the autoloader on `composer dump-autoload` is not possible, as there is no script event yet that one could hook a script into.

Usage
-----

In your project's `composer.json`, add the following lines:

    :::json
    {
        "require": {
            "webworker01/composer-php52": "1.*@dev"
        },
        "scripts": {
            "post-install-cmd": [
                "webworker01\\Composer52\\Generator::onPostInstallCmd"
            ],
            "post-update-cmd": [
                "webworker01\\Composer52\\Generator::onPostInstallCmd"
            ]
        }
    }

After the next update/install, you will have a `vendor/autoload_52.php` file, that you can simply include and use in PHP 5.2 projects.
