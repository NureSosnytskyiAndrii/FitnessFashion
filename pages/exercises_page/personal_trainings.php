<?php
global $mysqli;

use System\classes\User;

if (isset($_SESSION['username']) && $_SESSION['uid']) {
    $user_obj = new User();
    $user_id = $_SESSION['uid'];

    $user_personal_trainings = $mysqli->query("SELECT * FROM `exercise` WHERE user_id = '$user_id'");

    if (isset($_GET['action']) && ($_GET['action'] === 'delete')) {

        $exercise_id = $_GET['exercise_id'];

        $sql = "UPDATE exercise SET user_id = NULL, status = NULL WHERE exercise_id=?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $exercise_id);
            $stmt->execute();
            $stmt->close();
        }
        echo '<div style="margin-top: 5px;" class="alert alert-primary alert-dismissible fade show" role="alert">
        Exercise was removed.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }

    if (isset($_POST['exerciseId'])) {

        $exerciseId = $_POST['exerciseId'];
        $exercise_status = $_POST['status'];

        $sql = "UPDATE exercise SET status = ? WHERE exercise_id = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("si", $exercise_status, $exerciseId);  // Corrected variable name
            $stmt->execute() or die($mysqli->error);
            $stmt->close();
        }

}

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
                ?>
                <td>
                    <?php if ($row->status === "done"): echo "$row->status"?>
                    <?php else:
                        if (($row->status === "in_progress") || ($row->status === 'not_done')) {
                            echo "$row->status";
                        }
                        ?>
                        <form method="POST" action="">
                            <input type="hidden" name="exerciseId" value="<?php echo $row->exercise_id; ?>">
                            <label for="status">Select status:</label>
                            <select name="status" id="status">
                                <option value="not_done" selected>Not Done</option>
                                <option value="in_progress">In Progress</option>
                                <option value="done">Done</option>
                            </select>
                            <input type="submit" class="btn btn-sm btn-success" name="submit" value="Save">
                        </form>
                    <?php endif; ?>
                </td>
                <?php
                echo "<td><a type='button' class='btn btn-outline-danger' href='/?page=personal_trainings&action=delete&exercise_id=" . $row->exercise_id . "'>Delete</a></td>";
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
