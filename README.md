## How to install the project in your environment?

### run this command step by step:

- cp .env.example .env
- composer install
- php artisan key:generate
- change url in env file (if needed)
- change database values in env file to connect it
- php artisan migrate --seed
- load the collection file (Koinz.postman_collection.json) in your Postman
- change the base url in postman requests like the APP_URL in env file

## Visit the endpoints
* http://<base_url>/api/most-read
* http://<base_url>/api/submit-read

## For unit test
- php artisan test
