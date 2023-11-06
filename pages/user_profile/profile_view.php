<?php
global $mysqli;
$userId = $_SESSION['uid'];

$user = $mysqli->query('SELECT * FROM users WHERE user_id=' . $userId);

if (isset($_POST['upload']) && isset($_FILES['image'])) {

    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];

    $targetDirectory = "pages/user_profile/photo_dir/";
    $targetFilePath = $targetDirectory . $imageName;

    if (move_uploaded_file($imageTmpName, $targetFilePath)) {
        $sql = "UPDATE users SET avatar = ? WHERE user_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("si", $targetFilePath, $userId);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success alert-dismissible fade show '>Avatar was successfully uploaded
 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
 <span aria-hidden='true'>&times;</span>
  </button></div>";
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show '>Error uploading avatar!
 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
 <span aria-hidden='true'>&times;</span>
  </button></div>" . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error loading photo.";
    }
}
$user_avatar = $mysqli->query("SELECT avatar FROM `users` WHERE user_id='$userId'");
$user_avatar = mysqli_fetch_assoc($user_avatar);
?>
    <div class="container mx-auto my-5">
        <div class="row">
            <div class="col-9 card">
                <div class="card-header bg-secondary text-white">
                    User profile
                </div>
                <?php
                $user_info = $user->fetch_object();
                ?>
                <div class="card-body">
                    <div class="form-group">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <label for="image">Upload photo</label>
                                <input type="file" class="form-control" id="image" name="image"/>
                                <input type="submit" class="btn btn-primary mt-2" name="upload" value="upload"/>
                            </form>
                            <br>
                    </div>
                    <div class="form-group">
                        <label>Avatar</label>
                        <div><img src="<?=$user_avatar['avatar'];?>" style="height: 90px; width: 90px;"/></div>
                    </div>
                    <div class="form-group">
                        <label>Login</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->username ?: "Not filled"; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->name ?: "Not filled"; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->surname ?: "Not filled"; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->email ?: "Not filled"; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>User role</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->user_role ?: "Not filled"; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Contact info</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->contact_info ?: "Not filled"; ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Profile description</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $user_info->profile_description ?: "Not filled"; ?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

