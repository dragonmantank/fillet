# Fillet - A CMS to Sculpin Converter

[![Code Climate](https://codeclimate.com/github/dragonmantank/fillet/badges/gpa.svg)](https://codeclimate.com/github/dragonmantank/fillet)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dragonmantank/fillet/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dragonmantank/fillet/?branch=master)

Many people coming to Sculpin are coming from other CMSes out there in the
wild. While almost all of these are database-backed, Sculpin isn't. Fillet
will help convert exports from different CMSes into the HTML/Markdown format
that Sculpin expects.

What this will /not/ do is create a Sculpin site from scratch from your
existing blog. Fillet will simply parse a known format and create pages and
posts for you, and convert as much stuff over as possible. You still need to
create an index.html file, views, and configure Sculpin. We're just going to
make it easier to get your content in.

If you have a favorite CMS and would like to help expand Fillet, help us write
a parser!

Currently supported CMSes:
  - Wordpress, via the XML Export

## Sample Usage

Add Fillet to your site with Composer

```
composer require "dragonmantank/fillet:dev-master"
```

Right now Fillet doesn't integrate with Sculpin directly, but you can use the
following sample code to run Fillet.

```php
<?php

require_once 'vendor/autoload.php';

$config = [
    'destinationFolders' => [
        'page' => __DIR__ . '/source/',
        'post' => __DIR__ . '/source/_posts/',
    ]
];

$fillet = new \Fillet\Fillet(new \Fillet\Parser\WordpressExport(), __DIR__ . '/mysite.xml', $config);
$fillet->parse();
```