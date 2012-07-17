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
        extract($parameters);
        
        $this->__fromDate = $fromDate;
        $this->__toDate = $toDate;
        $this->__fieldValue = $fieldValue;
        $this->__fieldName = $fieldName;
        $this->__tableName = $tableName;
        $this->__selectFiledName = $selectFieldName;
        
    }
    
    // {{{ calculateMedian12months()
    /**
     * Used for Calculate the amount for Last 12 months
     *
     * @access Public
     *
     * @return array value with 
     */
    public function calculateMedian12months(){
        
        $medianPrice2Yearsquery = "SELECT SUM(".$this->__selectFiledName.") AS TOTALMEDIANAMOUNT,
                                    ".$this->__fieldName.",COUNT(*) as TOTALRECORD
                                    FROM ".$this->__tableName." WHERE ".$this->__fieldName."='".$this->__fieldValue."'
                                    AND MONTH_YEAR BETWEEN '".$this->__fromDate."' AND '".$this->__toDate."'";
        
        //echo $medianPrice2Yearsquery."</br></br>";
        
        $medianPrice2YearsResult = $this->query($medianPrice2Yearsquery);
        
        $medianSoldPriceLast12Months = $medianPrice2YearsResult[0][0]['TOTALMEDIANAMOUNT']/$medianPrice2YearsResult[0][0]['TOTALRECORD'];
        
       return $medianSoldPriceLast12Months;
    }
    
    
    // {{{ groupBymonthWiseWithDifferentYears()
    /**
     * Used for Calculate the amount for Last 12 months
     *
     * @access Public
     *
     * @return array value with 
     */
    public function groupBymonthWiseWithDifferentYears(){
        
        $medianPriceWithGroupbyMonthAndYearquery = "SELECT sum(".$this->__selectFiledName.") as MONTHLYTOTAL, month(".$this->__fieldName.") as MONTH, 
                                    year(".$this->__fieldName.") as YEAR FROM ".$this->__tableName."
                                    GROUP BY month(".$this->__fieldName.") , year(".$this->__fieldName.")";
        
        //echo $medianPrice2Yearsquery."</br></br>";
        
        $medianPriceWithGroupbyMonthAndYearResult = $this->query($medianPriceWithGroupbyMonthAndYearquery);
        
        return $medianPriceWithGroupbyMonthAndYearResult;
    }
    
    // {{{ getSameDateOfLastYear()
    /**
     * Used for Calculate the amount of Last 12th month
     *
     * @access Public
     *
     * @return array value with 
     */
    public function getSameDateOfLastYear(){
        
        $lastYearSameMonthgetQuery = "SELECT (SELECT SUM(".$this->__selectFiledName.")
                                        FROM ".$this->__tableName." WHERE YEAR(".$this->__fieldName.") = '".date('Y')."'
                                        AND MONTH(".$this->__fieldName.") = '".date('m')."') as CURRENTYEAR,
                                        SUM(".$this->__selectFiledName.") as LASTYEAR,
                                        ((SELECT SUM(".$this->__selectFiledName.") 
                                        FROM ".$this->__tableName." WHERE YEAR(".$this->__fieldName.") = '".date('Y')."' AND
                                        MONTH(".$this->__fieldName.") = '".date('m')."') - SUM(".$this->__selectFiledName.")) as DIFFERENCE FROM ".$this->__tableName."
                                        WHERE YEAR(".$this->__fieldName.") = '".$this->__fieldValue['year']."'
                                        AND MONTH(".$this->__fieldName.") = '".$this->__fieldValue['month']."'";
        
        $lastYearSameMonthgetResult = $this->query($lastYearSameMonthgetQuery);
        
        return $lastYearSameMonthgetResult;
        
    }
    
    
}


?>