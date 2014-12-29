<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 */
/**
 * Class Environment
 */
class Environment{

    public $errorReporting = E_ALL;
    /**
     * @var string
     */
    public $envVar = 'YII_ENV';
    /**
     * @var
     */
    public $_env;

    /**
     * @var string
     */
    public $debugVar = 'YII_DEBUG';

    /**
     * @var
     */
    public $debug;

    public function __construct($config = [])
    {
        Dotenv::load(__DIR__ . '/..');
        foreach ($config as $name => $value) {
            $this->$name = $value;
        }
        defined('YII_ENV') or define('YII_ENV', $this->getEnv());
        defined('YII_DEBUG') or define('YII_DEBUG', $this->getDebug());

        defined('YII_ENV_DEV') or define('YII_ENV_DEV', $this->getEnv() == 'dev');
        defined('YII_ENV_PROD') or define('YII_ENV_PROD', $this->getEnv() == 'prod');
        defined('YII_ENV_TEST') or define('YII_ENV_TEST', $this->getEnv() == 'test');

        if($this->getDebug()){
            error_reporting($this->errorReporting);
            ini_set('display_errors', 1);
        }
    }

    /**
     * @return mixed
     */
    public function getDebug()
    {
        if($this->debug === null){
            $debug = array_key_exists($this->debugVar, $_SERVER) ? $_SERVER[$this->debugVar] : $this->getEnv() == 'dev';
            $this->debug = !!$debug;
        }
        return $this->debug;
    }

    /**
     * @param mixed $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getEnv()
    {
        if($this->_env === null){
            $env = getenv($this->envVar) ?: 'dev';
            if(!$env){
                throw new \Exception('You should set environment by setting environmental YII_ENV variable or Environment::env');
            }
            $this->_env = strtolower($env);
        }
        return $this->_env;
    }

    /**
     * @param $env
     */
    public function setEnv($env)
    {
        $this->_env = $env;
    }
}