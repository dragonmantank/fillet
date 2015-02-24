<?php

namespace Fillet\Parser;

class WordpressExport
{
    public function parse($inputFile)
    {
        $DCNamespace = 'http://purl.org/rss/1.0/modules/content/';
        $WPNamespace = 'http://wordpress.org/export/1.2/';
        $reader = new \XMLReader();
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $reader->open($inputFile);

        while ($reader->read() && $reader->name !== 'item');

        while($reader->name == 'item') {
            $xml = simplexml_import_dom($dom->importNode($reader->expand(), true));
            $wpItems = $xml->children($WPNamespace);
            $content = $xml->children($DCNamespace)->encoded;

            $categories = [];
            $tags = [];

            foreach($xml->category as $category) {
                if('category' == $category->attributes()->domain) {
                    $categories[] = (string)$category;
                }

                if('post_tag' == $category->attributes()->domain) {
                    $tags[] = (string)$category;
                }
            }

            if($wpItems) {
                $post_type = (string)$wpItems->post_type;
                $data = [
                    'type' => $post_type,
                    'post_date' => new \DateTime((string)$wpItems->post_date),
                    'title' => (string)$xml->title,
                    'content' => (string)$content,
                    'tags' => $tags,
                    'categories' => $categories,
                ];
                yield $data;
            }

            $reader->next('item');
        }
    }
}