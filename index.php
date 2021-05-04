<?php
  session_start();
 include 'controller.php';
   // var_dump($_SESSION); exit;
  function getMatureDate($dateCreated, $amount) {
    $hours = 96;
    $maturedDate = date('Y-m-d H:m:s', strtotime("+" . $hours ." hours", strtotime($dateCreated)));

    return $maturedDate;
}

function getPercent($amount) {
  return getPlan($amount)['percent']/100;
}

function getTotalAmountInvested($investments) {
  $totalAmount = 0;

  foreach($investments as $investment) {
    $totalAmount+=$investment['amount'];
  }

  return $totalAmount;

}

function getTotalAmountWithdrawn($transactions) {
  $totalAmount = 0;

  foreach($transactions as $transaction) {
    if ($transaction['transaction_type'] == 0) {
      $totalAmount+=$transaction['amount'];
    }
  }

  return $totalAmount;
}

function getProfit($investment) {
  return $investment['amount'] * getPercent($investment['amount']);
}

function getSingleBalance($investment) {
  if (gmdate('Y-m-d\ H:i:s') > getMatureDate($investment['date_created'], $investment['amount'])) {
    return $investment['amount'] + ($investment['amount'] * getPercent($investment['amount']));
  }

  return 0;
}

// var_dump($_SESSION); exit;

function getBalance($transactions, $investments) {
  $amountWithdrawn = getTotalAmountWithdrawn($transactions);

  $maturedInvestments = 0;
  foreach($investments as $investment) {
    if (gmdate('Y-m-d\ H:i:s') > getMatureDate($investment['date_created'], $investment['amount'])) {
      $maturedInvestments+=$investment['amount'] + ($investment['amount'] * getPercent($investment['amount']));
    }
  }

  return $maturedInvestments - $amountWithdrawn;
}


function getFirst10Transactions($transactions) {
  $newTransactions = array();
  $size = sizeof($transactions) > 10 ? 10 : sizeof($transactions);
  for ($i = 0; $i < $size; $i++) {
    array_push($newTransactions, $transactions[$i]);
  }

  return $newTransactions;
}

function isAdmin() {
  return isset($_SESSION['user']) && $_SESSION['user']['id'] == 1;
}

function isLogin() {
  return isset($_SESSION['user']);
}

function looginGuide() {
  if (!isLogin()) {
    header('Location: /login');
  }
}

function adminGuide() {
  if (!isAdmin()) {
    header('Location: /login');
  }
}

$subPath = $_SERVER['HTTP_HOST'] == 'localhost:8888' ? '/coinbase-dashboard' : '';
$currentPage = 'Dashboard';
$header = 'Last ten Transaction';
$url = explode('?', $_SERVER['REQUEST_URI'])[0];
$details = isset($_SESSION['user']) ? getDashboardDetails($_SESSION['user']['id']) : null;

$url = explode('?', $_SERVER['REQUEST_URI'])[0];
if ($url == '/transactions') {
  looginGuide();
  $transactions = $details['transactions'];
  $currentPage = 'Transactions';
  $header = 'All Transactions';
  include 'transactions.php';
  exit;
} else if ($url == '/investments') {
  looginGuide();
  if (isset($_GET['id']) && is_numeric($_GET['id']) && isAdmin()) {
    $header = 'All Investments For ' . $_SESSION['user']['name'];
    $investments = getInvestments($_GET['id']);
  } else {
    $header = 'All Investments';
    $investments = getInvestments($_SESSION['user']['id']);
  }

  // $investments =  getInvestments($_SESSION['user']['id']);
  $currentPage = 'Investments';
  include 'investments.php';
  exit;
} else if ($url == '/withdraw') {
  looginGuide();
  $header = 'Withdraw Funds';
  include 'withdraw.php';
  exit;
} else if ($url == '/plans') {
  looginGuide();
  $plans = getPlans();
  $header = 'Investment Plans';
  include 'plans.php';
  exit;
}  else if ($url == '/users') {
  adminGuide();
  $users = getUsers();
  $currentPage = 'users';
  $header = 'All Users';
  include 'users.php';
  exit;
} else if ($url == '/updateUserDetails') {
  updateUserDetails();
} else if ($url == '/addInvestment') {
  looginGuide();
  include 'addInvestment.php';
  exit;
} else if ($url == '/profile') {
  looginGuide();
  $currentPage = 'Profile';
  $header = 'My Profile';
  include 'profile.php';
  exit;
}  else if ($url == '/login') {
  if (isset($_SESSION['user'])) {
    header('Location: /');
  }
  include 'login.php';
  exit;
} else if ($url == '/signup') {
  if (isset($_SESSION['user'])) {
    header('Location: /');
  }
  include 'signup.php';
  exit;
} else if ($url == '/logout') {
  include 'logout.php';
} else {
  looginGuide();
}

  $totalAmountInvested = 0;
  $transactions = getFirst10Transactions($details['transactions']);
?>

<!doctype html>
<html lang="en">
<?php include 'head.php'; ?>

<body class="sidebar-menu-collapsed">
  <div class="se-pre-con"></div>
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

    <!-- chatting -->

    <!-- //chatting -->

    <!-- accordions -->
    <!-- //accordions -->

    <!-- modals -->
      <?php include 'transaction.php'; ?>
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
</body>

</html>
  