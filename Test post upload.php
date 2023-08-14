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
//    $ID = sanitise_data($_POST['ID']);
    $BodyText = sanitise_data($_POST['Description']);
//    $Author = sanitise_data($_POST['Author']);
    $Title = sanitise_data($_POST['Title']);
//    $DataTime = sanitise_data($_POST['DataTime']);
//    $DownVotes = sanitise_data($_POST['DownVotes']);
//    $UpVotes = sanitise_data($_POST['UpVotes']);
//    $Enabled = sanitise_data($_POST['Enabled']);
//    $location = sanitise_data($_POST['location']);
    //$username;
    //$hashed_password;

// check username in database
//    $query = $conn->query("SELECT COUNT(*) FROM Products WHERE ID='$ID'");
//    $data = $query->fetch();
//    $numberOfPosts = (int)$data[0];

//    if ($numberOfPosts > 0) {
//        echo "No Posts";
//    } else {
        $sql = "INSERT INTO Posts (ID, BodyText, Author, Title, DataTime, DownVotes, UpVotes, Enabled, location) VALUES (:ID, :BodyText, :Author, :Title, :DataTime, :DownVotes, :UpVotes, :Enabled, :location)";
        $stmt = $conn->prepare($sql);
//        $stmt->bindValue(':ID', $ID);
        $stmt->bindValue(':BodyText', $BodyText);
//        $stmt->bindValue(':Author', $Author);
        $stmt->bindValue(':Title', $Title);
//        $stmt->bindValue(':DataTime', $DataTime);
//        $stmt->bindValue(':DownVotes', $DownVotes);
//        $stmt->bindValue(':UpVotes', $UpVotes);
//        $stmt->bindValue(':Enabled', $Enabled);
//        $stmt->bindValue(':location', $location);
        $stmt->execute();
        $_SESSION["flash_message"] = "Post Create!!";
        header("Location:index.php");

//    }
}
?>