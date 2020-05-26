<?php

require_once WACT_ROOT . 'controller/controller.inc.php';
require_once WACT_ROOT . 'controller/form.inc.php';

require_once APP_LIB_ROOT . "users/users.model.php";

class LoginPage extends PageController {

    function LoginPage() {
        parent::PageController();
        
        $Form = new FormController();

        $Form->addChild('submit', new ButtonController(new Delegate($this, 'login')));
        $Form->setDefaultChild('submit');

    $Form->addRule(new Handle('RequiredRule', array('Username')));
    $Form->addRule(new Handle('SizeRangeRule', array('Username', 10)));
    $Form->addRule(new Handle('RequiredRule', array('Password')));
    $Form->addRule(new Handle('SizeRangeRule', array('Password', 10)));
        
        $this->addChild('LoginForm', $Form);
        $this->setDefaultChild('LoginForm');
        
        $this->setDefaultView(new Handle('FormView', array('/users/login.html')));
        $this->addView('success', new Handle('RedirectView', array('/')));
        $this->addView('failure', new Handle('FormView', array('/users/login.html')));
        $this->addView('notfound', new Handle(APP_LIB_ROOT . 'views/404.view.php|NotFoundView', array('/users/notfound.html')));
    }

    function login(&$source, &$request, &$responseModel) {
        if ($responseModel->isValid()) {
            return Users::DoLogin($responseModel);
        }
    }

}

?>