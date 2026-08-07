<?php
    // creating variables for the header.php and added the required files.
    $pageTitle = "SugarRush - Register";
    $pageDescription = "Creating a new SugarRush account or editing an existing account.";
    require_once 'includes/header.php';
    require_once 'includes/Database.php';
    require_once 'includes/User.php';

    // opens the database connection and creates a new User object.
    $database = new Database();
    $db = $database->connect();
    $user = new User($db);
    $success = false;
    $error = "";

    // checks whether the page should show the edit or delete section based on the form submitted.
    $showEditSection = isset($_GET['edit']) || isset($_POST['update_user']);
    $showDeleteSection = isset($_GET['delete']) || isset($_POST['delete_user']);
    // handles the new account from the registration form, while validating the information.
    if(!$showEditSection && !$showDeleteSection && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_submit'])){
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        try{
            $user->create($username, $email, $password, $confirmPassword);
            $success = true;
        }catch(Exception $e){
            $error = $e->getMessage();
        }
    }
    $deleted = false;
    $loginError = "";
    // handles the updating of an exisitng account, while check the login creditals and validating the information.
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])){
        $userEmail = trim($_POST['user_email']);
        $userPassword = $_POST['user_password'];
        $loggedInUser = $user->login($userEmail, $userPassword);

        if($loggedInUser){
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $newPassword = $_POST['password'];
            if(empty($newPassword)){
                $newPassword = null;
            }
            $user->update($loggedInUser['id'], $username, $email, $newPassword);
            $success = true;
        }else{
            $loginError = "Incorrect email or password.";
        }
    }
    // handles the deleting of an existing account, while checking the login creditals.
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])){
        $userEmail = trim($_POST['user_email']);
        $userPassword = $_POST['user_password'];
        $loggedInUser = $user->login($userEmail, $userPassword);

        if($loggedInUser){
            $user->delete($loggedInUser['id']);
            $deleted = true;
        }else{
            $loginError = "Incorrect email or password.";
        }
    }
?>
<?php if($showDeleteSection): ?>
    <?php if($deleted): ?>
        <!-- Shows a success message after the user deletes their accounts. -->
        <section class="register-page">
            <h2>Account Deleted</h2>
            <p class="success-message">Your account was deleted successfully.</p>
        </section>
    <?php else: ?>
        <!-- The delete form that asks the user credentials. -->
        <section class="user-form">
            <h2>Delete User</h2>
            <?php if($loginError): ?><p class="error-messages"><?php echo htmlspecialchars($loginError); ?></p><?php endif; ?>
            <form method="post">
                <label for="user_email">Current Email:</label>
                <input type="email" id="user_email" name="user_email" required>

                <label for="user_password">Current Password:</label>
                <input type="password" id="user_password" name="user_password" required>

                <button class="btn-delete" type="submit" name="delete_user" value="1">Delete Account</button>
            </form>
        </section>
    <?php endif; ?>
<?php elseif($showEditSection): ?>
    <!-- The edit form that asks for the user credentials and the new information. --> 
    <section class="user-form">
        <h2>Edit User Info</h2>
        <?php if($success): ?>
            <p class="success-message">Your account was updated successfully.</p>
        <?php endif; ?>
        <?php if($loginError): ?><p class="error-messages"><?php echo htmlspecialchars($loginError); ?></p><?php endif; ?>

        <form method="post">
            <label for="user_email">Current Email:</label>
            <input type="email" id="user_email" name="user_email" required>

            <label for="user_password">Current Password:</label>
            <input type="password" id="user_password" name="user_password" required>

            <label for="username">New Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">New Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" placeholder="Leave blank to keep the current password">

            <button class="btn" type="submit" name="update_user" value="1">Update Account</button>
        </form>
    </section>
<?php else: ?>
    <!-- The registration form that asks for the new user information. -->
    <section class="register-page">
        <h2>Register</h2>

        <?php if(!empty($error)): ?>
            <p class="error-messages"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <?php if($success): ?>
            <p class="success-message">Your account was created successfully. You can now use the Edit User Info or Delete User links to sign in.</p>
        <?php else: ?>
            <form method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button class="btn" type="submit" name="register_submit" value="1">Create Account</button>
            </form>
        <?php endif; ?>
    </section>
<?php endif; ?>
<?php require_once 'includes/footer.php'; ?>