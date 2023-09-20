<?php
include '../db.php';

// if (isset($_POST['submit'])) {
//     if (
//         empty($_POST["name"]) ||
//         empty($_FILES['img']['name']) ||
//         empty($_POST["desce"]) ||
//         empty($_POST["price"]) ||
//         empty($_POST["quantity"]) ||
//         empty($_POST["status"])
//     ) {
//         if (empty($_POST["name"])) {
//             $nameErr = "Name is required";
//         }
//         if (empty($_FILES['img']['name'])) {
//             $imgErr = "Image is required";
//         }
//         if (empty($_POST["desce"])) {
//             $desceErr = "Description is required";
//         }
//         if (empty($_POST["price"])) {
//             $priceErr = "Price is required";
//         }
//         if (empty($_POST["quantity"])) {
//             $quantityErr = "Quantity is required";
//         }
//         if (empty($_POST["status"])) {
//             $statusErr = "Status is required";
//         }
//     } else {
//         $allowed_ext = array('png', 'jpg', 'jpeg', 'gif');
//         // $fileName = time() . "-nk." . $req->file('file')->getClientOriginalExtension();
//         $file_name = time() . "-" . $_FILES['img']['name'];
//         $file_size = $_FILES['img']['size'];
//         $file_tmp = $_FILES['img']['tmp_name'];
//         $target_dir = "../img/$file_name";
//         // Get file extension
//         $file_ext = explode('.', $file_name);
//         $file_ext = strtolower(end($file_ext));
//         // Validate file type/extension
//         if (in_array($file_ext, $allowed_ext)) {
//             // Validate file size
//             if ($file_size <= 3000000) { // 1000000 bytes = 1MB
//                 move_uploaded_file($file_tmp, $target_dir);
//             } else {
//                 $imgErr = "File too large!";
//             }
//         } else {
//             $imgErr = "Invalid file type!";
//         }

// if ((!preg_match("/^[a-zA-Z-' ]*$/", $name))) {
//     $nameErr = "Only letters and white space allowed";
// } else {

//     if (empty($nameErr) && empty($imgErr) && empty($desceErr) && empty($priceErr) && empty($quantityErr) && empty($statusErr)) {
//         // add to database
//         $sql = "INSERT INTO product (`name`, `img`, `price`, `quantity`, `desce`, `status`) VALUES ('$name', '$img', '$price','$quantity', '$desce', '$status')";
//         if (mysqli_query($conn, $sql)) {
//             // success
//             $message = "Product Inserted Successfully";
//             // header('Location: add_zProduct.php');
//         } else {
//             // error
//             echo 'Error: ' . mysqli_error($conn);
//         }
//     }
// }
//     }
// }
$Name = $_POST['ename'];
// $img = $file_name;
$Desce = $_POST['edesce'];
$Price = $_POST['eprice'];
$Quantity = $_POST['equantity'];
$Status = $_POST['estatus'];
$pId = $_POST['pId'];
// echo $pId . "<br>";
// echo $name . "<br>";
// echo $quantity . "<br>";
// echo $desce . "<br>";
// echo $price . "<br>";
// echo $status . "<br>";

$sql = "UPDATE product SET `name`='$Name', `price`='$Price', `desce`='$Desce', `quantity`='$Quantity', `status`='$Status' WHERE id='$pId'";
// $SQL="UPDATE crud SET `title`='$Title', `description`='$Desc' WHERE id='$Id'";
// "UPDATE `product` SET `id`='[value-1]',`name`='[value-2]',`img`='[value-3]',`price`='[value-4]',`desce`='[value-5]',`quantity`='[value-6]',`status`='[value-7]',`created_at`='[value-8]',`updated_at`='[value-9]' WHERE 1"

if (mysqli_query($conn, $sql)) {
    // success
    // $message = "Product Inserted Successfully";
    // header('Location: add_Product.php');
    header('Location:list_Product.php');

} else {
    // error
    echo 'Error: ' . mysqli_error($conn);
}
