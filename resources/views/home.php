<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resources/css/main.css">
    <title><?= $values['title'] ?></title>
</head>
<body>

<header>
    <div class="header-contents">
        <h1 class="header_heading"><?= $values['title'] ?></h1>
        <h2 class="header_description"><?= $values['desc'] ?></h2>
    </div>
</header>

<?php if (!isset($_SESSION['gatekeeper'])) { ?>
<div class="home_content_wrapper">
    <div class="cowabunga_form_wrapper">
        <form action="/solent-slim/public/user/sign-up" method="post" class="cowabunga_form" onsubmit="return validation
        ()">
            <p class="form-heading">Please sign-up here</p>
            <input type="text" required autocomplete="off" name="username" placeholder="Username" class="js-reg-usr">
            <input type="password" required autocomplete="off" name="password" placeholder="Password"
                   class="js-reg-pas">
            <p class="php-errors"><?php // ...TO-BE IMPLEMENTED.. ?></p>
            <p class="js-errors"></p>
            <button>Sign-up</button>
        </form>
    </div>

    <div class="cowabunga_form_wrapper">
        <form action="/solent-slim/public/user/sign-in" method="post" class="cowabunga_form">
            <p class="form-heading">Please sign-in here</p>
            <input type="text" required autocomplete="off" name="username" placeholder="Username">
            <input type="password" required autocomplete="off" name="password" placeholder="Password">
            <button>Sign-in</button>
        </form>
    </div>
</div>
<?php } else { ?>

    <p>Hello, <?php echo $_SESSION['gatekeeper'] ?> </p>
    <a href="/solent-slim/public/user/sign-out">Log out</a>

<?php } ?>

</body>
<script src="../resources/scripts/app.js"></script>
</html>