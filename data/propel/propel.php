<?php
return [
    'propel' => [
        'database' => [
            'connections' => [
                'default' => [
                    'adapter'    => 'mysql',
                    'settings' => [
                        'charset' => 'utf8',
                        'queries' => [
                            'utf8' => "SET NAMES utf8"
                        ]
                    ],
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=;dbname=',
                    'user'       => 'root',
                    'password'   => '',
                    'attributes' => []
                ]
            ]
        ],
        // TODO: does propel always use the cwd as the output dir for migrations or which of the paths affects the diff task?
        'paths' => [
            'schemaDir' => realpath(__DIR__ . '/../../../../../config/model'),
            'phpDir' => realpath(__DIR__ . '/../../../../../module'),
            'phpConfDir' => realpath(__DIR__ . '/../../../../../config/propel'),
            'sqlDir' => realpath(__DIR__ . '/../sql'),
        ],
        'generator' => [
            'defaultConnection' => 'default',
            'connections' => ['default'],
            'namespaceAutoPackage' => true,
            'schema' => [
                'basename' => 'debugschema'
            ],
            'objectModel' => [
                // We need to use our own builders to change the path mappings
                'builders' => [
                    'object' => '\Zf2Propel2\Generator\Builder\Om\ObjectBuilder',
                    'objectstub' => '\Zf2Propel2\Generator\Builder\Om\ExtensionObjectBuilder',
                    'objectmultiextend' => '\Zf2Propel2\Generator\Builder\Om\MultiExtendObjectBuilder',
                    'tablemap' => '\Zf2Propel2\Generator\Builder\Om\TableMapBuilder',
                    'query' => '\Zf2Propel2\Generator\Builder\Om\QueryBuilder',
                    'querystub' => '\Zf2Propel2\Generator\Builder\Om\ExtensionQueryBuilder',
                    'queryinheritance' => '\Zf2Propel2\Generator\Builder\Om\QueryInheritanceBuilder',
                    'queryinheritancestub' => '\Zf2Propel2\Generator\Builder\Om\ExtensionQueryInheritanceBuilder'
                ],
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'default',
            'connections' => ['default']
        ],
    ]
];

