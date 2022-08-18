<?php
// starting session and collecting session data from login page and connecting to database
session_start();
$login_user_id = $_SESSION['login_user_id'];

include '../partials/_connect.php';

// Collecting data from form that is in the index page
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // checking that user has send some details or not
    if (!($_POST['myHolder']) || !($_POST['myIFSC']) || !($_POST['myBank'])) {
        echo "Enter some details";
        header("location: ../index.php");
    } else {

        $holder_name = $_POST['myHolder'];
        $IFSC_Code = $_POST['myIFSC'];
        $bank_name = $_POST['myBank'];

        // inseting the collected data of bank sender from form to database -- bank_user
        $sql = "INSERT INTO `bank_user` (`login_user_id`,`bank_name`, `bank_holder_name`, `IFSC_code`, `Date/Time`) VALUES ('$login_user_id', '$bank_name', '$holder_name', '$IFSC_Code', current_timestamp())";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo "Bank data cannot be inserted";
            header("location: index.php");
        } else {
            echo "Bank data has be inserted";

            // Fetching the data of the bank sender which we had recently add in database -- bank_user and sending the fetched data to pay_bank page
            $sql = "SELECT * FROM `bank_user` WHERE bank_holder_name='$holder_name' AND bank_name='$bank_name' AND IFSC_code='$IFSC_Code'";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($result);
            $_SESSION['bank_user_id'] = $row['bank_user_no'];
            $_SESSION['login_user_id'] = $login_user_id;
            header("location: _pay_bank.php");
        }
    }
}
?>
