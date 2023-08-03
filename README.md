<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## challenge_beer-tap-dispenser

Welcome to the README file for your challenge_beer-tap-dispenser project! This document will guide you through the installation and setup process.

## Prerequisites

Before you begin, make sure you have the following tools installed:

- [Composer](https://getcomposer.org/download/)
- [PHP](https://www.php.net/manual/en/install.php) (>= 7.3)
- [Mysql or sqlserver Database](https://www.mysql.com/)

## Installation

 1. Clone the repository:

   ```bash
   git clone https://github.com/upworksanjeev/Dispenser-API.git
   cd Dispenser-API```

 2. Install dependencies:

   ```bash
   composer install```
    
 3. Create a copy of the .env.example file and name it .env:

    ```bash
    cp .env.example .env ```

 4. Generate an application key:

    ```bash
    php artisan key:generate```

 5. Configure your .env file with your database and other settings.

 6. Run migrations and seed the database:
    
    ```bash
    php artisan migrate --seed```



## Usage 

  To start the development server, run:

  ```bash 
    php artisan serve```


  You can now access your Laravel project at http://localhost:8000.

## List Of API and usage 

1. Login API

	```bash 
	curl --location 'http://127.0.0.1:8000/api/login' \
	--header 'Accept: application/json' \
	--form 'email="admin@admin.com"' \
	--form 'password="password"'
	```

- location: Follow redirects if the server responds with a redirect.
- header 'Accept: application/json': Set the Accept header to indicate that you expect JSON response.
- form 'email="admin@admin.com"': Specify the email parameter for the login request.
- form 'password="password"': Specify the password parameter for the login request.

2. Logout API

	```bash 
	curl --location --request POST 'http://127.0.0.1:8000/api/logout' \
	--header 'Accept: application/json' \
	--header 'Authorization: Bearer {token from API 1}' ```

- request POST: Set the HTTP method to POST.
- header 'Accept: application/json': Set the Accept header to indicate that you expect a JSON response.
- header 'Authorization: Bearer eyJ0eXAi...': Include the Authorization header with a JWT token. Replace eyJ0eXAi... with your actual JWT token.

3. Create Dispensers

	```bash 
	curl --location --request POST 'http://127.0.0.1:8000/api/dispensers' \
	--header 'Accept: application/json' \
	--header 'Authorization: Bearer {token from API 1}'
	--form 'flow_volume="{value}"'```

- request POST: Set the HTTP method to POST.
- header 'Accept: application/json': Set the Accept header to indicate that you expect a JSON response.
- header 'Authorization: Bearer {token}': Include the Authorization header with a JWT token. Replace {token} with your actual JWT token.
- form 'flow_volume="0.3"': Send the flow_volume parameter as form data with the value

4. Open a Dispenser

	```bash 
	curl --location --request POST 'http://127.0.0.1:8000/api/dispensers/open/4' \
	--header 'Accept: application/json'
	```

- request POST: Set the HTTP method to POST.
- location: Follow redirects if the server responds with a redirect.
- header 'Accept: application/json': Set the Accept header to indicate that you expect a JSON response.

4. Close a Dispenser

	```bash 
	curl --location --request POST 'http://127.0.0.1:8000/api/dispensers/close/6aea4cd3-8a9f-4e9e-9c99-812bf69cf96e'
	```

- request POST: Set the HTTP method to POST.
- location: Follow redirects if the server responds with a redirect.
- header 'Accept: application/json': Set the Accept header to indicate that you expect a JSON response.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
