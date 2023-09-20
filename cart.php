<?php
include 'db.php';
session_start();

if (isset($_POST['getInvoice'])) {
    $_SESSION['username'] = $_POST['cname'];
    $_SESSION['phone'] = $_POST['cphone'];
    $_SESSION['address'] = $_POST['caddress'];
    $_SESSION['mode'] = $_POST['cmode'];
    header("Location:invoice.php");
} else if (isset($_POST['placeOrder'])) {
    $_SESSION['username'] = $_POST['cname'];
    $_SESSION['phone'] = $_POST['cphone'];
    $_SESSION['address'] = $_POST['caddress'];
    $_SESSION['mode'] = $_POST['cmode'];

    $query1 = "INSERT INTO customer (`cname`, `cphone`, `caddress`, `cmode`) VALUES ('$_POST[cname]','$_POST[cphone]','$_POST[caddress]','$_POST[cmode]')";

    if ($conn->query($query1)) {

        $Order_id = mysqli_insert_id($conn);
        $query2 = "INSERT INTO user_orders (`order_id`, `item_name`, `price`, `quantity`) VALUES (?,?,?,?)";
        $stmt = mysqli_prepare($conn, $query2);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "isii", $Order_id, $Item_Name, $Price, $Quantity);
            foreach ($_SESSION['arr'] as $key => $value) {
                $Item_Name = $value['name'];
                $Price = $value['price'];
                $Quantity = $value['quantity'];
                mysqli_stmt_execute($stmt);
            }
            unset($_SESSION['arr']);
            echo "<script>
            alert('Order Placed');
            window.location.href='index.php';
            </script>";
        } else {
            echo "query error";
        }

    } else {
        echo "Error";
    }

}

if (isset($_POST['delete_button'])) {

    $Id = $_POST['index'];
    if ($Id == null) {
        header('Location:index.php');
    }
    if ($_SESSION['arr'][$Id]) {
        unset($_SESSION['arr'][$Id]);
        $_SESSION['arr'] = array_merge($_SESSION['arr']);
        $_SESSION['count'] -= 1;
    } else {
        header('Location:index.php');
    }
}

if (isset($_POST['action']) && $_POST['action'] == "change") {
    foreach ($_SESSION["arr"] as &$value) {
        if ($value['id'] === $_POST["pId"]) {
            $value['quantity'] = $_POST["num"];
            break; // Stop the loop after we've found the product
        }
    }

}

?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Shopping Cart</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>

    <body>
        <?php
include "header.php";
?>
        <div>
            <?php $total_price = 0;
if ($_SESSION['count'] == 0) {
    ?>
            <div class="d-flex flex-column justify-content-center align-items-center my-5">
                <h1 class="text-center my-5">Your Cart is Empty!</h1>
                <a class="btn btn-info btn-lg col-3" href="index.php">Add Product to Cart</a>
            </div>

            <?php
} else {?>
            <div>
                <h1 class="text-center" style="margin-top:20px;">My Cart</h1>
            </div>
            <div class="container d-flex my-5 flex-row mb-5 border rounded">
                <div class="col-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Items Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
foreach ($_SESSION['arr'] as $key => $product) {
    ?>
                            <tr>
                                <td><img src="img/<?=$product['img']?>" alt="" style="width:55px; height:70px;"
                                        class="rounded"></td>
                                <td><?=$product['name']?></tdname=>
                                <td>
                                    <form method='post' action=''>
                                        <input type='hidden' name='pId' value="<?php echo $product["id"]; ?>" />
                                        <input type='hidden' name='action' value="change" />
                                        <select class="form-input" name='num' onChange="this.form.submit()">
                                            <option <?php if ($product["quantity"] == 1) {
        echo "selected";
    }
    ?> value="1">1</option>
                                            <option <?php if ($product["quantity"] == 2) {
        echo "selected";
    }
    ?> value="2">2</option>
                                            <option <?php if ($product["quantity"] == 3) {
        echo "selected";
    }
    ?> value="3">3</option>
                                        </select>
                                    </form>
                                </td>
                                <td><?php echo "$" . $product["price"]; ?></td>
                                <td><?php echo "$" . $product["price"] * $product['quantity']; ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="index" value="<?=$key?>">
                                        <input class="btn btn-sm btn-outline-danger" type="submit" name="delete_button"
                                            value="Remove">
                                    </form>
                                </td>
                            </tr>
                            <?php $total_price += ($product["price"] * $product['quantity']);
}?>
                        </tbody>
                    </table>
                    <div class="col-11 mt-5">
                        <h4 class="bg-info float-end border p-2 rounded">Grand Total $<?=$total_price;?></h4>
                    </div>
                </div>
                <div class="col-4 h-50 py-3 bg-info rounded">
                    <h3 class="mt-3 text-center">Check Out Form</h3>
                    <div class="container mt-3">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="cname" class="form-control" placeholder="Your name..."
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="number" name="cphone" class="form-control"
                                    placeholder="Your phone number..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="caddress" class="form-control"
                                    placeholder="Your phone number..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Payment Mode</label>
                                <select name="cmode" id="" class="form-select">
                                    <option value="Cash">Cash</option>
                                    <option value="Online">Online</option>
                                </select>
                            </div>
                            <input class="btn btn-sm btn-outline-dark" type="submit" name="placeOrder"
                                value="Place Order">
                            <input class="btn btn-sm btn-outline-dark" type="submit" name="getInvoice"
                                value="Get Invoice">
                        </form>
                    </div>

                </div>
            </div>
            <?php
include "footer.php";
    ?>
            <?php
}
?>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
        </script>
    </body>

</html>