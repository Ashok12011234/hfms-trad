<?php
include("classes/probDomCls/request.php");
//include("AuthenticationService.php");

$_SESSION["request_option"]="sent";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/Hospital-page.css">
    <link rel="stylesheet" href="/assets/css/Request-Page.css">
    <title>Request Dashboard</title>


<script src="https://code.jquery.com/jquery-latest.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

    <script src="donate.js"></script>

    </head>
<body>
<?php
include("navbar.php");
?>
    <!-- Headings and title-->
    <div class="row justify-content-between mt-5 ms-2 me-2">
        <div class="col-md-8 ">
            <h2>Sent Requests</h2>
            <br>
        </div>
        <!--
        <div class="col-md-4">
            <div class="input-group" >
                <select <?php
                    if($type ==2){
                        echo 'disabled';  
                  }
                  ?>   class="form-select div-toggle" data-target=".my-info-1" aria-label="Default select example">
                    <option style="<?php
                    if($type ==2){
                        echo 'display:none;';  
                  }
                  ?>" data-show=".sent">Sent requests</option>
                    <option  selected  value="1" data-show=".received">Receive requests</option>
                </select>
            </div>
        </div>
        -->
    </div>
    <!-- Headings and title end-->
    <div class="container mt-5 mb-4" >
        <div class="row my-info-1">
    <!--sent request-->
    <?php
        if($type ==1){

    
            if ($result = AuthenticationService::apiCall()) {
                if (is_array($result)) { // Check if $result is an array
                    $rows = $result;
                    foreach ($rows as $row) {
                        $current = new HHRequest($row->RequestId); // Use -> operator to access properties
                        $current->assignAll();
                        //style="display: none;"
                        // if($_SESSION["request_option"]=="sent"){
                        $_SESSION["request_option"] = "sent";
                        include("requestcard.php");
                        // }
                    }
                } else {
                    // Handle case when $result is not an array
                    echo "An error occurred while fetching product details.";
                }
            } else {
                // Handle case when $result is false or null
                echo "An error occurred while fetching product details.";
            }

/*
            $sql2 = "SELECT * FROM HPrequest WHERE HospitalId=1";
               
             if($result = QueryExecutor::query($sql2)){
                $rows = $result->fetch_all(MYSQLI_ASSOC);
             
            foreach($rows as $row){
                $current = new HPRequest( $row['RequestId']);
                $current->assignAll();
              
                $_SESSION["request_option"]="sent";
                include("requestcard.php");
               
            }
                
            }
            
           
            //<!--received request-->

            $hospitalID = 1;
            $sql = "SELECT * FROM HHrequest WHERE ProviderId=$hospitalID";
               
             if($result = QueryExecutor::query($sql)){
                $rows = $result->fetch_all(MYSQLI_ASSOC);
             
            foreach($rows as $row){
                $current = new HHRequest( $row['RequestId']);
                $current->assignAll();
               //
                $_SESSION["request_option"]="received";
               //include("requestcard.php");
               

           }}
           */    
            
        }else if($type ==2){

            $providerID = 1;
            $sql2 = "SELECT * FROM HPrequest WHERE ProviderId=$providerID";
               
            if($result = QueryExecutor::query($sql2)){
               $rows = $result->fetch_all(MYSQLI_ASSOC);
            
           foreach($rows as $row){
               $current = new HPRequest( $row['RequestId']);
               $current->assignAll();
           
               $_SESSION["request_option"]="received";
               //include("requestcard.php");
              
           }
               
           }

        }
            
            
            
            ?>
</body>

<script type="text/javascript">
    function myhref(web) {
        window.location.href = web;
    }

    $(document).on('change', '.div-toggle', function() {
        var target = $(this).data('target');
        var show = $("option:selected", this).data('show');
        $(target).children().addClass('hide');
        $(show).removeClass('hide');
    });

    $(document).ready(function(){
        $('.div-toggle').trigger('change');
    });

</script>

</html>