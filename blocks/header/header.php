<?php

use System\classes\User;

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

        <link rel="stylesheet" href="blocks/header/css/normalize.css">
        <link rel="stylesheet" href="blocks/header/css/style.css">
        <link rel="stylesheet" href="pages/styles/carousel.css">
        <script src="blocks/header/js/main.js"></script>
        <title>FitnessFashion</title>
    </head>
<body>
<header class="header">
    <div class="container header__container">
    <a href="/?page=main" class="logo">
        <img class="logo__img rounded" src="blocks/header/logos/IMG_1606.PNG" alt="Logo"/>
    </a>

    <button class="header__burger-btn" id="burger">
        <span></span><span></span><span></span>
    </button>

    <nav class="menu" id="menu">
    <ul class="menu__list">
    <li class="menu__item">
        <a class="menu__link mr-4 ml-4" href="/?page=gym_page">
            Find a gym
        </a>
        <a class="menu__link mr-4 ml-4" href="#">
           Training
        </a>
        <a class="menu__link mr-4 ml-4" href="#">
            FAQ
        </a>
        <a class="menu__link mr-4 ml-4" href="/?page=health_tips_page">
            Health tips
        </a>
    </li>
        <?php
        if (isset($_SESSION['username']) && $_SESSION['uid']) {
            $user_obj = new User();
            $user = $user_obj->getUserById($_SESSION['uid']);
            $user_first_name = $user['name'];
            $user_last_name = $user['surname'];
        ?>
        <div class="dropdown show text-white">
            <a class="btn btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $user_first_name . '&nbsp;' . $user_last_name; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="../../logout.php">Log out</a>
                <a class="dropdown-item" href="/?page=profile_settings">Profile settings</a>
                <a class="dropdown-item" href="/?page=personal_trainings">Personal trainings</a>
                <?php
                if ($user['user_role'] == "admin") {
                    ?>
                    <a class="dropdown-item" href="/?page=admin_page">Admin panel</a>
                <?php } else if ($user['user_role'] == "moder") {
                ?>
                    <a class="dropdown-item" href="/?page=moder_page">Moder panel</a>
                <?php } else if ($user['user_role'] == "trainer") {?>
                    <a class="dropdown-item" href="/?page=trainer_page">Trainer panel</a>
                <?php } ?>
            </div>
        </div>
            <?php } else { ?>
                <li class="menu__item">
                    <a class="menu__link" href="../../login.php">
                        Log in
                    </a>
                </li>
            <?php } ?>
    </ul>
    </nav>
    </div>
</header>