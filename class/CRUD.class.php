<?php
include 'Connection.class.php';

class CRUD extends Connection {

    private $query, $run;

    public function __construct() {
        parent::__construct('mysql:dbname=preetec; host=localhost', 'root', '');
    }

    private function set_statement($stmt) {
        if (is_object(parent::con())) {
            $this->query = parent::con()->prepare($stmt);
        } else {
            die(parent::kill_with_style());
        }
    }

    private function do_run() {
        $this->query->execute($this->run);
    }

    public function run($r = []) {
        $this->run = $r;
        $this->do_run();

        return $this->query;
    }

    public final function insert($table, $fields, $values) {
        $this->set_statement("INSERT INTO " . $table . " (" . $fields . ") VALUES " . $values . "");
        return $this;
    }

    public final function select($fields, $table, $condition = '') {
        $this->set_statement("SELECT " . $fields . " FROM " . $table . " " . $condition . "");
        return $this;
    }

    public function update($table, $values, $condition) {
        $this->set_statement("UPDATE " . $table . " SET " . $values . " " . $condition . "");
        return $this;
    }

    public function delete($table, $condition) {
        $this->set_statement("DELETE FROM " . $table . " " . $condition . "");
        return $this;
    }

}
