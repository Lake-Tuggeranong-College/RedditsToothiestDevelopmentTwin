<?php include "template.php";
/**  @var $conn */
/**  @var $deletionid */
isEnabled($conn);
if (isset($_GET["deletionid"])) {
    if($_SESSION["access_level"] == 3){
        $deletionid = $_GET["deletionid"];
    } else {
        header("Location:index.php");
    }
    echo "Deletion ID found: $deletionid";
    $stmt = $conn->prepare("SELECT username, message FROM contact WHERE ID = ?");
    $stmt->bindParam(1, $deletionid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $username = $result['username'];
        $message = $result['message'];
        echo "Username: " . $username;
        echo "Message: " . $message;
        $stmt_delete = $conn->prepare("DELETE FROM contact WHERE ID = ?");
        $stmt_delete->bindParam(1, $deletionid);
        if ($stmt_delete->execute()) {
            header("Location:receivedMessages.php");
            echo "Entry deleted successfully.";
        } else {
            echo "Error deleting entry: " . $stmt_delete->errorInfo()[2];
        }
    }
}
if (!authorisedAccess(false, false, true)) {
    header("Location:index.php");
}
?>
    <!--This script will list all the products to the admins and show edit and remove buttons to access productEdit.php and productRemove.php.-->
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
                    <a href="receivedMessages.php?deletionid=<?php echo $contactData["ID"] ?>">Delete Message</a>
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