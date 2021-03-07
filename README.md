INSTALLATION
------------

~~~
composer install
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=shortener',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

Apply migrations by running the command:

~~~
php yii migrate
~~~

### Apache

Add the following to Apache httpd.conf or virtual host config file. Remember to replace path/to/shortener/web with the correct path to shortener/web.

~~~
<VirtualHost shortener:80>

        ServerName shortener
        DocumentRoot "path/to/shortener/web"

        <Directory "path/to/shortener/web">
                RewriteEngine on
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteCond %{REQUEST_FILENAME} !-d
                RewriteRule . index.php
        </Directory>
</VirtualHost>
~~~

### Hosts file

Add the following to hosts file:

~~~
127.0.0.1 shortener
~~~

After installation and configuration, the application will be available at the following URL:

~~~
http://shortener/index.php
~~~