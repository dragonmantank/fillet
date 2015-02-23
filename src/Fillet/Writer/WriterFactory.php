<?php

namespace Fillet\Writer;

class WriterFactory
{
    static public function create($postType, $config, $throwExceptionOnInvalidWriter = false)
    {
        $className = 'Fillet\\Writer\\' . ucfirst($postType) . 'Writer';
        if(class_exists($className)) {
            return new $className($config['destinationFolders'][$postType]);
        }

        if($throwExceptionOnInvalidWriter) {
            throw new Exception('There is no writer for ' . $postType);
        }
    }
}