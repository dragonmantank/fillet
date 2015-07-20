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
     * Configuration options for writer
     * @var array
     */
    protected $config;

    /**
     * @param string $destinationFolder Destination that we should write to. Should be the full path ending in /
     */
    public function __construct($destinationFolder, $config)
    {
        $this->destinationFolder = $destinationFolder;
        $this->config = $config;
    }

    /**
     * Converts content from HTML to Markdown via pandoc
     *
     * @param $content
     * @return string
     */
    protected function toMarkdown($content)
    {
        $tmpfname = tempnam(sys_get_temp_dir(), 'fillet'); // good
        file_put_contents($tmpfname, $content);
        $cmd = $this->config['pandoc']['bin'] . ' --no-wrap -f html -t markdown ' . $tmpfname;
        $content = shell_exec($cmd);
        unlink($tmpfname);
        return $content;
    }

    /**
     * Tests if markdown conversion is enabled
     * @return bool
     */
    protected function isMarkdownEnabled() {
        return isset($this->config['pandoc']['to_markdown']) && true == $this->config['pandoc']['to_markdown'];
    }
}