<?php

namespace Fillet\Parser;

/**
 * Creates the appropriate writer class for a post type
 *
 * @package Fillet\Writer
 */
class ParserFactory
{
    /**
     * Create a new instance of a parser
     *
     * @param string $class Class that we want to try and create
     *
     * @return ParserInterface
     * @throws \Exception
     */
    public static function create($class)
    {
        $className = 'Fillet\\Parser\\' . ucfirst($class);
        if(class_exists($className)) {
            /** @var ParserInterface $parser */
            $parser = new $className();
            return $parser;
        }

        throw new \Exception('There is no parser for ' . $class);
    }
}