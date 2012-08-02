<?php

$zip = $_SESSION["zip"];

?>

<script type="text/javascript">
$(document).ready(function() {
	$("#state").autocomplete("<?php echo Router::url(array('controller' => 'DashboardImports','action' => 'getState'));?>", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#city").autocomplete("<?php echo Router::url(array('controller' => 'DashboardImports','action' => 'getCity'));?>", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#zipcode").autocomplete("<?php echo Router::url(array('controller' => 'DashboardImports','action' => 'getZipCode'));?>", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#state").result(function(event, data, formatted) {
		$("#state").val(data[0]);
	});
	
	$("#city").result(function(event, data, formatted) {
		$("#city").val(data[0]);
	});
	
	$("#zipcode").result(function(event, data, formatted) {
		$("#zipcode").val(data[0]);
	});
	
});
</script>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
      $("body").css("background-color","#151515");
      $('.searchContent').hide();
      var showOrHide;
      $('.searchTxt').click(function(){
	if($(".searchContent").is(":hidden"))
	{
	  $('#searchText').html('Search');
	  $('#searchArrow').attr("class","searchDownArrow");
	}
	else{
	  $('#searchText').html('<?php $zipData = $this->requestAction("/Dashboard/getZipArea/".$zip);
				      echo $zipData[0]["tab_median_price_2years"]["zip_code"]." ".$zipData[0]["tab_median_price_2years"]["zip_code_area"];
				?>');
	  $('#searchArrow').attr("class","searchUpArrow");
	  
	}
	$('.searchContent').slideToggle(showOrHide);
      });
      
      $('#submitForm').click(function(){
	//$.ajax({
	//    url: 'dashboard/getZipArea/'+<?php echo $zip ?>,
	//    type: 'POST',
	//    success: function (jsqon) {
	//      alert(jqson)
	//    }
	//});
	//alert($('#zipcode').val());
	$('#ZipLabel').html($('#zipcode').val()+" Median Price");
	getSearchData('<?php echo Router::url(array('controller' => 'dashboard', 'action' => 'getJsonFormat'));?>');
      });
  });
