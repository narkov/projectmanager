<?php

require_once WACT_ROOT . 'controller/controller.inc.php';
require_once WACT_ROOT . 'controller/form.inc.php';

require_once APP_LIB_ROOT . "users/users.model.php";

class LogoutPage extends PageController {

    function LogoutPage() {
        parent::PageController();
        
        $Form = new FormController();
        $Form->registerOnLoadListener(new Delegate($this, 'load'));

        $this->setDefaultView(new Handle('FormView', array('/users/login.html')));
        $this->addView('success', new Handle('RedirectView', array('/')));
    }

    function load(&$source, &$request, &$responseModel) {
        if ($responseModel->isValid()) {
            return Users::DoLogout();
        }
    }

}

?>