<?php include "template.php";
/** @var $conn */
?>
    <!--Contact.php-->
    <!--This script asks for the users email and asks them to write a message which will be saved sanitised and sent to the database.-->
    <!--It also checks if the user hasn't inputted anything-->
    <body>
<title>Contact Us</title>
<div class="container-fluid">
    <h1 style="color: #000000;">Contact Us</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="mb-3">
            <label for="contactUsername" class="form-label">Username</label>
            <input type="text" class="form-control" id="contactUsername" name="contactUsername"
                   readonly value="<?php echo $_SESSION["username"] ?>">
        </div>
        <div class="mb-3">
            <label for="contactMessage" class="form-label">Message</label>
            <textarea class="form-control" id="contactMessage" name="contactMessage" rows="4"></textarea>
        </div>
        <button type="submit" name="formSubmit" class="btn btn-primary">Send</button>
    </form>
</div>

<?php
if (isset($_POST['formSubmit'])){
    $contactUsername = $_SESSION["username"];
    $contactMessage = sanitise_data($_POST['contactMessage']);

    $formError = false;
    if (empty($_POST['contactUsername'])) {
        $formError = true;
        echo "Enter an email address.\n";
    }
    if (empty($_POST['contactMessage'])) {
        $formError = true;
        echo "\nEnter a message to submit.";
    }
    if ($formError == false) {
        $emailAddress = $_POST['contactUsername'];
        $messageSubmitted = $_POST['contactMessage'];
        $query = "INSERT INTO contact (username, message) VALUES (:contactUsername, :contactMessage)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':contactUsername', $contactUsername);
        $stmt->bindParam(':contactMessage', $contactMessage);
        $stmt->execute();
        $conn = null;
    }
}
?>