# BlogPost
Blog Professionnel

## Database and email with GMail SMTP server

1. Copy the file `app/config/dev.ini.dist` into `app/config/dev.ini` for development use
or `config/prod.ini.dist` into `config/prod.ini` for production use
2. Enter your database's and GMail's credentials
3. import `db/blog_post.sql` into your MySQL database

## Dependencies

Twig is used as template and Swiftmailer to send emails

To install the defined dependencies for your project, just run the install command.

php composer.phar install or composer install
