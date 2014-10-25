<?php

namespace Zf2Propel2\Generator\Builder\Om;

class ObjectBuilder
    extends \Propel\Generator\Builder\Om\ObjectBuilder
{
    public function getClassFilePath()
    {
        $path = parent::getClassFilePath();
        file_put_contents("my_build_log.txt", file_get_contents("my_build_log.txt") . "\n" . $path);

        return $path;
    }
}