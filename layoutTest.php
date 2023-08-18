<!--This file is for UI testing purposes only.
If you are not testing around the UI, you can safely ignore this file.
If it is causing issues within the site, please let me know or delete it from your repository.-->
<?php require_once 'config.php'; ?>
    <html>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
<body>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images/R2D2Globe.png" alt="" width="100" height="100">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>

                <?php
                $accessLevel = 2;
                if (isset($_SESSION["username"])) {
                    echo '
                    <li class="nav-item"><a class="nav-link" href="fakelink.php">Make Post</a></li>
                    ';
                    if ($_SESSION["access_level"] == $accessLevel) {

                        ?>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Administrator Functions
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="userSearch.php">User Search</a>
                        <?php
                    }
                    ?>
                    </ul>
                    </li>

                    <?php
                } else {
                    echo '
                    <li class="nav-item"><a class="nav-link" href="userRegister.php">Register</a></li>
                    ';
                    echo '
                    <li class="nav-item"><a class="nav-link" href="userLogin.php">Login</a></li>
                    ';


                }
                ?>

            </ul>
        </div>
        <?php
        if (isset($_SESSION["username"])) {
            echo "<div class='alert alert-success d-flex'><span>Welcome, " . $_SESSION["username"] . "<br><a href='userLogout.php'>Logout</a></span></div>";
        }
        ?>
    </div>
</nav>
</body>
<!--https://getbootstrap.com/docs/5.0/layout/containers/
15%, 70%, 15% or 10%, 70%, 20%
So, 1.5, 9, 1.5 or 1, 9, 2-->
<div class="container-fluid">
    <div class="row">
        <div class="col-1 bg-light p-3 border">Community Feed</div>
        <div class="col-9 bg-light p-3 border">Post Feed</div>
        <div class="col-2 bg-light p-3 border">User Controls</div>
    </div>
    <div class="row">
        <div class="col-1 bg-light p-3 border">Hot Topics</div>
        <div class="col-9 bg-light p-3 border">Posts</div>
        <div class="col-2 bg-light p-3 border">Followers</div>
    </div>
</div>

<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="col-1 bg-light p-3 border">-->
<!--            Communities n stuff-->
<!--            <!-- Tested around with making columns inside these containers. Nothing I tried (admittedly not a lot) worked -->-->
<!--        </div>-->
<!--        <!-- Currently, these sit in the centre rather than touching the edges as I would have liked -->-->
<!--        <div class="col-9 bg-light p-3 border">-->
<!--            The feed-->
<!--        </div>-->
<!--        <div class="col-2 bg-light p-3 border">-->
<!--            User stuff-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--<div class="container">-->
<!--    <div class="row row-cols-3">-->
<!--        <div class="col-1 bg-light p-3 border">Communities</div>-->
<!--        <div class="col-9 bg-light p-3 border">Feed</div>-->
<!--        <div class="col-2 bg-light p-3 border">User Management</div>-->
<!--        <div class="col-2 bg-light p-3 border">Hot Topics</div>-->
<!--    </div>-->
<!--</div>-->

<!--<div class="container-fluid">-->
<!--    <div class="row">-->
<!--        <div class="column">-->
<!--            <div class="col-2 bg-light p-3 border"><a href="communities.php"> Communities</a></div>-->
<!--            <div class="col-2 bg-light p-3 border">Hot Topics</div>-->
<!--        </div>-->
<!---->
<!--        <div class="container">-->
<!--            <div class="col-md-9 offset-md-1 bg-light p-3 border">Feed</div>-->
<!--        </div>-->
<!---->
<!--        <div class="column">-->
<!--            <div class="col-2 bg-light p-3 border"><a href="communities.php"> Users</a></div>-->
<!--            <div class="col-2 bg-light p-3 border">Following</div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--</div>-->

<!--<div class="align-top">-->
<!--    <div class="row row-cols-3">-->
<!--        <div class="col-1 bg-light p-3 border">Communities</div>-->
<!--        <div class="col-9 bg-light p-3 border">Feed</div>-->
<!--        <div class="col-2 bg-light p-3 border">User Management</div>-->
<!--        <div class="col-2 bg-light p-3 border">Hot Topics</div>-->
<!--    </div>-->
<!--</div>-->

<!--Stole the below code from Reddit to figure it out-->
<!--<div class="left-sidebar relative isolate hidden m:block m:col-span-3 l:col-span-3 xl:col-span-3 border-0 border-solid s:border-r-sm border-r-neutral-border-weak isolate"><shreddit-async-loader bundlename="hamburger_menu"><reddit-sidebar-nav class="-->
<!--      block w-full sticky top-[56px] h-screen-without-header-->
<!--      styled-scrollbars overflow-y-scroll overflow-x-hidden-->
<!--    ">-->
<!--            <nav class="bg-neutral-background w-[274px] z-[2] box-border flex flex-col mt-0 mb-0-->
<!--      pt-xs s:pt-lg-->
<!--      pb-[100px] s:pb-0-->
<!--      shrink-0 s:shrink-->
<!--      ">-->
<!--                <div>-->
<!--                    <faceplate-tracker source="nav" action="click" noun="home" class="visible">-->
<!--                        <a rpl="" id="home-posts" href="/?feed=home" class="-->
<!--      grid grid-cols-left-nav text-14 font-normal h-[3rem] flex items-center a-->
<!---->
<!---->
<!---->
<!--      no-underline hover:no-underline-->
<!--      "><svg rpl="" class="text-neutral-content-weak text-20 ml-[0.375rem] col-start-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" height="20" width="20" icon-name="home-outline" fill="currentColor">-->
<!--                                <path d="m17.71 8.549 1.244.832v8.523a1.05 1.05 0 0 1-1.052 1.046H12.73a.707.707 0 0 1-.708-.707v-4.507c0-.76-1.142-1.474-2.026-1.474-.884 0-2.026.714-2.026 1.474v4.507a.71.71 0 0 1-.703.707H2.098a1.046 1.046 0 0 1-1.052-1.043V9.381l1.244-.835v9.158h4.44v-3.968c0-1.533 1.758-2.72 3.27-2.72s3.27 1.187 3.27 2.72v3.968h4.44V8.549Zm2.04-1.784L10.646.655a1.12 1.12 0 0 0-1.28-.008L.25 6.765l.696 1.036L10 1.721l9.054 6.08.696-1.036Z"></path>-->
<!--                            </svg>-->
<!--                            <span class="col-span-2 mr-md line-clamp-1 text-neutral-content-weak">Home</span></a>-->
<!--                        <!----></faceplate-tracker>-->
<!--</div>-->


<?php
if (isset($_SESSION['flash_message'])) {
    $message = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
//    echo $message;
    ?>
    <div class="position-absolute bottom-0 end-0">
        <?= $message ?>

    </div>


    <?php
}
?>
<script src="js/bootstrap.bundle.js"></script>
<?php
function sanitise_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function authorisedAccess($unauthorisedUsers, $users, $admin)
{
    // Unauthenticated User
    if (!isset($_SESSION["username"])) { // user not logged in
        if ($unauthorisedUsers == false) {
            $_SESSION['flash_message'] = "<div class='bg-danger'>Access Denied</div>";
            return false;
        }
    } else {

        // Regular User
        if ($_SESSION["access_level"] == 1) {
            if ($users == false) {
                $_SESSION['flash_message'] = "<div class='bg-danger'>Access Denied</div>";
                return false;
            }
        }

        // Administrators
        if ($_SESSION["access_level"] == 2) {
            if ($admin == false) {
                return false;
            }
        }
    }

    // otherwise, let them through
    return true;
}