<?php

namespace Fillet;

use Fillet\Parser\WordpressExport;
use Fillet\Writer\WriterFactory;

class Fillet
{
    protected $config;
    protected $inputFile;
    protected $parser;

    public function __construct($parser, $inputFile, $config)
    {
        $this->parser = $parser;
        $this->inputFile = $inputFile;
        $this->config = $config;
    }

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