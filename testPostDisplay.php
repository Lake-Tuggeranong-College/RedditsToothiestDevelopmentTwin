<title>Test Post</title>
<?php include "template.php";
/**  @var $conn */
?>
<!--Pulls the details frome the Posts table-->
<?php
$postDetails = $conn->query( "SELECT BodyText, Title FROM Posts");
?>

<!--this will be the border of the hole post-->
<div>

<?php
while ($postData = $postDetails->fetchArray()){
?>


<!--    this is the div that will display the title and other things displayed in the heaad note-->
    <div>
<?php echo '<h1>' . $postData[1] . '</h1>'; ?>
    </div>
<!--    this is the div that will display the contents of the body of the post-->
    <div>
<?php echo $postData[0]; ?>
    </div>
<!--    this it the div that will display the contents of the fotter of the post eg. the up-votes and down-votes-->
    <div>

    </div>
    <?php
}
    ?>
</div>