</script>
<div id='initialContainerMask'>
<div id='loader'><img src='../img/loading.gif'><span style='float:right;margin-right:40px;'>Loading</span></img></div>
</div>
<div id='wrapper'>
	<!--Guage Section -->
	
	<div class='searchPanel'>
	  <div class='searchTxt'>
	    <div id="searchText" style="float: left">
	    <?php
	      $zipData = $this->requestAction('/Dashboard/getZipArea/'.$zip);
	      echo $zipData[0]['tab_median_price_2years']['zip_code']." ".$zipData[0]['tab_median_price_2years']['zip_code_area'];
	    ?>
	    </div>
	    <div class="search searchUpArrow" id="searchArrow"></div>
	  </div>
	  
    	  <div class="searchContent">
	    <div class='searchSep'></div>
	    <?php
		  echo $this->Form->create('Dashboard', array('controller' => 'Dashboard', 'action' => 'dashboard'));
		  echo "<div class='sections'>
			<div class='formdivider'>";
		  echo "<label class='labelTxtSearch'>Date</label>";
		  echo "<div class='rangePicker futureRange'>
			<label for='range1'>From:</label>
			<input type='text' name='range1' id='range1' value='".$lastYear."' />
			<label for='range1'>To:</label>
			<input type='text' name='range2' name='range2' value='".date('m/d/Y')."' />
			</div>";	
		  echo "</div>";
		  echo "<div class='formdivider'>";
		  echo "<label class='labelTxtSearch'>City</label>";
		  echo "<input type='text' class='inputTxtSearch' name='city' id='city' value='SAN ANTONIO'></input>";	
		  echo "</div></div>";
		  echo "<div class='sections'><div class='formdivider'>";
		  echo "<label class='labelTxtSearch'>State</label>";
		  echo "<input type='text' class='inputTxtSearch' name='state' id='state' value='TX'></input>";	
		  echo "</div>";
		  echo "<div class='formdivider'>";
		  echo "<label class='labelTxtSearch'>Zipcode</label>";
		  echo "<input type='text' class='inputTxtSearch' name='zipcode' id='zipcode' value='78253'></input>";	
		  echo "</div></div>";
		  echo "<a href='#' id='submitForm'></a>";
		  echo "<br>";
	  ?>
	  </div>
	</div>
	

	<div id='guage-wrapper'>
	  <div class="firstGuageGroup">
	    <div class="header" id="ZipLabel">
	   <?php echo $_SESSION['zip']." Median Price"; ?>
	    </div>
		<div class='guage-div' style='margin-left:0px;'>
			<div id="jGaugeDemo1" class="jgauge"></div>
			<div class="min-max">
				<div class='min-max-left'>Min - $70,208</div>
				<div class='min-max-right'>Max - $270,208</div>
			</div>
			<div class='guage_calculation'>
			  <span class='saleMedianZipValue'></span>
			</div>
		</div>
		<div class='downstrategy'>
		    <div class='downTxt'>Down</div>
			<div class='seperator'></div>
			<div class='upStrategy' id="firstgauageStrategy">
			  <span class='strategyPercentageZip'></span>
			</div>
		</div>
	  </div>
	  <div class="secondGuageGroup">
	    <div class="header" id="CityValue">
	      SAN ANTONIO Median Price
	    </div>
		<div class='guage-div'>
		    <div id="jGaugeDemo2" class="jgauge"></div>
			  <div class="min-max">
				  <div class='min-max-left'>Min - $70,208</div>
				  <div class='min-max-right'>Max - $270,208</div>
			</div>
			<div class='guage_calculation'>
			  <span class='saleMedianCityValue'></span>
			</div>
		</div>
		<div class='downstrategy'>
		    <div class='downTxt'>Down</div>
			<div class='seperator'></div>
			<div class='upStrategy' id="secondgauageStrategy">
			  <span class='strategyPercentageCity'></span>
			</div>
		</div>
	  </div>
		<div class='guage_description' style='margin-left:0px;'>Median Sold Price Last 12 month Avg</div>
		<div class='guage_description_down'>Previous 12 mos. <span class='prev12MonStrategy'></span></div>
		<div class='guage_description'>Median SA Price</div>
		<div class='guage_description_down'>SA Previous 12 Months, <span class='prev12MonStrategyCity'></span></div>
	</div>
	
	<!--Statistics Section -->
	<div id='statistics-wrapper'>
		<div class='statistics-box' style='margin-left:0px;'>
		  <div class="statisticsboxHeader">
		    Avg. $ / Ft.(6 mos)
		  </div>
		  <div class='upStrategyOuter' id="firstStrategyOuter">
		    <span id='perFootLast12Months' class="strategyPercentage"></span>
		  </div>
		</div>
		<div class='statistics-box'>
		  <div class="statisticsboxHeader">
		    # Sold Homes
		  </div>
		  <div class="upStrategyOuter" id="firstsubStrategyOuter">
		    <span id='soldHomeInDate' class="strategyPercentage"></span>
		  </div>
		</div>
		<div class='statistics-box'>
		  <div class="statisticsboxHeader">
		    Sold Hms Last Yr.
		  </div>
		    <div class='upStrategyOuter' id="secondStrategyOuter">
			  <span id='soldDifferenceWithLastYear' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='statistics-box'>
		  <div class="statisticsboxHeader">
		    Days on Market
		  </div>
		    <div class="strategyOuter">
			  <span id='avgDifferenceWithLastYearAndCurrentYear' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='statistics-box'>
		  <div class="statisticsboxHeader">
		    DOM Last Yr.
		  </div>
			<div class='upStrategyOuter' id="thirdStrategyOuter">
			  <span id='avg_difference' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='statistics-box'>
		  <div class="statisticsboxHeader">
		    Avg. Home Size
		  </div>
			<div class="strategyOuter">
			  <span id='soldAvgSqft' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='guage_description_panel2' id="guage_description_panel1" style='margin-left:0px;'></div>
		<div class='guage_description_panel2' id="guage_description_panel2">Number of Sold Homes in [Date]</div>
		<div class='guage_description_panel2'>Number of Sold Homes Same Period Last Yr</div>
		<div class='guage_description_panel2'>Avg. # Days on Market Last 6 Months (Solds).</div>
		<div class='guage_description_panel2'>Avg. # Days on Market Same Period Last Yr.</div>
		<div class='guage_description_panel2'>Average Sq. Ft. Last 12 Months</div>
	</div>
	<div class="bottom-left-panel">
	  <div id='video-wrapper'>
	    
	      <div class='video-panel'>
		<?php
		echo $youtube_data[0]['tab_dashboard_content']['field_value'];
		?>
	      </div>
	      <div class='text-panel'>
		<?php
		  echo $dashboardData[0]['tab_dashboard_content']['field_value'];
		?>
	      </div>
	      <div class="rssReed">
		<div class='rssFeed1'>
		  <?php
		  //echo $rssFieldData_left[0]['tab_dashboard_content']['field_value'];
		  
		  //$url = urlencode($rssFieldData_left[0]['tab_dashboard_content']['field_value']);
		  //$this->requestAction('/Dashboard/readingRss/'.$url);
		  ?>
		</div>
		<div class='rssFeed2'>
		  <?php
		  //echo $rssFieldData_right[0]['tab_dashboard_content']['field_value'];
		  
		  //$url = urlencode($rssFieldData_right[0]['tab_dashboard_content']['field_value']);
		  //$this->requestAction('/Dashboard/readingRss/'.$url);
		  ?>
		</div>
	      </div>
	    </div>
	</div>
	  <div class="bottom-right-panel">
	    <div class='chart-panel'>
	      <div id="chart-render" style="min-width: 400px; height: 500px; margin: 0 auto"></div>
	    </div>
	  </div>
	  <div class="bottomleft">
	    <a href="<?php
	 echo  Router::url(array('controller' => 'DashboardImports', 'action' => 'dashboardAdd'));?>">Click to change youtube data</a>
	  </div>
<div class="bottomright">
  
	  <a href="<?php
	 echo  Router::url(array('controller' => 'DashboardImports', 'action' => 'dashboardimport'));?>">Click to Upload.XLS File</a>
	</div>
