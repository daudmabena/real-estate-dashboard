<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#submitDashboardData').click(function(){
      var youtubeData  = $('#youtube_data').val();
      var rssLeft      = $('#rss_left').val();
      var rssRight     = $('#rss_right').val();
      var dashboardText= $('#dashboard_text').val();  
      
      $.ajax({
	url: "<?php echo  Router::url(array('controller' => 'DashboardImports', 'action' => 'insertDashboardData'));?>",
	type: 'POST',
	data: "youtube="+youtubeData+"&rssleft="+rssLeft+"&rssright="+rssRight+"&dashboarddata="+dashboardText,
	success: function (json) {
	  alert(json);
	  jQuery(document).ajaxStart(function(){
	    $('#initialContainerMask').show();
	    $('#loader').show();
	  });
	  
	  jQuery(document).ajaxStop(function(){
	    $('#loader').hide();
	    $('#initialContainerMask').hide();
	  });  
	  
	}
      });
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
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>Youtube</label>";
	//ho "<input type='text' class='inputTxt' name='youtube_data' id='youtube_data'></input>";
        echo "<textarea class='inputTxt' name='youtube_data' id='youtube_data' style='width: 267px; height: 84px;'></textarea>";
	echo "</div>";
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>Dashboard text</label>";
        echo "<textarea class='inputTxt' name='dashboard_text' id='dashboard_text' style='width: 267px; height: 84px;'></textarea>";
	echo "</div>";
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>Rss Left</label>";
	echo "<textarea class='inputTxt' name='rss_left' id='rss_left' style='width: 267px; height: 84px;'></textarea>";
	echo "</div>";
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>Rss Right</label>";
        echo "<textarea class='inputTxt' name='rss_right' id='rss_right' style='width: 267px; height: 84px;'></textarea>";
	echo "</div>";
	//echo "<div class='selectfilename'></div><br>";
	echo "<br>";
	echo "<a href='#' id='submitDashboardData'>Click to cubmit</a>";
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
<div class="topXLSUploaddiv" style="margin-right: 0px;">
  <a href="#" onclick="history.go(-1);">Back to Dashboard</a>
</div>