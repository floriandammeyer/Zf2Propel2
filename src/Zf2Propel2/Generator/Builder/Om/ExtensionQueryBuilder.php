<?php

namespace Zf2Propel2\Generator\Builder\Om;

class ExtensionQueryBuilder
    extends \Propel\Generator\Builder\Om\ExtensionQueryBuilder
{
    public function getClassFilePath()
    {
        $path = parent::getClassFilePath();

        // extract the first part of the class path because this is the module name
        $module_name = explode('/', $path)[0];

        return $module_name . "/src/" . $path;
    }
}