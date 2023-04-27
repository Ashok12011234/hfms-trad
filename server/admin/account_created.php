<?php include 'header.php';?>
<!--Content-->


<div class="container text-center">
    <p class="display-4">New Account has been Validated Successfully</p>
    <p class="lead">You will be redirected to Check New Request Page very shortly</p>
    <br>
    <img   class=" img-thumbnail"   src="../assets/documents/PageDocuments/admin/new_acc.gif" alt="">
    <br>
    <br>
</div>
<?php include 'footer.php'?>
<script>
    $('title').text("New Account Vertified");
    $('#title1').hide();
    $("#search1").hide();
    setTimeout(function(){
             window.location = "check_new.php";
            }, 4000);
            //<a href="check_new.php"><p class="lead">Click Here </a> to check other new requests</p>
</script>
