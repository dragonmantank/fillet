<?php

namespace Fillet;

use Fillet\Parser\ParserInterface;
use Fillet\Writer\WriterFactory;

/**
 * Mainline driver for Fillet
 * This class handles all the heavy lifting for turning a data source into a series of Sculpin outputs.
 *
 * @package Fillet
 */
class Fillet
{
    /**
     * Configuration for Fillet
     * @var array
     */
    protected $config;

    /**
     * Full path to the file we need to work against
     * @var string
     */
    protected $inputFile;

    /**
     * Parser that we will be using
     * @var ParserInterface
     */
    protected $parser;

    /**
     * Create an instance of Fillet
     *
     * @param ParserInterface $parser Parser to use
     * @param string $inputFile File to parse
     * @param array $config Fillet configuration
     */
    public function __construct(ParserInterface $parser, $inputFile, $config)
    {
        $this->parser = $parser;
        $this->inputFile = $inputFile;
        $this->config = $config;
    }

    /**
     * Calls the parser and generates the files
     *
     * @throws \Exception
     */
    public function parse()
    {
        foreach($this->parser->parse($this->inputFile) as $item) {
            $writer = null;

            $writer = WriterFactory::create($item['type'], $this->config);

            if($writer) {
                $writer->write($item);
            }
        }
    }
}