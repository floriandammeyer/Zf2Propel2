<?php
return array(
    'console' => array(
        'router' => array(
            'routes' => array(
                'propel_orm' => array(
                    'options' => array(
                        'route' => 'propel <script>',
                        'defaults' => array(
                            'controller' => 'propel_orm-controller-index',
                            'action' => 'propel'
                        )
                    )
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'propel_orm-controller-index' => 'Zf2Propel2\Controller\IndexController',
        ),
    ),
);