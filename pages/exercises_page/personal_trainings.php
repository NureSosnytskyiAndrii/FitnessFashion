<?php
global $mysqli;

use System\classes\User;

if (isset($_SESSION['username']) && $_SESSION['uid']) {
    $user_obj = new User();
    $user_id = $_SESSION['uid'];

    $user_personal_trainings = $mysqli->query("SELECT * FROM `exercise` WHERE user_id = '$user_id'");
    $user_personal_trainings = mysqli_fetch_assoc($user_personal_trainings);
    print_r($user_personal_trainings);
    }
?>