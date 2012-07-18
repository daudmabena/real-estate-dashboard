<?php

class DashboardController extends AppController {
   // {{{ Properties
   /**
    * Controller access name
    *
    * @access public
    * @var string
    */
   var $name = 'Dashboard';
   // {{{ Properties
   /**
    * Controller access uses
    *
    * @access public
    * @var string
    */
   var $uses = array('Dashboard','Calculation');
   
   // {{{ method
   /**
    * Controller method Index()
    *
    */
   public function index($args){
     
     extract($args);
     
     $parameters = array();
     $returnValues = array();
     $lastYearTotalSum = "";
     $lastYearTotalDivider = "";
     
     //Current Year Date
     $currentYear = date('Y-m-d');
     
     //Calling the getDatePreviousYearandLastPreviousYear() for GetLast two years from Current date...
     $lastYears = $this->getDatePreviousYearandLastPreviousYear($currentYear);
     
     //Get the array count of Years
     $countYears = count($lastYears);
     
     //Array Value for Parameters of tableNAme, fieldName, zipCode, fromDate and toDate
          
     $parameters['fieldName'] = $fieldName;
     $parameters['selectFieldName'] = $selectedFieldName;
     $parameters['tableName'] = $tableName;
     
     if($parameters['fieldName'] == "zip_code"){
          $parameters['fieldValue'] = $fieldValue;
     }
     else if($parameters['fieldName'] == "city"){
          $parameters['fieldValue'] = $fieldValue;
     }
     
     for($i=0; $i<$countYears; $i++){
          if($i == 0){
               $parameters['fromDate'] = $lastYears[0];
               $parameters['toDate'] = $currentYear;
          }
          else{
               $parameters['fromDate'] = $lastYears[1];
               $parameters['toDate'] = $lastYears[0];
          }
          $this->Calculation->setData($parameters);
          $lastYearValue = $this->Calculation->calculateMedian12months();
          
          if($i == 1){
               //Getting Divider here
               $lastYearTotalDivider = $lastYearValue;
               $returnValues['previousLastYear'] = $lastYearTotalDivider;
          }
          else{
               $returnValues['lastYear'] = $lastYearValue;
          }
          
          //Getting Sum of total year with last Two Years
          $lastYearTotalSum += $lastYearValue;
          //$countYears--;

          
     }
     $returnValues['totalOfLastTwoYearsData'] = $lastYearTotalSum;
     $returnValues['avg_of_lastYear_and_previousLastYear'] = $lastYearTotalSum/$lastYearTotalDivider;
     
     return $returnValues;
     $this->autoRender = false;
   }
   
   
   function getDatePreviousYearandLastPreviousYear($currentYear = null){
     
     // $date = date('Y-m-d',strtotime('2010-01-01 -1 year'));
     $lastyear = strtotime("-1 year", strtotime($currentYear));
     
     // format and display the computed date
     $lastYear = date("Y-m-d", $lastyear);
      
     //Get Second Prevoius Year from Last Year
     $previouslastyear = strtotime("-1 year", strtotime($lastYear));
     
     // format and display the computed date
     $previousLastYear = date("Y-m-d", $previouslastyear);
     
     $lastYears = array($lastYear, $previousLastYear);
     
     return $lastYears;
   }
   
   
   function getSameMonthDateOfLastYear($args = null){
     
     //print_r($ar)
     
     extract($args);
     $finalResult = array();
     
     //Current Year Date
     $currentYear = date('Y-m-d');
     
     //Calling the getDatePreviousYearandLastPreviousYear() for GetLast two years from Current date...
     $lastTwoYearsDates = $this->getDatePreviousYearandLastPreviousYear($currentYear);
     
     $parameters['fieldName']           = $fieldName;
     $parameters['selectFieldName']     = $selectedFieldName;
     $parameters['tableName']           = $tableName;
     
     $getMonthOfLastYear = date_parse_from_format('Y-m-d',$lastTwoYearsDates[0]);
     
     /*$parameters['fieldName']           = 'month_year';
     $parameters['selectFieldName']     = 'sold';
     $parameters['tableName']           = 'tab_median_price_2years';*/
     $parameters['fieldValue']          = $getMonthOfLastYear;
     
     $this->Calculation->setData($parameters);
     $lastYearValue = $this->Calculation->getSameDateOfLastYear();
     
     $finalResult['currentYear'] = $lastYearValue[0][0]['CURRENTYEAR'];
     $finalResult['lastYear']    = $lastYearValue[0][0]['LASTYEAR'];
     $finalResult['difference']  = $lastYearValue[0][0]['DIFFERENCE'];
     $finalResult['changes']     = $lastYearValue[0][0]['DIFFERENCE']/$lastYearValue[0][0]['CURRENTYEAR'];
     
     return $finalResult;
     
     $this->autoRender = false;
     
   }
   
   
   function getJsonFormat(){
     
     $args = array();
     $finalInputToJson = array();
     
     /* This is For Sale For Median in tab_median_price_2years*/
     
     $args['selectedFieldName'] = 'for_sale_median';
     $args['tableName']         = 'tab_median_price_2years';
     $args['fieldName']         = 'zip_code';
     $args['fieldValue']        = '12207';
     
     $finalInputToJson['saleMedian'] = $this->index($args);
     
     /* This is For Sold for Median in tab_median_price_2years*/
     
     $args['selectedFieldName'] = 'sold_median';
     $args['tableName']         = 'tab_median_price_2years';
     $args['fieldName']         = 'zip_code';
     $args['fieldValue']        = '12207';
     
     $finalInputToJson['soldMedian'] = $this->index($args);
     
     /* This is For Sold for SQFT in tab_media_sold_sqft*/
     
     $args['selectedFieldName'] = 'for_sold_sqft';
     $args['tableName']         = 'tab_media_sold_sqft';
     $args['fieldName']         = 'zip_code';
     $args['fieldValue']        = '12207';
     
     $finalInputToJson['soldSqft'] = $this->index($args);
     
     /*This is For get the Last Year amount of current month*/
     
     $args['fieldName']           = 'month_year';
     $args['selectedFieldName']   = 'sold';
     $args['tableName']           = 'tab_median_price_2years';
     
     $finalInputToJson['soldDifferenceWithLastYearAndCurrentYear'] = $this->getSameMonthDateOfLastYear($args);
     
     /*This is For get the Last Year Avg amount of current month*/
     
     $args['fieldName']           = 'month_year';
     $args['selectedFieldName']   = 'average_dom';
     $args['tableName']           = 'tab_median_price_2years';
     
     $finalInputToJson['avgDifferenceWithLastYearAndCurrentYear'] = $this->getSameMonthDateOfLastYear($args);
     
     
    /* This is For Sold for Avg SQFT in tab_media_sold_sqft*/
     
     $args['selectedFieldName'] = 'for_sold_avg_sqft';
     $args['tableName']         = 'tab_media_sold_sqft';
     $args['fieldName']         = 'zip_code';
     $args['fieldValue']        = '12207';
     
     $finalInputToJson['soldAvgSqft'] = $this->index($args);
     
     //Group by of Month and YearWise     
     
     $args['selectFieldName'] = 'sold_median';
     $args['tableName']         = 'tab_median_price_2years';
     $args['fieldName']         = 'month_year';
     //$args['fieldValue']        = '12207';
     
     $this->Calculation->setData($args);
     $finalInputToJson['groupByMonthAndYearForMedian'] = $this->Calculation->groupBymonthWiseWithDifferentYears();

     echo json_encode($finalInputToJson);
     $this->autoRender = false;
   }
   
   
   // {{{ method
   /**
    * Controller method dashboardImport()
    *
    */
   public function dashboard(){
        $this->render('dashboard');
   }
   
   
}
?>

