<?php
class Dashboard extends AppModel {
	    // {{{ Properties
	    /**
	     * Model access name
	     *
	     * @access public
	     * @var string
	     */
	    var $name = 'Dashboard';
	    
	    /**
	     * Table name used for ATS import cron  (scheduled for batch processing) 
	     *
	     * @access public
	     * @var string
	     */
	    var $useTable = false;
		
	    // {{{ importMedianPrice2Yrs()
	    /**
	     * Used for importmedianprice for 2 years
	     *
	     * @access  Public
	     * @param array $medianPrice2Yrs
	     *
	     * @return boolean
	     */
	    function importMedianPrice2Yrs($tableName, $medianPrice2Yrs, $city, $state, $zipcodearea, $uploadType){
	    
		$forSaleMedian = substr( $medianPrice2Yrs[1], 1 );
		$forSaleMedian = str_replace(',', '', $forSaleMedian);

		$soldMedian = substr( $medianPrice2Yrs[2], 1 );
		$soldMedian = str_replace(',', '', $soldMedian);

		$medianPrice2Yrs[9] = str_replace("*","",$medianPrice2Yrs[9]);
		$medianPrice2Yrs[9] = trim($medianPrice2Yrs[9]);
		
		if($uploadType == 1){
		    $query = "INSERT INTO $tableName (
				`median_min`,
				`median_max`,
				`median_price_avg_last_six_months`,
				`median_price_avg_previous_six_months`,
				`median_change_percent`,
				`san_antonio_min_median`,
				`san_antonio_max_median`,
				`san_antonio_median_last_six_months`,
				`san_antonio_median_previous_six_months`,
				`SA_median_change_persent`,
				`avg_ft_last_six_month`,
				`avg_ft_previous_six_month`,
				`sold_homes`,
				`sold_homes_same_period_last_yr`,
				`sold_homes_incre_or_decre`,
				`avg_days_on_market`,
				`avg_days_on_market_same_period_last_yr`,
				`avg_days_on_market_incre_or_decre`,
				`avg_home_size_last_six_months`,
				`zipcode`)
				VALUES('$medianPrice2Yrs[0]',
					'$medianPrice2Yrs[1]',
					'$medianPrice2Yrs[2]',
					'$medianPrice2Yrs[3]',
					'$medianPrice2Yrs[4]',
					'$medianPrice2Yrs[5]',
					'$medianPrice2Yrs[6]',
					'$medianPrice2Yrs[7]',
					'$medianPrice2Yrs[8]',
					'$medianPrice2Yrs[9]',
					'$medianPrice2Yrs[10]',
					'$medianPrice2Yrs[11]',
					'$medianPrice2Yrs[12]',
					'$medianPrice2Yrs[13]',
					'$medianPrice2Yrs[14]',
					'$medianPrice2Yrs[15]',
					'$medianPrice2Yrs[16]',
					'$medianPrice2Yrs[17]',
					'$medianPrice2Yrs[18]',
					'$zipcodearea')";
		    //echo $query;
		    //exit;
		    $rs = $this->query($query);
		}
		else if($uploadType == 2){
		    $query = "INSERT INTO $tableName (
				for_sale_median, sold_median, sold, average_dom, month_year, city, state)
				VALUES('$forSaleMedian', '$soldMedian', '$medianPrice2Yrs[3]', '$medianPrice2Yrs[4]', '$medianPrice2Yrs[0]', '$city', '$state')";
    
