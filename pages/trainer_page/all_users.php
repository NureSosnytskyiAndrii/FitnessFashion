<?php
global $mysqli;

$query = "SELECT * FROM users";
$result = $mysqli->query($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_POST["user_id"];
    $trainer_id = $_SESSION['uid'];

    $updateQuery = "INSERT INTO trainees(tranee_id, user_id, trainer_id)  VALUES (NULL, '$user_id', '$trainer_id')";

    $mysqli->query($updateQuery);
    echo '<div style="margin-top: 5px;" class="alert alert-warning alert-dismissible fade show" role="alert">
        Trainee was added.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
        </div>';
}

?>

<div class="container mt-5">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>User ID</th>
            <th>Avatar</th>
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($user = $result->fetch_object()) {
            echo "<tr>";
            echo "<td>{$user->user_id}</td>";
            echo "<td><img src='{$user->avatar}' alt='no img' style='width: 50px; height: 50px;'/></td>";
            echo "<td>{$user->username}</td>";
            echo "<td>{$user->name} {$user->surname}</td>";
            echo "<td>{$user->email}</td>";
            echo "<td>{$user->user_role}</td>";
            ?>
            <td>
            <form action="" method="post" style="display: inline;">
                <input type="hidden" name="user_id" value="<?= $user->user_id; ?>">
                <button type="submit">Add trainee</button>
            </form>
            </td>
        <?php
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>


