<?php

namespace Fillet\Writer;

class PostWriter extends AbstractWriter
{
    public function write($data)
    {
        $post_date_string = $data['post_date']->format('Y-m-d H:i:s');
        $slug = $this->generateSlug($data['title']);
        $filename = $data['post_date']->format('Y-m-d') . '-' . $slug;
        $header = <<<ENDTEXT
---
title: ${data['title']}
date: ${post_date_string}
layout: post
slug: ${slug}
---
ENDTEXT;
        file_put_contents($this->destinationFolder . '/' . $filename . '.html', $header . PHP_EOL . $data['content']);
    }
}