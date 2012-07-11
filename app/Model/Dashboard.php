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
    
    function importMedianPrice2Yrs($tableName, $medianPrice2Yrs){
		$forSaleMedian = substr( $medianPrice2Yrs[1], 1 );
		$forSaleMedian = str_replace(',', '', $forSaleMedian);

		$soldMedian = substr( $medianPrice2Yrs[3], 1 );
		$soldMedian = str_replace(',', '', $soldMedian);
		
		$query = "INSERT INTO $tableName (
					  zip_code, for_sale_median, for_sale, sold_median, sold, average_dom, month_year)
					  VALUES('78253', '$forSaleMedian', '$medianPrice2Yrs[2]', 
					  '$soldMedian', '$medianPrice2Yrs[4]', '$medianPrice2Yrs[5]', '$medianPrice2Yrs[0]')";
		$rs = $this->query($query);

        return true;
    }
}
?>