<?php include "template.php";
/**  @var $conn */
?>
    <title>Test Post</title>
    <link rel="stylesheet" href="css/style.css">
    <body>

    <!--Pulls the details from the Posts table-->
    <?php
//    defining number of posts per page
    $postsPerPage = 10;

    if (!isset ($_GET['page']) ) {
        $page = 1;
        $postNumStart = 0;
    } else {
        $page = $_GET['page'];
        $pageNum = $page - 1;
        $postNumStart = $pageNum * $postsPerPage;
    }

//    echo $page;
//    echo $pageNum;
//    echo $postsPerPage;
//    echo $postNumStart;
    $modAccessLevel = 2;
    $postDetails = $conn->query("SELECT BodyText, Title, Enabled, ID FROM Posts WHERE Enabled = 1 ORDER BY ID DESC LIMIT $postNumStart, $postsPerPage ");

    ?>


    <?php
    while ($postData = $postDetails->fetch()) {
//    print_r($postData);

    ?>

    <!--this will be the border of the hole post-->
    <div class="POST">

        <!--    this is the div that will display the title and other things displayed in the headnote-->
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
                                <button type="submit" class="btn btn-outline-danger">Disable</button>
                            </form>
            <?php }

            ?>
        </div>
    </div>
        <?php }?>
    <form action="testPostDisplay.php?page=<?=$page - 1?>"  method="post">
        <button type="submit" class="btn btn-outline-danger">Previous  Page</button>
    </form>
    <form action="testPostDisplay.php?page=<?=$page + 1?>"  method="post">
        <button type="submit" class="btn btn-outline-success">Next Page</button>
    </form>

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