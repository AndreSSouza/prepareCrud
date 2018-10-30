<?php

//class AutoLoad {
//
//    private $permitidos;
//
//    public function __construct() {
//        spl_autoload_register([$this, @Paginas]);
//    }
//
//    private function Paginas($class) {
//        $this->permitidos = (['../class/' . $class . '.class.php']);
//        foreach ($this->permitidos as $class) {
//            if (!file_exists($class)) {
//                echo 'Não existe a ' . $class . ' na pasta class';
//                exit;
//            } else {
//                require_once ($class);
//            }
//        }
//    }
//
//}
//
//new AutoLoad;

//class AutoLoad {
//
//    private $archives;
//
//    public function __construct() {
//        spl_autoload_register([$this, 'folders']);
//    }
//
//    private function folders($files) {
//        $this->archives = ['class/' . $files . '.class.php'];
//
//        foreach ($this->archives as $archive) {
//            if (file_exists($archive)) {
//                require_once $archive;
//            }
//        }
//    }
//
//}


