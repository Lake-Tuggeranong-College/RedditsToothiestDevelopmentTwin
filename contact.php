<?php include "template.php";
/** @var $conn */
$username = $_SESSION["username"];
if(empty($username)){
    $username = "UserNotLoggedIn";
}
?>
    <!--Contact.php-->
    <!--This script asks them to write a message which will be saved sanitised and sent to the database.-->
    <!--It also checks if the user hasn't inputted anything-->
    <body>
<title>Contact Us</title>
<div class="container bg-light border">
    <h3><center>Need help?</center></h3>
    <h1 style="color: #000000;" class="text-primary"><center>Contact Us!</center></h1>
    <p><center>We are here to help, and create the best possible user experience.</center></p>
    <p><center>We eagerly await hearing your feedback!</center></p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="mb-3">
            <label for="contactUsername" class="form-label">Username</label>
            <input type="text" class="form-control" id="contactUsername" name="contactUsername"
                   readonly value="<?php echo $username ?>">
        </div>
<!--        <div class="mb-3">-->
<!--            <label for="contactEmail" class="form-label">Email Address</label>-->
<!--            <input type="text" class="form-control" id="contactEmail" name="contactEmail"-->
<!--                   readonly value="--><?php //echo $_SESSION["email"] ?><!--">-->
<!--        </div> Placeholder code for a possible "Email" field-->
        <div class="mb-3">
            <label for="contactMessage" class="form-label">Message</label>
            <textarea class="form-control" id="contactMessage" name="contactMessage" rows="4"></textarea>
            <br>
            <label for="subject">Message Subject: </label>
            <select name="subject" id="subject">
                <optgroup label="Select Option">
                    <option value="1">General Question</option>
                    <option value="2">Disabled Account</option>
                    <option value="3">Forgot Password</option>
                    <option value="4">Site Bugs / Issues</option>
                    <option value="5">Other</option>
                </optgroup>
            </select>
        </div>
        <button type="submit" name="formSubmit" class="btn btn-primary">Send</button>
    </form>
</div>
<?php
if (isset($_POST['formSubmit'])){
    $contactMessage = sanitise_data($_POST['contactMessage']);
    $subject = sanitise_data($_POST['subject']);

    $formError = false;
    if (empty($_POST['contactUsername'])) {
        $formError = true;
        echo "User not logged in.\n";
    }
    if (empty($_POST['contactMessage'])) {
        $formError = true;
        echo "\nEnter a message to submit.";
    }
    if ($formError == false) {
        $emailAddress = $_POST['contactUsername'];
        $messageSubmitted = $_POST['contactMessage'];
        $subject = $_POST['subject'];
        if($subject>5) {
            $subject = 5;
        }
        $query = "INSERT INTO contact (username, message, subject) VALUES (:contactUsername, :contactMessage, :subject)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':contactUsername', $username);
        $stmt->bindParam(':contactMessage', $contactMessage);
        $stmt->bindParam(':subject', $subject);
        $stmt->execute();
        $conn = null;
    }
}
?>