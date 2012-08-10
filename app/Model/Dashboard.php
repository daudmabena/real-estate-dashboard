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
	    function importMedianPrice2Yrs($tableName, $medianPrice2Yrs, $city, $state, $zipcode, $zipcodearea){

		$forSaleMedian = substr( $medianPrice2Yrs[1], 1 );
		$forSaleMedian = str_replace(',', '', $forSaleMedian);
	    
		$soldMedian = substr( $medianPrice2Yrs[2], 1 );
		$soldMedian = str_replace(',', '', $soldMedian);
			
		$query = "INSERT INTO $tableName (
			    zip_code, for_sale_median, sold_median, sold, average_dom, month_year, city, state,zip_code_area)
			    VALUES('$zipcode', '$forSaleMedian', $soldMedian, '$medianPrice2Yrs[3]', '$medianPrice2Yrs[4]', '$medianPrice2Yrs[0]', '$city', '$state','$zipcodearea')";

		$rs = $this->query($query);
			
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
	    function importMedianForSoldPriceSqft($tableName, $medianForSoldPriceSqft, $city, $state, $zipcode, $zipcodearea){
	    
		$fsAvg = substr( $medianForSoldPriceSqft[3], 1 );
		$fsAvg = str_replace(',', '', $fsAvg);

		$query = "INSERT INTO $tableName (for_sold_avg_sqft , for_sold_sqft, month_year, zip_code, city, state, zip_code_area)
						VALUES('$medianForSoldPriceSqft[2]', '$fsAvg', '$medianForSoldPriceSqft[1]','$zipcode', '$city', '$state','$zipcodearea')";
	
		$rs = $this->query($query);
	    
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
	    function getFieldDatas($fieldName){
			
		$getFieldQuery = "SELECT * FROM `tab_dashboard_content` WHERE field_name='".$fieldName."'";
		$getfieldData = $this->query($getFieldQuery);
		return $getfieldData;
	    
	    }
	    // {{{ insertDashboardData()
	    /**
	     * Used for update particular field value with fieldname
	     *
	     * @access  Public
	     * @param array $data
	     *
	     * @return boolean
	     */
	    function insertDashboardData($data){
		extract($data);
		$query = "update `tab_dashboard_content` set field_value='".$fieldValue."' WHERE field_name='".$selectedFieldValue."'";
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
		$this->query('truncate table `tab_median_1price_2years`');
		$this->query('truncate table `tab_median_noprice_2years`');
		$this->query('truncate table `tab_median_price_2years`');
		$this->query('truncate table `tab_media_forsale_sqft`');
		$this->query('truncate table `tab_media_sold_sqft`');
	    }
	
}
?>