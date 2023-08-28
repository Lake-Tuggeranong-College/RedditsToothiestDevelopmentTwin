<?php include "template.php";
/**  @var $conn */
isEnabled($conn);

if (isset($_GET["disableID"])) {
    if ($_SESSION["access_level"] == 3) {
        $disableID = $_GET["disableID"];
    } else {
        header("Location:index.php");
    }
    echo "DisableID ID found: $disableID";
    $stmt = $conn->prepare("UPDATE users SET Enabled = :disable WHERE UserID = :disableID");
    $stmt->bindParam(":disable", $disable);
    $stmt->bindParam(":disableID", $disableID);
    $disable = 0;
    $stmt->execute();
    header("Location:userList.php");
}
if (isset($_GET["enableID"])) {
    if ($_SESSION["access_level"] == 3) {
        $enableID = $_GET["enableID"];
    } else {
        header("Location:index.php");
    }
    echo "EnableID ID found: $enableID";
    $stmt = $conn->prepare("UPDATE users SET Enabled = :enable WHERE UserID = :enableID");
    $stmt->bindParam(":enable", $enable);
    $stmt->bindParam(":enableID", $enableID);
    $enable = 1;
    $stmt->execute();
    header("Location:userList.php");
}
?>
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
    <div class="container-fluid">
        <?php
        while ($userData = $userList->fetch()) {
            ?>
            <div class="row">
                <div class="col-md-1">
                    <?php echo $userData["UserID"]; ?>
                </div>
                <div class="col-md-1">
                    <?php echo $userData["Username"]; ?>
                </div>
                <div class="col-md-1">
                    <?php echo $userData["enabled"]; ?>
                </div>
                <div class="col-md-1">
                    <?php echo $userData["AccessLevel"]; ?>
                </div>
                <div class="col-md-1">
                    <div class="btn-group dropright">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            User Options
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="userProfile.php?UserID=<?php echo $userData["UserID"]?>">Reset Password</a>
                            <a class="dropdown-item" href="userList.php?enableID=<?php echo $userData["UserID"]?>">Enable User</a>
                            <a class="dropdown-item" href="userList.php?disableID=<?php echo $userData["UserID"]?>">Disable User</a>
                        </div>
                    </div>
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
<!--These are here because the Bootstrap dropdown buttons will break without them!-->
<!--DO NOT REMOVE!!-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
