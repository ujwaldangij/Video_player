To wait for a download to complete in Laravel Dusk and then close the browser if the download is done, you can use the following approach:

```php
// Click the link or button to initiate the file download
$browser->click('#download-button');

// Define the path where you expect the file to be downloaded
$downloadPath = storage_path('app/downloads/your_file_name.ext'); // Adjust the path and filename

// Use a loop to check if the file exists with a maximum timeout
$maxTimeout = 60; // Set a maximum timeout (in seconds) for the download
$startTime = time();

while ((time() - $startTime) < $maxTimeout) {
    if (file_exists($downloadPath)) {
        // The file is downloaded; you can close the browser
        $browser->quit();
        break;
    }

    // Wait for a moment and then check again
    sleep(2); // Adjust the sleep time as needed
}

// You can then proceed with further assertions or actions if needed
```

In this code:

1. Click the link or button to initiate the file download.

2. Define the path where you expect the file to be downloaded.

3. Use a loop to repeatedly check if the file exists. If the file is found, it means the download is complete, and the browser is closed using `$browser->quit()`. The loop will exit immediately.

4. Set a maximum timeout (`$maxTimeout`) to ensure that the script doesn't wait indefinitely for the download to complete.

After the browser is closed (if the download is done), you can proceed with further assertions or actions outside of this code block if needed.

Please adjust the values of `$maxTimeout` and `sleep` as required for your specific download duration and polling interval.