# laravel-ldap

Easy to use ldap api for laravel

### Install

 - You can install directly using composer `composer require coderscoop/laravel-ldap`

 - Or include the package to your composer.json

```

"require": {
    "coderscoop/laravel-ldap": "*"
}

```

 - Or download it directly from the github repository

```

"require": {
    "coderscoop/laravel-ldap": "dev-master"
},
"repositories": [
    {
        "type": "git",
        "url": "git@github.com:Coder-Scoop-Inc/laravel-ldap.git"
    }
]

```

 - And run `composer install` or `composer update`

### Requirements

 - `php ldap module` is require to use this package

### Usage

 - Add `Coderscoop\LaravelLdap\LdapServiceProvider::class`, to the providers array in config\app.php.

 - Add `'Ldap' => Coderscoop\LaravelLdap\Facade\LdapFacade::class`, to the aliases array in config\app.php.

 - Include `use Ldap;` to any class you want

 - And then you can do `Ldap::newInstance();`

### Todo

 - Step by step basic configuration/usage
