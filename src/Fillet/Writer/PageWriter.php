<?php

namespace Fillet\Writer;

use Symfony\Component\Yaml\Dumper as YamlDumper;

class PageWriter extends AbstractWriter
{
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
        
        file_put_contents($this->destinationFolder . '/' . $filename . '.html', $header . PHP_EOL . $data['content']);
    }
}