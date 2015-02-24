<?php

namespace Fillet\Writer;

/**
 * Creates the appropriate writer class for a post type
 *
 * @package Fillet\Writer
 */
class WriterFactory
{
    /**
     * Create a new instance of a writer based on the post type
     *
     * @param string $postType Post type we are working against
     * @param array $config Config to use to generate the writer
     * @param bool $throwExceptionOnInvalidWriter Whether to throw an exception if an unknown writer is requested
     *
     * @return WriterInterface
     * @throws \Exception
     */
    static public function create($postType, $config, $throwExceptionOnInvalidWriter = false)
    {
        $className = 'Fillet\\Writer\\' . ucfirst($postType) . 'Writer';
        if(class_exists($className)) {
            return new $className($config['destinationFolders'][$postType]);
        }

        if($throwExceptionOnInvalidWriter) {
            throw new \Exception('There is no writer for ' . $postType);
        }
    }
}