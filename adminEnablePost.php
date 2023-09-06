<title>Index</title>
<?php include "template.php";
/**  @var $conn */
?>
<link rel="stylesheet" href="css/style.css">
<body>
<!--https://getbootstrap.com/docs/5.0/layout/containers/
15%, 70%, 15% or 10%, 70%, 20%
So, 1.5, 9, 1.5 or 1, 9, 2-->
<div class="container-fluid">
    <div class="row">
        <div class="col-1">
            <div class="col bg-light p-1 border">
                <p><u><b><center>Trending Communities</center></b></u></p>
                <ul>
                    <li>Community</li>
                    <li>Community</li>
                    <li>Community</li>
                    <li>Community</li>
                    <li>Community</li>
                    <li>Community</li>
                    <li>Community</li>
                    <li>Community</li>
                </ul>
                <!-- Tested around with making columns inside these containers. Nothing I tried (admittedly not a lot) worked -->
            </div>
            <div class="col bg-light p-1 border">
                <p><u><b><center>Hot Topics</center></b></u></p>
                <ul>
                    <li>Topic</li>
                    <li>Topic</li>
                    <li>Topic</li>
                    <li>Topic</li>
                    <li>Topic</li>
                    <li>Topic</li>
                    <li>Topic</li>
                    <li>Topic</li>
                </ul>
            </div>
        </div>
        <div class="col-9 bg-light p-3 border">
            <!--Pulls the details from the Posts table-->
            <?php

            //    defining number of posts per page
            $postsPerPage = 10;

            if (!isset ($_GET['page'])) {
                $page = 1;
                $postNumStart = 0;
            } else {
                $page = $_GET['page'];
                $pageNum = $page - 1;
                $postNumStart = $pageNum * $postsPerPage;
            }


            $modAccessLevel = 2;
            $postDetails = $conn->query("SELECT BodyText, Title, Enabled, ID  FROM Posts WHERE Enabled = 0 ORDER BY ID DESC LIMIT $postNumStart, $postsPerPage");

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
                        <?php if ($_SESSION["access_level"] >= $modAccessLevel) {
                            ?>
                            <form action="adminEnablePost.php?EnableID=<?=$postData['ID']?>"  method="post">
                                <button type="submit" class="btn btn-outline-success">Enable</button>
                            </form>
                        <?php }

                        ?>
                    </div>
                </div>
            <?php }?>

</body>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET["EnableID"])) {
        $postID = $_GET["EnableID"];
        $sql = "UPDATE Posts SET Enabled = 1 WHERE ID ='$postID'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $_SESSION["flash_message"] = "Post Disabled";
        header("Location:index.php");
    }
}

?>


<!--          start of pagination-->
<?php
            if ($page >= 2) {
                ?>
                <form action="adminEnablePost.php?page=<?= $page - 1 ?>" method="post">
                    <button type="submit" class="btn btn-outline-danger">Previous Page</button>
                </form>
            <?php }
            $info = $conn->query("SELECT COUNT(*) FROM Posts WHERE Enabled = 0");
            $data = $info->fetch();
            $numberOfPosts = (int)$data[0];
            $PostDisplayed = $page * $postsPerPage;
            if ($numberOfPosts > $PostDisplayed){
                ?>
                <form action="adminEnablePost.php?page=<?= $page + 1 ?>" method="post">
                    <button type="submit" class="btn btn-outline-success">Next Page</button>
                </form>
            <?php } ?>


            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_GET["DisableID"])) {
                    $postID = $_GET["DisableID"];
                    $sql = "UPDATE Posts SET Enabled = 0 WHERE ID ='$postID'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $_SESSION["flash_message"] = "Post Disabled";
                    header("Location:adminEnablePost.php");
                }
            }

            ?>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_GET["DisableID"])) {
                    $postID = $_GET["DisableID"];
                    $sql = "UPDATE Posts SET Enabled = 0 WHERE ID ='$postID'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $_SESSION["flash_message"] = "Post Disabled";
                    header("Location:adminEnablePost.php");
                }
            }

            ?>


        </div>
        <div class="col">
            <div class="col bg-light p-2 border">
                <p><u><b><center>Following</center></b></u></p>
                <ul>
                    <li>User - Online Status</li>
                    <li>User - Online Status</li>
                    <li>User - Online Status</li>
                    <li>User - Online Status</li>
                    <li>User - Online Status</li>
                    <li>User - Online Status</li>
                    <li>User - Online Status</li>
                    <li>User - Online Status</li>
                </ul>
                <!-- Tested around with making columns inside these containers. Nothing I tried (admittedly not a lot) worked -->
            </div>
            <div class="col bg-light p-3 border">
                <p><u><b><center>Private Messaging</center></b></u></p>
                <p>This is where the private messaging code would go, if we had any.</p>
            </div>
        </div>
    </div>
</div>
</body>
