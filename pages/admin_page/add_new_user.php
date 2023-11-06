<?php
global $mysqli;

use System\classes\User;

require_once 'system/config.php';
require_once 'blocks/header/header.php';

if (isset($_POST['login']) && isset($_POST['password'])) {

    $username = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $status = $_POST['user_role'];
    $experience = $_POST['experience'];
    $phone = $_POST['phone'];
    $specialization = $_POST['specialization'];

    $user_obj = new User();

    if ($status == 'trainer') {
        $user_obj->registerUser($username, $password, $first_name, $last_name, $email, $status);
        $last_user_id = $mysqli->insert_id;
        $sql_query = "INSERT INTO `trainer` (trainer_id, experience, specialization, phone)  
        VALUES ('$last_user_id', '$experience', '$specialization', '$phone')";
        //echo $sql_query;
        $mysqli->query($sql_query) or die($mysqli->error);
    } else {
        $user_obj->registerUser($username, $password, $first_name, $last_name, $email, $status);
    }
}

?>

<div class="container" style="margin-top: 100px;">
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
                <div class="form-group">
                    <label>User role</label>
                    <select name="user_role" class="form-control" id="userRoleSelect">
                        <option value="admin">Administrator</option>
                        <option value="moder">Moderator</option>
                        <option value="trainer">Trainer</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group" id="trainerField" style="display: none;">
                    <label for="experience">Trainer experience</label>
                    <input type="text" name="experience" class="form-control">
                    <label for="specialization">Trainer specialization</label>
                    <input type="text" name="specialization" class="form-control">
                    <label for="experience">Trainer phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Add user</button>
            </form>
        </div>
    </div>

</div>
<script>
    const userRoleSelect = document.getElementById("userRoleSelect");
    const trainerField = document.getElementById("trainerField");

    userRoleSelect.addEventListener("change", function() {
        if (userRoleSelect.value === "trainer") {
            trainerField.style.display = "block";
        } else {
            trainerField.style.display = "none";
        }
    });
</script>