<?php

namespace Fillet\Writer;

use Fillet\TextUtils\GenerateSlug;

abstract class AbstractWriter implements WriterInterface
{
    use GenerateSlug;

    protected $destinationFolder;

    public function __construct($destinationFolder)
    {
        $this->destinationFolder = $destinationFolder;
    }
}