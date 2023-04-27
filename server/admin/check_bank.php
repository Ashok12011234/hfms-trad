<?php include 'header.php'; ?>
<?php //include '../config.php';
include '../classes/probDomCls/NewAccount.php';

if (!isset($_GET['id'])) {
?>
    <script>
        window.location.href = "index.php";
    </script>

<?php
} else {
    $id = $_GET['id'];
    $user_acc = new NewAccount();
    $user_acc->setID($id);
    $sql = "SELECT UserName,AccountType,Email,BankName,AccountNumber,BankEvidence,InstituteEvidence  FROM newaccount WHERE NewAccountID='$id';";
    $result = QueryExecutor::query($sql);
    $row = mysqli_fetch_assoc($result);

    $user_acc->setUsername($row['UserName']);

    $user_acc->setEmailAddress($row['Email']);
    $user_acc->setAcType($row['AccountType']);

    if ($user_acc->getAcType() == 'HOSPITAL') {
        $user_acc->setBankName($row['BankName']);
        $user_acc->setBankAcNumber($row['AccountNumber']);
        $user_acc->setBankEvidence($row['BankEvidence']);
    }

    $user_acc->setInstituteEvidence($row['InstituteEvidence']);

    $_SESSION['user'] = $user_acc;
}
?>




<div class="container mt-3 mb-4">
    <ul class=" text-center text-dark list-inline">
        <li class="lead list-inline-item">&emsp;&emsp;Hospital : <?php echo $user_acc->getUsername(); ?></li>
        <li class=" lead list-inline-item">&emsp;&emsp;Bank Name : <?php echo $user_acc->getBankName(); ?></li>
        <li class="lead list-inline-item">&emsp;&emsp;Account Number : <?php echo $user_acc->getBankAcNumber(); ?></li>

    </ul>
    <iframe src="../assets/documents/PageDocuments/Signup/BankEvidence.pdf" width="100%" height="600px" frameborder="0">

    </iframe>


    <div class="text-center but_group mt-4 mb-2 align-self-center">
        <div class="btn-group btn-group-lg" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Vertify</button>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModa2">Can't Vertify</button>
            <button type="button" onclick="window.location.href = 'index.php';" class="btn btn-secondary">Cancel</button>
        </div>

    </div>


    <!-- Modal 1-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Are you going to vertify the above document as correct ?</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
                    <form action="process/bank_correct.php">
                        <input type="hidden" name="uname" value="<?php echo $user_acc->getUsername(); ?>">
                        <input type="hidden" name="mail" value="<?php echo $user_acc->getEmailAddress(); ?>">
                        <input type="hidden" name="ishos" value="<?php echo $user_acc->getAcType(); ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button type="submit" name="yes" class="btn btn-success">Yes, Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2-->
    <div class="modal fade " id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabe2" aria-hidden="true">
        <div class="  modal-dialog modal-dialog-centered  ">
            <div class="modal-content">

                <form action="process/bank_wrong.php" method="GET">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabe2">Provide the missing information !</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <textarea name="io" class="form-control" id="exampleFormControlTextarea2" rows="5"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="uname" value="<?php echo $user_acc->getUsername(); ?>">
                    <input type="hidden" name="mail" value="<?php echo $user_acc->getEmailAddress(); ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>
<script>
    $('title').text("Check Bank Documents");
    $('#title1').text("Check Bank Documents");
    $("#search1").hide();
</script>