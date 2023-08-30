<?php include "template.php";
/** @var $conn */

if (!authorisedAccess(false, true, true)) {
    header("Location:index.php");
}
if (isset($_GET["UserID"])) {
    if ($_SESSION['access_level'] == 3) {
        $userid = $_GET["UserID"];
    } else {
        $_SESSION["flash_message"] = "Access denied!";
        $userid = $_SESSION["user_id"] ;
    }
} else {
    $userid = $_SESSION["user_id"] ;
}
$query = $conn->query("SELECT * FROM Users WHERE UserID='$userid'");
$userData = $query->fetch();
$userName = $userData["Username"];
$hashedPassword = $userData["HashedPassword"];
$userAccessLevel = $userData["AccessLevel"];
$userEnabled = $userData["enabled"];

?>


<title>Register Page</title>

<h1 class='text-primary'>Reset Password <?=$userid?></h1>
<form action="userProfile.php?UserID=<?=$userid?>" method="post" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <!--Customer Details-->


            <p>Please enter new username:</p>

            <p>Username<input type="text" name="newusername" class="form-control" required="required" value="<?php echo"$userName" ?>"></p>

        </div>
            <div class="col-md-12">

                <p>Please enter new password:</p>

                <p>Password<input type="password" name="password" class="form-control" required="required"></p>

            </div>
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
    $newusername = sanitise_data($_POST['newusername']);
    //$hashed_password;


        $sql = "UPDATE Users SET Username = :newusername, HashedPassword = :newPassword WHERE UserID='$userid'";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':newPassword', $hashed_password);
        $stmt->bindValue(':newusername', $newusername);
        $stmt->execute();
        $_SESSION["flash_message"] = "Password Reset!";
        header("Location:index.php");


}
?>

