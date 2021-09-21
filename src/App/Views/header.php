<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Philter - Add colour to your life</title>
    <meta name="description" content="Image filtering and sharing">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/vendor/cssgram.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
    <div class="loader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
    <header id="header">
      <div class="container-fliud">
        <nav id="menu" class="navbar navbar-expand-md navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-navbar">
                <ul class="navbar-nav ml-md-auto">
                  <li><a href="/">Home</a></li>
                  <li><a href="/image">Images</a></li>
                <?php if(isset($_SESSION['is_logged_in'])) : ?>
                  <li><a href="/">Welcome <?php echo $_SESSION['user_data']['name']; ?></a></li>
                  <li><a href="/user/logout">Logout</a></li>
                <?php else : ?>
                  <li><a href="/user/login">Login</a></li>
                  <li><a href="/user/register">Register</a></li>
                <?php endif; ?>
                </ul>
            </div>
        </nav>
      </div>
    </header>
    <!--end header-->