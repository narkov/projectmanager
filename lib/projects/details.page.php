<?php

require_once WACT_ROOT . 'controller/controller.inc.php';

require_once APP_LIB_ROOT . "projects/projects.model.php";

class DetailsPage extends PageController {

    function DetailsPage() {
        parent::PageController();

        $this->registerOnLoadListener(new Delegate($this, 'load'));
        $this->registerOnActivateListener(new Delegate($this, 'guard'));
        
        $this->setDefaultView(new Handle('View', array('/projects/details.html')));
        $this->addView('notfound', 
            new Handle(APP_LIB_ROOT . 'views/404.view.php|NotFoundView', array('/projects/notfound.html')));
    }

    function guard(&$source, &$request, &$responseModel) {
        if (!$request->hasParameter('Id')) {
            return 'notfound';
        }
    }

    function load(&$Source, &$request, &$responseModel) {
        $Rec =& Projects::getRecord($request->getParameter('Id'));
        if (is_null($Rec)) {
            return 'notfound';
        }

        $responseModel->import($Rec->export());
    }

}

?>