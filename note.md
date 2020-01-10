# Note for Laravel API

## Laravel passport

> Offical documentation of laravel passport are available in [here](https://laravel.com/docs/6.x/passport)  
> Tutorial avaiable in [here](https://github.com/anil-sidhu/laravel-passport-poc)

### 1.Installation

#### First

Just run this command in cmd `composer require laravel/passport`  
Then, run `php artisan migrate` to create a needed table for Passport.  
After that, run `php artisan passport:install` to create encryption keys needed to generate secure access tokens

#### Config your app

Add the `Laravel\Passport\HasApiTokens` trait to your `App\User` model
> Example:
>
> ```<?php
> namespace App;
> use Illuminate\Foundation\Auth\User as Authenticatable;
> use Illuminate\Notifications\Notifiable;
> use Laravel\Passport\HasApiTokens;
> class User extends Authenticatable
> {
>     use HasApiTokens, Notifiable;
> }

Next, call the `Passport::routes` method within the boot method of your `AuthServiceProvider`

```<?php
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider
{
    [...]
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
```

Finally, in your `config/auth.php` configuration file, you should set the driver option of the `api` authentication `guard` to `passport`

```<?php
'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
```

#### Migration Customization

Please read the full documentation in [here](https://laravel.com/docs/6.x/passport#installation)

### [2. Frontend Quickstart](https://laravel.com/docs/6.x/passport#frontend-quickstart)

### [3. Deploying passport](https://laravel.com/docs/6.x/passport#deploying-passport)

In the first time when you deploying Passport, you will need run

> `php artisan passport:keys`  

to generate the access key token.  
In addition,  you may define the path where Passport's keys should be loaded from.

```<?php
public function boot()
{
    $this->registerPolicies();

    Passport::routes();

    Passport::loadKeysFrom('/secret-keys/oauth');  
    //this line define where your key loaded
}
```

May be need publish Passport's configuration file?  

> `php artisan vendor:publish --tag=passport-config`

### 4. Configuration

#### Token Lifetimes

By default, token will expire after 1 year. By using `tokensExpireIn`, `refreshTokensExpireIn`, `personalAccessTokensExpireIn`, you can configure the token lifetimes  
These methods should be called from the `boot` method of your `AuthServiceProvider`  

``` <?php
public function boot()
{
    $this->registerPolicies();

    Passport::routes();

    Passport::tokensExpireIn(now()->addDays(15));

    Passport::refreshTokensExpireIn(now()->addDays(30));

    Passport::personalAccessTokensExpireIn(now()->addMonths>6));
}
```

#### [Overriding Default Models](https://laravel.com/docs/6.x/passport#overriding-default-models)

You can read more in [here](https://stackoverflow.com/questions/53897379/customize-laravel-passport-so-it-can-be-used-with-own-models-jwt)

### Issuing Access Tokens

OAuth2 with authorization code

#### [Managing Clients](https://laravel.com/docs/6.x/passport#managing-clients)

##### The `passport:client` Command

##### JSON API

### [Requesting Tokens](https://laravel.com/docs/6.x/passport#requesting-tokens)

#### Redirecting For Authorization

### [Personal Access Tokens](https://laravel.com/docs/6.x/passport#personal-access-tokens)
