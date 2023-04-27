<?php
include("navbar.php");
include("classes/probDomCls/request.php");

if (array_key_exists("id", $_GET) && array_key_exists("type", $_GET)) {
    if ($_GET["type"] == RequestType::HH_REQUEST) {
        $request = new HHRequest(QueryExecutor::real_escape_string($_GET["id"]));
    } else {
        $request = new HPRequest(QueryExecutor::real_escape_string($_GET["id"]));
    }
    
    $request->assignAll();

    if (array_key_exists("send", $_POST) && array_key_exists("msg", $_POST)) {
        $request->sendMsg($user, QueryExecutor::real_escape_string($_POST["msg"]));
        
    }
    $request->buildChat();
    $chat = $request->getChat();
}
else {

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/css/Hospital-page.css">
    <link rel="stylesheet" href="./assets/css/Request-Page.css">
    
    <title>Request</title>
</head>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="donate.js"></script>


<script>
$(function () {
    $('.our1').on('click', function (){
        
        var Status = $(this).val();
        if(Status=="Accept"){
            $.ajax({
            url: 'process_state.php',
            type: "POST",
            data: {
                id : $('#showid').val(),
                type : $('#showtype').val(),
                count: $('#count1').val(),
                Status: Status
                
            },
            success: function (response) {
                    $("#mod11").modal('show');
                    

            }
        });

        }
        else{
            $.ajax({
            url: 'process_state.php',
            type: "POST",
            data: {
                id : $('#showid').val(),
                type : $('#showtype').val(),
                Status: Status
                
            },
            success: function (response) {
                if(Status=="Decline"){
                    $("#mod11").modal('show');
                }
                else{
                    location.reload();
                }
                
            }
        });
        }
       
    });
});

</script>

<body>
    <!-- Headings and title-->
    <div class="row justify-content-between mt-5 ms-2 me-2">
        <div class="col-md-8 ">
            <h2>Request</h2>
            <br>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <select class="form-select" aria-label="Default select example" disabled>
                    <option 
                    <?php 
                        if ($request->getFrom() === $user) 
                        {echo "selected";}
                    ?>>Sent requests</option>
                    <option
                    <?php 
                        if ($request->getTo() === $user) 
                        {echo "selected";}
                    ?>>Receive requests</option>
                </select>
            </div>
        </div>
    </div>
    <!-- Headings and title end-->

    <!--Content-->
    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-md-5 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between mb-1">
                            <h2 class="col-9 card-title">Request ID - <?php echo $request->getId(); ?></h2>
                            <input id="showid" type="hidden" value="<?php echo $request->getId(); ?>">
                            <input id="showtype" type="hidden" value="<?php echo $_GET['type'] ?>">
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <p style="margin-bottom: -25px; margin-top: 7px;">From</p>
                            </div>
                            <div class="col-7">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-link link-btn" data-bs-toggle="modal" data-bs-target="">
                                <?php echo $request->getFrom()->get_name(); ?>
                                </button>
                                                    
                            </div>
                        </div>

                        <?php 
                            if($user->get_name()!=$request->getFrom()->get_name() and $user->get_name()!=$request->getTo()->get_name() ){
                                   ?>
                                    <script>
                                            window.location.href = requestDashboard.php;
                                    </script>
                                   <?php
                            }
                            
                        
                        
                        
                        
                        ?>
                        <div class="row">
                            <div class="col-5">
                                <p style="margin-bottom: -25px; margin-top: 7px;">To</p>
                            </div>
                            <div class="col-7">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-link link-btn" data-bs-toggle="modal" data-bs-target="#">
                                <?php echo $request->getTo()->get_name(); ?>
                                </button>
                                
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: -15px;">
                            <div class="col-5">
                                <p style="margin-top: 7px;">Equipment</p>
                            </div>
                            <div class="col-7">
                                <p class="btn">
                                <?php echo $request->getEquipment(); ?>
                                </p>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: -15px;">
                            <div class="col-5">
                                <p style="margin-top: 7px;">Quantity</p>
                            </div>
                            <div class="col-7">
                                <p class="btn">
                                <?php echo $request->getQuantity(); ?>
                                </p>
                            </div>
                        </div>

                        <?php
                            $state1 = $request->getState()->showstate();
                            
                            if($state1=="Requested"){
                                echo '<div class="row mb-2" id="status">
                                        <div class="col-12 px-1">
                                            <button type="button" class="btn btn-primary" disabled>Current Status : Requested</button>
                                        </div>
                                    </div>';
                            }
                            else if($state1=="Accepted"){
                                echo '<div class="row mb-2" id="status">
                                                <div class="col-12 px-1">
                                                    <button type="button" class="btn btn-success" disabled>Current Status : Accepted</button>
                                                </div>
                                        </div>';
                            }
                            else if($state1=="Declined"){
                                echo '<div class="row mb-2" id="status">
                                            <div class="col-12 px-1">
                                                <button type="button" class="btn btn-danger" disabled>Current Status : Declined</button>
                                            </div>
                                    </div>';
                            }
                            else if($state1=="Transporting"){
                                echo '<div class="row mb-2" id="status">
                                            <div class="col-12 px-1">
                                                <button type="button" class="btn btn-warning" disabled>Current Status : Transporting</button>
                                            </div>
                                        </div>';
                            }
                            else if($state1=="Exchange Completed"){
                                echo '<div class="row mb-2" id="status">
                                            <div class="col-12 px-1">
                                                <button type="button" class="btn btn-success" disabled>Current Status : Exchange completed</button>
                                            </div>
                                        </div>';
                            }
                            else if($state1=="Cancelled"){
                                echo '<div class="row mb-2" id="status">
                                            <div class="col-12 px-1">
                                                <button type="button" class="btn btn-dark" disabled>Current Status : Cancelled</button>
                                            </div>
                                        </div>';
                            }



                            if($state1=="Requested"){
                                if($user->get_name()!=$request->getFrom()->get_name()){
                                    echo ' 
                                    <div class="row mb-2" id="status">
                                                <div class="col-12 px-1" style="text-align: center;">
                                                    Choose Count for Accept : &nbsp;&nbsp;
                                                 <input id="count1" type="number" style="width: 60px; " value="'.$request->getQuantity().'" min="0" max="'.$request->getQuantity().'" step="1"/> 
                                                </div>
                                            </div>
                                            <div class="row mb-2" id="status">
                                                
                                                <div class="col-6 px-1">
                                                    
                                                    <button class="btn btn-success our1" value="Accept">Accept</button>
                                                </div>
                                                <div class="col-6 px-1">
                                                    <button style=" " class="btn btn-danger our1" value="Decline">Decline</button>
                                                </div>
                                            </div>
                                            <div class="row" id="status" style="margin-bottom: -5px;">
                                                <div class="col-12 px-1">
                                                    <button type="button " value="Cancel" class="btn btn-dark our1">Cancel</button>
                                                </div>
                                            </div>';
                                }
                                else{
                                    echo '<div class="row" id="status" style="margin-bottom: -5px;">
                                    <div class="col-12 px-1">
                                        <button type="button " value="Cancel" class="btn btn-dark our1">Cancel</button>
                                    </div>
                                </div>';
                                }
                                
                            }
                            else if($state1=="Accepted"){
                                if($user->get_name()!=$request->getFrom()->get_name()){
                                    echo '<div class="row mb-2" id="status">
                                            <div class="col-12 px-1"> 
                                                <button type="button" value="Transport" class="btn btn-warning our1">Transport</button>
                                            </div>
                                        </div>';
                                }
                                echo '<div class="row" id="status" style="margin-bottom: -5px;">
                                            <div class="col-12 px-1">
                                                <button type="button" value="Cancel" class="btn btn-dark our1">Cancel</button>
                                            </div>
                                        </div>';
                            }
                            else if($state1=="Declined"){
                                echo ' ';
                            }
                            else if($state1=="Transporting"){
                                if($user->get_name()==$request->getFrom()->get_name()){
                                    echo '<div class="row mb-2" id="status">
                                            <div class="col-12 px-1">
                                                <button type="button" value="Exchange" class="btn btn-secondary our1">Confirm exchange</button>
                                            </div>
                                        </div>';
                                }
                                
                            }
                            else if($state1=="Exchange Completed"){
                                echo '';
                            }
                            else if($state1=="Cancelled"){
                                echo ' ';
                            }
                            
                       
                        ?>                      
                           
               
                        
                        
                    </div>
                </div>
            </div>

            <div class="col-md-7 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card mb-2">
                            <div class="card-header">
                                <h3><?php if($request->getTo()->get_username() == $user->get_username()){echo $request->getFrom()->get_username();}else{echo $request->getTo()->get_username();}?><h3>
                            </div>
                            <div id="chat-box-body" class="card-body">
                                <?php
                                    $messages = $chat->getMessages();
                                    foreach($messages as $msg)
                                    {
                                        $txt = $msg->getMsg();
                                        if (($msg->getSenderType() == strtoupper(get_class($user))) 
                                            && ($msg->getSenderId() == $user->get_id())) {
                                            echo '<div class="message" style="float: right;background-color: #f2e4fd;font-weight: 500;">'.$txt.'</div><br>
                                                  <div style="clear: both;"></div>';
                                        }
                                        else {
                                            echo '<div class="message" style="float: left;background-color: #f0fde4;font-weight: 500;">'.$txt.'</div><br>
                                                  <div style="clear: both;"></div>';
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <form action="" method="post">
                            <div class="input-group">
                                <textarea id="chat-textarea" class="form-control" aria-label="With textarea" name="msg" required></textarea>
                                <button type="submit" name="send" class="input-group-text btn btn-link chat-btn"><i class="far fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        include("./footer.php");
    ?>

    <div id="mod11" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Resources</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to update resources</p>
      </div>
      <div class="modal-footer">
        <a href="updateResources.php"><button type="button"  class="btn btn-primary">Yes</button> </a>
        <button type="button" onclick="location.reload();" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>


</body>

<script type="text/javascript">
    function myhref(web) {
        window.location.href = web;
    }

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</html>
