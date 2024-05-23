<?php
include('sidebar.php');
// session_start();

// Daftar produk (contoh)
$products = [
    1 => ['name' => 'Nokia Essential Wireless Headphones 120CM BLACK', 'price' => 600000, 'image' => 'https://via.placeholder.com/150'],
    2 => ['name' => 'Nokia Essential Wireless Headphones 120CM BLACK', 'price' => 600000, 'image' => 'https://via.placeholder.com/150'],
];

// Proses pembelian produk
if (isset($_POST['buy'])) {
    $product_id = intval($_POST['product_id']);
    if (isset($products[$product_id])) {
        $_SESSION['selected_product'] = $products[$product_id];
        header("Location: pembayaran.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="css/pasar.css">    
</head>
<body>
    <div class="product-container">
        <?php foreach ($products as $id => $product): ?>
            <div class="product-card">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <div class="price">₦<?php echo number_format($product['price'], 0, ',', '.'); ?></div>
                <form method="post">
                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                    <button type="submit" name="buy">Beli</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
