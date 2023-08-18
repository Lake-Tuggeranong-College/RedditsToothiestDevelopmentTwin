<title>Index</title>
<?php include "template.php";
/**  @var $conn */
?>
<body>
<!--https://getbootstrap.com/docs/5.0/layout/containers/
15%, 70%, 15% or 10%, 70%, 20%
So, 1.5, 9, 1.5 or 1, 9, 2-->
<div class="container-fluid">
    <div class="row">
        <div class="col-1 bg-light p-3 border">
            Communities n stuff
            <!-- Tested around with making columns inside these containers. Nothing I tried (admittedly not a lot) worked -->
        </div>
        <!-- Currently, these sit in the centre rather than touching the edges as I would have liked -->
        <div class="col-9 bg-light p-3 border">
            The feed
        </div>
        <div class="col-2 bg-light p-3 border">
            User stuff
        </div>
    </div>
</div>
</body>
