<?php
namespace Zf2Propel2\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController
    extends AbstractActionController
{
    public function propelAction()
    {
        $request = $this->getRequest();
        $script = $request->getParam('script');
        $config = $this->getServiceLocator()->get('config')["database"];

        $src_dir = getcwd();
        $wd = __DIR__ . '/../../../../../../data/zf2propel2';
        if(!file_exists($wd))
        {
            mkdir(wd);
        }
        chdir($wd);

        // Copy the Propel config file
        if(!copy(__DIR__ . '/../../../config/propel.config.php', 'propel.php.dist'))
        {
            die("Could not copy the Propel configuration file")
        }

        // Dynamically create a propel.php.dist config file with the database config
        $db_config = [
            'propel' => [
                'database' => [
                    'connections' => [
                        'default' => [
                            'dsn'        => 'mysql:host=' . $config['host'] . ';dbname=' . $config['database'],
                            'user'       => $config['username'],
                            'password'   => $config['password'],
                        ]
                    ]
                ]
            ]
        ];
        file_put_contents("propel.php", '<?php return ' . var_export($db_config, true) . ';');

        exec('php ../../vendor/propel/propel/bin/propel.php ' . $script, $output);

        // Delete the created propel.php file
        unlink("propel.php");

        foreach($output as $line)
        {
            echo $line . PHP_EOL;
        }

        chdir($src_dir);

        return array();
    }
}