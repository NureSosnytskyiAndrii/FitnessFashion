<?php
global $mysqli;

if (isset($_GET['do']) && $_GET['do'] == "delete") {
    $mysqli->query("DELETE FROM users WHERE user_id='" . $_GET['id'] . "'") or die($mysqli->error);
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Success!</strong> User with ID = ' . $_GET['id'] . ' have been removed!
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
                                    <a href="/?page=user_edit&id=<?= $user->user_id; ?>" class="btn btn-light">Edit</a>
                                    <?php
                                    if ($user->user_role !== 'admin') {
                                        ?>
                                        <a href="/?page=admin_page&action=user_list&do=delete&id=<?= $user->user_id; ?>"
                                           class="btn btn-danger">Delete</a>
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
