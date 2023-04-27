<div class="col-lg-4 col-md-6 col-xl-3 mb-4 <?php echo $_SESSION["request_option"];?>">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between mb-1">
                            <h3 class="col-9 card-title"><?php echo $current->getType().'<br>'; ?>Request ID - <?php 
                            if($_SESSION["request_option"]=="sent"){
                                echo ' '.$current->getId().'<br>(sent)';
                                }else echo ' '.$current->getId().'<br>(receive)';?></h3>
                        </div>
                        <div class="row" style="display: <?php
                             if($_SESSION["request_option"]=="sent"){
                               echo 'none';
                               }
                        ?>;">
                            <div class="col-5">
                                <p style="margin-bottom: -25px; margin-top: 7px;">From</p>
                            </div>
                            <div class="col-7">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-link link-btn" data-bs-toggle="modal" data-bs-target="#fromModal">
                                    <?php echo $current->getFrom()->get_name();?>
                                </button>  
                            </div>
                        </div>
                        <div class="row" style="display: <?php
                             if($_SESSION["request_option"]=="received"){
                               echo 'none';
                               }
                        ?>;">
                            <div class="col-5">
                                <p style="margin-bottom: -25px; margin-top: 7px;">To</p>
                            </div>
                            <div class="col-7">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-link link-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <?php echo $current->getTo()->get_name();?>
                                </button>
                           
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: -15px;">
                            <div class="col-5">
                                <p style="margin-top: 7px;">Equipment</p>
                            </div>
                            <div class="col-7">
                                <p class="btn">
                                    <?php echo $current->getEquipment();?>
                                </p>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: -15px;">
                            <div class="col-5">
                                <p style="margin-top: 7px;">Quantity</p>
                            </div>
                            <div class="col-7">
                                <p class="btn">
                                    <?php echo $current->getQuantity();?>
                                </p>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: -15px;">
                            <div class="col-5">
                                <p style="margin-top: 7px;">Status</p>
                            </div>
                            <div class="col-7">
                                <p class="btn">
                                    <?php echo $current->getState()->showstate();?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <p class="text-end" style="margin-bottom: -5px; margin-top: -5px;">
                                <a href="./viewRequest.php?type=<?php echo $current->getType();?>&id=<?php echo $current->getId();?>" style="text-decoration: none; color: #aaa;">See more..</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>