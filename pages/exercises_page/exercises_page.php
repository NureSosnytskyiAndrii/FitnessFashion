<?php
global $mysqli;

use System\classes\User;

$search = '';
?>
<script>
    function performAction(action) {
        const searchValue = document.getElementById('search').value;
        let sortValue = document.getElementById('sort').value;

        let url = '/?page=exercises_page&action=' + action;

        if (action === 'search') {
            url += '&search=' + encodeURIComponent(searchValue);
        } else if (action === 'sort') {
            url += '&sort=' + sortValue;
        }

        window.location.href = url;
    }
</script>
<div class="container mb-2 mt-2">
    <h2><span style="background-color: #6e6185; border-radius: 5px;"> &nbsp;Exercises for you&nbsp; </span></h2>
    <form method="GET" action="">
        <div class="form-group">
            <label for="search">Search:</label>
            <input type="text" class="form-control" id="search" name="search" placeholder="Enter exercise name">
        </div>
        <button type="button" class="btn btn-primary" onclick="performAction('search')">Search</button>
    </form>
    <form method="GET" action="">
        <div class="form-group">
            <label for="sort">Sort By Difficulty:</label>
            <select class="form-control" id="sort" name="sort">
                <option value="asc">Low to High</option>
                <option value="desc">High to Low</option>
            </select>
        </div>
        <button type="button" class="btn btn-primary" onclick="performAction('sort')">Search</button>
    </form>
    <div class="row">
        <?php
        $search = isset($_GET['action']) && $_GET['action'] === 'search' ? $_GET['search'] : '';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

    $sql = "SELECT exercise_id, name, icon, description, difficulty, tags FROM exercise";

    if (!empty($search)) {
        $sql .= " WHERE name LIKE '%$search%'";
    }

    if (!empty($sort)) {
        $sql .= " ORDER BY difficulty $sort";
    }

        $result = $mysqli->query($sql);
        if (!$result) {
            trigger_error('Error in SQL: ' . $mysqli->error);
        }
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4">
                    <div class="card mb-3 mt-3">
                        <div class="card-body">
                            <h5 class="card-title"><span style="color: #39285e;"><?php echo $row['name']; ?></span></h5>
                            <img src="<?php echo $row['icon'];?>" style="height: 50px; width: 50px;"/>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <p class="card-text"><strong>Difficulty:</strong> <?php echo $row['difficulty']; ?></p>
                            <p class="card-text"><strong>Tags:</strong> <?php echo $row['tags']; ?></p>
                            <?php
                            /* check user auth */
                            if (isset($_SESSION['username']) && $_SESSION['uid']) {
                                $user_obj = new User();
                                $user = $user_obj->getUserById($_SESSION['uid']);
                                echo ' <p class="card-text"><a type="button" class="btn btn-small btn-light">Add to personal training</a></p>';
                            }
                            ?>
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
