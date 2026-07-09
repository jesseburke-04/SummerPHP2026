<?php

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
        <?php  ?>
            <tr>
                <td><?=  ?></td>
                <td><?=  ?></td>
                <td><?=  ?></td>
                <td>
                    <?php  ?>
                        <img src="uploads/<?=  ?>" alt="User Image" style="max-width: 100px;">
                    <?php  ?>
                </td>
                <td>
                    <a class="btn btn-warning" href="edit.php?id=<?=  ?>">Edit</a>
                    <a class="btn btn-danger" href="delete.php?id=<?=  ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php  ?>
    </table>
</section>
<?php  ?>