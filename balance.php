<?php
    session_start();
    include 'nav.php';
    $login_user_id = $_SESSION['login_user_id'];
?>
<?php
include 'partials/_connect.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaction History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container my-4">
        <table class="table">
            <h2 class="my-5">Transation History :</h2>
            <thead>
                <tr>
                    <th scope="col">Sr No</th>
                    <th scope="col">Money Transferred To</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date/Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `balance` WHERE login_user_id='$login_user_id'";
                $result = mysqli_query($conn,$sql);

                $rowNO = mysqli_num_rows($result);
                $id = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    echo
                    '<tr>
                        <th scope="row">'.++$id.'</th>
                        <td>'. $row['transaction_done_by'].'</td>
                        <td>'. $row['transaction_amount'].'</td>
                        <td>'. $row['transation_date'].'</td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- balance page coursel -->
    <div class="container mx-auto">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/coursel-5.jpg" style="height:80vh; width:80%;" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'partials/_footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>