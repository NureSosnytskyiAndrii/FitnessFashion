<?php
global $mysqli;


?>

<div class="container">
    <h2>Exercise Cards</h2>
    <div class="row">
        <?php
        $sql = "SELECT exercise_id, name, icon, description, difficulty, tags FROM exercise";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4">
                    <div class="card mb-3 mt-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <img src="<?php echo $row['icon'];?>" style="height: 50px; width: 50px;"/>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <p class="card-text"><strong>Difficulty:</strong> <?php echo $row['difficulty']; ?></p>
                            <p class="card-text"><strong>Tags:</strong> <?php echo $row['tags']; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</div>
