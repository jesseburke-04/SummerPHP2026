<?php
    $pageTitle = "View users";
    $pageDesc = "this page lets us view the user records";
    require_once 'includes/header.php';
    require_once 'includes/database.php';
    require_once 'includes/user.php';
    $db = (new Database())->connect();
    $user = new User($db);
    $users = $user->getAll(); // Fetch all users from the database.
?>
<section class="lesson-masthead">
    <h1>CRUD with Images</h1>
</section>
<section class="table-row">
    <h2>All Users</h2>
    <a class="btn btn-primary" href="create.php">Create New</a>
    <table class="table table-striped align-middle">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php foreach($users as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['name']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td>
                    <?php if(!empty($u['image'])): ?>
                        <img src="uploads/<?= htmlspecialchars($u['image']) ?>" alt="User Image" style="max-width: 100px;">
                    <?php endif; ?>
                </td>
                <td>
                    <a class="btn btn-warning" href="edit.php?id=<?= $u['id'] ?>">Edit</a>
                    <a class="btn btn-danger" href="delete.php?id=<?= $u['id'] ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
<?php require './includes/footer.php'; ?>