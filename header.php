<div class="header sticky-header">

<!-- notification menu start -->
<div class="menu-right">
  <div class="navbar user-panel-top">
    <div class="user-dropdown-details d-flex">

      <div class="profile_details">
        <ul>
          <li class="dropdown profile_details_drop">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu3" aria-haspopup="true"
              aria-expanded="false">
              <div class="profile_img">
                <img src="<?=$subPath . '/assets/images/male.png'?>" class="rounded-circle" alt="" />
                <div class="user-active">
                  <span></span>
                </div>
              </div>
            </a>
            <ul class="dropdown-menu drp-mnu" aria-labelledby="dropdownMenu3">
              <li class="user-info">
                <h5 class="user-name"><?=$_SESSION['user']['name']?></h5>
                <span class="status ml-2">Available</span>
              </li>
              <li> <a href="/profile"><i class="lnr lnr-user"></i>My Profile</a> </li>
              <li class="logout" id="log-out"> <a href="/logout"><i class="fa fa-power-off"></i> Logout</a> </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!--notification menu end -->
</div>
<script>
  // $('#log-out').click()
</script>

