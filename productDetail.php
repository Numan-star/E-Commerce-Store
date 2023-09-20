<?php
include 'db.php';
session_start();
if (isset($_GET['detail'])) {
    $product_id = $_GET['detail'];
}

$sql = $conn->query("SELECT*FROM product WHERE id='$product_id'");

if ($sql->num_rows === 1) {
    $product = $sql->fetch_assoc();
} else {
    header('Location:index.php');
}
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
        <title>Product Detail</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/jumbotron/">



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
        </style>


    </head>

    <body>
        <?php
include "header.php";
?>
        <main>
            <div class="container py-4">
                <header class="pb-3 mb-4 border-bottom">
                    <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
                        <span class="fs-4">Product Detail</span>
                    </a>
                </header>

                <div class="container d-flex flex-row col-12">
                    <div class="col-6">
                        <div class=" mb-4 container">
                            <img class="rounded-3" src="img/<?=$product['img']?>" alt=""
                                style="width:32rem; height:45rem;">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                            <div class="container-fluid py-5">
                                <h1 class="display-5 fw-bold"><?=$product['name']?></h1>
                                <p class="col-md-8 fs-4"><?=$product['desce']?></p>
                                <p class="col-md-8 fs-4">Price: $<?=$product['price']?></p>
                                <div class="d-flex justify-content-between align-items-center mb-2">

                                    <!-- <button class="btn btn-primary btn-lg" type="button"
                                        <?php
// ($product['status'] != 'inStock') ? "disabled" : ""
?>>Add to Cart</button> -->

                                    <small
                                        class="<?=($product['status'] == 'inStock') ? "text-success" : "text-danger"?> d-block text-right fs-5">
                                        <?php if ($product['status'] == 'inStock') {
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
                </div>

                <div class="d-flex justify-content-center align-items-center mb-2 border-top">
                    <a class="btn btn-sm btn-info mt-2" href="?index">Back to Home</a>
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