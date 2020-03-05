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

<nav>
    <div class="nav_item_wrapper">
        <a href="poiadd" class="nav_item">Add New POI</a>
        <a href="poisearch" class="nav_item">Search for POI</a>
        <a href="poireview" class="nav_item">Review POI</a>
        <a href="poiread" class="nav_item">Read reviews</a>
    </div>
    <div class="authentication">
        <?php if (isset($_SESSION['gatekeeper'])) { ?>
            <?php echo "Welcome, " . $_SESSION['gatekeeper']; ?>
            <a href="/solent-slim/public/user/sign-out">Log out</a>
        <?php } else { echo "<a href='/solent-slim/public/home'>Home</a>"; } ?>
    </div>
</nav>

<header>
    <div class="header-contents">
        <h1 class="header_heading"><?= $values['title'] ?></h1>
        <h2 class="header_description"><?= $values['desc'] ?></h2>
    </div>
</header>

<div class="page_wrapper">

    <section class="about">
        <h1>Project Features</h1>
        <div class="about_list_items">
            <div class="about_list_item">
                <h4 class="about_heading">Share Points of Interest!</h4>
                <span>Feel free to share your experience with Points of Interest, that you have visited by adding
                    them on the map
                </span>
            </div>
            <div class="about_list_item">
                <h4 class="about_heading">Rate and Read reviews!</h4>
                <span>Help other tourists by rating Points of Interest and writing personal experience reviews!
                    Please be polite and honest!</span>
            </div>
            <div class="about_list_item">
                <h4 class="about_heading">Search and Explore!</h4>
                <span>Planning your travel, but you don't know where to go and what's the place rating? Look it
                    up now!</span>
            </div>
        </div>
    </section>

    <section class="description">
        <div class="description_item contents"></div>
        <div class="description_item">
            <h4>Points of Interest Project Description</h4>
            <p class="reg_text">This project was developed by Aleksandrs Bogackins for Solent University, DFTI.</p>
            <p class="reg_text">This uses PHP Slim, closely working with JS for the best user experience!</p>

            <h4>Points of Interest Project Description</h4>
            <p class="reg_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, quas!</p>
            <p class="reg_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, quas!</p>

            <h4>Points of Interest Project Description</h4>
            <p class="reg_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, quas!</p>
        </div>
    </section>

</div>

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
            <button class="cowabunga_button">Sign-up</button>
        </form>
    </div>

    <div class="cowabunga_form_wrapper">
        <form action="/solent-slim/public/user/sign-in" method="post" class="cowabunga_form">
            <p class="form-heading">Please sign-in here</p>
            <input type="text" required autocomplete="off" name="username" placeholder="Username">
            <input type="password" required autocomplete="off" name="password" placeholder="Password">
            <button class="cowabunga_button">Sign-in</button>
        </form>
    </div>
</div>
<?php } ?>

</body>
<script src="../resources/scripts/app.js"></script>
</html>