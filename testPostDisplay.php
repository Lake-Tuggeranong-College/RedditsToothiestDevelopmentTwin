<?php include "template.php";
/**  @var $conn */
?>
    <title>Test Post</title>
    <link rel="stylesheet" href="css/style.css">
    <body>

    <!--Pulls the details from the Posts table-->
<?php
$modAccessLevel = 2;
$postDetails = $conn->query("SELECT BodyText, Title, Enabled, ID FROM Posts");
?>


<?php
while ($postData = $postDetails->fetch()) {

    if ($postData[2] == 1) {
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
                    <button type="submit" name="disablePost">Disable</button>
                    <?php
                    $newCondition = 0;
                } else {
                    echo "123";
                }
                ?>
            </div>
        </div>

        </body>

        <?php
    } else {

    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "UPDATE POST SET Enabled = :newCondition WHERE ID='$postData[3]'";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':newCondition', $newCondition);
    $stmt->execute();
    $_SESSION["flash_message"] = "Post Disabled";
    header("Location:index.php");
}
?>