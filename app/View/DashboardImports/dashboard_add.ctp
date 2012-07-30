<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#submitDashboardData').click(function(){
      var youtubeData  = $('#youtube_data').val();
      var rssLeft      = $('#rss_left').val();
      var rssRight     = $('#rss_right').val();
      var dashboardText= $('#dashboard_text').val();
      
      if((youtubeData != "")||(rssLeft != "")||(rssRight != "")||(dashboardText != "")){
	//alert('sdsd');
	$.ajax({
	  url: "<?php echo  Router::url(array('controller' => 'DashboardImports', 'action' => 'insertDashboardData'));?>",
	  type: 'POST',
	  data: "youtube="+youtubeData+"&rssleft="+rssLeft+"&rssright="+rssRight+"&dashboarddata="+dashboardText,
	  success: function (json) {
	    //alert(json);
	    if($.trim(json) == 'success'){
	      jQuery(document).ajaxStart(function(){
		$('#initialContainerMask').show();
		$('#loader').show();
	      });
	      
	      jQuery(document).ajaxStop(function(){
		$('#loader').hide();
		$('#initialContainerMask').hide();
	      });
	    setTimeout(function(){ window.location = "<?php echo  Router::url(array('controller' => 'dashboard', 'action' => 'dashboard'));?>"; }, 1000);
	    }
	    else{
	      ///alert("Erro");
	    }
	    
	  }
	});
      }
      else{
	$('#msg').html('Please enter atleast one value');
      }
    });
  });
  
</script>
<div id='initialContainerMask'>
<div id='loader'><img src='../img/loading.gif'><span style='float:right;margin-right:40px;'>Changing</span></img></div>
</div>
<div class='header_txt'>Dashboard Import</div>
<div class='searchSep'></div>


<div id="content-import">
<?php
	echo $this->Form->create('DashboardImports', array('controller' => 'DashboardImports', 'action' => 'insertDashboardData', 'class' =>'choose_file'));
	echo "<div id='msg'></div><div class='formdivider'>";
	echo "<label class='labelTxt'>Youtube</label>";
	//ho "<input type='text' class='inputTxt' name='youtube_data' id='youtube_data'></input>";
        echo "<textarea class='inputTxt' name='youtube_data' id='youtube_data' style='width: 267px; height: 84px;'>".$youtube[0]['tab_dashboard_content']['field_value']."</textarea>";
	echo "</div>";
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>Dashboard text</label>";
        echo "<textarea class='inputTxt' name='dashboard_text' id='dashboard_text' style='width: 267px; height: 84px;'>".$text_message[0]['tab_dashboard_content']['field_value']."</textarea>";
	echo "</div>";
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>Rss Left</label>";
	echo "<textarea class='inputTxt' name='rss_left' id='rss_left' style='width: 267px; height: 84px;'>".$rss_field_left[0]['tab_dashboard_content']['field_value']."</textarea>";
	echo "</div>";
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>Rss Right</label>";
        echo "<textarea class='inputTxt' name='rss_right' id='rss_right' style='width: 267px; height: 84px;'>".$rss_feed_right[0]['tab_dashboard_content']['field_value']."</textarea>";
	echo "</div>";
	//echo "<div class='selectfilename'></div><br>";
	echo "<br>";
	echo "<a href='javascript:void(0)' id='submitDashboardData'></a>";
	echo "<br><br>";
?>
<!--
<div id="importAnimation" style='display:none;'>
<?php echo $this->Html->image('loading.gif', array('width' => 20, 'height' => 20));?>
</div>
-->
<?php echo $this->Form->end();
?>
</div>
<div class="bottomright" style="margin-right: 0px;">
  <a href="<?php
	 echo  Router::url(array('controller' => 'dashboard', 'action' => 'dashboard'));?>">Back to Dashboard</a>
</div>