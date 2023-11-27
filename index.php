<?php

use System\classes\User;

session_start();
//define("ABSPATH",true);
require_once 'system/config.php';
require_once 'system/classes/User.php';
require_once 'blocks/header/header.php';

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case "main":
            require_once "pages/main.php";
            break;
        case "register":
            require_once "register.php";
            break;
        case "admin_page":
            $user_obj = new User();
            $user = $user_obj->getUserById($_SESSION['uid']);
            if ($user['user_role'] == "admin") {
                require_once "pages/admin_page/admin_page.php";
            }
            if ($user['user_role'] == "admin") {
                if (isset($_GET['action'])) {
                    $action = $_GET['action'];
                    if ($action == 'user_list') {
                        require_once "pages/admin_page/user_list.php";
                    } elseif ($action == 'add_new_user') {
                        require_once "pages/admin_page/add_new_user.php";
                    }
                }
            }
            break;
        case "user_view":
            $user_obj = new User();
            $user = $user_obj->getUserById($_SESSION['uid']);
            if (($user['user_role'] == "admin") || ($user['user_role']) == "moder") {
                require_once "pages/admin_page/user_view.php";
            }
            break;
        case "user_edit":
            $user_obj = new User();
            $user = $user_obj->getUserById($_SESSION['uid']);
            if ($user['user_role'] == "admin") {
                require_once "pages/admin_page/user_edit.php";
            }
            break;
        case "moder_page":
            $user_obj = new User();
            $user = $user_obj->getUserById($_SESSION['uid']);
            if ($user['user_role'] == "moder") {
                require_once "pages/moder_page/moder_user_view.php";
            }
            break;
        case "trainer_page":
            $user_obj = new User();
            $user = $user_obj->getUserById($_SESSION['uid']);
            if ($user['user_role'] == "trainer") {
                require_once "pages/trainer_page/trainer_page.php";
                if (isset($_GET['action'])) {
                    $action = $_GET['action'];
                    if ($action == 'add') {
                        require_once "pages/trainer_page/add_training.php";
                    } elseif ($action == 'view') {
                        require_once "pages/trainer_page/trainer_user_view.php";
                    } elseif ($action == 'trainees') {
                        require_once "pages/trainer_page/trainees.php";
                    }
                }
            }
            break;
        case "profile_settings":
            require_once "pages/user_profile/profile_view.php";
            break;
        case "profile_edit":
            require_once "pages/user_profile/profile_edit.php";
            break;
        case "health_tips_page":
            require_once "pages/health_tips_page.php";
            break;
        case "exercises_categories":
            require_once "pages/exercises_page/categories.php";
            break;
        case "exercises_page":
            require_once "pages/exercises_page/exercises_page.php";
            break;
        default:
            require_once "pages/404.php";
    }
} else {
    echo "<script>location.replace('/?page=main');</script>";
}
require_once 'blocks/footer.php';

