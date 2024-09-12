<?php
include 'db.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $offer_price = $_POST['offer_price'];
    $offer_percentage = $_POST['offer_percentage'];
    $quantity = $_POST['quantity'];
    $available_stocks = $_POST['available_stocks'];
    $category = $_POST['category'];
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    // Move uploaded image to target directory
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $sql = "INSERT INTO products (name, price, offer_price, offer_percentage, quantity, available_stocks, category, image) 
            VALUES ('$name', '$price', '$offer_price', '$offer_percentage', '$quantity', '$available_stocks', '$category', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Product added successfully</div>";
        header('Location: index.php');
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>

<form action="add_product.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="offer_price">Offer Price</label>
        <input type="number" class="form-control" id="offer_price" name="offer_price" step="0.01">
    </div>
    <div class="form-group">
        <label for="offer_percentage">Offer Percentage</label>
        <input type="number" class="form-control" id="offer_percentage" name="offer_percentage" step="0.01">
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" required>
    </div>
    <div class="form-group">
        <label for="available_stocks">Available Stocks</label>
        <input type="number" class="form-control" id="available_stocks" name="available_stocks" required>
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <select class="form-control" id="category" name="category" required>
            <option value="veg">Veg</option>
            <option value="non-veg">Non-Veg</option>
            <option value="tea">Tea</option>
            <option value="coffee">Coffee</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" id="image" name="image" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Product</button>
</form>

<?php
include 'footer.php';
$conn->close();
?>
