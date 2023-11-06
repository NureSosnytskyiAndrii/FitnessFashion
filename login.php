<?php

use System\classes\User;

session_start();

require_once 'system/config.php';
require_once 'system/classes/User.php';

if(isset($_POST['login']) && isset($_POST['password'])){

    global $mysqli;
    $login = $_POST['login'];
    $password = $_POST['password'];
    $user = new User();
    $user->authUser($login, $password);
}

require_once 'blocks/header/header.php';

?>
<style>
    .login {
        background: url('/src/1.jpg') no-repeat;
        width: 100%;
        height:100vh;
        background-size: cover;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    input {
        opacity: 0.6;
    }
    h1 {
        font-family: "Comic Sans MS";
    }
    h2 {
        font-weight: bold;
        font-family: Arial;
    }
</style>

<div class="container text-white bg-light login" style="margin-top: 20px; margin-bottom: 20px;">
    <h1 class="text-white">Fitness Fashion</h1>
    <h2 class="text-white">Sign in</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="InputLogin">Email</label>
            <input type="text" class="form-control" id="InputLogin" placeholder="Enter login" name="login">
        </div>
        <div class="form-group">
            <label for="InputPassword">Password</label>
            <input type="password" class="form-control" id="InputPassword" placeholder="Enter password" name="password">
        </div>
        <div align="center">
            <button type="submit" class="btn btn-white">Login</button>
            <br/>
            <a href="/?page=register" class="text-primary">Create account</a>
        </div>
    </form>
</div>
