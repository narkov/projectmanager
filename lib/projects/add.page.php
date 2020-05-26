<?php

require_once WACT_ROOT . 'controller/form.inc.php';

require_once APP_LIB_ROOT . 'projects/restrictedpagecontroller.inc.php';
require_once APP_LIB_ROOT . "projects/projects.model.php";

class AddPage extends RestrictedPageController {

    function AddPage() {
        parent::RestrictedPageController();
        $this->registerOnActivateListener(new Delegate($this, "guard"));
        
        $Form = new FormController();
        $Form->addChild('preview', new ButtonController(new Delegate($this, 'preview')));
        $Form->addChild('submit', new ButtonController(new Delegate($this, 'add')));
        $Form->setDefaultChild('submit');

    $Form->addRule(new Handle('RequiredRule', array('Name')));
    $Form->addRule(new Handle('SizeRangeRule', array('Name', 63)));
    $Form->addRule(new Handle('SizeRangeRule', array('Description', 255)));
    $Form->addRule(new Handle('RequiredRule', array('Url')));
    $Form->addRule(new Handle('SizeRangeRule', array('Url', 127)));

        $this->addChild('AddForm', $Form);
        $this->setDefaultChild('AddForm');
        
        $this->setDefaultView(new Handle('FormView', array('/projects/add.html')));
        $this->addView('success', WACT_DEFAULT_VIEW);
        $this->addView('notfound', WACT_DEFAULT_VIEW);
    }


    function guard(&$source, &$request, &$responseModel) {
//      if (!$request->hasParameter('Id')) {
//         return 'notfound';
//      }
      require_once APP_LIB_ROOT . "users/users.model.php";
      return $this->allow(Users::isAdmin());
    }


    function preview(&$source, &$request, &$responseModel) {
        $responseModel->set('ShowPreview', TRUE);
    }

    function add(&$source, &$request, &$responseModel) {
        if ($responseModel->isValid()) {
            require_once WACT_ROOT .  'util/phpcompat/clone.php';
    
            $responseModel->set('Deprecated', $responseModel->get('Deprecated') ? 'Y' : '');
            $Id = projects::insert($responseModel);
            if ($Id) {
                $LastRecord = clone_obj($responseModel);
                $LastRecord->set('Id', $Id);
    
                // Set up the model for adding the next record
                $responseModel->removeAll();
                $responseModel->set('LastRecord', $LastRecord);
    
                return 'success';
            } else {
                return 'failure';
            }
        } else {
            $responseModel->set('ShowPreview', TRUE);
        }
    }

}

?>