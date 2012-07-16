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
   public function index(){
     
     $parameters = array();
     
     //Current Year Date
     $currentYear = date('Y-m-d');
     
     // $date = date('Y-m-d',strtotime('2010-01-01 -1 year'));
     $lastyear = strtotime("-1 year", strtotime($currentYear));
     
     // format and display the computed date
     $lastYear = date("Y-m-d", $lastyear);
     
     // ZipCode of city
     $zipCode = '12207';
     $city = 'Albany';
     $lastYearTotalSum = "";
     $lastYearTotalDivider = "";
     
     $previouslastyear = strtotime("-1 year", strtotime($lastYear));
     
     $previousLastYear = date("Y-m-d", $previouslastyear);
     
     $lastYears = array($lastYear, $previousLastYear);
     
     $countYears = count($lastYears);
     
     //Array Value for Parameters of tableNAme, fieldName, zipCode, fromDate and toDate
          
     $parameters['fieldName'] = 'zip_code';
     $parameters['selectFieldName'] = 'for_sale_median';
     $parameters['tableName'] = 'tab_median_price_2years';
     
     if($parameters['fieldName'] == "zip_code"){
          $parameters['fieldValue'] = $zipCode;
     }
     else if($parameters['fieldName'] == "city"){
          $parameters['fieldValue'] = $city;
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
          }
          //Getting Sum of total year with last Two Years
          echo $lastYearValue."</br>";
          $lastYearTotalSum += $lastYearValue;
          //$countYears--;
     }
     echo $lastYearTotalSum/$lastYearTotalDivider;
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

