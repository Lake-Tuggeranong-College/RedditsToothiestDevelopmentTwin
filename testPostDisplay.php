<?php include "template.php";
/**  @var $conn */
?>
    <title>Test Post</title>
<link rel="stylesheet" href="style.css">
<body>

<!--Pulls the details from the Posts table-->
<?php
$postDetails = $conn->query( "SELECT BodyText, Title FROM Posts");
?>


<?php
while ($postData = $postDetails->fetch()){
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
<!--    this it the div that will display the contents of the fotter of the post eg. the up-votes and down-votes-->
    <div>

    </div>
</div>

    </body>

<?php
}
?>