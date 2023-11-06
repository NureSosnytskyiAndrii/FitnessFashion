<?php

use System\classes\User;

require_once 'system/config.php';
require_once 'blocks/header/header.php';

if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['confirm_password'])){
    if($_POST['password'] !== $_POST['confirm_password']){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Error password not equals
<button type='button' class='close' data-dismiss='alert' aria-label='Close' 
</button></div>";
    }else{

        $username = $_POST['login'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $user_obj = new User();
       echo $user_obj->registerUser($username,$password,$first_name,$last_name, $email,'user');
    }
}

?>
    <style>
        .register {
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
            opacity: 0.7;
        }
        h1 {
            font-family: "Comic Sans MS";
        }

    </style>
<div class="container register text-white" style="margin-top: 20px; margin-bottom: 20px;">
    <h1 class="text-white">Fitness Fashion</h1>
    <div class="row">
        <div class="col-12">
    <form method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Login</label>
            <input type="text" class="form-control" name="login">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail">Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label for="exampleInputFirstName">First Name</label>
            <input type="text" class="form-control" name="first_name">
        </div>
        <div class="form-group">
            <label for="exampleInputLastName">Last Name</label>
            <input type="text" class="form-control" name="last_name">
        </div>
        <button type="submit" class="btn btn-white">Create an account</button>
    </form>
    </div>
   </div>
</div>
<?php
//require_once 'blocks/footer.php';
?>