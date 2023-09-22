<title>Index</title>
<?php include "template.php";
/**  @var $conn */

if (!authorisedAccess(true, true, true)) {
    header("Location:index.php");
}

if (isset ($_GET['community'])) {
    $community = $_GET['community'];
} else {
   $community = 1;
}
?>
<body>
<?=$community;?>

</body>
</html>