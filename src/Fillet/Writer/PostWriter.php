<?php

namespace Fillet\Writer;

use Symfony\Component\Yaml\Dumper as YamlDumper;

/**
 * Generates a Post for Sculpin
 *
 * @package Fillet\Writer
 */
class PostWriter extends AbstractWriter
{
	/**
	 * Write out a set of data into a file
	 *
	 * @param array $data Data to use for constructing the page
	 */
    public function write($data)
    {
        $post_date_string = $data['post_date']->format('Y-m-d H:i:s');
        $slug = $this->generateSlug($data['title']);
        $filename = $data['post_date']->format('Y-m-d') . '-' . $slug;

		$headerData = [
			'title' => $data['title'],
			'date' => $post_date_string,
			'layout' => 'post',
			'slug' => $slug,
			'categories' => $data['categories'],
			'tags' => $data['tags'],
		];

		$dumper = new YamlDumper();
		$header = '---' . PHP_EOL . $dumper->dump($headerData, 2) . '---' . PHP_EOL;

        file_put_contents($this->destinationFolder . '/' . $filename . '.html', $header . PHP_EOL . $data['content']);
    }
}