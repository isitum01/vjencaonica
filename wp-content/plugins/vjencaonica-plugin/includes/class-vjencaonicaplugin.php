<?php

namespace Vjencaonica;

class VjencaonicaPlugin{

    protected $loader;

    public function __construct()
    {
        $this->load_dependencies();
        $this->initialize_post_types();
    }

    private function load_dependencies(){
        
        require_once plugin_dir_path(dirname(__FILE__)).'/constants.php';

        require_once PLUGIN_DIR . '/includes/class-vjencaonicaplugin-loader.php';

        // Load classes
        require_once PLUGIN_DIR . 'classes/class-vj-test.php';
    }

    private function initialize_post_types(){
        Vj_Test::load_class($this->loader);
    }

    public function run(){
        $this->loader->run();
    }

    public function get_loader(): VjencaonicaPlugin_Loader{
        return $this->loader;
    }
}