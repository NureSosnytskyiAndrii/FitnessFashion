<?php
global $mysqli;

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    <span class="text-white">Users</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Login</th>
                            <th>Full name</th>
                            <th>E-mail</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $trainer = $_SESSION['uid'];

                        $all_users = $mysqli->query("SELECT * FROM users WHERE user_id = 
                                                    (SELECT user_id FROM exercise WHERE training_id = 
                                                    (SELECT training_id FROM training WHERE trainer_id='$trainer'))");

                        while ($user = $all_users->fetch_object()) {
                            ?>
                            <tr>
                                <td><?= $user->user_id; ?></td>
                                <td><?= $user->avatar; ?></td>
                                <td><?= $user->username; ?></td>
                                <td><?= $user->name . "&nbsp;" . $user->surname; ?></td>
                                <td><?php echo $user->email ?: "Not filled"; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
