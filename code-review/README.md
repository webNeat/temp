# 1. Code Review

```php
<?php
mysql_connect('localhost', 'root', '');
mysql_select_db('mycorp');
$id = $_GET['id'];
$query = mysql_query("SELECT * FROM newsletters WHERE id='" . $id . "'");
while ($newsletter = mysql_fetch_assoc($query)) {
  echo '<h3>' . $newsletter['subject'] . '</h3>';
  echo $newsletter['body'];
  echo 'You are viewing <a href="' . $_SERVER['PHP_SELF']. '?id='. $_GET['id'] . '">This newsletter</a>';
}
```

Well these few lines of code contain many issues. Most of which are security problems.

**Use `PDO` instead of `mysql_*`**

- `mysql_*` functions are **deprecated** and should no longer be used.

- `PDO` has prepared statements which help to prevent SQL injections.

- `PDO` gives the possibility to change the database type easily. Using functions like `mysqli_*` ties the code to MySQL.

- Would be nice to use an ORM or implement a basic one (Like I did here https://github.com/webNeat/rss-reader/tree/master/src/orm). But for this simple case, I have just created the class `Database` to handle queries.

**Exposing the files structure via the URL can be dangerous**

- `.htaccess` can be used to limit the direct access to files. A `RewriteRule`  should be added to it and `$_SERVER['PHP_SELF']` should not be used. Example (assuming that `id` is always an integer). This rule will also ensure that the parameter `$_GET['id']` is always given.

```
RewriteRule ^newsletter/([0-9]+)$ index.php?page=newsletter&id=$1
```

**All user inputs should be checked and validated**

- We should check if `$_GET['id']` is set and has a valid value (this is done using `RewriteRule` above).

- We should ensure that `$newsletter['body']` will not cause any XSS attack. This is out of the scope of this code and should be handled by the part which adds newsletters to the database.

**Create a good files structure instead of writing all code in one file**

- Use configuration file instead of hard coding the application parameters (like database name and type). This would help to change these parameters easily. Multiple versions of the configuration file could be used for multiple environments (Local, Test, Production).

- Use a `public` directory to expose only files you have to, typically images, CSS and Javascript files.

- Separate the views (files showing the data) and controllers (files manipulating data) in different files. I tried to implement a simple MVC pattern without using classes, just simple procedural code.

- Global initialization of the application is done in the `bootstrap.php` file.

**Notes**

- I ignored the front end specific issue (like that the HTML code should be complete, that we may need some CSS ...) and didn't write functional tests.

- I tried to keep it as simple as possible and write all from scratch. So the resulting code is not perfect, but it's better then the first version.
