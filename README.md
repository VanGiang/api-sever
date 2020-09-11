# Setup Project
- Clone project.
- Run *composer install*
- Run *php artisan jwt:secret*
- Run *php artisan storage:link*
- Setup .env
```
    // About database if using mysql change parameters below using your configuration.
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    // Or using Sqlite for fast light database.
    DB_CONNECTION=sqlite
    DB_DATABASE=path/to/file/database.sqlite
    // Config public disk to public image.
    FILESYSTEM_DRIVER=public
```
- Run migration.
- Run db seed to generate 2 user.

# Setup Server

Choose nginx or apache. Or run *php artisan serve* to run build in server.

# Api endpoint

Base url depend on your host config.

| Endpoint   | Method   | Description   |
|---|---|---|
| api/auth/login          | POST   | login with data {email, password}                          |
| api/auth/logout         | POST   |                                                            |
| api/auth/me             | POST   |                                                            |
| api/auth/refresh        | POST   |                                                            |
| api/images              | GET    | Get all with parm *keyword* to search and *page* to pagination                                                  |
| api/images              | POST   | Create one with form data {file: file upload, infos: text} |
| api/images/{id}         | PUT    | Update one with form data {file: file upload, infos: text} |
| api/images/{id}         | DELETE | Delete one                                                 |
| api/images/{id}         | GET    | Get detail                                                 |