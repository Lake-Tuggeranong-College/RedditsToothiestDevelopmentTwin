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
        <div class="col">
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
        <!-- If someone could find a way to have separation between the columns, that would be great -->
        <!-- Currently, these sit in the centre rather than touching the edges as I would have liked -->
        <div class="col-9 bg-light p-3 border">
            <!--Pulls the details from the Posts table-->
<?php
$postDetails = $conn->query( "SELECT BodyText, Title, Enabled FROM Posts ORDER BY ID DESC;");
?>



<?php
while ($postData = $postDetails->fetch()){

    if($postData[2]== 1){
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
