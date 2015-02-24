<?php

namespace Fillet\Parser;

/**
 * Interface for parsers
 *
 * @package Fillet\Parser
 */
interface ParserInterface
{
    /**
     * Parses a file
     * The parser is expected to return a generator that Fillet will use to actually write out the files. This function
     * should return a data set containing up to the following keys, depending on the post type:
     *  - title
     *  - post_date
     *  - layout
     *  - categories
     *  - tags
     *  - content
     *
     * @param string $inputFile File to parse
     * @return \Generator
     */
    public function parse($inputFile);
}