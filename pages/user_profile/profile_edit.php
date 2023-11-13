<?php
global $mysqli;

$userId = $_SESSION['uid'];

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_hash = md5($password);
        $first_name = $_POST['name'];
        $last_name = $_POST['surname'];
        $status = $_POST['status'];
        $email = $_POST['email'];
        $contact_info = $_POST['contact_info'];
        $profile_description = $_POST['profile_description'];
        $is_banned = $_POST['is_banned'];

        if(!empty($password)) {
            $upd = $mysqli->query("
        UPDATE 
            users
        SET 
        username = '" . $username . "',
        hashed_password = '" . $password_hash . "',
        name = '" . $first_name . "',
        surname = '" . $last_name . "',
        email = '" . $email . "',
        user_role = '" . $status . "',
        contact_info = '" . $contact_info . "',
        profile_description = '" . $profile_description . "',
        is_banned = '" . $is_banned . "'
        WHERE
            user_id =" . $userId);
        } else {
            $upd = $mysqli->query("
        UPDATE users
        SET 
        username = '" . $username . "',
        name = '" . $first_name . "',
        surname = '" . $last_name . "',
        email = '" . $email . "',
        user_role = '" . $status . "',
        contact_info = '" . $contact_info . "',
        profile_description = '" . $profile_description . "',
        is_banned = '" . $is_banned . "'
        WHERE
            user_id =" . $userId);
        }
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Profile was updated.</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';

}

$user = $mysqli->query('SELECT * FROM users WHERE user_id=' . $userId);
?>
<div class="container mx-auto my-5">
    <div class="row">
        <div class="col-9 card">
            <div class="card-header bg-secondary text-white">
                User profile
            </div>
            <?php
            $user_info = $user->fetch_object();
            ?>
            <div class="card-body">
                <form method="post">
                <div class="form-group">
                    <label>Login</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $user_info->username ?: "Not filled"; ?>"/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control"  value=""/>
                    <small>Leave empty if you don`t want to change password</small>
                </div>
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="name" autocomplete="off" class="form-control" value="<?php echo $user_info->name ?: "Not filled"; ?>"/>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="surname" autocomplete="off" class="form-control" value="<?php echo $user_info->surname ?: "Not filled"; ?>"/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" autocomplete="off" value="<?php echo $user_info->email ?: "Not filled"; ?>"/>
                </div>
                    <div class="form-group" style="display: none;">
                        <label>User role</label>
                        <input type="text" name="status" class="form-control"  value="<?php echo $user_info->user_role; ?>"/>
                    </div>
                <div class="form-group">
                    <label>Contact info</label>
                    <input type="text" name="contact_info" class="form-control" autocomplete="off" value="<?php echo $user_info->contact_info ?: "Not filled"; ?>"/>
                </div>
                <div class="form-group">
                    <label>Profile description</label>
                    <input type="text" name="profile_description" autocomplete="off" class="form-control" value="<?php echo $user_info->profile_description ?: "Not filled"; ?>"/>
                </div>
                    <div class="form-group" style="display: none;">
                        <label>Is banned</label>
                        <input type="number" name="is_banned" placeholder="Enter 1 if want to ban user..." class="form-control"  value="<?php echo $user_info->is_banned; ?>"/>
                    </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


