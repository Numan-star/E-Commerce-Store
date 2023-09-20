<?php
session_start();
if (!isset($_SESSION['arr']) || !isset($_SESSION['username'])) {
    header("Location:cart.php");
}

?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Invoice</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <?php
$total_price = 0;

if ($_SESSION['count'] == 0) {
    ?>
            <div class="d-flex flex-column justify-content-center align-items-center my-5">
                <h1 class="text-center my-5">Your Cart is Empty!</h1>
                <a class="btn btn-info btn-lg col-3" href="index.php">Add Product to Cart</a>
            </div>

            <?php
} else {?>
            <div class="d-flex justify-content-between">
                <h1 class="d-inline">NK</h1>
                <h1 class="d-inline">INVOICE</h1>
            </div>
            <div class="d-flex justify-content-between mt-5">
                <div>
                    <h3>BILLED TO</h3>
                    <p><?=$_SESSION['username']?></p>
                    <p>+92 <?=$_SESSION['phone']?></p>
                    <p><?=$_SESSION['address']?></p>
                </div>
                <div>
                    <p>Invoice No: 12345</p>
                    <p><?php
echo date("d M Y");
    ?></p>
                    <p>
                        <a class="btn btn-sm btn-outline-dark" href="javascript:window.print()">Print Invoice</a>
                    </p>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th class="">Item</th>
                        <th class="col-0">Quantity</th>
                        <th class="col-0">Unit Price</th>
                        <th class="col-0">Total</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
foreach ($_SESSION['arr'] as $key => $product) {
        ?>
                    <tr>
                        <td class="col-7"><?=$product['name']?></td>
                        <td>
                            <?=$product['quantity']?>
                        </td>
                        <td><?php echo "$" . $product["price"]; ?></td>
                        <td><?php echo "$" . $product["price"] * $product['quantity']; ?></td>
                    </tr>

                    <?php $total_price += ($product["price"] * $product['quantity']);
    }
    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <th>
                            Subtotal
                        </th>
                        <td>
                            $<?=$total_price?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <th>
                            Tax (0%)
                        </th>
                        <td>
                            $0
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <h3>Total</h3>
                        </td>
                        <td>
                            <h3> $<?=$total_price?> </h3>
                        </td>
                    </tr>


                </tbody>
            </table>
            <div class="d-flex justify-content-between my-5">
                <h1 class="d-inline">Thank you!</h1>
            </div>


            <?php
}
?>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
        </script>
    </body>

</html>