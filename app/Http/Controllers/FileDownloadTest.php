In Laravel Dusk, if you want to stop a loop when the URL changes, you can achieve this by using a loop control structure (such as a `while` or `for` loop) and periodically checking the current URL within the loop. When the URL changes as expected, you can use a `break` statement to exit the loop. Here's an example using a `while` loop:

```php
$this->browse(function ($browser) {
    $desiredUrl = 'https://example.com/target-page';

    while (true) {
        $currentUrl = $browser->visit($desiredUrl)->url();

        if ($currentUrl === $desiredUrl) {
            // URL hasn't changed yet, continue looping
            sleep(1); // Optional: Add a sleep to avoid continuous checking
        } else {
            // URL has changed, break out of the loop
            break;
        }
    }

    // You can continue with further test steps after the URL change
    $browser->assertSee('New Page Content');
});
```

In this example, the `while` loop continues to visit the desired URL and checks the current URL. If the current URL matches the desired URL, it means the URL hasn't changed yet, so the loop continues. When the URL changes (indicating the desired page has loaded), the loop is exited using the `break` statement.

Please note that you should add some form of delay (`sleep` in this example) to avoid continuously checking the URL and causing excessive load on your server. Adjust the sleep duration as needed based on your specific use case and server response times.