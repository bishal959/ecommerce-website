<title>Home</title>
<?php
  include 'header.php'
?>

    <div class="image">
                <p style="font-size: 50px; margin: 50px;">Electronic Collection<p><br>
                <p style="font-size: 50px; margin: 30px; margin-left: 50px;">20% Off Till July<p><br>
                <p style="font-size: 50px; margin: 30px; margin-left: 50px;">A leading company in the field of Electronics.<p><br>
                <p style="font-size: 50px; margin: 30px; margin-left: 50px;">30-Day return or refund guarantee<p><br>
    </div>

    <div>
        <h1 style="background-color: #3d3939; color: white; text-align: center; font-size: 40px; padding: 15px;">Our Latest Products</h1>

        <div class="flex-container">
        <?php
        $product_query = $conn->query("SELECT * FROM products ORDER BY product_id DESC LIMIT 6");
        $latest_products = $product_query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($latest_products as $product) {
            echo '<div class="product">';
            echo '<img src="uploaded_img/'.$product['product_image'].'" alt="' . $product['product_name'] . '" class="pro"><hr>';
            echo '<h4>' . $product['product_name'] . '</h4>';
            echo '<button><a href="readmore.php?read=' . $product['product_id'] . '">Read More</a></button>';
            echo '</div>';
        }
        ?>
    </div>
</div>



    <div class="para">
        <h1>Evolve Electronics</h1>
    <p>       
          <i>
            Evolve Electronics is the leading online electronics marketplace in Nepal, currently listing tens of thousands of electronics product for sale all over Kathmandu, Pokhara and rest the country.
            If you are looking to buy any electronics items from any part of Nepal, you can find them all on our website. 
          </i>
        </p>
    </div>
   

</body>
<?php
  include 'footer.php'
?>
</html>