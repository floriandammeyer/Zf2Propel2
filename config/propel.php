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
                            'utf8' => "SET NAMES utf8 COLLATE utf8_unicode_ci, COLLATION_CONNECTION = utf8_unicode_ci, COLLATION_DATABASE = utf8_unicode_ci, COLLATION_SERVER = utf8_unicode_ci"
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
        'paths' => [
            'schemaDir' => realpath(__DIR__ . '/../../../../config/model'),
            'phpDir' => realpath(__DIR__ . '/../../../../module'),
            'phpConfDir' => realpath(__DIR__ . '/../../../../config/propel'),
            'sqlDir' => realpath(__DIR__ . '/../../../../sql')
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

