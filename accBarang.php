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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            display: block;
            margin: auto;
        }

        .action-links a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }

        .action-links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            th, td {
                display: block;
                text-align: right;
            }

            th {
                display: none;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
            }

            img {
                max-width: 100%;
                height: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>ACC Penjualan</h1>

        <table>
            <thead>
                <tr>
                    <th>Penjual</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="Penjual">Airbus SE</td>
                    <td data-label="Kategori">EU</td>
                    <td data-label="Harga">Bank</td>
                    <td data-label="Gambar"><img src="airbus.jpg" alt="Airbus SE" width="50" height="50"></td>
                    <td data-label="Action" class="action-links">
                        <a href="#">ACC</a>
                        <a href="#">Reject</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
