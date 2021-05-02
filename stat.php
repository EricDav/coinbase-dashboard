<?php


?>

<nav aria-label="breadcrumb">
      <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=$currentPage?></li>
      </ol>
    </nav>
    <div class="welcome-msg pt-3 pb-4">
      <h1>Hi <span class="text-primary"><?=$_SESSION['user']['name']?></span>, Welcome back</h1>
      <p>View your transaction details.</p>
    </div>
    <div class="statistics">
      <div class="row">
        <div class="col-xl-6 pr-xl-2">
          <div class="row">
            <div class="col-sm-6 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                
                <h3 class="text-primary number"><?=sizeof($details['investments'])?></h3>
                <p class="stat-text">Total Investments</p>
              </div>
            </div>
            <div class="col-sm-6 pl-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                
                <h3 class="text-secondary number"><?=('$ ' . getTotalAmountInvested($details['investments']))?></h3>
                <p class="stat-text">Total Amount Invested</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 pl-xl-2">
          <div class="row">
            <div class="col-sm-6 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                
                <h3 class="text-success number"><?=('$ ' . getTotalAmountWithdrawn($details['transactions']))?></h3>
                <p class="stat-text">Total Amount Withdrawn</p>
              </div>
            </div>
            <div class="col-sm-6 pl-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                
                <h3 class="text-danger number"><?=('$ ' . getBalance($details['transactions'], $details['investments']))?></h3>
                <p class="stat-text">Available balance</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    