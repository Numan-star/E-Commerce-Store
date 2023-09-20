<?php
include '../db.php';

// Set vars to empty values
$name = $img = $desce = $price = $quantity = $status = $message = '';
$nameErr = $imgErr = $desceErr = $priceErr = $quantityErr = $statusErr = '';

// Form submit
if (isset($_POST['submit'])) {
    if (
        empty($_POST["name"]) ||
        empty($_FILES['img']['name']) ||
        empty($_POST["desce"]) ||
        empty($_POST["price"]) ||
        empty($_POST["quantity"]) ||
        empty($_POST["status"])
    ) {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        }
        if (empty($_FILES['img']['name'])) {
            $imgErr = "Image is required";
        }
        if (empty($_POST["desce"])) {
            $desceErr = "Description is required";
        }
        if (empty($_POST["price"])) {
            $priceErr = "Price is required";
        }
        if (empty($_POST["quantity"])) {
            $quantityErr = "Quantity is required";
        }
        if (empty($_POST["status"])) {
            $statusErr = "Status is required";
        }
    } else {
        $allowed_ext = array('png', 'jpg', 'jpeg', 'gif');

        // $fileName = time() . "-nk." . $req->file('file')->getClientOriginalExtension();

        $file_name = time() . "-" . $_FILES['img']['name'];
        $file_size = $_FILES['img']['size'];
        $file_tmp = $_FILES['img']['tmp_name'];
        $target_dir = "../img/$file_name";
        // Get file extension
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));
        // Validate file type/extension
        if (in_array($file_ext, $allowed_ext)) {
            // Validate file size
            if ($file_size <= 3000000) { // 1000000 bytes = 1MB
                move_uploaded_file($file_tmp, $target_dir);
            } else {
                $imgErr = "File too large!";
            }
        } else {
            $imgErr = "Invalid file type!";
        }

        $name = $_POST['name'];
        $img = $file_name;
        $desce = $_POST['desce'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $status = $_POST['status'];

        if ((!preg_match("/^[a-zA-Z-' ]*$/", $name))) {
            $nameErr = "Only letters and white space allowed";
        } else {

            if (empty($nameErr) && empty($imgErr) && empty($desceErr) && empty($priceErr) && empty($quantityErr) && empty($statusErr)) {
                // add to database
                $sql = "INSERT INTO product (`name`, `img`, `price`, `quantity`, `desce`, `status`) VALUES ('$name', '$img', '$price','$quantity', '$desce', '$status')";
                if (mysqli_query($conn, $sql)) {
                    // success
                    $message = "Product Inserted Successfully";
                    // header('Location: add_Product.php');
                } else {
                    // error
                    echo 'Error: ' . mysqli_error($conn);
                }
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Product</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>

    <body>
        <div class="container my-5">
            <h1 class="text-info">Add Product</h1>
            <?php
if ($message) {
    echo "<div class='alert alert-success' role='alert'>" . $message . "</div>";} else {echo "";}?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <div class="mb-2">
                    <label for="name" class="form-label text-dark">Product Name *</label>
                    <input type="text" placeholder="Name..." name="name" value="<?php
if (isset($_POST['name'])) {
    echo $_POST['name'];
}
?>" class="form-control">
                    <p class="text-danger"><?php echo $nameErr; ?></p>
                </div>
                <div class="mb-2">
                    <label for="image" class="form-label text-dark">Product Image *</label>
                    <input type="file" placeholder="Image..." name="img" value="" class="form-control">
                    <p class="text-danger"><?php echo $imgErr; ?></p>
                </div>
                <div class="mb-1">
                    <div>
                        <label for="desc" class="form-label text-dark">Product Description *</label>
                    </div>
                    <textarea class="col-sm-6 col-md-12" placeholder="Description..." name="desce" value="" cols="70"
                        rows="8"><?php
if (isset($_POST['desce'])) {
    echo $_POST['desce'];
}
?></textarea>
                    <p class="text-danger"><?php echo $desceErr; ?></p>
                </div>
                <div class="mb-2">
                    <label for="price" class="form-label text-dark">Product Price *</label>
                    <input type="number" placeholder="Price..." name="price" value="<?php
if (isset($_POST['price'])) {
    echo $_POST['price'];
}
?>" class="form-control">
                    <p class="text-danger"><?php echo $priceErr; ?></p>
                </div>
                <div class="mb-2">
                    <label for="author" class="form-label text-dark">Product Quantity *</label>
                    <input type="number" placeholder="Quantity..." name="quantity" value="<?php
if (isset($_POST['quantity'])) {
    echo $_POST['quantity'];
}
?>" class="form-control">
                    <p class="text-danger"><?php echo $quantityErr; ?></p>

                </div>
                <div class="mb-2">
                    <label for="special" class="form-label text-dark">Status *</label>
                    <select name="status" class="form-control">
                        <option value="">-- Select Value --</option>
                        <option value="inStock">inStock</option>
                        <option value="outOfStock">outOfStock</option>
                    </select>
                    <p class="text-danger"><?php echo $statusErr; ?></p>

                </div>
                <div class="mb-3">
                    <!-- <button type="submit" name="sumbit" value="submit" class="btn btn-info">ADD</button> -->

                    <input type="submit" name="submit" value="Add" class="btn btn-success">
                    <a href="" class="btn btn-dark">Reset</a>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
        </script>
    </body>

</html>