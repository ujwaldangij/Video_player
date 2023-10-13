To use Laravel Dusk to locate the text "2023" on a page and then click a `span` tag associated with it, you can do the following:

```php
$textToFind = '2023';

// Locate the text "2023" and find the associated span tag
$browser->script("document.querySelector('span:contains(\"$textToFind\")').click();");
```

In this code:

- Replace `'2023'` with the specific text you want to find.
- The `script` method is used to execute JavaScript in the browser, which locates the `span` tag containing the specified text and clicks it.

Please make sure the `span` tag you want to click has a relationship with the text you're searching for and that the `:contains` selector accurately matches the desired text. Adjust the code based on your HTML structure.