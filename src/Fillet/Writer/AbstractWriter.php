<?php

namespace Fillet\Writer;

use Fillet\TextUtils\GenerateSlug;

/**
 * Abstract class for setting up a basic output writer
 *
 * Class AbstractWriter
 * @package Fillet\Writer
 */
abstract class AbstractWriter implements WriterInterface
{
    use GenerateSlug;

    /**
     * Destination that we should write to
     * @var string
     */
    protected $destinationFolder;

    /**
     * @param string $destinationFolder Destination that we should write to. Should be the full path ending in /
     */
    public function __construct($destinationFolder)
    {
        $this->destinationFolder = $destinationFolder;
    }
}