# laravel-under-construction
Laravel middleware to display under construction message with an option to login 

## Description
It's dead simple. The middleware redirects to the under construction page. This may useful in instances when you want push a release to a server that is still under construction. The under construction page will show to all visitors. 

If you want to allow certain visitors to be able to see the site you can enable the login option in your .env file. 

To make development easier, you can also disable the under construction when the request ip is the localhost. Similarly, when on server you can disable the under construction message when the request is from certain ip addresses.

You enable and disable the under construction message for everyone at any point by changing the .env value.

However, when you are ready to go live and no longer need the under construction message, you should remove the middleware from the kernel.


## Provider
Add **Jrl05k\UnderConstruction\UnderConstructionProvider::class** to _config/app.php_ providers.


## Middleware
Add **\Jrl05k\UnderConstruction\RedirectIfUnderConstructionMiddleware::class** to _Kernel.php_ middlewareGroups web. 

It's a simple middleware that will redirect to an "under construction" page. 

However, it can be enabled to have a login to get past the under construction page.


## .env
You will need to add the following to your .env and set them accordingly

- **UNDER_CONSTRUCTION=**true
- **UNDER_CONSTRUCTION_ON_LOCALHOST=**{true/false} // false will disable under construction when request ip is 127.0.0.1}
- **UNDER_CONSTRUCTION_ALLOWED_IP_ADDRESSES=**{8.8.8.8,8.8.4.4} // comma separated string of ip addresses that won't see under construction
- **UNDER_CONSTRUCTION_LOGIN_ALLOWED=**{true/false} // allow a login page
- **UNDER_CONSTRUCTION_LOGIN_KEY=**123457890 // if you have a login page set the login key here


### Settings
- If UNDER_CONSTRUCTION=true is set in .env, the middleware will redirect to the under construction page for all routes.
- To have under contruction disabled on localhost set UNDER_CONSTRUCTION_ON_LOCALHOST=false
- When on server, if you want to access site from your ip or give access to others add the ip addresses separated by commas to the .env UNDER_CONSTRUCTION_ALLOWED_IP_ADDRESSES
- If you want to give access to someone, but do not have their ip address or the ip address is shared you can enable the login page in .env with UNDER_CONSTRUCTION_LOGIN_ALLOWED=true
- If you are using the login page set the key in .env UNDER_CONSTRUCTION_LOGIN_KEY


## Disable 
To temporarily turn off the under construction message, you can set the .env UNDER_CONSTRUCTION variable to false. 

But to permanently disable it when it is no longer needed for a live production site, you should remove the **\Jrl05k\UnderConstruction\RedirectIfUnderConstructionMiddleware::class** middleware from the Kernel.php.
Keeping it in middleware and just disabling it by the .env setting will have a performance cost; so it is best to remove it completely from the Kernel.php middleware.

_You can also remove the provider to clean things up more thoroughly._
