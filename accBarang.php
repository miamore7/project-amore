<?php
include('sidebar.php');
include('dbConnection.php');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjual</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div>

        <h1>ACC Penjualan</h1>

        <table>
            <tr>
                <th>Penjual</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>Airbus SE</td>
                <td>EU</td>
                <td>Bank</td>
                <td><img src="airbus.jpg" alt="Airbus SE" width="50" height="50"></td>
                <td>
                    <a href="#">ACC</a>
                    <a href="#">Reject</a>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>