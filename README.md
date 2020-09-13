# Laravel-csrf

This application is vulnerable to CSRF.
You can to try to add an entry in database on behalf of an authenticated user.

## Explanation

### Basics

The `HackmeController` with the route `hackme`.
Try if the request come from an authenticated user to persist an entry in the `pawns` database.

To be able to perform the csrf attack some miss configurations had to be done on the application.
The first one and the most obvious was to remove **CSRF** check on each request.
To do this we removed the **middleware** in `Kernel` class from `App\Http` namesapce.

We also removed the ` \App\Http\Middleware\EncryptCookies` from the *middleware*
> I don't know why yet

### Miss configurations

By default laravel has a CORS `\Fruitcake\Cors\HandleCors` class that protect the user from **CORS**.
The **server** don't allow *request* from an other origin than one expected.
We can remove this entry from the middleware chain but a miss configuration lead to the same vulnerability.
We can allow all origin in the `config/cors.php`:
```php
'allowed_origins' => ['*'],
```
This make possible to our malicious form in `malicious-site.html`. To execute a `POST` request on our server.

A *last thing* need to be done we need to change the same site option of the session cookie.
We can do this in `config/session.php` :

```php
'same_site' => 'none',
```
> Need to check if we can do the same with `lax`

Like this the browser accept that the malicious site use the cookie session of user authenticated with his **crafted request**.
