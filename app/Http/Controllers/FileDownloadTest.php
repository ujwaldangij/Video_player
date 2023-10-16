I apologize for the confusion. It seems there was an issue with the `:contains` selector, which is not a standard CSS selector. To highlight and check for the presence of specific text, you can use JavaScript to achieve this. Here's an example that should work:

```php
$year = date('Y'); // Get the current year
$textToFind = "$year"; // Text to find on the page

$browser->visit('/your-page-url') // Navigate to your page
    ->script("var elements = document.querySelectorAll('*'); 
              for (var i = 0; i < elements.length; i++) { 
                  var element = elements[i];
                  if (element.textContent.includes('$textToFind')) {
                      element.style.backgroundColor = 'yellow';
                      element.style.color = 'black';
                  }
              }") // Highlight the text
    ->assertSee($textToFind); // Check if the text is present
```

In this code, we use JavaScript to iterate through all elements on the page and check if their `textContent` contains the text you want to find. If found, we apply the highlight style, and then we use `assertSee` to ensure the text is present. Make sure to replace `"/your-page-url"` with the actual URL of the page you're testing.