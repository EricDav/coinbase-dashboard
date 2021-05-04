<div class="sidebar-menu sticky-sidebar-menu">

<!-- logo start -->
<div class="logo">
  <h3><a style="font-size: 20px;" href="index.html">BaseCoinInvestment</a></h3>
</div>

<!-- if logo is image enable this -->
<!-- image logo --
<div class="logo">
  <a href="index.html">
    <img src="image-path" alt="Your logo" title="Your logo" class="img-fluid" style="height:35px;" />
  </a>
</div>
 //image logo -->

<div class="logo-icon text-center">
  <a href="index.html" title="logo"><img src="<?=$subPath . '/assets/images/logo.png'?>" alt="logo-icon"> </a>
</div>
<!-- //logo end -->

<div class="sidebar-menu-inner">

  <!-- sidebar nav start -->
  <ul class="nav nav-pills nav-stacked custom-nav">
    <li class="active"><a href="index.html"><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
    </li>
    <li><a href="/investments"><i class="fa fa-table"></i> <span>Investments</span></a></li>
    <li><a href="/transactions"><i class="fa fa-th"></i> <span>Transactions</span></a></li>
    <li><a href="/profile"><i class="fa fa-user"></i> <span>My Profile</span></a></li>
    <li><a href="/plans"><i class="fa fa-bars"></i> <span>Investment Plans</span></a></li>
    <li><a href="/withdraw"><i class="fa fa-money"></i> <span>Withdraw | Deposit</span></a></li>
    <?php if (isAdmin()): ?> 
      <li><a href="/users"><i class="fa fa-users"></i> <span>Users</span></a></li>
    <?php endif; ?>
  </ul>
  <!-- //sidebar nav end -->
  <!-- toggle button start -->
  <a class="toggle-btn">
    <i class="fa fa-angle-double-left menu-collapsed__left"><span>Collapse Sidebar</span></i>
    <i class="fa fa-angle-double-right menu-collapsed__right"></i>
  </a>
  <!-- //toggle button end -->
</div>
</div>