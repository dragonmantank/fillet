<?php

namespace Fillet\Writer;

/**
 * Interface for Writers
 *
 * @package Fillet\Writer
 */
interface WriterInterface
{
    /**
     * Write out data
     *
     * @param string $data Data to use to construct the file
     */
    public function write($data);
}