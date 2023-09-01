# PHP

## What is PHP

```php
<!DOCTYPE html>
<html>
<head>
<title>Example</title>
</head>
<body>

<?php
	echo "Hi, I'm a PHP script!";
?>

</body>
</html>
```

- PHP (recursive acronym for `PHP: Hypertext Preprocessor`) is a widely-used open source general-purpose scripting language that is especially suited for web development and can be embedded into HTML.
- Unlike JS, PHP code is executed on the server, generating HTML which is then sent to the client

## Getting Started

[Code](./code/first_page.php)

- The server finds out that this file needs to be interpreted by PHP because you used the ".php" extension, which the server is configured to pass on to PHP. Think of this as a normal HTML file which happens to have a set of special tags available to you.

## Something Useful

[Code](./code/useful.php)

- `$_SERVER` is a special reserved PHP variable that contains all web server information. It is known as a **superglobal**.

## Forms

[Code](./code/form.php)

- Any form element will automatically be available to your PHP scripts.
