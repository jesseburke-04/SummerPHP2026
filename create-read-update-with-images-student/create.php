<?php
    $pageTitle = "Add user";
    $pageDesc = "this page lets you make a user";
    require_once 'includes/header.php';
    require_once 'includes/database.php';
    require_once 'includes/user.php';

    $db = (new Database()->connect());
    $user = new User($db);

    // Process the form submission only when a POST request is sent.
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
        $name = $_POST['name'];
        $email = $_POST['email'];
        $imageName = '';

        // Check if an image file was selected and uploaded without errors.  NOTE: only use when coding an image.
        if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
            // Prepend a timestamp to filenames to prevent duplicate naming collisions in /uploads.
            $imageName = time() . '_' . basename($_FILES['image']['name']);
            // Ensure the upload directory exists before moving files.
            if(!is_dir('uploads')){
                mkdir('uploads', 0775, true); // check filezilla for file permissions if you are having issues with uploads.
            }
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
        }
        $user->create($name, $email, $imageName);
        header("Location: index.php"); // this makes you don't have a white screen. This is an auto redirect.
        exit; // Best Practice: always call exit after a redirect to halt engine processing or to prevent further script execution.
    }
?>
<section class="lesson-masthead">
    <h1>CRUD with Images</h1>
</section>
<section class="table-row">
    <h2>Create User</h2>
    <form method="post" enctype="multipart/form-data">
        <label class="form-label">Name:</label>
        <input class="form-control" type="text" name="name" required><br>
        <label class="form-label">Email:</label>
        <input class="form-control" type="email" name="email" required><br>
        <label class="form-label">Image:</label>
        <input class="form-control" type="file" name="image" accept="image/*"><br>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
    <a class="btn btn-success" href="index.php">Back</a>
</section>
<?php require './includes/footer.php'; ?>