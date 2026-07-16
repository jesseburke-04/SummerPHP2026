<?php include_once 'templates/header.php'; ?>

<section aria-labelledby="form-heading">
    <h2 id="form-heading" class="mb-4">User Registration</h2>
    
    <form action="register_submit.php" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" autocomplete="username" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" autocomplete="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" required>
        </div>
        
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" autocomplete="new-password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</section>

<?php include_once 'templates/footer.php'; ?>