<?php include 'header.php';?>
<!--Content-->


<div class="container text-center">
    <p class="display-4">Mail has been sent Successfully</p>
    <p class="lead">You will be redirected to Check New Request Page very shortly</p>
    <img   class=" img-thumbnail"   src="../assets/documents/PageDocuments/admin/mail_sent.gif" alt="">
</div>
<?php include 'footer.php'?>
<script>
    $('title').text("Successfully Sent the mail");
    $('#title1').hide();
    $("#search1").hide();
    setTimeout(function(){
             window.location = "check_new.php";
            }, 4000);
            //<a href="check_new.php"><p class="lead">Click Here </a> to check other new requests</p>
</script>
