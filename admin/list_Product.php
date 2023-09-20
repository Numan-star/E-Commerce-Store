<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['user'])) {
        $sno = $_GET['user'];
        $sql = "DELETE FROM product WHERE id = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $delete = true;
            header('Location:list_Product.php');
        } else {
            echo "Not deleted";
        }
    }
}

?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <title>List Product</title>
    </head>

    <body>

        <!-- Show information in table using database-->

        <div class="container my-5">
            <h1 class="text-info text-center mb-3">Product's List</h1>
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);
$sno = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $sno = $sno + 1;
    ?>
                    <tr>
                        <th scope='row'><?php echo $sno ?></th>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['price'] ?></td>
                        <td><?php echo $row['quantity'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                        <td><?php echo $row['desce'] ?></td>
                        <td><?php echo $row['img'] ?></td>

                        <td class="">
                            <a target="_blank" class="btn btn-primary btn-sm "
                                href="edit_Product.php?user=<?php echo $row['id'] ?>">
                                Edit
                            </a>
                            <a class="btn btn-danger btn-sm" href="list_Product.php?user=<?php echo $row['id'] ?>">
                                Delete
                            </a>
                        </td>



                    </tr>
                    <?php
}
?>



                </tbody>
            </table>
        </div>

        <hr>

        <!-- insert javascript in your project online-->


        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
        </script>
        <!-- insert datatable file in your project online-->


        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js">
        </script>


        <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
        </script>
    </body>

</html>