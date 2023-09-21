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
                <p><u><b>
                            <center>Trending Communities</center>
                        </b></u></p>
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
                <p><u><b>
                            <center>Hot Topics</center>
                        </b></u></p>
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
            <title>Community Creation</title>
            <div>
                <div>
                    <h1 class="text-primary">Create a Community</h1>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                          enctype="multipart/form-data">
                        <!--Unsure about functionality. Placeholder for community tagging dropdown-->
                        <div class="mb-3">
                            <label for="Communities" class="form-label">Title</label>
                            <!--                <label for="Posts" class="form-label">Flairs</label> Other placeholder for flair tag dropdown-->
                            <input type="text" class="form-control" id="title" name="title"
                                   placeholder="Tell about the Community"
                                   required="required">
                        </div>
                        <div class="mb-3">
                            <label for="Communities" class="form-label">Description</label>
                            <!--                <label for="Posts" class="form-label">Text Settings</label> <Other OTHER placeholder to have text settings-->
                            <textarea class="form-control" id="description" name="description" rows="3"
                                      required="required"></textarea>
                        </div>
                        <button type="submit" name="CommunitiesSubmit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="col bg-light p-3 border">
                <p><u><b>
                            <center>Community Creation Terms of Service</center>
                        </b></u></p>
                <p>
                <ul class="list-group">
                    <li class="list-group-item">Rule 1: Don't be a [insult]</li>
                    <li class="list-group-item">Rule 2: Source your stuff</li>
                    <li class="list-group-item">Rule 3: Please don't make hate spots</li>
                    <li class="list-group-item">Rule 4: Show your grandma your community</li>
                </ul>
                </p>
            </div>
            <div class="col bg-light p-3 border">
                <p><u><b>
                            <center>Community Terms of Service</center>
                        </b></u></p>
                <p>
                <ul class="list-group">
                    <li class="list-group-item">Rule 1: This is where</li>
                    <li class="list-group-item">Rule 2: The community's personal rules</li>
                    <li class="list-group-item">Rule 3: Will go, so it'll probably be fancy code</li>
                    <li class="list-group-item">Rule 4: Your meme isn't funny</li>
                </ul>
                </p>
            </div>
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userID = $_SESSION['user_id'];
            $description = sanitise_data($_POST['description']);
            $title = sanitise_data($_POST['title']);

            if (strlen($description) >= 1024) {
                echo 'You cant have the Description bigger then 1024 charaters';
            } else if (strlen($title) >= 100) {
                echo 'You cant have the Title bigger then 100 charaters';
            } else {
                $sql = "INSERT INTO Communities (title, description, owner) VALUES ( :title, :description, :owner)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':title', $title);
                $stmt->bindValue(':owner', $userID);
                $stmt->bindValue(':description', $description);
                $stmt->execute();
                $_SESSION["flash_message"] = "Community Create!!";
            }
        }
        ?>
