<?php
global $mysqli;


$trainer = $_SESSION['uid'];

$all_users = $mysqli->query("SELECT * FROM users WHERE user_id IN 
                                                    (SELECT user_id FROM trainees WHERE trainer_id='$trainer')");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_POST["user_id"];

    $updateQuery = "DELETE FROM trainees WHERE user_id='$user_id'";

    $mysqli->query($updateQuery);
    echo '<div style="margin-top: 5px;" class="alert alert-warning alert-dismissible fade show" role="alert">
        Trainee was removed.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
        </div>';
}

if ($all_users->num_rows == 0) {
    echo "<p align='center'>No trainees</p>";
} else {
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
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($user = $all_users->fetch_object()) {
                            ?>
                            <tr>
                                <td><?= $user->user_id; ?></td>
                                <td><img src="<?= $user->avatar; ?>" style="width: 50px; height: 50px;"/></td>
                                <td><?= $user->username; ?></td>
                                <td><?= $user->name . "&nbsp;" . $user->surname; ?></td>
                                <td><?php echo $user->email ?: "Not filled"; ?></td>
                                <td>
                                    <!-- Delete button with a form to handle the update request -->
                                    <form action="" method="post">
                                        <input type="hidden" name="user_id" value="<?= $user->user_id; ?>">
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>