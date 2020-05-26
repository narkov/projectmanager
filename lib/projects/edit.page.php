<?php

require_once WACT_ROOT . 'controller/controller.inc.php';
require_once WACT_ROOT . 'controller/form.inc.php';

require_once APP_LIB_ROOT . 'projects/restrictedpagecontroller.inc.php';
require_once APP_LIB_ROOT . "projects/projects.model.php";

class EditPage extends RestrictedPageController {

    function EditPage() {
        parent::RestrictedPageController();
        $this->registerOnActivateListener(new Delegate($this, "guard"));
        
        $Form = new FormController();

        $Form->addChild('submit', new ButtonController(new Delegate($this, 'update')));
        $Form->addChild('preview', new ButtonController());
        $Form->setDefaultChild('submit');

        $Form->registerOnLoadListener(new Delegate($this, 'load'));

    $Form->addRule(new Handle('RequiredRule', array('Name')));
    $Form->addRule(new Handle('SizeRangeRule', array('Name', 63)));
    $Form->addRule(new Handle('SizeRangeRule', array('Description', 255)));
    $Form->addRule(new Handle('RequiredRule', array('Url')));
    $Form->addRule(new Handle('SizeRangeRule', array('Url', 127)));
        
        $this->addChild('EditForm', $Form);
        $this->setDefaultChild('EditForm');
        
        $this->registerOnActivateListener(new Delegate($this, 'guard'));
        
        $this->setDefaultView(new Handle('FormView', array('/projects/edit.html')));
        $this->addView('success', new Handle('RedirectView', array('/')));
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

    function update(&$source, &$request, &$responseModel) {
        if ($responseModel->isValid()) {
            $responseModel->set('Deprecated', $responseModel->get('Deprecated') ? 'Y' : '');
            Projects::update($request->getParameter('Id'), $responseModel);
            return 'success';
        }
    }

}

?>