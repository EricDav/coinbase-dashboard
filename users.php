<!doctype html>
<html lang="en">
<?php include 'head.php'; ?>

<body class="sidebar-menu-collapsed">
  <style>
    #m-success {
      display: none;
    }
    #m-error {
      display: none;
    }
  </style>
  <div class="se-pre-con"></div>
  <div class="modal fade" id="addInvestment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div style="display: flex;" class="modal-header">
        <h4 style="width: 95%; font-size: 2rem;" class="modal-title" id="exampleModalLongTitle">Add Investment: </h4>
        <button id="cancel-create-prediction-button" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div style="margin-top: 0px;" id='m-body-id' class="modal-body m-body">
    <div id="m-success" class="alert alert-success" role="alert">Created successfully</div>
    <div id="m-error" class="alert alert-danger" role="alert"></div>
    <div class="form-group">
        <label for="exampleInputEmail1" class="input__label">Amount</label>
        <input name="amount" type="text" class="form-control login_text_field_bg input-style" id="amount" aria-describedby="emailHelp" placeholder="Enter amount" required="" autofocus="">
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="addInvestmentSubmit" type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Model close -->
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

    <!-- modals -->
      <?php include 'user.php'; ?>
    <!-- //modals -->
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
<script>let userId = null;</script>

<script>
    console.log('Freeee');
    function saveUserId(id) {
      console.log(id, 'ID_________');
      userId = id;
    }
    $('#addInvestmentSubmit').click(function() {
      console.log('Inside First Level');
      const amount = $('#amount').val();
      console.log(amount);

      if (amount) {
        $('#addInvestmentSubmit').css('disabled', true);
        // $('#').css('cursor', 'default');
        $('#addInvestmentSubmit').text('Submiting...');
        $.ajax('/addInvestment', { data: {'amount': amount, 'userId': userId},
        type: 'POST',  success: function(result) {
          $('#addInvestmentSubmit').css('disabled', false);
          $('#addInvestmentSubmit').text('Submit');
           response = result;
           if (response.success) {
               const messages = response.message
               $('#m-success').css('display', 'block');
                setTimeout(function() {
                  $('#m-success').css('display', 'none');
                  $('#amount').val('');
                  $('#addInvestment').modal('toggle');
                }, 2000);
               //$('#error-message').text(response.message);
          } else {
              $('#m-error').css('display', 'block');
              $('#m-error').text(response.message || response.data);
          }
       }});
      }
    });
    </script>
</body>

</html>
  