<script>
    $(document).ready(function(){
  jQuery(document).ajaxStart(function(){
        $('#initialContainerMask').show();
        $('#loader').show();
    });
    jQuery(document).ajaxStop(function(){
        $('#loader').hide();
        $('#initialContainerMask').hide();
    });    
        $('#confirmbtn').click(function(){
            $.ajax({
                url: '/dashboard/clearDashboard',
                type: 'POST',
                async: false,
                dataType: 'html',
                success: function (jsonValue) {
                  $('.clearDashboard').attr('style','margin-left:0px; width:903px;');
                  $('.clearDashboard').html("Your dashboard Cleared Successfully. Please use this <a style='color:red' href='<?php
                    echo  Router::url(array('controller' => 'DashboardImports', 'action' => 'dashboardimport'));?>'>link</a> to import new data's")
                }
            });
            return false;
        })
    });
</script>
<div id='initialContainerMask'>
<div id='loader'><img src='../img/loading.gif'><span style='float:right;margin-right:40px;'>Deleting</span></img></div>
</div>
<div class="clearDashboard">
  Do you want clear dashboard?
  <div>
    <a href="" id="confirmbtn"></a>
    <a href="<?php
	 echo  Router::url(array('controller' => 'dashboard', 'action' => 'dashboard'));?>" id="cancelbtn"></a>
  </div>
</div>