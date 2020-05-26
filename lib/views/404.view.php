<?php

require_once WACT_ROOT . 'view/view.inc.php';

//--------------------------------------------------------------------------------
class NotFoundView extends View {

    function NotFoundView($TemplateFile) {
        parent :: View($TemplateFile);
    }
    
    function display() {
    header("Status: 404 File not found");
        parent :: display();
    }

}

?>