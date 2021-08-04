Installation
Add a Composer dependency and install the package.

composer require ckfinder/ckfinder-laravel-package
Run the command to download the CKFinder code.

After installing the Laravel package you need to download CKFinder code. It is not shipped with the package due to different license terms. To install it, run the following artisan command:

php artisan ckfinder:download
It will download the required code and place it inside an appropriate directory of the package (vendor/ckfinder/ckfinder-laravel-package/).

Publish the CKFinder connector configuration and assets.

php artisan vendor:publish --tag=ckfinder-assets --tag=ckfinder-config
This will publish CKFinder assets to public/js/ckfinder, and the CKFinder connector configuration to config/ckfinder.php.

You can also publish the views used by this package in case you need custom route names, different assets location, file browser customization etc.

php artisan vendor:publish --tag=ckfinder-views
Finally, you can publish package's configuration, assets and views using only one command.

php artisan vendor:publish --tag=ckfinder
Create a directory for CKFinder files and allow for write access to it. By default CKFinder expects the files to be placed in public/userfiles (this can be altered in the configuration).

mkdir -m 777 public/userfiles
NOTE: Since usually setting permissions to 0777 is insecure, it is advisable to change the group ownership of the directory to the same user as Apache and add group write permissions instead. Please contact your system administrator in case of any doubts.

CKFinder by default uses a CSRF protection mechanism based on double submit cookies. On some configurations it may be required to configure Laravel not to encrypt the cookie set by CKFinder.

To do that, please add the cookie name ckCsrfToken to the $except property of EncryptCookies middleware:

// app/Http/Middleware/EncryptCookies.php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        'ckCsrfToken',
        // ...
    ];
}
You should also disable Laravel's CSRF protection mechanism for CKFinder's path. This can be done by adding ckfinder/* pattern to the $except property of VerifyCsrfToken middleware: (app/Http/Middleware/VerifyCsrfToken.php)

// app/Http/Middleware/VerifyCsrfToken.php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'ckfinder/*',
        // ...
    ];
}
At this point you should see the connector JSON response after navigating to the <APP BASE URL>/ckfinder/connector?command=Init address. Authentication for CKFinder is not configured yet, so you will see an error response saying that CKFinder is not enabled.

Configuring Authentication
CKFinder connector authentication is handled by middleware class or alias. To create the custom middleware class, use the artisan command:

php artisan make:middleware CustomCKFinderAuth
The new middleware class will appear in app/Http/Middleware/CustomCKFinderAuth.php. Change the authentication option in config/ckfinder.php:

$config['authentication'] = '\App\Http\Middleware\CustomCKFinderAuth';
The handle method in CustomCKFinderAuth class allows to authenticate CKFinder users. A basic implementation that returns true from the authentication callable (which is obviously not secure) can look like below:

public function handle($request, Closure $next)
{
    config(['ckfinder.authentication' => function() {
        return true;
    }]);
    return $next($request);
}
Please have a look at the CKFinder for PHP connector documentation to find out more about this option.

Note: Alternatively, you can set the configuration option $config['loadRoutes'] = false; in config/ckfinder.php. Then you copy the routes from vendor/ckfinder/ckfinder-laravel-package/src/routes.php to your application routes such as routes/web.php to protect them with your Laravel auth middleware.

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
Configuration Options
The CKFinder connector configuration is taken from the config/ckfinder.php file.

To find out more about possible connector configuration options please refer to the CKFinder for PHP connector documentation.

Usage
The package code contains a couple of usage examples that you may find useful. To enable them, uncomment the ckfinder_examples route in vendor/ckfinder/ckfinder-laravel-package/src/routes.php:

// vendor/ckfinder/ckfinder-laravel-package/src/routes.php

Route::any('/ckfinder/examples/{example?}', 'CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
    ->name('ckfinder_examples');
After that you can navigate to the <APP BASE URL>/ckfinder/examples path and have a look at the list of available examples. To find out about the code behind them, check the views/samples directory in the package (vendor/ckfinder/ckfinder-laravel-package/views/samples/).

Including the Main CKFinder JavaScript File in Templates
To be able to use CKFinder on a web page you have to include the main CKFinder JavaScript file. The preferred way to do that is to include the CKFinder setup template, as shown below:

@include('ckfinder::setup')
The included template renders the required script tags and configures a valid connector path.

<script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
<script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>