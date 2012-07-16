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
    private $__fieldValue;
    private $__tableName;
    private $__fieldName;
    private $__selectFiledName;
    
    // {{{ setData()
    /**
     * Used For Set the Private member Values
     *
     * @access  Public
     * @param $FromDate, $ToDate, $ZipCode
     *
     * @return no return type
     */
    public function setData($parameters) {
        
        //This Function will Split the index name as variable name with values.        
        extract($parameters, EXTR_PREFIX_SAME, 'dup');
        
        $this->__fromDate = $fromDate;
        $this->__toDate = $toDate;
        $this->__fieldValue = $fieldValue;
        $this->__fieldName = $fieldName;
        $this->__tableName = $tableName;
        $this->__selectFiledName = $selectFieldName;
        
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
        
        $MedianPrice2Yearsquery = "select sum(".$this->__selectFiledName.") as TotalMedianAmount,".$this->__fieldName.",count(*) as TotalRecord
                                    from ".$this->__tableName." where ".$this->__fieldName."='".$this->__fieldValue."' and month_year
                                    between '".$this->__fromDate."' and '".$this->__toDate."'";
        
        //echo $MedianPrice2Yearsquery;
        
        $MedianPrice2YearsResult = $this->query($MedianPrice2Yearsquery);
        
        $MedianSoldPriceLast12Months = $MedianPrice2YearsResult[0][0]['TotalMedianAmount']/$MedianPrice2YearsResult[0][0]['TotalRecord'];
        
        //print_r($MedianSoldPriceLast12Months);
        
       return $MedianSoldPriceLast12Months;
    }
    
}


?>