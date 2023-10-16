In Laravel Dusk, you can check if a specific text is present on a page using the `assertSee` method. If you want to visually mark the text, you can do so by using JavaScript to highlight or style the element containing the text. Here's an example of how to achieve this:

```php
$year = date('Y'); // Get the current year
$textToFind = "$year"; // Text to find on the page

$browser->visit('/your-page-url') // Navigate to your page
    ->script("document.querySelectorAll('*:contains(\"$textToFind\")').forEach(function(element) { element.style.backgroundColor = 'yellow'; });") // Highlight the text
    ->assertSee($textToFind); // Check if the text is present and highlighted
```

In the above code, we first navigate to the page and then use JavaScript to highlight all elements containing the text (in this case, the current year). We set the background color to yellow, but you can adjust the styling as needed. After highlighting the text, we use `assertSee` to verify that the text is present on the page. If it's found and highlighted, the assertion will pass.