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
        <h1>Create a Post</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!--Unsure about functionality. Placeholder for community tagging dropdown-->
            <div class="mb-3">
                <label for="Posts" class="form-label">Title</label> <!--Other placeholder for flair tag dropdown-->
                <input type="text" class="form-control" id="Title" name="Title" placeholder="Tell about the Post" required="required">
            </div>
            <div class="mb-3">
                <label for="Posts" class="form-label">Description</label> <!--Other OTHER placeholder to have text settings-->
                <textarea class="form-control" id="Description" name="Description" rows="3" required="required"></textarea>
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
                    <li class="list-group-item">Rule 1: Don't be an asshole</li>
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
    //$username;
    //$hashed_password;
    if(strlen($BodyText) >= 1024) {
        echo 'You cant have the Description bigger then 1024 charaters';
    } else if(strlen($Title) >= 200) {
        echo 'You cant have the Title bigger then 200 charaters';
    } else {

    $sql = "INSERT INTO Posts (BodyText, UserID, Title, DateTime, DownVotes, UpVotes, Enabled, location) VALUES ( :BodyText, :UserID, :Title, :DateTime, 0, 0, true, :location)";
    $stmt = $conn->prepare($sql);
//        $stmt->bindValue(':ID', $ID);
    $stmt->bindValue(':BodyText', $BodyText);
    $stmt->bindValue(':UserID', $userID);
    $stmt->bindValue(':Title', $Title);
    $stmt->bindValue(':DateTime', $DateTime);
//    $stmt->bindValue(':DownVotes', $DownVotes);
//    $stmt->bindValue(':UpVotes', $UpVotes);
//    $stmt->bindValue(':Enabled', $Enabled);
    $stmt->bindValue(':location', $location);
    $stmt->execute();
    $_SESSION["flash_message"] = "Post Create!!";

    }
}
?>
