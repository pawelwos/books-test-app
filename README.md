# books-test-app
Simple Laravel Fullstack app for managing books. Both backend API and frontend using VueJs are on a single laravel instal. 

Demo available at: <a href="http://139.162.163.187/ ">http://139.162.163.187/ </a>

To install the app:
1. Clone the repo
2. docker-compose up
3. docker-compose exec myapp composer install
4. docker-compose exec myapp npm install
5. docker-compose exec myapp npm run build
6. docker-compose exec myapp php artisan migrate --seed

API endpoints:

list

GET http://139.162.163.187/api/books

view

GET http://139.162.163.187/api/books/{book}

create

POST http://139.162.163.187/api/books/{book}

updated

PUT http://139.162.163.187/api/books/{book}

delete

DELETE http://139.162.163.187/api/books/{book}

