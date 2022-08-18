<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <?php
// Including the navigation bar and database and collection data from session which is already set in navbar
include '_connect.php';
session_start();
include '_nav.php';
$login_user_id = $_SESSION['login_user_id'];
?>
    <div class="container col-md-6 pt-5">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">

            <?php
                // Fetching the Logged in user's information from database -- login
                $sql = "SELECT * FROM `login` WHERE user_id='$login_user_id'";
                $result = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result);
                
                echo
                '<div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary">Joining : Nov 10</strong>
                <h3 class="mb-0">' . $row['user_name'] . '</h3>
                <div class="mb-1 text-muted">8108595232</div>
                <div class="mb-1 text-muted">UPI ID : ' . $row['user_name'] . '@okhdfc</div>
                <p class="card-text mb-auto"><-- I talk, I smile, I laugh too but be careful when I am silent --></p>
                <a href="#" class="stretched-link">More Details :-</a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <img src="../images/profile1.jpg" width="200" height="250" class="d-block w-100" alt="...">
                </div>';
                ?>

        </div>
    </div>


    <div class="container px-4 py-5" id="custom-cards">
        <h2 class="pb-2 border-bottom">Recent Posts</h2>

        <div class="d-flex flex-direction-row justify-content-around my-4">


            <img src="../images/post-1.jpg" class="img-thumbnail" style="height:300px; width:300px;" alt="...">
            <div class="d-flex list-unstyled mt-auto px-3">
                <li class="me-auto">
                    <img src="https://github.com/twbs.png" alt="Bootstrap" width="32" height="32"
                        class="rounded-circle border border-white">
                    <small>Mumbai</small><br>
                    <small>3min ago</small>
                </li>
            </div>
            <img src="../images/post-2.jpg" class="img-thumbnail" style="height:300px; width:300px;" alt="...">
            <div class="d-flex list-unstyled mt-auto px-3">
                <li class="me-auto">
                    <img src="https://github.com/twbs.png" alt="Bootstrap" width="32" height="32"
                        class="rounded-circle border border-white">
                    <small>Pune</small><br>
                    <small>5d ago</small>
                </li>
            </div>
            <img src="../images/post-3.jpg" class="img-thumbnail" style="height:300px; width:300px;" alt="...">
            <ul class="d-flex list-unstyled mt-auto px-3">
                <li class="me-auto">
                    <img src="https://github.com/twbs.png" alt="Bootstrap" width="32" height="32"
                        class="rounded-circle border border-white">
                    <small>Delhi</small><br>
                    <small>3w ago</small>
                </li>
            </ul>

        </div>
    </div>

    <!-- profile page coursel -->
    <div class="container mx-auto">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../images/1.jpg" style="height:100vh; width:100%;" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
    </div>

    <?php
include '_footer.php'
?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>