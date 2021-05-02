<script>
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () {
    scrollFunction()
  };

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      document.getElementById("movetop").style.display = "block";
    } else {
      document.getElementById("movetop").style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>
<!-- /move top -->


<script src="<?=$subPath . '/assets/js/jquery-3.3.1.min.js'?>"></script>
<script src="<?=$subPath . '/assets/js/jquery-1.10.2.min.js'?>"></script>

<!-- chart js -->

<script src="<?=$subPath . '/assets/js/utils.js'?>"></script>
<!-- //chart js -->


<script src="<?=$subPath . '/assets/js/jquery.nicescroll.js'?>"></script>
<script src="<?=$subPath . '/assets/js/scripts.js'?>"></script>

<!-- close script -->
<script>
  var closebtns = document.getElementsByClassName("close-grid");
  var i;

  for (i = 0; i < closebtns.length; i++) {
    closebtns[i].addEventListener("click", function () {
      this.parentElement.style.display = 'none';
    });
  }
</script>
<!-- //close script -->

<!-- disable body scroll when navbar is in active -->
<script>
  $(function () {
    $('.sidebar-menu-collapsed').click(function () {
      $('body').toggleClass('noscroll');
    })
  });
</script>
<!-- disable body scroll when navbar is in active -->

 <!-- loading-gif Js -->
 <script src="<?=$subPath . '/assets/js/modernizr.js'?>"></script>
 <script>
     $(window).load(function () {
         // Animate loader off screen
         $(".se-pre-con").fadeOut("slow");;
     });
 </script>
 <!--// loading-gif Js -->

<!-- Bootstrap Core JavaScript -->
<script src="<?=$subPath . '/assets/js/bootstrap.min.js'?>"></script>
<style>
    table.dataTable thead th, table.dataTable thead td {
      padding: 10px 10px 0 0;
    }
</style>