<?php
include('sidebar.php');
// session_start();

// Daftar produk (contoh)
$products = [
    1 => ['name' => 'Kursi Gaming', 'price' => 49.99],
];

// Pilih produk pertama secara default untuk contoh ini
$_SESSION['selected_product'] = $products[1];

// Proses pembayaran
if (isset($_POST['pay'])) {
    // Validasi input dan proses pembayaran
    $payment_success = true; // Anggap pembayaran berhasil untuk contoh ini

    if ($payment_success) {
        echo "<h3>Pembayaran berhasil untuk " . htmlspecialchars($_SESSION['selected_product']['name']) . "!</h3>";
        session_destroy();
        exit;
    } else {
        echo "<h3>Pembayaran gagal. Silakan coba lagi.</h3>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bayar Produk</title>
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .container {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            width: 300px;
            border-radius: 8px;
        }
        .product-card {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .product-card h2 {
            margin: 0;
            font-size: 1.2em;
        }
        .product-card .price {
            font-size: 1.5em;
            font-weight: bold;
            margin-top: 10px;
        }
        button {
            background-color: #333;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
    </style> -->
</head>
<body>
    <div class="container">
        <h1>Bayar Produk</h1>
        <?php if (isset($_SESSION['selected_product'])): ?>
            <div class="product-card">
                <h2><?php echo htmlspecialchars($_SESSION['selected_product']['name']); ?></h2>
                <p>Rincian Harga</p>
                <div class="price">Total $<?php echo number_format($_SESSION['selected_product']['price'], 2); ?></div>
            </div>
            <form method="post">
                <button type="submit" name="pay">Bayar</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
