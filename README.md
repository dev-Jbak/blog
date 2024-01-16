# Bloggging platform

This is a basic example of a blogging application providing a interface to be able to create, update, delete and view posts as well as comments.


### Structure

|  Posts     |
|  --------  |
|    ID      |
| created_at |
| updated_at |
| user_id    |
| title      |
| short_body |
| body       |
| emailed_at |

|  Comments  |
|  --------  |
|    ID      |
| created_at |
| updated_at |
| user_id    |
| post_id    |
| body       |

Post
  -> Comments



## Install

- Docker

## Setting up the enviroment

First spin up the docker instance:

`docker-compose up -d`

---

Install frontend and backend packages:

`npm install`

`composer install`

---

Make a copy of the example env band configure it with mail config:

> MAIL_MAILER=smtp
>
> MAIL_HOST=sandbox.smtp.mailtrap.io
>
> MAIL_PORT=2525
>
> MAIL_USERNAME={{ INSERT PRIVATE TOKEN }}
>
> MAIL_PASSWORD={{ INSERT PRIVATE TOKEN }}
>
> MAIL_ENCRYPTION=tls

---

Generate application key

`php artisan key:generate`

---

Set up the database to migrate all inital tables and seed dummy data

`php artisan migrate:fresh --seed`

---


## Running the app

1. Make sure the docker instance is running:
`docker-compose up -d`

2. Run the frontend dev enviroment: `npm run dev`

3. Run the backend dev enviroment: `php artisan serve`

4. You can now load base url which by default is: `localhost:8000`

> Seeded data includes 3 users:
>
> Email | Password
> 
> admin@local.com | password
> 
> user1@local.com | password
> 
> user2@local.com | password
``


## Extras

Using this command you can send out the emails from the command line:

`php artisan app:send-emails`
