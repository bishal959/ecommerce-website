<?php
include 'header.php';
try {
  
    $user_id = $_SESSION['id'];
    
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
if (isset($_SESSION['id']) && $_SESSION['loggedin']){

?>
<link rel="stylesheet" href="css/myorder.css">
<main>
    <div class="order-table">
        <h2 style="color: black;">My Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Total Products</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                    <th>Action</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['name']; ?></td>
                        <td><?php echo $order['email']; ?></td>
                        <td><?php echo $order['total_product']; ?></td>
                        <td>Rs.<?php echo number_format($order['total_price']); ?></td>
                        <td><?php echo $order['order_date']; ?></td>
                        <td><?php echo $order['order_status']; ?></td>
                        <td>
                            <form action="https://uat.esewa.com.np/epay/main" method="POST">
                                <input value="<?php echo $order['total_price']; ?>" name="tAmt" type="hidden">
                                <input value="<?php echo $order['total_price']; ?>" name="amt" type="hidden">
                                <input value="0" name="txAmt" type="hidden">
                                <input value="0" name="psc" type="hidden">
                                <input value="0" name="pdc" type="hidden">
                                <input value="EPAYTEST" name="scd" type="hidden">
                                <input value="<?php echo "aaaaa". $order['order_id']; ?>" name="pid" type="hidden">
                                <input value="https://localhost/Evolve/sucess.php" type="hidden" name="su">
                                <input value="https://localhost/Evolve/fail.php" type="hidden" name="fu">
                                <input type="image" src="https://binitabhujel.com.np/image/esewa.png" class="btn" >
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <input value="<?php echo $order['order_id']; ?>" name="pid" >
    </div>
</main>

<?php 
} else{
header('Location: login.php');
exit();
}
include 'footer.php'; ?>
