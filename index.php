<?php
include 'db.php';
session_start();

$message = "";
if (isset($_POST['click_button'])) {

    $Id = $_POST['productId'];
    $sql = $conn->query("SELECT*FROM product WHERE id='$Id'");
    $product = $sql->fetch_assoc();
    $name = $product['name'];
    $Id = $product['id'];
    $price = $product['price'];
    $image = $product['img'];
    $quantity = $product['quantity'];

    $cartArray = array(
        array(
            'name' => $name,
            'id' => $Id,
            'price' => $price,
            'quantity' => $quantity,
            'img' => $image),
    );
    if (empty($_SESSION["arr"])) {
        $_SESSION["arr"] = $cartArray;
    } else {

        for ($i = 0; $i < count($_SESSION['arr']); $i++) {
            $check = in_array($Id, $_SESSION['arr'][$i]);
            if ($check == true) {
                $message = "This Product already added in the Cart!";
                break;
            }
        }
        if ($check == false) {
            $_SESSION["arr"] = array_merge(
                $_SESSION["arr"],
                $cartArray
            );
        }
    }
    // $array_keys = array_keys($_SESSION["arr"]);

    //     if (in_array($code, $array_keys)) {
    //         $status = "<div class='box' style='color:red;'>
    // Product is already added to your cart!</div>";
    //     } else {
    //         $_SESSION["shopping_cart"] = array_merge(
    //             $_SESSION["shopping_cart"],
    //             $cartArray
    //         );
    //         $status = "<div class='box'>Product is added to your cart!</div>";
    //     }

}

$sql = "SELECT*FROM product";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

    <head>
        <script src="/docs/5.3/assets/js/color-modes.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.115.4">
        <title>e_Commerce</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
        <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
        <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
        <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
        <meta name="theme-color" content="#712cf9">


        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        #banner {
            /* background-image: url('https://source.unsplash.com/random/200x200?stationery,book,pen'); */
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url(banner/ecommerce.jpg);
            width: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

        }
        </style>


    </head>

    <body>
        <?php
include "header.php";
?>

        <main>
            <section class="py-5 text-center" id="banner" style="height:400px;">
            </section>
            <?php
if ($message) {
    echo "<div class='alert alert-success mt-2' role='alert'>" . $message . "</div>";} else {echo "";}?>
            <div class="album py-5 bg-body-tertiary">

                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
                        <div class="col">
                            <div class="card shadow-sm" style="width: 22rem; height: 35rem;">
                                <img src="img/<?=$row['img']?>" class="card-img-top" alt="..." style="height: 24rem;">
                                <div class="card-body">
                                    <h5 class="card-title"><?=$row['name']?></h5>
                                    <p class="card-text"><?php
echo substr($row['desce'], 0, 40) . "...";
        ?></p>
                                    <h3>Price $<?=$row['price']?></h3>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="btn-group">
                                            <form action="" method="post">
                                                <input type="hidden" name="productId" value="<?=$row['id']?>">
                                                <button class="btn btn-sm btn-outline-dark" type="submit"
                                                    name="click_button"
                                                    <?=($row['status'] != 'inStock') ? "disabled" : ""?>>Add to
                                                    Cart</button>
                                                <a class="btn btn-sm btn-outline-dark"
                                                    href="productDetail.php?detail=<?php echo $row['id'] ?>"
                                                    target="_blank">
                                                    Detail
                                                </a>
                                            </form>

                                        </div>
                                        <small
                                            class="<?=($row['status'] == 'inStock') ? "text-success" : "text-danger"?>">
                                            <?php if ($row['status'] == 'inStock') {
            echo "In Stock";
        } else {
            echo "Out of Stock";
        }
        ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php
}
}
?>

                    </div>
                </div>
            </div>

        </main>

        <?php
include "footer.php";
?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
        </script>

    </body>

</html>