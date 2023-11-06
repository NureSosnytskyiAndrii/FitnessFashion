<?php

global $mysqli;
if (isset($_GET['id'])) {
    $user = $mysqli->query('SELECT * FROM users WHERE user_id=' . $_GET['id']);
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 card">
                <div class="card-header bg-secondary text-white">
                    User view
                </div>
                <?php
                $user_info = $user->fetch_object();
                ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?= $user_info->user_id; ?>">
                    </div>
                    <div class="form-group">
                        <label>Avatar</label>
                        <img src="" />
                    </div>
                    <div class="form-group">
                        <label>Login</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->username ?: "Not filled"; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->name ?: "Not filled"; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->surname ?: "Not filled"; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->email ?: "Not filled"; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>User role</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->user_role ?: "Not filled"; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Contact info</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->contact_info ?: "Not filled"; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Profile description</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->profile_description ?: "Not filled"; ?>"/>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php
}
