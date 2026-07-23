<?php
    $pageTitle = "Burke's Oven";
    $pageDescription = "Order your favorite pizza online for delivery or pickup.";
    require_once 'includes/header.php';
    require_once 'includes/Database.php';
    require_once 'includes/PizzaOrder.php';

    $orderComplete = false;
    $customerName = '';

    // Process the form when a POST request is sent.
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Store the submitted values into variables.
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $size = $_POST['size'];
        $crust = $_POST['crust'];
        // Put toopings in an array for mutliple selection.
        $toppings = isset($_POST['toppings']) ? implode(', ', $_POST['toppings']) : 'None';
        $deliveryMethod = $_POST['delivery_method'];

        $db = (new Database())->connect();
        $order = new PizzaOrder($db);
        $order->create($name, $email, $phone, $address, $size, $crust, $toppings, $deliveryMethod);

        $orderComplete = true;
        $customerName = $name;
    }
?>
<header class="menu-header">
    <h1>Burke's Oven</h1>
    <p>Fast, fresh and firey pizza, made for you.</p>
</header>
<main>
    <?php if($orderComplete): ?>
        <section class="completed-order">
            <div class="thank-you-message">
                <h2>Thank You, <?php echo htmlspecialchars($customerName); ?>!</h2>
                <p>Your order has been placed and is being prepared. Enjoy your delicious Pizza!</p>
            </div>
            <a class="order-again" href="index.php">Place Another Order</a>
        </section>
    <?php else: ?>
        <section class="pizza-form">
            <h2>Your Order</h2>
            <form method="post">
                <section>
                    <h3>Contact Information</h3>

                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>

                    <label for="address">Delivery Address:</label>
                    <input type="text" id="address" name="address" required>
                </section>

                <section>
                    <h3>Pizza Builder</h3>

                    <label for="size">Pizza Size:</label>
                    <select id="size" name="size" required>
                        <option value="">Choose a size</option>
                        <option value="Small">Small (10")</option>
                        <option value="Medium">Medium (12")</option>
                        <option value="Large">Large (14")</option>
                        <option value="X-Large">X-Large (16")</option>
                    </select>

                    <label for="crust">Crust Type:</label>
                    <select id="crust" name="crust" required>
                        <option value="">Choose a crust</option>
                        <option value="Thin">Thin Crust</option>
                        <option value="Regular">Regular Crust</option>
                        <option value="Deep Dish">Deep Dish</option>
                        <option value="Stuffed">Stuffed Crust</option>
                    </select>

                    <label for="toppings">Toppings:</label>
                    <select id="toppings" name="toppings[]" multiple size="7">
                        <option value="Pepperoni">Pepperoni</option>
                        <option value="Sausage">Sausage</option>
                        <option value="Bacon">Bacon</option>
                        <option value="Mushrooms">Mushrooms</option>
                        <option value="Onions">Onions</option>
                        <option value="Spinach">Spinach</option>
                        <option value="Extra Cheese">Extra Cheese</option>
                    </select>
                    <script>
                        // Let the user click a topping to select it on or off.
                        document.getElementById('toppings').addEventListener('mousedown', function(event){
                            event.preventDefault();
                            if(event.target.tagName === 'OPTION'){
                                event.target.selected = !event.target.selected;
                            }
                        });
                    </script>

                    <label for="delivery_method">Delivery Method:</label>
                    <select id="delivery_method" name="delivery_method" required>
                        <option value="Delivery" selected>Delivery</option>
                        <option value="Pickup">Pickup</option>
                    </select>
                </section>

                <button class="submit-button" type="submit">Place Order</button>
            </form>
        </section>
    <?php endif; ?>
</main>
<?php require_once 'includes/footer.php'; ?>