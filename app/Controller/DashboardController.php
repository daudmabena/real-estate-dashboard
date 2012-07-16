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
   //var $uses = array('Dashboard');
   
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

