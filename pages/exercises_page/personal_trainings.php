<?php
global $mysqli;

use System\classes\User;

if (isset($_SESSION['username']) && $_SESSION['uid']) {
    $user_obj = new User();
    $user_id = $_SESSION['uid'];

    $user_personal_trainings = $mysqli->query("SELECT * FROM `exercise` WHERE user_id = '$user_id'");
    ?>

    <div class="container mt-5">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Exercise Name</th>
                <th>Exercise description</th>
                <th>Difficulty</th>
                <th>Tags</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $user_personal_trainings->fetch_object()) {
                echo "<tr>";
                echo "<td>{$row->name}</td>";
                echo "<td>{$row->description}</td>";
                echo "<td>{$row->difficulty}</td>";
                echo "<td>{$row->tags}</td>";
                echo "<td></td>";
                echo "<td><a type='button' href='#'>Delete</a></td>";
                echo "</tr>";
            }

            if ($user_personal_trainings->num_rows == 0) {
                echo "<tr><td colspan='2'>No personal trainings found.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <?php
}
?>
