<?

require_once WACT_ROOT . 'controller/controller.inc.php';

class RestrictedPageController extends PageController {
   var $allowed = false;
     
   function RestrictedPageController() {
     parent::PageController();
         
     $this->registerOnLoadListener(new Delegate($this, "_restrict"));

     $this->addView("restricted", new Handle("View", array('/projects/display.html')));
//     $this->addView('restricted', new Handle('View', array("/users/login.html")));
   }
     
   function _restrict() {
     if (!$this->allowed) {
        return "restricted";
     }
   }
     
   function allow($bool) {
      $this->allowed = ($this->allowed || $bool);
   }
}
 
?>