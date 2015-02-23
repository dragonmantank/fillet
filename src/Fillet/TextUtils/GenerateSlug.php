<?php

namespace Fillet\TextUtils;

trait GenerateSlug
{
    public function generateSlug($title)
    {
        $title = strtolower($title);
        $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
        $title = preg_replace('/\s+/', '-', $title);
        $title = preg_replace('|-+|', '-', $title);
        $title = trim($title, '-');

        return $title;
    }
}