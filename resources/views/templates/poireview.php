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
        <a href="#" class="nav_item">Review POI</a>
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
    <?php if (isset($_SESSION['gatekeeper'])) { ?>

        <p class="form-heading">Search for POI by region</p>
        <input type="text" required autocomplete="off" name="region" placeholder="POI Region" id="value">
        <button onclick="ajaxReviewRequest()">Submit</button>

        <p id="response"></p>
    <?php } else { ?>
        <p>Please log into the system!</p>
    <?php } ?>
</div>

</body>
<script src="../resources/scripts/app.js"></script>
</html>