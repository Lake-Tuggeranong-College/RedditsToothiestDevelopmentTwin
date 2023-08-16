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
//    $ID = $_SESSION['ID'];
    $BodyText = 'h';
    $Author = 'h';
    $Title = 'h';
    $DataTime = 'h';
    $DownVotes = 'h';
    $UpVotes = 'h';
    $Enabled = 'h';
    $location = 'h';
    //$username;
    //$hashed_password;

// check username in database
//    $query = $conn->query("SELECT COUNT(*) FROM Products WHERE ID='$ID'");
//    $data = $query->fetch();
//    $numberOfPosts = (int)$data[0];

//    if ($numberOfPosts > 0) {
//        echo "No Posts";
//    } else {
        $sql = "INSERT INTO Posts (BodyText, Author, Title, DataTime, DownVotes, UpVotes, Enabled, location) VALUES ( :BodyText, :Author, :Title, :DataTime, :DownVotes, :UpVotes, :Enabled, :location)";
        $stmt = $conn->prepare($sql);
//        $stmt->bindValue(':ID', $ID);
        $stmt->bindValue(':BodyText', $BodyText);
        $stmt->bindValue(':Author', $Author);
        $stmt->bindValue(':Title', $Title);
        $stmt->bindValue(':DataTime', $DataTime);
        $stmt->bindValue(':DownVotes', $DownVotes);
        $stmt->bindValue(':UpVotes', $UpVotes);
        $stmt->bindValue(':Enabled', $Enabled);
        $stmt->bindValue(':location', $location);
        $stmt->exec();
        $_SESSION["flash_message"] = "Post Create!!";
//        header("Location:index.php");

//    }
}
?>