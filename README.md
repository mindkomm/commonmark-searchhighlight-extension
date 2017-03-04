# SearchHighlight Extension

SearchHighlight is an extension for the [CommonMark PHP implementation](https://github.com/thephpleague/commonmark) and can be used to highlight Markdown text that matches a search string.

The extension adds a `<span class="search-highlight">` around the strings that match the search string.

**Example for "something":**

![](https://cloud.githubusercontent.com/assets/2084481/23606637/e96e6b68-0261-11e7-9249-65a79a544ed7.png)

## Installation

This project can be installed via [Composer](https://getcomposer.org/):

```
composer require mindkomm/commonmark-searchhighlight-extension
```

## Usage

```php
use League\CommonMark\Environment;
use League\CommonMark\CommonMarkConverter;

use Mind\CommonMark\SearchHighlightExtension\SearchHighlightExtension;

$searchstring = 'Your search string';
$config = [];

$environment = Environment::createCommonMarkEnvironment();

if (!empty($searchstring)) {
    $environment->addExtension(new SearchHighlightExtension());

    // Pass the search string to the environment config
    $config['searchstring'] = $searchstring;
}

$converter = new CommonMarkConverter($config, $environment);

echo $converter->convertToHtml('A text that contains your search string.');
```


