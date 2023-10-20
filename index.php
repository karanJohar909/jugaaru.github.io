<?php
session_start();

if (isset($_SESSION["name"])) {
    header("location: ./home.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jugaar</title>

    <link rel="stylesheet" href="./style.css" />
</head>

<body>
    <div class="container">
        <div class="box">
            <h1 class="box__title">Jugaar</h1>
            <p class="box__subtitle">Please log in to continue</p>
            <?php if (isset($_SESSION["login_failed"])): ?>
                <div class="alert">
                    Incorrect Secret Key!
                </div>
            <?php unset($_SESSION["login_failed"]);endif; ?>
            <form action="./auth.php" method="post" class="form">
                <input type="text" class="form__input" placeholder="Enter Secret Key" name="username" required />
                <button class="form__button" type="submit" name="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>

</html>