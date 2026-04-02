<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (str_contains($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
    ?>
        <h3>str_contains() returned true</h3>
        <p>You are using Firefox</p>
    <?php
    } else {
    ?>
        <h3>str_contains() returned false</h3>
        <p>You are not using Firefox</p>
    <?php
    }
    ?>
</body>

</html>
