<?php include "template.php";
/**  @var $conn */
?>
    <title>Test Post</title>
    <link rel="stylesheet" href="css/style.css">
    <body>

    <!--Pulls the details from the Posts table-->
    <?php
    $modAccessLevel = 2;
    $postDetails = $conn->query("SELECT BodyText, Title, Enabled, ID FROM Posts WHERE Enabled = 1");

    ?>


    <?php
    while ($postData = $postDetails->fetch()) {
//    print_r($postData);

    ?>

    <!--this will be the border of the hole post-->
    <div class="POST">

        <!--    this is the div that will display the title and other things displayed in the head note-->
        <div class="POSTTITLE">
            <?php echo '<h1>' . $postData[1] . '</h1>'; ?>
        </div>
        <hr>
        <!--    this is the div that will display the contents of the body of the post-->
        <div class="POSTBODY">
            <?php echo $postData[0]; ?>
        </div>

        <!--    this it the div that will display the contents of the footer of the post eg. the up-votes and down-votes-->
        <div class="POSTFOOTER">
            <?php if ($_SESSION["access_level"] == $modAccessLevel) {
                ?>
                            <form action="testPostDisplay.php?DisableID=<?=$postData['ID']?>"  method="post">
                                <button type="submit" >Disable</button>
                            </form>
            <?php }

            ?>
        </div>
    </div>
        <?php }?>

    </body>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET["DisableID"])) {
        $postID = $_GET["DisableID"];
        $sql = "UPDATE Posts SET Enabled = 0 WHERE ID ='$postID'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $_SESSION["flash_message"] = "Post Disabled";
        header("Location:index.php");
    }
}

?>