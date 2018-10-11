<?php

class AutoLoad {

    private $archives;


    public function __construct() {
        spl_autoload_register([$this, 'folders']);
    }
    
    private function folders($files) {
        $this->archives = ['class/'.$files.'.class.php',
                           'interface/'.$files.'.php'];
        
        foreach ($this->archives as $archive){
            if (file_exists($archive)) {
                require_once $archive;    
            }
        }
    }
}
new AutoLoad;
