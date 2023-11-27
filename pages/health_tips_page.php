<?php
global $mysqli;

?>

<div class="container" style="background: url('../src/2.jpeg'); width: 100%; height:200vh; ">
    <h2 class="text-warning" style="display: flex; justify-content: center">Health tips page</h2>

    <?php
    $sql = "SELECT name, hint_name, hint_description FROM health_hint, exercise WHERE health_hint.exercise_id = exercise.exercise_id";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="card col-9 mb-2 text-white" style="padding: 20px; margin: 50px; background-color: black; border: 2px solid yellow; opacity: 0.7; border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title text-warning"><?php echo $row['hint_name']; ?></h5>
                    <p class="card-text"><?php echo $row['hint_description']; ?></p><br/>
                    <p class="card-text">In category: <span class="badge badge-warning"><?php echo $row['name']; ?></span></p>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No data to display.";
    }

    ?>

</div>