		    $rs = $this->query($query);   
		}
		else if($uploadType == 3){
		    $query = "INSERT INTO $tableName (
			    `price_per_sqft_over_time`,
			    `price`,
			    `solds`)
				VALUES('$medianPrice2Yrs[0]',
					'$medianPrice2Yrs[1]',
					'$medianPrice2Yrs[2]',
					'$zipcodearea')";
		    $rs = $this->query($query);   
		}

		if(!$rs){
		    $this->log("importMedianPrice2Yrs::importMedianPrice2Yrs(). Data not inserted");
		    return false;
		}
		return true;
	    }
	    
	    // {{{ importMedianPrice2YrsForCty()
	    /**
	     * Used for importmedianprice for 2 years
	     *
	     * @access  Public
	     * @param array $medianPrice2Yrs
	     *
	     * @return boolean
	     */
	    function importMedianPrice2YrsForCty($tableName, $medianPrice2Yrs, $city, $state, $zipcodearea, $uploadType){
	    
		$forSaleMedian = substr( $medianPrice2Yrs[1], 1 );
		$forSaleMedian = str_replace(',', '', $forSaleMedian);

		$soldMedian = substr( $medianPrice2Yrs[2], 1 );
		$soldMedian = str_replace(',', '', $soldMedian);

		if($uploadType == 1){
		    $query = "INSERT INTO $tableName (
				for_sale_median, sold_median, sold, month_year, zip_code_area)
				VALUES('$forSaleMedian', '$soldMedian', '$medianPrice2Yrs[3]', '$medianPrice2Yrs[0]', '$zipcodearea')";
    
		    $rs = $this->query($query);
		}
		else if($uploadType == 2){
		    $query = "INSERT INTO $tableName (
				for_sale_median, sold_median, sold, month_year, city, state)
				VALUES('$forSaleMedian', '$soldMedian', '$medianPrice2Yrs[3]', '$medianPrice2Yrs[0]', '$city', '$state')";
    
		    $rs = $this->query($query);   
		}

		if(!$rs){
		    $this->log("importMedianPrice2Yrs::importMedianPrice2Yrs(). Data not inserted");
		    return false;
		}
		return true;
	    }
	
	    // {{{ importMedianNoPrice2Yrs()
	    /**
	     * Used for importmedian for no price 2 years
	     *
	     * @access  Public
	     * @param array $medianNoPrice2Yrs
	     *
	     * @return boolean
	     */
	    function importMedianNoPrice2Yrs($tableName, $medianNoPrice2Yrs, $city, $state, $zipcode, $zipcodearea){
			
		$soldMedian = str_replace('%', '', $medianNoPrice2Yrs[2]);
		$query = "INSERT INTO $tableName (
			    month_year, zip_code, sold, avg_sp_op, avg_dom, city, state, zip_code_area)
			    VALUES('$medianNoPrice2Yrs[0]', '$zipcode', '$medianNoPrice2Yrs[1]', 
			    '$soldMedian', '$medianNoPrice2Yrs[3]', '$city', '$state','$zipcodearea')";
						  
		$rs = $this->query($query);
			
		if(!$rs){
		    $this->log("importMedianNoPrice2Yrs::importMedianNoPrice2Yrs(). Data not inserted");
		    return false;
		}
		return true;
	    }
	
	    // {{{ importMedian1Price2Yrs()
	    /**
	     * Used for importmedian for +1 price 2yrs
	     *
	     * @access  Public
	     * @param array $median1Price2Yrs
	     *
	     * @return boolean
	     */
	    function importMedian1Price2Yrs($tableName, $median1Price2Yrs, $city, $state, $zipcode, $zipcodearea){
			
		$soldMedian = str_replace('%', '', $median1Price2Yrs[2]);
		$query = "INSERT INTO $tableName (
			    month_year, zip_code, sold, avg_sp_op, avg_dom, city, state, zip_code_area)
			    VALUES('$median1Price2Yrs[0]', '$zipcode', '$median1Price2Yrs[1]', 
			    '$soldMedian', '$median1Price2Yrs[3]', '$city', '$state', '$zipcodearea')";
	    
		$rs = $this->query($query);
	    
		if(!$rs){
		    $this->log("importMedian1Price2Yrs::importMedian1Price2Yrs(). Data not inserted");
		    return false;
		}
		return true;
	    }
	
	    // {{{ importMedianForSalePriceSqft()
	    /**
	     * Used for import median for sale price sqft
	     *
	     * @access  Public
	     * @param array $medianForSalePriceSqft
	     *
	     * @return boolean
	     */
	    function importMedianForSalePriceSqft($tableName, $medianForSalePriceSqft, $city, $state, $zipcode, $zipcodearea){
	    
		$fsAvg = substr( $medianForSalePriceSqft[2], 1 );
		$fsAvg = str_replace(',', '', $fsAvg);
	    
		$query = "INSERT INTO $tableName (
						month_year, for_sale, for_sale_avg, for_sale_avg_sqft, for_sale_sqft, zip_code, city, state, zip_code_area)
						VALUES('$medianForSalePriceSqft[0]', '$medianForSalePriceSqft[1]', 
						'$fsAvg', '$medianForSalePriceSqft[3]', '$medianForSalePriceSqft[4]', '$zipcode', '$city', '$state','$zipcodearea')";
	    
		$rs = $this->query($query);
	    
		if(!$rs){
		    $this->log("importMedianForSalePriceSqft::importMedianForSalePriceSqft(). Data not inserted");
		    return false;
		}
		return true;
	    }
		
		
		// {{{ importMedianForSoldPriceSqft()
	    /**
	     * Used for import median for sold price sqft
	     *
	     * @access  Public
	     * @param array $medianForSoldPriceSqft
	     *
	     * @return boolean
	     */
	    function importMedianForSoldPriceSqft($tableName, $medianForSoldPriceSqft, $city, $state, $zipcodearea, $uploadType){
	    
		$fsAvg = substr( $medianForSoldPriceSqft[3], 1 );
		$fsAvg = str_replace(',', '', $fsAvg);
		if($uploadType == 1){
		    $query = "INSERT INTO $tableName (for_sold_avg_sqft , for_sold_sqft, month_year, zip_code_area)
		    				VALUES('$medianForSoldPriceSqft[2]', '$fsAvg', '$medianForSoldPriceSqft[1]','$zipcodearea')";
	
		    $rs = $this->query($query);
		}
		else if($uploadType == 2){
		    $query = "INSERT INTO $tableName (for_sold_avg_sqft , for_sold_sqft, month_year, city, state)
		    				VALUES('$medianForSoldPriceSqft[2]', '$fsAvg', '$medianForSoldPriceSqft[1]','$city', '$state')";
	
		    $rs = $this->query($query);
		}
	    
		if(!$rs){
		    $this->log("importMedianForSoldPriceSqft::importMedianForSoldPriceSqft(). Data not inserted");
		    return false;
		}
		return true;
	    }
		

	    
	    function getStateCode($stateTxt){
		    
		    $query = "SELECT DISTINCT state from tab_zip_codes where state LIKE '%$stateTxt%'";
		    $rs = $this->query($query);
			    
		    if(!$rs){
			    $this->log("getStateCode::getStateCode(). No data found");
			    return false;
		    }
			    
		    foreach ($rs as $r){
			    $stateCode[] = $r['tab_zip_codes']['state'];
		    }
		    
		    return $stateCode;
	    }
	
	    function getCityCode($cityTxt, $selectedStateCode){
		    
		    $query = "SELECT DISTINCT city FROM tab_zip_codes WHERE state='$selectedStateCode' AND city LIKE '%$cityTxt%'";
		    $rs = $this->query($query);
			    
		    if(!$rs){
			    $this->log("getCityCode::getCityCode(). No data found");
			    return false;
		    }
			    
		    foreach ($rs as $r){
			    $cityCode[] = $r['tab_zip_codes']['city'];
		    }
		    
		    return $cityCode;
	    }

	
	    function getZipCodes($zipTxt, $selectedCityCode){
		    $query = "SELECT DISTINCT zipcode FROM tab_zip_codes WHERE city='$selectedCityCode' AND zipcode LIKE '%$zipTxt%'";
		    $rs = $this->query($query);
			    
		    if(!$rs){
			    $this->log("getZipCode::getZipCode(). No data found");
			    return false;
		    }
			    
		    foreach ($rs as $r){
			    $zipCode[] = $r['tab_zip_codes']['zipcode'];
		    }
		    
		    return $zipCode;
	    }
	    // {{{ getFieldDatas()
	    /**
	     * Used for get particular field value with fieldname
	     *
	     * @access  Public
	     * @param array $fieldName
	     *
	     * @return boolean
	     */
	    function getFieldDatas($fieldName,$zipcode){
			
		$getFieldQuery = "SELECT * FROM `tab_dashboard_content` WHERE field_name='".$fieldName."'
				    and zip_code_or_city='".$zipcode."'";
		$getfieldData = $this->query($getFieldQuery);
		return $getfieldData;
	    
	    }
	    // {{{ updateDashboardData()
	    /**
	     * Used for update particular field value with fieldname
	     *
	     * @access  Public
	     * @param array $data
	     *
	     * @return boolean
	     */
	    function updateDashboardData($data){
		extract($data);
		$query = "update `tab_dashboard_content` set field_value='".$fieldValue."' WHERE field_name='".$selectedFieldValue."'";
		$rs = $this->query($query);
		return $rs;
	    }
	    // {{{ insertDashboardData()
	    /**
	     * Used for update particular field value with fieldname
	     *
	     * @access  Public
	     * @param array $data
	     * @param $zipcode
	     *
	     * @return result status
	     */
	    function insertDashboardData($data){
		extract($data);
		$query = "insert into `tab_dashboard_content`(zip_code_or_city, field_name, field_value) values('".$zipcode_or_city."'
								,'".$selectedFieldValue."','".$fieldValue."')";
		$rs = $this->query($query);
		return $rs;
	    }
	    
	    // {{{ getZipCodeAreaName()
	    /**
	     * Used to get particular zipcode Areaname
	     *
	     * @access  Public
	     * @param array $zipcode
	     *
	     * @return boolean
	     */
	    function getZipCodeAreaName($zipcode){
		$query = "SELECT * FROM `tab_median_price_2years` where  `zip_code`= $zipcode ";
		$data = $this->query($query);
		$ziparea = $data[0]['tab_median_price_2years']['zip_code_area'];
		return $ziparea;
	    }
	    // {{{ truncateDashboard()
	    /**
	     * Used to truncate dashboard data
	     *
	     * @access  Public
	     *
	     * @return false
	     */
	    function truncateDashboard(){
		//$this->query('truncate table `tab_median_1price_2years`');
		//$this->query('truncate table `tab_median_noprice_2years`');
		$this->query('truncate table `tab_median_price_2years`');
		//$this->query('truncate table `tab_media_forsale_sqft`');
		$this->query('truncate table `tab_media_sold_sqft`');
	    }
	    
	    function getDateMM($typeDate, $thismonthLastDay, $sixMonthFirstDay, $oneyearFirstDay){
		$result = "";
		//echo $typeDate;
		//exit;
		if($typeDate == 0){
		    $query = "SELECT min(month_year) as minval, max(month_year) as maxval FROM tab_median_price_2years";
		    $result = $this->query($query);
		}
		else if($typeDate == 1){
		    $query = "SELECT min(month_year) as minval, max(month_year) as maxval FROM tab_median_price_2years
				where month_year  between '$sixMonthFirstDay' and '$thismonthLastDay'";
		    $result = $this->query($query);
		}
		else if($typeDate == 2){
		    $query = "SELECT min(month_year) as minval, max(month_year) as maxval FROM tab_median_price_2years
				where month_year  between '$oneyearFirstDay' and '$thismonthLastDay'";
		    $result = $this->query($query);
		}
		
		//print_r($result);
		
		$min = $result[0][0]['minval'];
		$max = $result[0][0]['maxval'];
		
		$min = date('m/d/Y',strtotime($min));
		$max = date('m/d/Y',strtotime($max));
		
		$val = $min."--".$max;
		
		return $val;
	    }
	    
	    function getDataFromDB($fieldName,$tableName,$type){
		if($type == "normalType"){
		    $query = "SELECT $fieldName FROM $tableName  GROUP BY $fieldName IS NOT NULL";
		    //echo $query;
		    $result = $this->query($query);
		}
		else if($type == "dateType"){
		    $query = "SELECT YEAR($fieldName) AS Year FROM $tableName
				GROUP BY YEAR($fieldName) ORDER BY YEAR($fieldName)";
		    $result = $this->query($query);
		}
		return $result;
	    }
	    
	    function getDashboardData($zip){
		$query = "SELECT * FROM tab_tmp_dashboard_fields WHERE zipcode='".$zip."'";
		$result = $this->query($query);
		return $result;
	    }
	
}
?>