<?php

namespace Fillet\Writer;

use Symfony\Component\Yaml\Dumper as YamlDumper;

/**
 * Generates a Page for Sculpin
 *
 * @package Fillet\Writer
 */
class PageWriter extends AbstractWriter
{
    /**
     * Write out a set of data into a file
     *
     * @param array $data Data to use for constructing the page
     */
    public function write($data)
    {
        $post_date_string = $data['post_date']->format('Y-m-d H:i:s');
        $filename = $this->generateSlug($data['title']);

        $headerData = [
			'title' => $data['title'],
			'date' => $post_date_string,
			'layout' => 'page',
			'slug' => $filename,
		];

		$dumper = new YamlDumper();
		$header = '---' . PHP_EOL . $dumper->dump($headerData, 2) . '---' . PHP_EOL;
        
        $filename = $this->destinationFolder . '/' . $filename;
        if ($this->isMarkdownEnabled()) {
            $filename .= '.md';
            $data['content'] = $this->toMarkdown($data['content']);
        } else {
            $filename .= '.html';
        }

        file_put_contents($filename, $header . PHP_EOL . $data['content']);
    }
}