<html>
<title>Reset Password UI</title>
<h1>Reset Password for Admin</h1>
<input placeholder="Current Password">Test</input>
</html>
<?php include "template.php";
$AccessLevel = $_SESSION["access_level"];
$User_ID = $_SESSION["user_id"];
echo "Access Level: $AccessLevel";
echo"User ID: $User_ID";

if(empty($User_ID)) {
    header("location:index.php");

    if ($AccessLevel = "4") ;
    echo "Admin Detected!";
    } else {
    header("location:index.php");
}



?>
