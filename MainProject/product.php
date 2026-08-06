<?php
    require_once 'includes/Database.php';
    require_once 'includes/Product.php';
    require_once 'includes/User.php';

    $id = $_GET['id'] ?? null;
    if(!$id){
        header("Location: products.php");
        exit;
    }

    $database = new Database();
    $db = $database->connect();
    $product = new Product($db);
    $user = new User($db);
    $p = $product->getById($id);

    if(!$p){
        header("Location: products.php");
        exit;
    }

    $pageTitle = $p['name'] . " - SugarRush";
    $pageDescription = "Details and pricing for " . ($p['name']) . ".";
    require_once 'includes/header.php';

    $loginError = "";
    $deleted = false;

    $showEditSection = isset($_GET['edit']) || isset($_POST['update_product']);
    $showDeleteSection = isset($_GET['delete']) || isset($_POST['delete_product']);

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])){
        $userEmail = trim($_POST['user_email']);
        $userPassword = $_POST['user_password'];
        $loggedInUser = $user->login($userEmail, $userPassword);

        if($loggedInUser){
            $name = trim($_POST['name']);
            $quantity = $_POST['quantity'];
            $description = trim($_POST['description']);
            $price = $_POST['price'];
            $product->update($id, $name, $quantity, $description, $price);
            $p = $product->getById($id);
        }else{
            $loginError = "Incorrect email or password.";
        }
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])){
        $userEmail = trim($_POST['user_email']);
        $userPassword = $_POST['user_password'];
        $loggedInUser = $user->login($userEmail, $userPassword);

        if($loggedInUser){
            if(!empty($p['image']) && file_exists("uploads/" . $p['image'])){
                unlink("uploads/" . $p['image']);
            }
            $product->delete($id);
            $deleted = true;
        }else{
            $loginError = "Incorrect email or password.";
        }
    }
?>
<?php if($deleted): ?>
    <section class="single-product">
        <p class="success-message">This product was deleted successfully.</p>
        <a class="btn-secondary" href="products.php">Back to All Products</a>
    </section>
<?php else: ?>
    <section class="single-product">
        <figure>
            <?php if(!empty($p['image'])): ?>
                <img src="uploads/<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
            <?php else: ?>
                <div class="no-image">No Image</div>
            <?php endif; ?>
            <figcaption><?php echo htmlspecialchars($p['name']); ?></figcaption>
        </figure>
        <div class="product-details">
            <h2><?php echo htmlspecialchars($p['name']); ?></h2>
            <p class="price">$<?php echo htmlspecialchars($p['price']); ?></p>
            <p class="stock">In Stock: <?php echo htmlspecialchars($p['quantity']); ?></p>
            <p class="description"><?php echo nl2br(htmlspecialchars($p['description'])); ?></p>
            <a class="btn-secondary" href="products.php">Back to All Products</a>
            <!-- These two links are side by side, each leads to its own separate form below. -->
            <div class="product-actions">
                <a class="btn-edit" href="product.php?id=<?php echo $p['id']; ?>&edit=1">Update Product</a>
                <a class="btn-delete" href="product.php?id=<?php echo $p['id']; ?>&delete=1">Delete Product</a>
            </div>
        </div>
    </section>

    <?php if($loginError): ?><p class="error-messages"><?php echo htmlspecialchars($loginError); ?></p><?php endif; ?>

    <?php if($showEditSection): ?>
        <section class="product-form">
            <h2>Update Product</h2>
            <form method="post">
                <label for="user_email">Email:</label>
                <input type="email" id="user_email" name="user_email" required>

                <label for="user_password">Password:</label>
                <input type="password" id="user_password" name="user_password" required>

                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($p['name']); ?>" required>

                <label for="quantity">Inventory in Stock:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($p['quantity']); ?>" required>

                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($p['description']); ?>" required>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($p['price']); ?>" required>

                <button class="btn" type="submit" name="update_product" value="1">Update Product</button>
            </form>
        </section>
    <?php endif; ?>

    <?php if($showDeleteSection): ?>
        <section class="product-form">
            <h2>Delete Product</h2>
            <form method="post">
                <label for="delete_user_email">Email:</label>
                <input type="email" id="delete_user_email" name="user_email" required>

                <label for="delete_user_password">Password:</label>
                <input type="password" id="delete_user_password" name="user_password" required>

                <button class="btn-delete" type="submit" name="delete_product" value="1">Delete Product</button>
            </form>
        </section>
    <?php endif; ?>
<?php endif; ?>
<?php require_once 'includes/footer.php'; ?>