<?php

require_once WACT_ROOT . 'controller/controller.inc.php';
require_once WACT_ROOT . 'controller/form.inc.php';

require_once APP_LIB_ROOT . 'projects/restrictedpagecontroller.inc.php';
require_once APP_LIB_ROOT . "projects/projects.model.php";

class DeletePage extends RestrictedPageController {

    function DeletePage() {
        parent::RestrictedPageController();
        $this->registerOnActivateListener(new Delegate($this, "guard"));

        $Form = new FormController();

        $Form->addChild('delete', new ButtonController(new Delegate($this, 'delete')));
        $Form->addChild('cancel', new ButtonController(new Delegate($this, 'cancel')));
        $Form->setDefaultChild('cancel');

        $Form->registerOnLoadListener(new Delegate($this, 'load'));

        $this->addChild('DeleteForm', $Form);
        $this->setDefaultChild('DeleteForm');
        
        $this->registerOnActivateListener(new Delegate($this, 'guard'));

        $this->setDefaultView(new Handle('FormView', array('/projects/delete.html')));
        $this->addView('success', new Handle('RedirectView', array('/')));
        $this->addView('cancel', new Handle('RedirectView', array('/')));
        $this->addView('notfound', new Handle(APP_LIB_ROOT . 'views/404.view.php|NotFoundView', array('/projects/notfound.html')));
    }

    function guard(&$source, &$request, &$responseModel) {
//        if (!$request->hasParameter('Id')) {
//            return 'notfound';
//        }
        require_once APP_LIB_ROOT . "users/users.model.php";
        return $this->allow(Users::isAdmin());
    }

    function load(&$source, &$request, &$responseModel) {
        $Rec =& Projects::getRecord($request->getParameter('Id'));
        if (is_null($Rec)) {
            return 'notfound';
        }

        $responseModel->import($Rec->export());
    }

    function cancel(&$source, &$request, &$responseModel) {
        return 'cancel';
    }

    function delete(&$source, &$request, &$responseModel) {
        if ($responseModel->isValid()) {
            Projects::delete($request->getParameter('Id'));
            return 'success';
        }
    }

}


?>
