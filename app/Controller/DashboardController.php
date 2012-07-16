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
     
     $parameters = array();
     $returnValues = array();
     extract($args);
     
     //Current Year Date
     $currentYear = date('Y-m-d');
     
     // $date = date('Y-m-d',strtotime('2010-01-01 -1 year'));
     $lastyear = strtotime("-1 year", strtotime($currentYear));
     
     // format and display the computed date
     $lastYear = date("Y-m-d", $lastyear);
     
     $lastYearTotalSum = "";
     $lastYearTotalDivider = "";
     
     $previouslastyear = strtotime("-1 year", strtotime($lastYear));
     
     $previousLastYear = date("Y-m-d", $previouslastyear);
     
     $lastYears = array($lastYear, $previousLastYear);
     
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
     $returnValues['avg_of_lastYear_and_previousLastYear'] = $lastYearTotalSum/$lastYearTotalDivider;
     
     return $returnValues;
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
     $args['fieldValue']        = '23445';
     
     $finalInputToJson['soldSqft'] = $this->index($args);
     
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

