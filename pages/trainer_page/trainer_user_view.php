<?php
global $mysqli;

use System\classes\User;

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
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>