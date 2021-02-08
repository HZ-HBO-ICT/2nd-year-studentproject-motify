# Motify Application <img style="align: right; float: right" src="https://img.shields.io/badge/php-%5E7.3-purple" alt="PHP Version">
<p style='text-align: justify;'><img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/da871337-d118-4488-8380-862ea2107950/db95ucc-9dee0777-e87b-4b20-9939-0607c3a0941d.png/v1/fill/w_658,h_633,strp/better_resolution_mocking_spongebob_by_ncognito_deviantart_db95ucc-fullview.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOiIsImlzcyI6InVybjphcHA6Iiwib2JqIjpbW3siaGVpZ2h0IjoiPD02MzMiLCJwYXRoIjoiXC9mXC9kYTg3MTMzNy1kMTE4LTQ0ODgtODM4MC04NjJlYTIxMDc5NTBcL2RiOTV1Y2MtOWRlZTA3NzctZTg3Yi00YjIwLTk5MzktMDYwN2MzYTA5NDFkLnBuZyIsIndpZHRoIjoiPD02NTgifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.tLE1ZaaQVtPGgmOX0rXZsDOy6Tzuge4d73Kt1NQk5Rk"  style="text-align: right; float: right;align-content: revert" width="200"></p>

#### First set-up
Follow the instructions to run the project yourself for development.

$ `composer install`

$ `npm install`
***
 

#### Create a .env File 

```shell script
Copy .env.example to .env 
Fill in the database settings
```

#### Set the Application Keys & prepare database
$ `php artisan key:generate`

$ `php artisan jwt:secret`

$ `php artisan migrate:fresh -—seed`

$ `composer dump-autoload`

***

#### Set the storage path
$ `php artisan storage:link`

***


#### Build and run the project in development mode
$ `npm run watch`
PHP Artisan serve will be runned automatic
Now, a window wil open and every time you edit something it wil automaticly compile and reload

#### Build the project for deployment
$ `npm run prod`
*** 

### Development Team

* **Angelique Huige** - *HBO-ICT* - [angeliquehuige](https://github.com/angeliquehuige)
* **Mariska Harnam** - *HBO-ICT* - [MariskaH](https://github.com/MariskaH)
* **Mart de Jager** - *HBO-ICT* - [martdejager](https://github.com/martdejager)
* **Levi Deurloo** - *HBO-ICT* - [levideurloo](https://github.com/levideurloo)
* **Danny Lifino** - *HBO-ICT* - [dannylifino](https://github.com/dannylifino)
