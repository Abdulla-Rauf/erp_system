<?php
include 'db.php';
include 'header.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $offer_price = $_POST['offer_price'];
    $offer_percentage = $_POST['offer_percentage'];
    $quantity = $_POST['quantity'];
    $available_stocks = $_POST['available_stocks'];
    $category = $_POST['category'];
    $image = $_FILES['image']['name'];
    if ($image) {
        $target = "images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $image_sql = ", image='$image'";
    } else {
        $image_sql = "";
    }

    $sql = "UPDATE products SET name='$name', price='$price', offer_price='$offer_price', offer_percentage='$offer_percentage', 
            quantity='$quantity', available_stocks='$available_stocks', category='$category' $image_sql WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // echo "<div class='alert alert-success'>Product updated successfully</div>";
        header('Location: index.php');
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}

$sql = "SELECT * FROM products WHERE id='$id'";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<form action="edit_product.php?id=<?php echo $product['id']; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="offer_price">Offer Price</label>
        <input type="number" class="form-control" id="offer_price" name="offer_price" value="<?php echo htmlspecialchars($product['offer_price']); ?>" step="0.01">
    </div>
    <div class="form-group">
        <label for="offer_percentage">Offer Percentage</label>
        <input type="number" class="form-control" id="offer_percentage" name="offer_percentage" value="<?php echo htmlspecialchars($product['offer_percentage']); ?>" step="0.01">
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>" required>
    </div>
    <div class="form-group">
        <label for="available_stocks">Available Stocks</label>
        <input type="number" class="form-control" id="available_stocks" name="available_stocks" value="<?php echo htmlspecialchars($product['available_stocks']); ?>" required>
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <select class="form-control" id="category" name="category" required>
            <option value="veg" <?php echo $product['category'] == 'veg' ? 'selected' : ''; ?>>Veg</option>
            <option value="non-veg" <?php echo $product['category'] == 'non-veg' ? 'selected' : ''; ?>>Non-Veg</option>
            <option value="tea" <?php echo $product['category'] == 'tea' ? 'selected' : ''; ?>>Tea</option>
            <option value="coffee" <?php echo $product['category'] == 'coffee' ? 'selected' : ''; ?>>Coffee</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" id="image" name="image">
        <?php if ($product['image']): ?>
            <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 100px;">
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Update Product</button>
</form>

<?php
include 'footer.php';
$conn->close();
?>
