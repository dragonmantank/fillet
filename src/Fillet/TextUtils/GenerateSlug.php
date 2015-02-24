<?php

namespace Fillet\TextUtils;

/**
 * Helper trait for generating properly slugged titles
 *
 * @package Fillet\TextUtils
 */
trait GenerateSlug
{
    /**
     * Generate an appropriate slug from a title
     * This function will turn a title into a lowercase and hyphenated title that is compatible with how Sculpin expects
     * slugs.
     *
     * @param string $title Raw title
     *
     * @return string
     */
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