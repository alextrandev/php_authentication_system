# PHP Authentication system

A authenticator app feature account activation and password reset using email link verification. Certain part of the site only visible to registered users

## Function

### Register page:

- input check for each field and display error
- check if email already register and display error
- send a verification email
- user will be recognize as active after email verification

### Login page:

- input and authentication check
- option for customer to reset password

### Reset password

- send an email with reset link
- input check if user give the old password

### Dashboard

- Can only be access if logged in
- Show user infos and all registered user info

## When cloning the project

### Install docker

Require docker to host the site locally: [Installation](https://www.docker.com/)

### Build the docker images

```shell
docker-compose build
```

### Run the docker images

```shell
docker-compose up
```

### Install PHP mailer

```shell
docker run --rm --interactive --tty \
  --volume $PWD:/app \
  composer require phpmailer/phpmailer
```

### Create MySQL table

Login to DB with PHPMyAdmin using username: root and password: nimda
Create the users table:

```SQL
CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## Extension

- Docker: to create a local development environment with the mamp stack (macOS, Apache, mySQL, phpmyadmin, php 8.3)
- PDO: handle access and manage database
- Composer: to install some libraries (install via docker image's dockerfile COPY command)
- PHPmailer: library to handle email sending. Installation:

```shell
docker run --rm --interactive --tty \
  --volume $PWD:/app \
  composer require phpmailer/phpmailer
```

- Mailtrap (https://mailtrap.io/home): email sending platform
