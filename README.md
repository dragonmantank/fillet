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

### Use with Sculpin

There is a bundle version of this that integrates with Sculpin directly. You can find it at [dragonmantank/fillet-sculpin-bundle](https://github.com/dragonmantank/fillet-sculpin-bundle)

### Manual installation with Composer for development

Add Fillet to your site with Composer

```
composer require "dragonmantank/fillet:dev-master"
```

You can use the following sample code to run Fillet.

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

### Generating markdown with pandoc

If you have [Pandoc](http://pandoc.org) installed, you can use it to generate markdown output instead of HTML by
adding a `pandoc` key to `$config`:

```php
$config = [
    'destinationFolders' => [
        'page' => __DIR__ . '/source/',
        'post' => __DIR__ . '/source/_posts/',
    ],
    'pandoc' => [
        'to_markdown' => true,
        'bin' => '/usr/local/bin/pandoc',
    ]
];
```
