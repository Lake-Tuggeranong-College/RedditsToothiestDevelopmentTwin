<?php include "template.php";
/**  @var $conn */
if (!authorisedAccess(false, false, true)) {
    header("Location:index.php");
}
?>
    <!--This script will list all of the products to the admins and show edit and remove buttons to access productEdit.php and productRemove.php.-->
    <title>Contacted Messages</title>

    <h1 class='text-primary'>Recieved Messages</h1>
<?php
$contactList = $conn->query("SELECT ID, username, message FROM contact");
?>
<?php
// Check to see if User is Administrator (level 3)
// If they are, allow functionality, otherwise redirect them back to the front page.
if ($_SESSION['access_level'] == 3) {
    ?>
    <!--  Display a list of the products  -->
    <div class="container-fluid">
        <?php
        while ($contactData = $contactList->fetch()) {
            ?>
            <!-- Display each product as [Image] [ProductName] [Edit Link]-->
            <div class="row">
                <div class="col-md-4">
                    <?php echo $contactData["ID"]; ?>
                </div>
                <div class="col-md-2">
                    <?php echo $contactData["username"]; ?>
                </div>
                <div class="col-md-2">
                    <?php echo $contactData["message"]; ?>
                </div>
                <div class="col-md-2">
                    <a href="userProfile.php?UserID=<?php echo $userData["UserID"]?>">Delete Message</a>
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