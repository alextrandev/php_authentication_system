# PHP Authentication system

A login app with account activation using email link verification
Certain part of the site only visible to registered users

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
