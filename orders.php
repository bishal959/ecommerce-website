<?php
include 'adminpanel.php';

function getOrders($conn)
{
    $sql = "SELECT * FROM orders";
    $stmt = $conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get all orders from the database
$orders = getOrders($conn);
?>
<link rel="stylesheet" href="css/orders.css">
<title>Orders</title>
<main>
    <div class="admin-orders">
        <h2>Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>ZIP Code</th>
                    <th>Country</th>
                    <th>Total Products</th>
                    <th>Payment Method</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['name']; ?></td>
                        <td><?php echo $order['email']; ?></td>
                        <td><?php echo $order['phone']; ?></td>
                        <td><?php echo $order['address']; ?></td>
                        <td><?php echo $order['city']; ?></td>
                        <td><?php echo $order['zip']; ?></td>
                        <td><?php echo $order['country']; ?></td>
                        <td><?php echo $order['total_product']; ?></td>
                        <td><?php echo $order['payment_method']; ?></td>
                        <td>$<?php echo number_format($order['total_price'], 2); ?></td>
                        <td><?php echo $order['order_date']; ?></td>
                        <td>
                        <?php if ($order['order_status'] == 'Processing'): ?>
                            <form action="completeorder.php" method="post">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <button type="submit" name="complete_btn" class="deliv">Mark as Delivered</button>
                            </form>
                        <?php else: ?>
                            <span class="deliv">Delivered</span>
                        <?php endif; ?>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
