<?php
global $mysqli;

use System\classes\User;

if (isset($_GET['do']) && $_GET['do'] === 'delete') {

    $training_id_to_delete = $_GET['training_id'];

    $delete_query = "DELETE FROM training WHERE training_id = ?";

    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param("i", $training_id_to_delete);

    if ($stmt->execute()) {
        echo '<div style="margin-top: 5px;" class="alert alert-danger alert-dismissible fade show" role="alert">
        Training was deleted.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    } else {
        echo "Error: " . $stmt->error;
    }

}

?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <span class="text-white">Trainings</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Training name</th>
                            <th>Training description</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $user_obj = new User();
                        $user = $_SESSION['uid'];

                        $all_trainings = $mysqli->query("SELECT * FROM training WHERE trainer_id='$user'");

                        while ($training = $all_trainings->fetch_object()) {
                            ?>
                            <tr>
                                <td><?= $training->training_name; ?></td>
                                <td><?= $training->training_description; ?></td>
                                <td><a type="button" class="btn btn-danger" href="/?page=trainer_page&action=view&do=delete&training_id=<?= $training->training_id; ?>">Delete training</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>