<?php

require_once WACT_ROOT . 'controller/controller.inc.php';
require_once WACT_ROOT . 'view/view.inc.php';

require_once APP_LIB_ROOT . "projects/projects.model.php";

class IndexView extends View {

    function IndexView($TemplateFile) {
        parent :: View($TemplateFile);
    }
    
    function prepare() {
        $pager =& $this->Template->getChild('pagenav');
        $list =& Projects::getList($pager);
        $this->Template->setChildDataSource('List', $list);
    }

}

class IndexPage extends PageController {
    
    function IndexPage() {
        parent::PageController();
        $this->setDefaultView(new IndexView('/projects/index.html'));
    }

}

?>