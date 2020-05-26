<?php

require_once WACT_ROOT . 'db/db.inc.php';

class Projects {

    function &getList(&$Pager) {
        return DBC::NewPagedRecordSet('SELECT * FROM project ORDER BY Name', $Pager);
    }

    function &getRecord($id) {
        return DBC::FindRecord("SELECT * FROM project WHERE Id=". DBC::makeLiteral($id));
    }

    function delete($id) {
        DBC::execute("DELETE FROM project WHERE Id=". DBC::makeLiteral($id));
    }

    function update($id, &$data) {
        $Record =& DBC::NewRecord($data);
        $Record->update('project',
            array('Name', 'Description', 'Url'),
            "Id=". DBC::makeLiteral($id));
    }

    function insert(&$data) {
        $Record =& DBC::NewRecord($data);
        return $Record->insert('project',
            array('Name', 'Description', 'Url'));
    }
}

?>