<script type="text/javascript">
$(document).ready(function() {
	//$("#state").autocomplete("<?php echo Router::url(array('controller' => 'DashboardImports','action' => 'getState'));?>", {
	//	width: 260,
	//	matchContains: true,
	//	//mustMatch: true,
	//	//minChars: 0,
	//	//multiple: true,
	//	//highlight: false,
	//	//multipleSeparator: ",",
	//	selectFirst: false
	//});
	//
	//$("#city").autocomplete("<?php echo Router::url(array('controller' => 'DashboardImports','action' => 'getCity'));?>", {
	//	width: 260,
	//	matchContains: true,
	//	//mustMatch: true,
	//	//minChars: 0,
	//	//multiple: true,
	//	//highlight: false,
	//	//multipleSeparator: ",",
	//	selectFirst: false
	//});
	
	//$("#zipcode").autocomplete("<?php echo Router::url(array('controller' => 'DashboardImports','action' => 'getZipCode'));?>", {
	//	width: 260,
	//	matchContains: true,
	//	//mustMatch: true,
	//	//minChars: 0,
	//	//multiple: true,
	//	//highlight: false,
	//	//multipleSeparator: ",",
	//	selectFirst: false
	//});
	
	//$("#state").result(function(event, data, formatted) {
	//	$("#state").val(data[0]);
	//});
	//
	//$("#city").result(function(event, data, formatted) {
	//	$("#city").val(data[0]);
	//});
	
	//$("#zipcode").result(function(event, data, formatted) {
	//	$("#zipcode").val(data[0]);
	//});
	
});
</script>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
      $("body").css("background-color","#151515");
      $('.searchContent').hide();
      var showOrHide;
      //var zipValue = $('#zipcode').val();
      //$('#ZipLabel').html(zipValue+" Median Price");
      $('#searchText').html('Search');
      $('#searchArrow').attr("class","searchDownArrow");
      
      var jsonValue;
      var zipValue = $('#zipcode').val();
