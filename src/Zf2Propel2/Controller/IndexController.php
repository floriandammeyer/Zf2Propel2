<?php
namespace Zf2Propel2\Controller;

// todo: propel-commandos entgegennehmen und mit entsprechenden propel-configs umgeleitet aufrufen, damit propel models etc. gebuildet werden

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
        chdir(__DIR__ . '/../../../config');

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
        file_put_contents("propel.php.dist", '<?php return ' . var_export($db_config, true) . ';');

        exec('php ../../../vendor/propel/propel/bin/propel.php ' . $script, $output);

        unlink("propel.php.dist");

        foreach($output as $line)
        {
            echo $line . PHP_EOL;
        }

        chdir($src_dir);
    }
}