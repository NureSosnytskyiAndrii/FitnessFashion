<?php
global $mysqli;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $training_name = $_POST['training_name'];
    $training_description = $_POST['training_description'];

    $trainer_id = $_SESSION['uid'];

    $insert_query = "INSERT INTO training (training_name, training_description, trainer_id) VALUES (?, ?, ?)";

    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ssi", $training_name, $training_description, $trainer_id);


    if ($stmt->execute()) {
        echo '<div style="margin-top: 5px;" class="alert alert-primary alert-dismissible fade show" role="alert">
        Training added successfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    } else {
        echo "Error: " . $stmt->error;
    }

}

?>

<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-12">
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputTraining">Training name</label>
                    <input type="text" class="form-control" name="training_name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Training description</label>
                    <input type="text" class="form-control" name="training_description">
                </div>
                <button type="submit" class="btn btn-success mb-4">Add training</button>
            </form>
        </div>
    </div>


