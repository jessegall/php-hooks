# php-hooks

A simple package that makes it easy to hook traits to any class.

## Installation

```bash
composer require jessegall/php-hooks
```

## Usage

To enable hooks in your class, you will need to use the `HasHooks` trait and add it to your class:

```php
use JesseGall\Hooks\HasHooks;

class MyClass
{
    use HasHooks;
}
```

You can then define hook methods in your traits by adding methods with a specific naming convention. The method name
should be prefixed with `hook`, followed by the name of the trait. For example:

```php 
trait MyTrait
{
    public function hookMyTrait()
    {
        // Will be called when the hook is initialized
    }  
}
```

To initialize the hooks, you can call the initializeHooks method on an instance of your class:

```php
$myClass = new MyClass();
$myClass->initializeHooks();
```

## Customizing Hooks

By default, the hook methods are expected to be prefixed with `hook`. You can change this prefix by defining a `hookPrefix`
property in your class:

```php
use JesseGall\Hooks\HasHooks;

class MyClass
{
    use HasHooks;

    protected $hookPrefix = 'myHook';
}
```

With the above configuration, the hook methods in your traits should be prefixed with `myHook` instead of `hook`. For example:

```php
trait MyTrait
{
    public function myHookMyTrait()
    {
        // This method will be called when the hook is initialized
    }  
}
```

