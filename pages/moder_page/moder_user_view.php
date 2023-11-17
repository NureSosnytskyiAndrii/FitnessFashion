<?php
global $mysqli;

if (isset($_GET['action']) && $_GET['action'] == "ban") {
    $mysqli->query("UPDATE `users` SET is_banned = 1 WHERE user_id='" . $_GET['id'] . "'") or die($mysqli->error);
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    User with ID = ' . $_GET['id'] . ' was banned!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if (isset($_GET['action']) && $_GET['action'] == "unban") {
    $mysqli->query("UPDATE `users` SET is_banned = 0 WHERE user_id='" . $_GET['id'] . "'") or die($mysqli->error);
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    User with ID = ' . $_GET['id'] . ' was unbanned!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
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
                            <th>User role</th>
                            <th>Is banned</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $all_users = $mysqli->query("SELECT * FROM users ORDER BY user_id ASC ");

                        while ($user = $all_users->fetch_object()) {
                            ?>
                            <tr>
                                <td><?= $user->user_id; ?></td>
                                <td><?= $user->avatar; ?></td>
                                <td><?= $user->username; ?></td>
                                <td><?= $user->name . "&nbsp;" . $user->surname; ?></td>
                                <td><?php echo $user->email ?: "Not filled"; ?></td>
                                <td><?php echo $user->user_role ?: "Not filled"; ?></td>
                                <td><?php echo $user->is_banned; ?></td>
                                <td>
                                    <a href="/?page=user_view&id=<?= $user->user_id; ?>" class="btn btn-light">View</a>
                                    <?php
                                    if ($user->user_role !== 'moder') {
                                        ?>
                                        <a href="/?page=moder_page&action=ban&id=<?= $user->user_id; ?>"
                                           class="btn btn-danger">Ban</a>
                                        <a href="/?page=moder_page&action=unban&id=<?= $user->user_id; ?>"
                                           class="btn btn-success">Unban</a>
                                    <?php } ?>
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