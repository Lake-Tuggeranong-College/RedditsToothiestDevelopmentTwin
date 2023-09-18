<?php include "template.php";
/**  @var $conn */
/**  @var $readID */
/**  @var $showIDis */
isEnabled($conn);
if (isset($_GET["readID"])) {
    if ($_SESSION["access_level"] == 3) {
        $readID = $_GET["readID"];
    } else {
        header("Location:index.php");
    }
    echo "ReadID ID found: $readID";
    $stmt = $conn->prepare("UPDATE contact SET Enabled = :read WHERE ID = :readID");
    $stmt->bindParam(":read", $read);
    $stmt->bindParam(":readID", $readID);
    $read = 0;
    $stmt->execute();
    header("Location:receivedMessages.php");
}
if (isset($_GET["showID"])) {
    if ($_SESSION["access_level"] == 3) {
        $showID = $_GET["showID"];
    } else {
        header("Location:index.php");
    }
    if ($showID == 1) {
        $contactList = $conn->query("SELECT ID, username, message, Enabled, subject FROM contact WHERE Enabled = 0");
        $showIDis = 0;
        $buttontext = "Show Unread Messages";
        $showReadButton = 0;
    } else {
        $contactList = $conn->query("SELECT ID, username, message, Enabled, subject FROM contact WHERE Enabled = 1");
        $showIDis = 1;
        $buttontext = "Show Read Messages";
        $showReadButton = 1;
    }
} else {
    header("Location:receivedMessages.php?showID=0");
    $contactList = $conn->query("SELECT ID, username, message, Enabled, subject FROM contact WHERE Enabled = 1");
    $showIDis = 1;
    $buttontext = "Show Read Messages";
    $showReadButton = 1;
}
?>
    <title>Contacted Messages</title>
    <h1 class='text-primary'>Received Messages</h1>
<?php
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
            <div class="row">
                <div class="col-md-1">
                    <?php echo $contactData["ID"]; ?>
                </div>
                <div class="col-md-1">
                    <?php echo $contactData["username"]; ?>
                </div>
                <div class="col-md-4">
                    <?php echo $contactData["message"]; ?>
                </div>
                <div class="col-md-1">
                    <?php

                    if ($contactData["Enabled"] == 1)
                        echo "Unread";
                    if ($contactData["Enabled"] == 0)
                        echo "Read"; ?>
                </div>
                <div class="col-md-1">
                    <?php
                    if ($contactData["subject"] == 1)
                        echo "General Question";
                    if ($contactData["subject"] == 2)
                        echo "Disabled Account";
                    if ($contactData["subject"] == 3)
                        echo "Forgot Password";
                    if ($contactData["subject"] == 4)
                        echo "Site Bugs / Issues";
                    if ($contactData["subject"] == 5)
                        echo "Other"; ?>

                </div>
                <?php
                if ($showReadButton == 1) {
                    ?>
                    <div class="col-md-1">
                        <a class="btn btn-secondary" href="receivedMessages.php?readID=<?php echo $contactData["ID"] ?>"
                           role="button">Mark as Read</a>
                    </div>
                    <?php
                } else {
                    // Nothing
                }
                ?>
            </div>

            <?php
        }
        ?>
        <div class="col-md-2">
            <a class="btn btn-secondary" href="receivedMessages.php?showID=<?php echo $showIDis; ?>"
               role="button"><?php echo $buttontext ?></a>
        </div>
    </div>

    <?php
} else {
    header("location:index.php");
}
?>