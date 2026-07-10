<?php
    $pageTitle = "Edit users";
    $pageDesc = "this page lets us edit the user records";
    require_once 'includes/header.php';
    require_once 'includes/database.php';
    require_once 'includes/user.php';
    $db = (new Database())->connect();
    $user = new User($db);
    // Fall back protection: bounce users if an ID is missing or invalid.
    $id = $_GET['id'] ?? null;
    if(!$id){
        header("Location: index.php");
        exit;
    }
    $u = $user->getById('id');
    // If the database returns false, the record does not exist.
    if(!$u){
        header("Location: index.php");
        exit;
    }
    $oldImage = $u['image'];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $imageName = $oldImage;
        if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
            $imageName = time() . '_' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
            // delete the old physical asset file if it exists to keep the storage clean.
            if($oldImage && file_exists("uploads/$oldImage")){
                unlink("uploads/$oldImage");
            }
        }
        $user->update($id, $name, $email, $imageName);
        header("Location: index.php");
        exit;
    }
?>
<section class="lesson-masthead">
    <h1>Create Read & Update with Images</h1>
</section>
<section class="table-row">
    <h2>Edit User</h2>
    <form method="post" enctype="multipart/form-data">
        <label class="form-label">Name:</label>
        <input class="form-control" type="text" name="name" value="<?= htmlspecialchars($u['name']) ?>" required><br>
        <label class="form-label">Email:</label>
        <input class="form-control" type="email" name="email" value="<?= htmlspecialchars($u['email']) ?>" required><br>

        <label class="form-label">Current Image:</label><br>
        <?php if(!empty($u['image'])): ?>
            <img src="uploads/<?= htmlspecialchars($u['image']) ?>" style="max-width: 150px;"><br>
        <?php else: ?>
            <p><small>No image uploaded.</small></p>
        <?php endif; ?>

        <label class="form-label">New Image:</label>
        <input class="form-control" type="file" name="image" accept="image/*"><br><br>
        <button class="btn btn-primary" type="submit">Update</button>
    </form>
    <a class="btn btn-success" href="index.php">Back</a>
</section>
<?php require './includes/footer.php'; ?>