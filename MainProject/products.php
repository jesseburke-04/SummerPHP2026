<?php
    $pageTitle = "SugarRush -Full Product Inventory";
    $pageDescription = "Here are all of SugarRush's inventory products!";
    require_once 'includes/header.php';
    require_once 'includes/Database.php';
    require_once 'includes/Product.php';

    $database = new Database();
    $db = $database->connect();
    $product = new Product($db);

    $showAddForm = isset($_GET['add']);
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])){
        $name = trim($_POST['name']);
        $quantity = $_POST['quantity'];
        $description = trim($_POST['description']);
        $price = $_POST['price'];
        $imageName = '';

        $product->create($name, $quantity, $description, $price, $imageName);
        header("Location: products.php");
        exit;
    }
    $products = $product->getAll();
?>
<section class="products-page">
    <h2>Candy Catalog</h2>
    <?php if(empty($products)): ?>
        <p>Nothing has been added to the SugarRush inventory.</p>
    <?php else: ?>
        <div class="product-grid">
            <?php foreach($products as $p): ?>
                <article class="product-card">
                    <?php if(!empty($p['image'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
                    <?php else: ?>
                        <div class="no-image">No Image</div>
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($p['name']); ?></h3>
                    <p class="price">$<?php echo htmlspecialchars($p['price']); ?></p>
                    <a class="btn-secondary" href="product.php?id=<?php echo $p['id']; ?>">Candy Details</a>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if(!$showAddForm): ?>
        <a class="btn" href="products.php?add=1">Add a New Product!</a>
    <?php else: ?>
        <section class="product-form">
            <h2>Add a New Product</h2>
            <form method="post">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>

                <label for="quantity">Inventory in Stock:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo isset($quantity) ? htmlspecialchars($quantity) : ''; ?>" required>

                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value="<?php echo isset($description) ? htmlspecialchars($description) : ''; ?>" required>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo isset($price) ? htmlspecialchars($price) : ''; ?>" required>

                <button class="btn" type="submit" name="add_product" value="1">Add Product</button>
            </form>
        </section>
    <?php endif; ?>
</section>
<?php require_once 'includes/footer.php'; ?>