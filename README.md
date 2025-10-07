# Blog App

Blog App is a Laravel project developed on Linux, featuring the ability to create, edit, delete, and list blog posts. It uses PHP 8.3, Laravel 10, MySQL/PostgreSQL, Composer, and Node.js for frontend assets. The project is compatible with Linux, macOS, and Windows (via Docker).
Note: This setup assumes a Linux environment. Users on Windows or macOS may need to modify certain commands (e.g., package installation or file permissions) to match their OS.
## Installation and Setup

### Local Setup
Clone the repository and navigate into it:
```bash
git clone https://github.com/username/blog-app.git
cd blog-app
```
### Adding .env and docker-compose.yml
```bash
.env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=blog_app
DB_USERNAME=postgres
DB_PASSWORD=postgres

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=0715f7b9be2139
MAIL_PASSWORD=d690bcceaf6c52
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@blog-app.com
MAIL_FROM_NAME="Blog App"


AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

docker-compose.yml
services:
    blog:
        build:
            context: .
            dockerfile: Dockerfile
        container_name: blog-backend
        ports:
            - "8000:8000"
        volumes:
            - .:/var/www
        depends_on:
            - db
        environment:
            APP_ENV: local
            APP_DEBUG: 'true'
            APP_KEY: base64:SomeRandomKeyHere==

    db:
        image: postgres:15
        container_name: blog-db
        environment:
            POSTGRES_USER: postgres
            POSTGRES_PASSWORD: postgres
            POSTGRES_DB: blog_app
        ports:
            - "5432:5432"
        volumes:
            - pgdata:/var/lib/postgresql/data

volumes:
    pgdata:

```
### Building docker
Build docker containers with and after build check if they are running
```bash
docker compose up -d
docker ps
```
### Generate api key in .env if there is none inside blog-backend container
```bash
php artisan key:generate
```
### Migrate db
Inside blog-backend container and start migrations with seed
```bash
php artisan migrate --seed
```
### Email verification
Used https://mailtrap.io/ to test email verification functionality.



