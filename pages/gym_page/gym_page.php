<?php
global $mysqli;

$query = "SELECT * FROM gym";
$result = $mysqli->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {

        echo '<div class="container mt-4 bg-light">';
        echo '<h3>' . $row['gym_name'] . '</h3>';
        echo '<p><strong>Description:</strong> ' . $row['gym_description'] . '</p>';
        echo '<p><strong>Work Hours:</strong> ' . $row['gym_work_hours'] . '</p>';
        echo '<p><strong>Address:</strong> ' . $row['gym_address'] . '</p>';

        $machines = explode(',', $row['machine_list']);
        echo '<p><strong>Machine List:</strong></p>';
        echo '<ul>';
        foreach ($machines as $machine) {
            echo '<li>' . trim($machine) . '</li>';
        }
        echo '</ul>';

        echo '</div>';
    }

    $result->free();
} else {
    echo 'Error executing query: ' . $mysqli->error;
}

?>
