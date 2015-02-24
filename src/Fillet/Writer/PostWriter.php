<?php

namespace Fillet\Writer;

use Symfony\Component\Yaml\Dumper as YamlDumper;

class PostWriter extends AbstractWriter
{
    public function write($data)
    {
        $post_date_string = $data['post_date']->format('Y-m-d H:i:s');
        $slug = $this->generateSlug($data['title']);
        $filename = $data['post_date']->format('Y-m-d') . '-' . $slug;
        $categories = '';
        $tags = '';

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