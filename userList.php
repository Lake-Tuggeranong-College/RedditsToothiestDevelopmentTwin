<?php include "template.php";
/**  @var $conn */
?>
    <!--This script will list all of the products to the admins and show edit and remove buttons to access productEdit.php and productRemove.php.-->
    <title>User List</title>

    <h1 class='text-primary'>User List</h1>
<?php
$userList = $conn->query("SELECT UserID, Username, enabled, AccessLevel FROM Users");
?>
<?php
// Check to see if User is Administrator (level 3)
// If they are, allow functionality, otherwise redirect them back to the front page.
if ($_SESSION['access_level'] == 3) {
    ?>
    <!--  Display a list of the products  -->
    <div class="container-fluid">
        <?php
        while ($userData = $userList->fetch()) {
            ?>
            <!-- Display each product as [Image] [ProductName] [Edit Link]-->
            <div class="row">
                <div class="col-md-4">
                    <?php echo $userData["UserID"]; ?>
                </div>
                <div class="col-md-2">
                    <?php echo $userData["Username"]; ?>
                </div>
                <div class="col-md-2">
                    <?php echo $userData["enabled"]; ?>
                </div>
                <div class="col-md-2">
                    <?php echo $userData["AccessLevel"]; ?>
                </div>
                <div class="col-md-2">
                    <a href="userProfile.php?UserID=<?php echo $userData["UserID"]?>">Reset Password</a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <?php
} else {
    header("location:index.php");
}
?>