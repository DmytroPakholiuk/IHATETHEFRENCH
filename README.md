<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About This

Hello, fellow CRMOZ employee. This project is the test task I was given.
The one that needed a Deal/Account creation form with ZohoCRM integration,
made with Laravel and Vue.

## Installation

<ol>
    <li>Clone this repo to your computer</li>
    <li>Copy <code>.env.example</code> to <code>.env</code></li>
    <li>
        Make sure that the app can interact with mysql database. 
        Create an empty database and configure the <code>.env</code> file accordingly
    </li>
    <li>Run <code>php artisan migrate</code></li>
    <li>Run <code>php artisan serve</code></li>
    <li>In <code>VUEISTOOFRENCH</code> directory run <code>npm run dev</code></li>
    <li>
        Retrieve the authentication code from Zoho API console on my account
        (or change the <code>.env</code> to suit your own account) and run 
        <code>php artisan app:start {auth code}</code> . This will create
        the first oauth token / refresh token record in the database and 
        launch automatic token refresh process every thirty minutes.
    </li>
    <li>
        If you stopped the first automatic token refresh process, just run
        <code>php artisan schedule:work</code>
    </li>
    <li>
        The Vue front will be hosted on 127.0.0.1:3000,
        Laravel - on 127.0.0.1:8000. If this still does not work, Try to contact me.
    </li>
</ol>
