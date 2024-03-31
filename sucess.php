<?php
include 'database.php'; // Assuming this file contains the database connection

if (isset($_REQUEST['oid']) &&
    isset($_REQUEST['amt']) &&
    isset($_REQUEST['refId'])
) {
    // Data from the incoming request
    $oid = substr($_REQUEST['oid'], 5);
    $order_update_id = $oid;
    $amt = $_REQUEST['amt']; // Assuming 'amt' is the total amount
    $refId = $_REQUEST['refId']; // Assuming 'refId' is some reference ID

    // API endpoint URL with query parameters
    $api_url = 'https://uat.esewa.com.np/api/epay/txn_status/v2?pid=' . urlencode($oid) . '&totalAmount=' . urlencode($amt) . '&scd=EPAYTEST';

    // Initialize cURL
    $ch = curl_init($api_url);

    // Set the request method to GET
    curl_setopt($ch, CURLOPT_HTTPGET, true);

    // Return the response instead of outputting it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_error($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        // Close cURL session
        curl_close($ch);

        // Decode JSON response
        $response_array = json_decode($response, true);

        // Check if status is 'COMPLETE'
        if (isset($response_array['status']) && $response_array['status'] === 'COMPLETE') {
            // Update payment status in the database
            $stmt = $conn->prepare("UPDATE `orders` SET `payment_method` = 'E-sewa paid' WHERE `order_id` = :oid");
            $stmt->bindParam(':oid', $oid);
            $stmt->execute();
        } else {
            echo "Transaction not complete";
        }
    }
} else {
    echo "Missing parameters";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Payment Success</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">
   <div class="flex">
      <div class="content">
         <h3>YOUR PAYMENT HAS BEEN SUCCESSFUL</h3>
         <p>You can click the button below to shop more:</p>
         <a href="shop.php" class="btn">Shop</a>
      </div>
   </div>
</section>

<?php include 'footer.php'; ?>

<!-- Custom JS file link -->
<script src="js/script.js"></script>

</body>
</html>
