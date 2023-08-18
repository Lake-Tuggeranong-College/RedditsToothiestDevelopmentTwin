<?php
include 'template.php';
/** @var $conn */
?>
<title>Post Creation</title>
<div>
    <div>
        <h1>Create a Post</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="Posts" class="form-label">Title</label>
                <input type="text" class="form-control" id="Title" name="Title" placeholder="Tell about the Post">
            </div>
            <div class="mb-3">
                <label for="Posts" class="form-label">Description</label>
                <textarea class="form-control" id="Description" name="Description" rows="3"></textarea>
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
    //$username;
    //$hashed_password;

// check username in database
    $query = $conn->query("SELECT COUNT(*) FROM Users WHERE Username='$userID'");
    $data = $query->fetch();
    $numberOfUsers = (int)$data[0];

//    if ($numberOfPosts > 0) {
//        echo "No Posts";
//    } else {
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
//        header("Location:index.php");

//    }
}
?>
