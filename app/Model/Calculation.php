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
    private $__extrafieldValue;
    
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
        $fromDate='';
        $toDate='';
        //This Function will Split the index name as variable name with values.        
        extract($parameters);
        
        $this->__fromDate = $fromDate;
        $this->__toDate = $toDate;
        $this->__fieldValue = $fieldValue;
        $this->__fieldName = $fieldName;
        $this->__tableName = $tableName;
        $this->__selectFiledName = $selectFieldName;
        $this->__extrafieldValue = $extrafieldValue;
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
                                    ".$this->__fieldName.",COUNT(*) as TOTALRECORD, MIN(".$this->__selectFiledName.") AS MIN
                                    , MAX(".$this->__selectFiledName.") AS MAX
                                    FROM ".$this->__tableName." WHERE ".$this->__fieldName."='".$this->__fieldValue."'
                                    AND MONTH_YEAR BETWEEN '".$this->__fromDate."' AND '".$this->__toDate."'";
        
        //echo $medianPrice2Yearsquery."</br></br>";
        
        $medianPrice2YearsResult = $this->query($medianPrice2Yearsquery);
        
        $medianSoldPriceLast12Months['MAXValue'] = $medianPrice2YearsResult[0][0]['MAX'];
        $medianSoldPriceLast12Months['MINValue'] = $medianPrice2YearsResult[0][0]['MIN'];
        
        $medianSoldPriceLast12Months['Value'] = $medianPrice2YearsResult[0][0]['TOTALMEDIANAMOUNT']/$medianPrice2YearsResult[0][0]['TOTALRECORD'];
        
        //print_r($medianSoldPriceLast12Months);
        
        //exit;
        
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
    public function groupBymonthWiseWithDifferentYears($zip = null){
        
        $monthName = array("1"=>"JAN","2"=>"FEB","3"=>"MAR","4"=>"APR","5"=>"MAY","6"=>"JUN","7"=>"JUL","8"=>"AUG","9"=>"SEP","10"=>"OCT","11"=>"NOV","12"=>"DEC");
        
        $medianPriceWithGroupbyMonthAndYearquery = "SELECT sum(".$this->__selectFiledName.") as MONTHLYTOTAL, month(".$this->__fieldName.") as MONTH, 
                                    year(".$this->__fieldName.") as YEAR FROM ".$this->__tableName." WHERE ZIP_CODE_AREA='".$zip."'
                                    GROUP BY month(".$this->__fieldName.") , year(".$this->__fieldName.") ORDER BY month_year";
        
        
        //echo  $medianPriceWithGroupbyMonthAndYearquery;
        
        $medianPriceWithGroupbyMonthAndYearResult = $this->query($medianPriceWithGroupbyMonthAndYearquery);
        for($i=0;$i<count($medianPriceWithGroupbyMonthAndYearResult);$i++){
            $yearVal = substr($medianPriceWithGroupbyMonthAndYearResult[$i][0]['YEAR'], 2);
            $medianPriceFinal['monthlytotal'][] = (int)$medianPriceWithGroupbyMonthAndYearResult[$i][0]['MONTHLYTOTAL'];
            $medianPriceFinal['monthYear'][]    = $yearVal." ".$monthName[$medianPriceWithGroupbyMonthAndYearResult[$i][0]['MONTH']];
        }
        return $medianPriceFinal;
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
        
        //echo $this->__fromDate;
        //echo $this->__toDate;
        $month = date("m",strtotime($this->__toDate));
        $year = date("Y",strtotime($this->__toDate));

        
        $lastYearSameMonthgetQuery = "SELECT (SELECT SUM(".$this->__selectFiledName.")
                                        FROM ".$this->__tableName." WHERE YEAR(".$this->__fieldName.") = '".$year."'
                                        AND MONTH(".$this->__fieldName.") = '".$month."' AND ZIP_CODE_AREA='".$this->__extrafieldValue."') as CURRENTYEAR,
                                        SUM(".$this->__selectFiledName.") as LASTYEAR,
                                        ((SELECT SUM(".$this->__selectFiledName.") 
                                        FROM ".$this->__tableName." WHERE YEAR(".$this->__fieldName.") = '".$year."' AND
                                        MONTH(".$this->__fieldName.") = '".$month."' AND ZIP_CODE_AREA='".$this->__extrafieldValue."') - SUM(".$this->__selectFiledName.")) as DIFFERENCE FROM ".$this->__tableName."
                                        WHERE YEAR(".$this->__fieldName.") = '".$this->__fieldValue['year']."'
                                        AND MONTH(".$this->__fieldName.") = '".$this->__fieldValue['month']."' AND ZIP_CODE_AREA='".$this->__extrafieldValue."'";
        
        //echo $lastYearSameMonthgetQuery;
        
        $lastYearSameMonthgetResult = $this->query($lastYearSameMonthgetQuery);
        
        return $lastYearSameMonthgetResult;
        
    }
    
    
}


?>