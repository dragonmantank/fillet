<?php

namespace Fillet\Writer;

use Fillet\TextUtils\GenerateSlug;

class PageWriter extends AbstractWriter
{
    public function write($data)
    {
        $post_date_string = $data['post_date']->format('Y-m-d H:i:s');
        $filename = $this->generateSlug($data['title']);
        $header = <<<ENDTEXT
---
title: ${data['title']}
date: ${post_date_string}
layout: page
slug: ${filename}
---
ENDTEXT;
        file_put_contents($this->destinationFolder . '/' . $filename . '.html', $header . PHP_EOL . $data['content']);
    }
}