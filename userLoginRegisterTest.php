<?php include "template.php";
/** @var $conn */

if (!authorisedAccess(true, false, false)) {
    header("Location:index.php");
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <title>R2D2 - Login/Register</title>

            <h1 class='text-primary'>Login</h1>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="row">
                        <!--Customer Details-->

                        <div class="col-md-12">
                            <p>User Name
                            <p><label><input type="text" name="username" class="form-control" required="required"></p>
                                </label></p>
                            <p>Password
                                    <p><label><input type="password" name="password" class="form-control" required="required"></p>
                                </label></p>

                        </div>
                    </div>
                </div>
                <input type="submit" name="formSubmit" value="Submit">
            </form>


            <?php
            //if (isset($_POST['login'])) {


            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = sanitise_data($_POST['username']);
                $password = sanitise_data($_POST['password']);

                $query = $conn->query("SELECT COUNT(*) as count FROM Users WHERE Username ='$username'");
                $row = $query->fetch();
                $count = $row[0];

                if ($count > 0) {
                    $query = $conn->query("SELECT * FROM Users WHERE Username='$username'");
                    $row = $query->fetch();
                    if ($row[4] == 1) {
                        if (password_verify($password, $row[2])) {
                            // successful log on.
                            $_SESSION["user_id"] = $row[0];
                            $_SESSION["username"] = $row[1];
                            $_SESSION['access_level'] = $row[3];
                            $_SESSION["flash_message"] = "php <div class='bg-success'>Login Successful</div>";

                            header("Location:index.php");
                        } else {
                            // unsuccessful log on.
                            echo "<div class='alert alert-danger'>Invalid Username or Password. <a href='contact.php'>Contact Us</a></div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Account Disabled. <a href='contact.php'>Contact Us</a></div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Invalid Username or Password. <a href='contact.php'>Contact Us</a></div>";
                }
            }

            ?>
        </div>
        <div class="col">
<!--            A known error is that this register section doesn't work. It treats it as a Login attempt-->
            <h1 class='text-primary'>Register</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="row">
                        <!--Customer Details-->

                        <div class="col-md-12">
                            <h2>Account Details</h2>
                            <p>Please enter wanted username and password:</p>
                            <p>User Name
                            <p><label><input type="text" name="username" class="form-control" required="required"></p>
                            </label></p>
                            <p>Password
                            <p><label><input type="password" name="password" class="form-control" required="required"></p>
                            </label></p>
                        </div>
                    </div>
                </div>
                <input type="submit" name="formSubmit" value="Submit">
            </form>

            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = sanitise_data($_POST['username']);
                $password = sanitise_data($_POST['password']);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $accessLevel = 1;
                //$username;
                //$hashed_password;

            // check username in database
                $query = $conn->query("SELECT COUNT(*) FROM Users WHERE Username='$username'");
                $data = $query->fetch();
                $numberOfUsers = (int)$data[0];

                if ($numberOfUsers > 0) {
                    echo "This username has already been taken.";
                } else {
                    $sql = "INSERT INTO Users (Username, HashedPassword, AccessLevel, Enabled) VALUES (:newUsername, :newPassword, :newAccessLevel, 1)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':newUsername', $username);
                    $stmt->bindValue(':newPassword', $hashed_password);
                    $stmt->bindValue(':newAccessLevel', $accessLevel);
                    $stmt->execute();
                    $_SESSION["flash_message"] = "Account Created!";
                    header("Location:index.php");

                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
