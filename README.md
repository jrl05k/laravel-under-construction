# laravel-under-construction
Laravel middleware to display under construction message with an option to login 

## Description
It's simple. The middleware redirects to the under construction page. This may useful in instances when you want push a release that is still "under construction" to a live server. Then you can use the middleware to display an under construction page to visitors. 

If you want to allow certain visitors to be able to see the site you can enable the login option in your .env file. 

To make development easier, you can also disable the under construction redirect when the request ip is the localhost. Similarly, when on live server you can disable the under construction message when the request is from certain ip addresses.

You can enable/disable the under construction message for everyone at any point by changing the .env value.

However, when you are ready to go live and no longer need the under construction message, you should remove the middleware from the kernel.

## Installation
```bash
composer require devswebdev/devtube
```
## Provider
Add **UnderConstruction\UnderConstructionProvider::class** to _config/app.php_ providers. (only for <5.5.x)
```php
  'providers' => [
    ...
    ...
    /*
     * Other Service Providers...
     */
    UnderConstruction\UnderConstructionProvider::class,  
    ...
    ...
```

## Middleware
It's a simple middleware that will redirect to an "under construction" page. 

But, it can be enabled to have a login to bypass the under construction page.

Add **\UnderConstruction\RedirectIfUnderConstructionMiddleware::class** to _Kernel.php_ middlewareGroups web.
```php
  protected $middlewareGroups = [
    'web' => [
      ...
      \UnderConstruction\RedirectIfUnderConstructionMiddleware::class
      ...
```

## .env
You will need to add the following to your .env and set them accordingly

- **UNDER_CONSTRUCTION=** {true/false}
- **UNDER_CONSTRUCTION_ON_LOCALHOST=** {true/false}
- **UNDER_CONSTRUCTION_ALLOWED_IP_ADDRESSES=** {8.8.8.8,8.8.4.4} _(also can be blank, null, or false for none)_
- **UNDER_CONSTRUCTION_LOGIN_ALLOWED=** {true/false}
- **UNDER_CONSTRUCTION_LOGIN_KEY=** {123457890}


### .env Settings
- If UNDER_CONSTRUCTION=true is set in .env, the middleware will redirect to the under construction page for all routes.
- To have under contruction disabled on localhost set UNDER_CONSTRUCTION_ON_LOCALHOST=false
- When on a remote server, if you want to access the site from your ip, or give access to others, add the ip addresses separated by commas to the .env UNDER_CONSTRUCTION_ALLOWED_IP_ADDRESSES
- If you want to give access to someone, but do not have their ip address, or the ip address is shared, you can enable the login page in .env with UNDER_CONSTRUCTION_LOGIN_ALLOWED=true
- If you are using the login page set the key in .env UNDER_CONSTRUCTION_LOGIN_KEY


## Apply to specific routes only
If you want to apply the under construction redirect to certain routes, then instead of putting the middleware in the $middlewareGroups 'web' group, you should put it in the $routeMiddleware array. Then put a route group around the routes you want protected.

Example:

  In Kernel.php
  ```php
    $routeMiddleware => [
      ...
      'under-construction' => \UnderConstruction\RedirectIfUnderConstructionMiddleware::class, 
      ...
  ```
  
  In routes/web.php
  ```php
    Route::get('/', function () {
      return view('welcome');
    });

    Route::group(['middleware'=>'under-construction'], function() {
      // the routes you want protected...    
      Route::get('/some-page', ...
      Route::get('/another-page', ...
      ...
    });
  ```    
  
## Custom views
If you want to use a custom under construction page, you can over-ride the views by placing view file in path:

> resources/views/vendor/underconstruction/under_construction.blade.php


Likewise, to over-ride the log in create your view in path: 

> resources/views/vendor/underconstruction/under_construction_login.blade.php




## Disable 
To temporarily turn off the under construction message, you can set the .env UNDER_CONSTRUCTION variable to false. 

But to permanently disable it when it is no longer needed for a live production site, you should remove the **\UnderConstruction\RedirectIfUnderConstructionMiddleware::class** middleware from the Kernel.php.
Keeping it in middleware and just disabling it by the .env setting will have a performance cost; so it is best to remove it completely from the Kernel.php middleware.
