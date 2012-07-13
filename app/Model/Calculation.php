<?php

class Calculation extends AppModel{
    
    // {{{ Properties
    /**
     * Model access name
     *
     * @access public
     * @var string
     */
    var $name = 'Calculation';
    /**
     * Variable $useTable used for use external table or without table 
     *
     * @access public
     * @var string
     */
    var $useTable = false;
    
    private $__fromDate;
    private $__toDate;
    private $__zipCode;
    
    // {{{ setData()
    /**
     * Used For Set the Private member Values
     *
     * @access  Public
     * @param $FromDate, $ToDate, $ZipCode
     *
     * @return no return type
     */
    public function setData($FromDate, $ToDate, $ZipCode) {
        
        $this->__fromDate = $FromDate;
        $this->__toDate = $ToDate;
        $this->__zipCode = $ZipCode;
        
    }
    // {{{ CalculateMedian12months()
    /**
     * Used for Calculate the amount for Last 12 months
     *
     * @access Public
     *
     * @return array value with 
     */
    function CalculateMedian12months(){
        
        $MedianPrice2Yearsquery = "select sum(for_sale_median) as TotalMedianAmount,zip_code,count(*) as TotalRecord
                                    from tab_median_price_2years where zip_code='".$this->__zipCode."' and month_year
                                    between '".$this->__fromDate."' and '".$this->__toDate."'";
        
        $MedianPrice2YearsResult = $this->query($MedianPrice2Yearsquery);
        
        $MedianSoldPriceLast12Months = $MedianPrice2YearsResult[0][0]['TotalMedianAmount']/$MedianPrice2YearsResult[0][0]['TotalRecord'];
        
        //print_r($MedianSoldPriceLast12Months);
        
       return $MedianSoldPriceLast12Months;
    }
    
}


?>