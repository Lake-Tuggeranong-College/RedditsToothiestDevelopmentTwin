<?php include "template.php";
/** @var $conn */

if (!authorisedAccess(true, true, true)) {
    header("Location:index.php");
}

?>

<title>Register Page</title>

<h1 class='text-primary'>Reset password</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <!--Customer Details-->

            <div class="col-md-12">
                <h2>Account Details</h2>
                <p>Please enter new password:</p>

                <p>Password<input type="password" name="password" class="form-control" required="required"></p>

            </div>
        </div>
    </div>
    <input type="submit" name="formSubmit" value="Submit">
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $password = sanitise_data($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $accessLevel = 1;
    $userid = $_SESSION["user_id"] ;
    //$hashed_password;


        $sql = "UPDATE Users SET HashedPassword = :newPassword WHERE UserID='$userid'";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':newPassword', $hashed_password);
        $stmt->execute();
        $_SESSION["flash_message"] = "Password Reset!";
        header("Location:index.php");


}
?>

