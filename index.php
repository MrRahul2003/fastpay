<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>index</title>
    <script src="https://kit.fontawesome.com/eb7f9471ef.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <?php    
    // connecting to database and starting session
    session_start();
    include 'partials/_connect.php';

    // including the navigation bar
    include 'nav.php'
    ?>

    <?php
    if (!($_SESSION['login'])) {
        header("location: partials/_login.php");
        exit;
    }

    $login_user_id = $_SESSION['login_user_id'];
    ?>

    <!-- index page coursel -->
    <div class=" mx-auto">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/4.jpg" style="height:90vh; width:100%;" class="d-block w-60" alt="...">
                </div>
            </div>
        </div>
    </div>

    <!-- Basic functions -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <object data="svg/svg-scan.svg" width="80" height="80"> </object>
                    <a class="nav-link py-0 my-0" data-bs-toggle="modal" data-bs-target="#mobile_pay"
                        href="#"><small>Scan</small></a>
                </li>
                <li class="nav-item">
                    <object data="svg/svg-pay.svg" width="80" height="80"> </object>
                    <a class="nav-link py-0 my-0" href="#" data-bs-toggle="modal"
                        data-bs-target="#mobile_pay"><small>Mobile Pay</small></a>
                </li>
                <li class="nav-item">
                    <object data="svg/svg-banktransfer.svg" width="80" height="80"> </object>
                    <a class="nav-link py-0 my-0" href="#" data-bs-toggle="modal" data-bs-target="#bank_pay"><small>Bank
                            Transfer</small></a>
                </li>
                <li class="nav-item">
                    <object data="svg/svg-balance.svg" width="80" height="80"> </object>
                    <a class="nav-link py-0 my-0" href="balance.php"><small>History</small></a>
                </li>
            </ul>
        </div>
    </div>

    <!-- including bank and phone contact list -->
    <?php
    include 'partials/_contacts.php';
    echo '<br>';
    include 'partials/_bank_contacts.php';
    ?>

    <!-- Modal Container for mobile pay -->
    <div class="container">
        <div class="modal fade " id="mobile_pay" tabindex="-1" aria-labelledby="mobile_pay" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mobile_pay">Enter Receiver's Details : </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="/fastpay/payment/_pay_mobile_no.php" method="POST">
                            <div class="form-group">
                                <label for="name"> Name :</label>
                                <input type="text" class="form-control" id="name" name="myName">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone :</label>
                                <input type="number" class="form-control" id="phone" name="myPhone">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-secondary">Proceed!</button>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Container for bank pay -->
    <div class="container">
        <div class="modal fade " id="bank_pay" tabindex="-1" aria-labelledby="bank_pay" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bank_pay">Enter Details : </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="/fastpay/payment/_pay_bank_details.php" method="POST">
                            <div class="form-group">
                                <label for="name"> Bank Holder Name :</label>
                                <input type="text" class="form-control" id="name" name="myHolder">
                            </div>

                            <div class="form-group">
                                <label for="name"> Bank Name :</label>
                                <input type="text" class="form-control" id="name" name="myBank">
                            </div>

                            <div class="form-group">
                                <label for="phone">IFSC Code :</label>
                                <input type="text" class="form-control" id="phone" name="myIFSC">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-secondary">Send Now!</button>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>

    <!-- Offers Section -->
    <div class="container">
        <div class="card text-center">
            <div class="card-body" style="border : 2px solid grey;">
                <div class="jumbotron jumbotron-fluid my-2">
                    <div class="container bg-light">
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <object data="svg/svg-recharge.svg" width="50" height="50"> </object>
                                <a class="nav-link py-0 my-0" href="#" data-bs-toggle="modal"
                                    data-bs-target="#mobile_pay"><small>Recharge</small></a>
                            </li>
                            <li class="nav-item">
                                <object data="svg/svg-shopping.svg" width="50" height="50"> </object>
                                <a class="nav-link py-0 my-0"
                                    href="https://www.amazon.in/?ie=UTF8&tag=googinprimeexpt5-21&ascsubtag=_k_Cj0KCQjwrs2XBhDjARIsAHVymmRV5BnPpajJKGsbllhrarmQNVaV22Er7GvEDBX3yEwr3StaCCtnkhEaAn9KEALw_wcB_k_&gclid=Cj0KCQjwrs2XBhDjARIsAHVymmRV5BnPpajJKGsbllhrarmQNVaV22Er7GvEDBX3yEwr3StaCCtnkhEaAn9KEALw_wcB"
                                    target="_blank"><small>Shopping</small></a>
                            </li>
                            <li class="nav-item">
                                <object data="svg/svg-cable.svg" width="50" height="50"> </object>
                                <a class="nav-link py-0 my-0"
                                    href="https://www.dishtv.in/Pages/Instant-Recharge-Payment.aspx"
                                    target="_blank"><small>DTH/Cable TV</small></a>
                            </li>
                            <li class=" nav-item">
                                <object data="svg/svg-electricity.svg" width="50" height="50"> </object>
                                <a class="nav-link py-0 my-0"
                                    href="https://wss.mahadiscom.in/wss/wss?uiActionName=getViewPayBill"
                                    target="_blank"><small>Electricity</small></a>
                            </li>
                            <li class="nav-item">
                                <object data="svg/svg-fasttag.svg" width="50" height="50"> </object>
                                <a class="nav-link py-0 my-0" data-bs-toggle="modal" data-bs-target="#mobile_pay"
                                    href="https://www.npci.org.in/what-we-do/netc-fastag/request-for-netc-fastag"
                                    target="_blank"><small>FASTtag</small></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="#" class="btn btn-primary">Show More</a>
            </div>
            <div class="card-footer text-muted">
                2 days left to avail offers
            </div>
        </div>
        <?php
        include 'partials/_footer.php';
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
            integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>

</body>

</html>