<?php

global $mysqli;
if (isset($_GET['id'])) {

    if (isset($_POST['username'])) {
        $user_id = $_GET['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_hash = md5($password);
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $status = $_POST['status'];
        $contact_info = $_POST['contact_info'];
        $profile_description = $_POST['profile_description'];
        $is_banned = $_POST['is_banned'];
        /*
         *
         *
         *   UPDATE table_name
        SET column1 = value1, column2 = value2, ...
        WHERE condition;
         *
         * */
        if (!empty($password)) {
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
            user_id =" . $user_id);
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
            user_id =" . $user_id);
        }
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Data saved!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }

    $user = $mysqli->query('SELECT * FROM users WHERE user_id=' . $_GET['id']);

    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="text-white">
                    User view
                </div>
                <?php
                $user_info = $user->fetch_object();
                ?>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" class="form-control" disabled="disabled"
                                   value="<?= $user_info->user_id; ?>">
                        </div>
                        <div class="form-group">
                            <label>Login</label>
                            <input type="text" name="username" class="form-control"
                                   value="<?php echo $user_info->username; ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" value=""/>
                            <small>Leave empty if you don`t want to change password</small>
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control"
                                   value="<?php echo $user_info->name; ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control"
                                   value="<?php echo $user_info->surname; ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" placeholder="Enter email..." class="form-control"
                                   value="<?php echo $user_info->email; ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Contact info</label>
                            <input type="text" name="contact_info" placeholder="Enter contact info..."
                                   class="form-control" value="<?php echo $user_info->contact_info; ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Profile description</label>
                            <input type="text" name="email" placeholder="Enter profile description..."
                                   class="form-control" value="<?php echo $user_info->profile_description; ?>"/>
                        </div>
                        <div class="form-group">
                            <label>User role</label>
                            <select name="status" class="form-control">
                                <option value="admin" <?php if ($user_info->status == "admin") {
                                    echo 'selected="selected"';
                                } ?> >Administrator
                                </option>
                                <option value="moder" <?php if ($user_info->status == "moder") {
                                    echo 'selected="selected"';
                                } ?> >Moderator
                                </option>
                                <option value="trainer" <?php if ($user_info->status == "trainer") {
                                    echo 'selected="selected"';
                                } ?> >Trainer
                                </option>
                                <option value="user" <?php if ($user_info->status == "user") {
                                    echo 'selected="selected"';
                                } ?> >User
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Is banned</label>
                            <input type="number" name="is_banned" placeholder="Enter 1 if want to ban user..."
                                   class="form-control" value="<?php echo $user_info->is_banned; ?>"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}