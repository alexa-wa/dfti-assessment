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

<nav>
    <div class="nav_item">Add new POI</div>
    <div class="nav_item">Search for POI</div>
</nav>

    <p>Hello, <?php echo $_SESSION['gatekeeper'] ?> </p>
    <a href="/solent-slim/public/user/sign-out">Log out</a>

<form action="" method="post">
    <p class="form-heading">Add new POI</p>
    <input type="text" required autocomplete="off" name="name" placeholder="Name">
    <input type="text" required autocomplete="off" name="type" placeholder="Type">
    <input type="text" required autocomplete="off" name="country" placeholder="Country">
    <input type="text" required autocomplete="off" name="region" placeholder="Region">
    <input type="text" required autocomplete="off" name="description" placeholder="Description">
    <button>Submit</button>
</form>

<form action="" method="post">
    <p class="form-heading">Search for POI by region</p>
    <input type="text" required autocomplete="off" name="name" placeholder="POI Region">
    <button>Submit</button>
</form>

</body>
</html>