<script>
    function performGymSearch(action) {
        const searchValue = document.getElementById('gym_search').value;

        let url = '/?page=gym_page&action=' + action;

        if (action === 'search') {
            url += '&search=' + encodeURIComponent(searchValue);
        }

        window.location.href = url;
    }
</script>

<?php
global $mysqli;
$search = isset($_GET['action']) && $_GET['action'] === 'search' ? $_GET['search'] : '';

//$sql = "SELECT gym_id, gym_name, image, gym_description, gym_work_hours, gym_address, machine_list FROM gym";
$sql = "SELECT g.gym_id, g.gym_name, g.image, g.gym_description, g.gym_work_hours, g.gym_address, g.machine_list, t.training_name, t.training_description
        FROM gym g
        LEFT JOIN training t ON g.gym_id = t.gym_id";

if (!empty($search)) {
    $sql .= " WHERE gym_name LIKE '%$search%'";
}


?>

<div class="container mb-2 mt-2">
    <h2 style="display: flex; justify-content: center;"><span style="color: #6e6185; border-radius: 5px;"> &nbsp;Gyms for you&nbsp; </span></h2>
    <form method="GET" action="">
        <div class="form-group">
            <label for="gym_search">Search:</label>
            <input type="text" class="form-control" id="gym_search" name="search" placeholder="Enter gym name">
        </div>
        <button type="button" class="btn" style="background-color:#be9ded; color: #39285e;" onclick="performGymSearch('search')">Search</button>
    </form>
</div>
    <div class="row">
        <?php
        $result = $mysqli->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="container mt-4 mb-4 bg-light" style="border: 2px solid #c8aaf2; border-radius: 10px;" data-toggle="modal" data-target="#gymModal' . $row['gym_id'] . '">';

                echo '<div class="modal fade" id="gymModal' . $row['gym_id'] . '" tabindex="-1" role="dialog" aria-labelledby="gymModalLabel' . $row['gym_id'] . '" aria-hidden="true">';
                echo '<div class="modal-dialog modal-dialog-centered" role="document">';
                echo '<div class="modal-content">';

                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="gymModalLabel' . $row['gym_id'] . '">' . $row['gym_name'] . '</h5>';
                echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
                echo '</div>';

                echo '<div class="modal-body">';
                echo '<img src="' . $row['image'] . '" alt="Gym Image" class="img-fluid">';
                echo '<p class="mb-2 mt-2"><strong>Description:</strong> ' . $row['gym_description'] . '</p>';
                echo '<p class="mb-2 mt-2"><strong>Work Hours:</strong> ' . $row['gym_work_hours'] . '</p>';
                echo '<p class="mb-2 mt-2"><strong>Address:</strong> ' . $row['gym_address'] . '</p>';

                $machines = explode(',', $row['machine_list']);
                echo '<p class="mb-2 mt-2"><strong>Machine List:</strong></p>';
                echo '<ul>';

                foreach ($machines as $machine) {
                    echo '<li>' . trim($machine) . '</li>';
                }

                echo '</ul>';

                // Add training information to the modal
                if (!empty($row['training_name'])) {
                    echo '<p class="mt-2 mb-2"><strong>Training:</strong> ' . $row['training_name'] . '</p>';
                } else {
                    echo '<p class="mt-2 mb-2 text-warning">No Trainings</p>';
                }echo '</div>';

                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn" style="background-color: #864ed4" data-dismiss="modal">Close</button>';
                echo '</div>';

                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '<div class="row mt-2 mb-2">';
                if (isset($row['image'])) {
                    echo '<div class="col-md-3"><img src="' . $row['image'] . '" alt="Gym Image" class="img-fluid"></div>';
                }
                echo '<div class="col-md-8">';
                echo '<h3>' . $row['gym_name'] . '</h3>';
                echo '<p><strong>Description:</strong> ' . $row['gym_description'] . '</p>';
                echo '<p><strong>Work Hours:</strong> ' . $row['gym_work_hours'] . '</p>';
                echo '<p><strong>Address:</strong> ' . $row['gym_address'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }

            $result->free();
        } else {
            echo 'Error executing query: ' . $mysqli->error;
        }
        ?>
    </div>
</div>







