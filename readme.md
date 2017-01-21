# MultiTenancy

## Introduction

MultiTenancy is a Laravel single DB multitenancy package based on subdomain routing.

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require lukapeharda/multitenancy
```

Add the service provider to `config/app.php` in the `providers` array.

```php
LukaPeharda\MultiTenancy\Providers\ContextServiceProvider::class,
```

Publish the config file and modify its params to fit your needs and installation.

```bash
$ php artisan vendor:publish --provider="LukaPeharda\MultiTenancy\ContextServiceProvider"
```

## Usage

Add the `LukaPeharda\MultiTenancy\Scopes\Contextable` trait to your models that are "tenant" dependable. This trait will automatically load global scope which will filter all your queries by defined tenant key.

Beside adding trait to your models, your model DB schema needs to have the tenant key as its attribute (and most likely as its foreign key).

To disable tenant global scope use `withoutGlobalScope` builder method:

```php
$model->withoutGlobalScope(\LukaPeharda\MultiTenancy\Scopes\TenantScope::class);
```

Fetching the current tenant (and all of its attributes) is available through helper function `context`.

```php
// To fetch entire tenant object
$tenant = context();

// To fetch one of its attribute
$tenantId = context('id');
```

## License

MultiTenancy is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
