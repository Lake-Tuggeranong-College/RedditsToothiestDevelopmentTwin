<?php
include 'template.php';
/** @var $conn */
if (!authorisedAccess(false, true, true)) {
    header("Location:index.php");
}
?>
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
<title>Post Creation</title>
<div>
    <div>
        <h1 class="text-primary">Create a Post</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
              enctype="multipart/form-data">
            <!--Unsure about functionality. Placeholder for community tagging dropdown-->
            <div class="mb-3">
                <label for="Posts" class="form-label">Title</label>
<!--                <label for="Posts" class="form-label">Flairs</label> Other placeholder for flair tag dropdown-->
                <input type="text" class="form-control" id="Title" name="Title" placeholder="Tell about the Post"
                       required="required">
            </div>
            <div class="mb-3">
                <label for="Posts" class="form-label">Description</label>
<!--                <label for="Posts" class="form-label">Text Settings</label> <Other OTHER placeholder to have text settings-->
                <textarea class="form-control" id="Description" name="Description" rows="3"
                          required="required"></textarea>
            </div>
            <div class="mb-3">
                <label for="postImage" class="form-label">Image</label>
                <input type="file" id="postImage" name="postImage" class="form-control">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Get Notifications
                </label>
            </div>
            <button type="button" name="PostDraftSave" class="btn btn-primary">Save Draft</button> <!--Save Draft button has no functionality-->
            <button type="submit" name="PostSubmit" class="btn btn-primary">Post</button>
        </form>
    </div>
</div>
        </div>
        <div class="col">
            <div class="col bg-light p-3 border">
                <p><u><b><center>Posting Terms of Service</center></b></u></p>
                <p><ul class="list-group">
                    <li class="list-group-item">Rule 1: Don't be a [insult]</li>
                    <li class="list-group-item">Rule 2: Source your stuff </li>
                    <li class="list-group-item">Rule 3: Read the community rules too</li>
                    <li class="list-group-item">Rule 4: Show your grandma your posts</li>
                </ul></p>
            </div>
            <div class="col bg-light p-3 border">
                <p><u><b><center>Community Terms of Service</center></b></u></p>
                <p><ul class="list-group">
                    <li class="list-group-item">Rule 1: This is where</li>
                    <li class="list-group-item">Rule 2: The community's personal rules </li>
                    <li class="list-group-item">Rule 3: Will go, so it'll probably be fancy code</li>
                    <li class="list-group-item">Rule 4: Your meme isn't funny</li>
                </ul></p>
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
    $NoImage = null;
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
        if ($_FILES['postImage']['size'] == 0) {
            $sql = "INSERT INTO Posts (BodyText, UserID, Title, DateTime, DownVotes, UpVotes, Enabled, location) VALUES ( :BodyText, :UserID, :Title, :DateTime, 0, 0, true, :location)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':BodyText', $BodyText);
            $stmt->bindValue(':UserID', $userID);
            $stmt->bindValue(':Title', $Title);
            $stmt->bindValue(':DateTime', $DateTime);
            $stmt->bindValue(':location', $location);
            $stmt->execute();
            $_SESSION["flash_message"] = "Post Create!!";
        } else {

            $fileName = $_FILES['postImage']['name'];
            $fileTmpName = $_FILES['postImage']['tmp_name'];
            $fileSize = $_FILES['postImage']['size'];
            $fileError = $_FILES['postImage']['error'];
            $fileType = $_FILES['postImage']['type'];

            $fileExtension = explode('.', $fileName);
            $fileActualExtension = strtolower(end($fileExtension));

            $allowedExtensions = array('jpg', 'jpeg', 'png', 'webp', 'avif', 'heic', 'jfif');

            if (in_array($fileActualExtension, $allowedExtensions)) {
                if ($fileError === 0) {
                    // File is smaller than arbitrary size
                    if ($fileSize < 10000000000) {
                        //file name is now a unique ID based on time with IMG- proceeding it, followed by the file type.
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
                    } else {
                        echo "Your image is too big!";
                    }
                } else {
                    echo "there was an error uploading your image!";
                }
            } else {
                echo "You cannot upload files of this type!";
            }
        }
    }
}
?>
