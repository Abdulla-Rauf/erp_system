<?php
include 'db.php';
include 'header.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<a href="add_product.php" class="btn btn-primary mb-3">Add New Product</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Offer Price</th>
            <th>Offer Percentage</th>
            <th>Quantity</th>
            <th>Available Stocks</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" style="width: 100px;"></td>
            <td><?php echo htmlspecialchars($row['price']); ?></td>
            <td><?php echo htmlspecialchars($row['offer_price']); ?></td>
            <td><?php echo htmlspecialchars($row['offer_percentage']); ?>%</td>
            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
            <td><?php echo htmlspecialchars($row['available_stocks']); ?></td>
            <td><?php echo htmlspecialchars($row['category']); ?></td>
            <td>
                <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
include 'footer.php';
$conn->close();
?>
