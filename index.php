<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Website anda telah berfungsi</h1>
    <?php

    $db_scheme = getenv("DB_SCHEME");
    echo "$db_scheme";

    ?>    
</body>
</html>