//      $.ajax({
//	url: '/dashboard/getZipArea',
//	type: 'POST',
//	async: true,
//	data: "zipValue="+zipValue,
//	dataType: 'html',
//	success: function (jsonValue) {
//	  $('#searchText').html(zipValue+" "+jsonValue);
//	}
//      });
      
      
      $('.searchTxt').click(function(){
	if($(".searchContent").is(":hidden"))
	{
	  $('#searchText').html('Search');
	  $('#searchArrow').attr("class","searchDownArrow");
	}
	else{
	  //var jsonValue;
	  //var zipValue = $('#zipcode').val();
	  //$.ajax({
	  //  url: '/dashboard/getZipArea',
	  //  type: 'POST',
	  //  async: false,
	  //  data: "zipValue="+zipValue,
	  //  dataType: 'html',
	  //  success: function (jsonValue) {
	  //   
	  //    $('#searchText').html(zipValue+" "+jsonValue);
	  //  }
	  //});
	  $('#searchText').html('Search');
	  $('#searchArrow').attr("class","searchDownArrow");
	  
	}
	$('.searchContent').slideToggle(showOrHide);
      });
      
      //$('#range1').datepicker();
      //$('#range2').datepicker();

      
      $('#dateType').change(function(){
	var typeDate = $('#dateType option:selected').val();
	//alert(typeDate);
	  $.ajax({
	    url: '/dashboard/getMinAndMaxDate',
	    type: 'POST',
	    async: true,
	    data: "typeDate="+typeDate,
	    success: function (jsonValue) {
	      //alert(jsonValue);
	      var da = jsonValue.split("--");
	      
	      var dateTo = da[0].split("-");
	      $('#range1Month option[value='+dateTo[0]+']').attr('selected', 'selected');
	      $('#range1Year option[value='+dateTo[1]+']').attr('selected', 'selected')
	      
	      var dateFrom = da[1].split("-");
	      $('#range2Month option[value='+dateFrom[0]+']').attr('selected', 'selected');
	      $('#range2Year option[value='+dateFrom[1]+']').attr('selected', 'selected')
	    }
	  });
      })
      
      $('#submitForm').click(function(){
	var zipValue = $('#zipcode').val();
	$('#ZipLabel').html(zipValue+" Median Price");
	getSearchData("<?php echo Router::url(array('controller' => 'dashboard', 'action' => 'getJsonFormat'));?>",0);
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
	    </div>
	    <div class="search searchUpArrow" id="searchArrow"></div>
	  </div>
	  
    	  <div class="searchContent">
	    <div class='searchSep'></div>
	    <?php
	      echo $this->Form->create('Dashboard', array('controller' => 'Dashboard', 'action' => 'dashboard'));
	      echo "<div class='sections'>
		    <div class='formdivider'>";
	      echo "<label class='labelTxtSearch'>Date Type</label>";
	      echo "<select id='dateType' name='dateType' style='width:227px'>
		    <option value='0'>--Select--</option>
		    <option value='1'>Past 6 Months</option>
		    <option value='2'>Past 1 Year</option>
		    </select></div><div class='formdivider'>";
	      echo "<label class='labelTxtSearch' style='float:left'>Date</label>";
	      echo "<div style=''><label class='labelTxtSearch' style='float: left; width: 39px !important; padding-left:0px'>From</label>
		    <select name='range1Month' id='range1Month' style='float:left'>
		    <option value='0'>--Month--</option>
		    <option value='01'>Jan</option>
		    <option value='02'>Feb</option>
		    <option value='03'>Mar</option>
		    <option value='04'>Apl</option>
		    <option value='05'>May</option>
		    <option value='06'>Jun</option>
		    <option value='07'>Jul</option>
		    <option value='08'>Aug</option>
		    <option value='09'>Sep</option>
		    <option value='10'>Oct</option>
		    <option value='11'>Nov</option>
		    <option value='12'>Dec</option>
			</select>";
		    echo "<select name='range1Year' id='range1Year' style='float:left'>
		    <option value='0'>--Year--</option>";
		    foreach($dateRangeTo as $dateRangeTo){
		    $dateYear = $dateRangeTo[0]['Year'];
		    echo "<option value='$dateYear'>$dateYear</option>";
		    }
		    echo "</select></div><div style='clear:both; margin-left:81px;'>
		    <label class='labelTxtSearch' style='float:left; width: 39px !important;'>To</label>
		    <select name='range2Month' id='range2Month' style='float:left'>
		    <option value='0'>--Month--</option>
		    <option value='01'>Jan</option>
		    <option value='02'>Feb</option>
		    <option value='03'>Mar</option>
		    <option value='04'>Apl</option>
		    <option value='05'>May</option>
		    <option value='06'>Jun</option>
		    <option value='07'>Jul</option>
		    <option value='08'>Aug</option>
		    <option value='09'>Sep</option>
		    <option value='10'>Oct</option>
		    <option value='11'>Nov</option>
		    <option value='12'>Dec</option>
		    </select>";
	      echo "<select name='range2Year' id='range2Year' style='float:left'>
		<option value='0'>--Year--</option>";
	      foreach($dateRangeFrom as $dateRangeFrom){
		$dateYear = $dateRangeFrom[0]['Year'];
		echo "<option value='$dateYear'>$dateYear</option>";
	      }
	      echo "</select></div>";	
	      echo "</div>";
	      //echo "<div class='formdivider'>";
	      //echo "<label class='labelTxtSearch'>City</label>";
	      //echo "<input type='text' class='inputTxtSearch' name='city' id='city' value='SAN ANTONIO'></input>";	
	      //echo "</div></div>";
	      //echo "<div class='sections'><div class='formdivider'>";
	      //echo "<label class='labelTxtSearch'>State</label>";
	      //echo "<input type='text' class='inputTxtSearch' name='state' id='state' value='TX'></input>";	
	      //echo "</div>";
	      echo "<div class='formdivider'>";
	      //	      print_r($zipCode);
	      echo "<label class='labelTxtSearch'>Zipcode</label>";
	      echo "<select name='zipcode' id='zipcode' style='float:left;width:230px'>";

	      foreach($zipCode as $zipCode){
		
		$zip = $zipCode['tab_median_price_2years']['zip_code_area'];
		echo "<option value='$zip'>$zip</option>";
	      }
	    
	      echo "</select></div></div>";
	      echo "<a href='#' id='submitForm'></a>";
	      echo "<br>";
	  ?>
	  </div>
	</div>
	

	<div id='guage-wrapper'>
	  <div class="firstGuageGroup">
	    <div class="header" id="ZipLabel">
	    </div>
	    <div class="guageMeter">
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
		<div class='guage_description' style='margin-left:0px;'>Median Sold Price Avg Over Last 6 Mos.</div>
	    </div>
	    <div class="guagePercentage">
		<div class='downstrategy'>
		    <div class='downTxt' id="firstgauageStrategyLabel">Up</div>
			<div class='seperator'></div>
			<div class='upStrategy' id="firstgauageStrategy">
			  <span class='strategyPercentageZip'></span>
			</div>
		</div>
		<div class='guage_description_down'>Previous 6 Month Period : <span class='prev12MonStrategy'></span></div>
	    </div>
	  </div>
	  <div class="secondGuageGroup">
	    <div class="header" id="CityValue">
	      SAN ANTONIO Median Price
	    </div>
	      <div class="guageMeter">
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
		  <div class='guage_description'>Median SA Sold Price Avg Over Last 6 Mos.</div>
		</div>
		<div class="guagePercentage">
		<div class='downstrategy'>
		    <div class='downTxt' id="secondgauageStrategyLabel">Up</div>
			<div class='seperator'></div>
			<div class='upStrategy' id="secondgauageStrategy">
			  <span class='strategyPercentageCity'></span>
			</div>
		</div>
		<div class='guage_description_down'>Previous 6 Month Period : <span class='prev12MonStrategyCity'></span></div>
		</div>
	  </div>
	</div>
	
	<!--Statistics Section -->
	<div id='statistics-wrapper'>
		<div class="subcalc">
		  <div class='statistics-box' style='margin-left:0px;'>
		    <div class="statisticsboxHeader" id="perFootLast12MonthsLabel">
		      Avg. $ / Ft.(6 mos)
		    </div>
		    <div class='upStrategyOuter' id="firstStrategyOuter">
		      <span id='perFootLast12Months' class="strategyPercentage"></span>
		    </div>
		  </div>
		  <div class='guage_description_panel2' id="guage_description_panel1" style='margin-left:0px;'></div>
		</div>
		
		<div class="subcalc">
		<div class='statistics-box' id="soldHome">
		  <div class="statisticsboxHeader">
		    # Sold Homes
		  </div>
		  <div class="upStrategyOuter" id="firstsubStrategyOuter">
		    <span id='soldHomeInDate' class="strategyPercentage"></span>
		  </div>
		</div>
		<div class='guage_description_panel2' id="guage_description_panel2">Number of Sold Homes in [Date]</div>
		</div>
		
		<div class="subcalc">
		<div class='statistics-box' id="soldHomeLastYr">
		  <div class="statisticsboxHeader" id="soldHomeLastYrLabel">
		    Sold Hms Last Yr.
		  </div>
		    <div class='strategyOuter' id="secondStrategyOuter">
			  <span id='soldDifferenceWithLastYear' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='guage_description_panel2' id="guage_description_panel3">Number of Sold Homes Same Period Last Yr</div>
		</div>
		
		<div class="subcalc">
		<div class='statistics-box' id="daysOnMarket">
		  <div class="statisticsboxHeader">
		    Days on Market
		  </div>
		    <div class="upStrategyOuter" id="fourStrategyOuter">
			  <span id='avgDifferenceWithLastYearAndCurrentYear' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='guage_description_panel2' id="guage_description_panel4">Avg. # Days on Market Last 6 Months (Solds).</div>
		</div>
		
		<div class="subcalc">
		<div class='statistics-box' id="domLastYr">
		  <div class="statisticsboxHeader" id="domLastYrLabel">
		    DOM Last Yr.
		  </div>
			<div class='strategyOuter' id="thirdStrategyOuter">
			  <span id='avg_difference' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='guage_description_panel2' id="guage_description_panel5">Avg. # Days on Market Same Period Last Yr.</div>
		</div>
		
		<div class="subcalc">
		<div class='statistics-box'>
		  <div class="statisticsboxHeader">
		    Avg. Home Size
		  </div>
			<div class="strategyOuter">
			  <span id='soldAvgSqft' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='guage_description_panel2' id="guage_description_panel6">Average Sq. Ft. Last 12 Months</div>
		</div>
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
		  echo $rssFieldData_left[0]['tab_dashboard_content']['field_value'];
		  
		  //$url = urlencode($rssFieldData_left[0]['tab_dashboard_content']['field_value']);
		  //$this->requestAction('/Dashboard/readingRss/'.$url);
		  ?>
		</div>
		<div class='rssFeed2'>
		  <?php
		  echo $rssFieldData_right[0]['tab_dashboard_content']['field_value'];
		  
		  //$url = urlencode($rssFieldData_right[0]['tab_dashboard_content']['field_value']);
		  //$this->requestAction('/Dashboard/readingRss/'.$url);
		  ?>
		</div>
	      </div>
	    </div>
	</div>
	  <div class="bottom-right-panel">
	    <div class='chart-panel'>
	      <div id="chart-render" style="min-width: 200px; height: 500px; margin: 0 auto"></div>
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
