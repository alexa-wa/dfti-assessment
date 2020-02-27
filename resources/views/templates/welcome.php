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
        <div class="nav_item">Add New POI</div>
        <div class="nav_item">Search for POI</div>
        <div class="nav_item">3</div>
    </div>
    <div class="authentication">
        <?php if (isset($_SESSION['gatekeeper'])) { ?>
            <?php echo "Welcome, " . $_SESSION['gatekeeper']; ?>
            <a href="/solent-slim/public/user/sign-out">Log out</a>
        <?php } ?>
    </div>
</nav>

<header>
    <div class="header-contents">
        <h1 class="header_heading"><?= $values['title'] ?></h1>
        <h2 class="header_description">

        </h2>
    </div>
</header>

<?php if (isset($_SESSION['gatekeeper'])) { ?>

    <form class="subject_form search" action="/solent-slim/public/poi/add" method="post">
        <p class="form-heading">Add new POI</p>
        <input class="subject_field" type="text" required autocomplete="off" name="name" placeholder="Name">
        <input class="subject_field" type="text" required autocomplete="off" name="type" placeholder="Type">
        <input class="subject_field" type="text" required autocomplete="off" name="country" placeholder="Country">
        <input class="subject_field" type="text" required autocomplete="off" name="region" placeholder="Region">
        <input class="subject_field" type="text" required autocomplete="off" name="description"
               placeholder="Description">
        <button>Submit</button>
    </form>

    <p class="form-heading">Search for POI by region</p>
    <input type="text" required autocomplete="off" name="region" placeholder="POI Region" id="value">
    <button onclick="ajaxRequest()">Submit</button>

    <p id="response"></p>
<?php } else { ?>
    <p>Please log into the system!</p>
<?php } ?>

<script src="../resources/scripts/app.js"></script>
</body>
</html>