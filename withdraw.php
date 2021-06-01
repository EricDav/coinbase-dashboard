<?php
// var_dump($_SESSION); exit;
?>

<!doctype html>
<html lang="en">
<?php include 'head.php'; ?>

<body class="sidebar-menu-collapsed">
  <div class="se-pre-con"></div>
  <style>
            .error-message {
                font-size: 13px;
                color: red;
            }
            .success-message {
                display: none;
            }
        </style>
<section>
  <!-- sidebar menu start -->
   <?php include 'sidebar.php'; ?>
  <!-- //sidebar menu end -->

  <!-- header-starts -->
    <?php include 'header.php'; ?>
  <!-- //header-ends -->

  <!-- main content start -->
<div class="main-content">

  <!-- content -->
  <div class="container-fluid content-top-gap">
    <!-- statistics data -->
      <?php include 'stat.php'; ?>
    <!-- //statistics data -->

    <div class="card card_border py-2 mb-4">
      <div class="cards__heading">
          <h3>Deposit Funds <span></span></h3>
      </div>

      <div class="card-body">
          <div class="form-row">
              <div class="form-group col-md-6">Make a bitcoin deposit to the wallet address below or a wire transfer. After successfull payment send mail us at <strong>info@basecoininvest.co</strong> or send a whatsapp message <strong>+1 424 209 4088</strong> with your email address and the details of your transfer</div>
              
          </div>
          <div><b>Bitcoin Address:  </b>  18skmQBU9bkvHpWM7XpmWiZrKfPGpfN6YW</div>
          <div style="margin-top: 20px;"><b>Wire Transfer</b></div>
          <div>Bank Name: Chase Bank<br>
            Account Holder: Crystal Morris Crenshaw<br>
            Account Number: 749157605<br>
            Routing Number: 021000021</div>
      </div>
    </div>

    <!-- profile details -->
    <div class="card card_border py-2 mb-4">
                <div class="cards__heading">
                    <h3>Withdraw Funds <span></span></h3>
                </div>
                <div class="card-body">
                <div id="m-success" class="alert alert-success success-message" role="alert">
                        
                    </div>
                    <div id="m-failure" class="alert alert-danger success-message" role="alert">
                        
                    </div>
                   
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4" class="input__label">Enter Wallet</label>
                                <input type="text" name="wallet" class="form-control input-style" id="wallet" placeholder="Wallet" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4" class="input__label">Amount</label>
                                <input type="number" name="amount" class="form-control input-style" id="amount" placeholder="Amount" required>
                            </div>
                        </div>
                        <button id="withdraw-funds" type="submit" class="btn btn-primary btn-style mt-4">Submit</button>
                </div>
            </div>

    <!-- // end of profile -->

  </div>
  <!-- //content -->
</div>
<!-- main content end-->
</section>
  <!--footer section start-->
  <?php include 'footer.php'; ?>
<!--footer section end-->
<!-- move top -->
<button onclick="topFunction()" id="movetop" class="bg-primary" title="Go to top">
  <span class="fa fa-angle-up"></span>
</button>
<?php include 'script.php'; ?>
<script src="<?=$subPath . '/assets/js/w.js?v=3'?>"></script>
</body>

</html>
  