<?php
include 'template.php';
/** @var $conn */
if (!authorisedAccess(false, true, true)) {
    header("Location:index.php");
}
?>
<title>Post Creation</title>
<div>
    <div>
        <h1>Create a Post</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  enctype="multipart/form-data">
            <div class="mb-3">
                <label for="Posts" class="form-label">Title</label>
                <input type="text" class="form-control" id="Title" name="Title" placeholder="Tell about the Post"
                       required="required">
            </div>
            <div class="mb-3">
                <label for="Posts" class="form-label">Description</label>
                <textarea class="form-control" id="Description" name="Description" rows="3"
                          required="required"></textarea>
            </div>
            <div class="mb-3">
                <label for="postImage" class="form-label">Image</label>
                <input type="file" id="postImage" name="postImage" class="form-control">
            </div>
            <button type="submit" name="PostSubmit" class="btn btn-primary">Post</button>
        </form>
    </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_SESSION['user_id'];
    $BodyText = sanitise_data($_POST['Description']);
//    $Author = 'h';
    $Title = sanitise_data($_POST['Title']);
    date_default_timezone_set('Australia/Canberra');
    $DateTime = date('Y-m-d H:i:s');
//    $DownVotes = 'h';
//    $UpVotes = 'h';
//    $Enabled = 'h';
    $location = 'Working On';

    if(array_key_exists('Image', $_FILES) && array_key_exists('error', $_FILES['Image'])) {


    }

    // defining what type of file is allowed
    // We separate the file, and obtain the file extension.

    //$username;
    //$hashed_password;
    if (strlen($BodyText) >= 1024) {
        echo 'You cant have the Description bigger then 1024 charaters';
    } else if (strlen($Title) >= 200) {
        echo 'You cant have the Title bigger then 200 charaters';
    } else {
        $file = $_FILES['postImage'];
        $fileName = $_FILES['postImage']['name'];
        $fileTmpName = $_FILES['postImage']['tmp_name'];
        $fileSize = $_FILES['postImage']['size'];
        $fileError = $_FILES['postImage']['error'];
        $fileType = $_FILES['postImage']['type'];

        $fileExtension = explode('.', $fileName);
        $fileActualExtension = strtolower(end($fileExtension));

        $allowedExtensions = array('jpg', 'jpeg', 'png', 'pdf');

        if (in_array($fileActualExtension, $allowedExtensions)) {
            if ($fileError === 0) {
                // File is smaller than arbitrary size
                if ($fileSize < 10000000000) {
                    //file name is now a unique ID based on time with IMG- preceeding it, followed by the file type.
                    $fileNameNew = uniqid('IMG-', True) . "." . $fileActualExtension;
                    //upload location
                    $fileDestination = 'images/PostImages/' . $fileNameNew;
                    // Upload file
                    move_uploaded_file($fileTmpName, $fileDestination);

                    $sql = "INSERT INTO Posts (BodyText, UserID, Title, DateTime, DownVotes, UpVotes, Enabled, location, Image) VALUES ( :BodyText, :UserID, :Title, :DateTime, 0, 0, true, :location, :Image)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':BodyText', $BodyText);
                    $stmt->bindValue(':UserID', $userID);
                    $stmt->bindValue(':Title', $Title);
                    $stmt->bindValue(':DateTime', $DateTime);
                    $stmt->bindValue(':Image', $fileNameNew);
                    $stmt->bindValue(':location', $location);
                    $stmt->execute();
                    $_SESSION["flash_message"] = "Post Create!!";
                }
            }
        }
    }

}
?>
