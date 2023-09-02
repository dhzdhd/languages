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
- `htmlspecialchars()` makes sure any characters that are special in html are properly encoded so people can't inject HTML tags or JavaScript into your page.

---

## PHP tags

- When PHP parses a file, it looks for opening and closing tags, which are `<?php and ?>` or `<?= and ?>` or `<? and ?>` (not recommended for compatibility) which tell PHP to start and stop interpreting the code between them.
- If a file contains only PHP code, it is preferable to omit the PHP closing tag at the end of the file. This prevents accidental whitespace or new lines being added after the PHP closing tag.

## HTML Escaping

```php
<?php if ($expression == true): ?>
  This will show if the expression is true.
<?php else: ?>
  Otherwise this will show.
<?php endif; ?>
```

- PHP will skip the blocks where the condition is not met, even though they are outside of the PHP open/close tags
- The PHP parser doesn't care that it's in the middle of an opening tag, and doesn't require that it be closed. It also doesn't care that after the closing ?> tag is the end of the HTML opening tag.

## Comments

```php
<?php  
  
//======================================================================  
// CATEGORY LARGE FONT  
//======================================================================  
  
//-----------------------------------------------------  
// Sub-Category Smaller Font  
//-----------------------------------------------------  
  
/* Title Here Notice the First Letters are Capitalized */  
  
# Option 1  
# Option 2  
# Option 3  
  
/*  
* This is a detailed explanation  
* of something that should require  
* several paragraphs of information.  
*/  
  
// This is a single line quote.  
?>
```

- As of PHP 8, single line comments starting exactly with `#[` have a special meaning: they are treated as "attributes", and they must respect the expected syntax

## Types

```php
# Types
echo get_debug_type($a_bool), "\n";
if (is_int($an_int)) {  
	$an_int += 4;  
}  
var_dump($an_int); # int(16)

# Type declarations
function a(bool $param): bool|int {}
function array_baz(array &$param): ?T # Can be T|null too
{  
$param = 1;  
}

# Strict typing
declare(strict_types=1);

# Various types
$a = NULL;
$b = true;
```

- PHP is dynamically typed
- Types
	- null
	- bool
	- int
	- float
	- string
	- array
	- object
	- callable
	- resource
- Type system
	- PHP uses a nominal type system with a strong behavioural subtyping relation. The subtyping relation is checked at compile time whereas the verification of types is dynamically checked at run time.
	- It is possible to combine simple types into composite types. PHP allows types to be combined in the following ways:
		- An intersection `&` type accepts values which satisfies multiple class-type declarations, rather than a single one.
		- A union `|` type accepts values of multiple different types, rather than a single one.
	- PHP does not support user-defined type aliases.
- Type declarations
	- We statically type some aspect of the language via the use of type declarations.
	- By default, PHP will coerce values of the wrong type into the expected scalar type declaration if possible. In **strict mode** however, only a value corresponding exactly to the type declaration will be accepted, otherwise a `TypeError` will be thrown
- Type juggling
	-  If an expression/variable is used in an operation which its type does not support, PHP will attempt to type juggle the value into a type that supports the operation

