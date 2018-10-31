<?php

class Connection {

    private $dns, $user, $pass, $con, $error_con;

    public function __construct($dns, $user, $pass) {
        $this->dns = $dns;
        $this->user = $user;
        $this->pass = $pass;

        $this->set_con();
    }

    public function set_con() {

        try {
            $this->con = new PDO($this->dns, $this->user, $this->pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->error_con = 'Falha na Conexão: ' . $e->getMessage();
        }
    }

    public function con() {
        return $this->con;
    }

    public function kill_with_style() {
        return '<pre class=error-die>' . $this->error_con . '</pre>';
    }

}
