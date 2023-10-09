To ensure that Laravel Dusk runs in incognito mode and doesn't prompt to save files every time, you need to configure your ChromeOptions when setting up your DuskTestCase.php. Specifically, you can use the `--no-sandbox` flag and specify a custom download directory to avoid the prompts for file downloads. Here's how you can do it:

In your `DuskTestCase.php` file, configure the Chrome options like this:

```php
use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Chrome\ChromeOptions;

class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function driver()
    {
        $options = (new ChromeOptions())->addArguments([
            '--disable-gpu',
            '--headless',
            '--no-sandbox', // Add this flag
            '--disable-extensions',
            '--disable-dev-shm-usage',
            '--disable-popup-blocking',
            '--disable-infobars',
            '--disable-notifications',
            '--disable-software-rasterizer',
            '--disable-web-security', // Add this flag to disable web security (incognito-like mode)
            '--user-data-dir=' . storage_path('app/chrome'), // Use a custom user data directory to avoid prompts
            '--disk-cache-dir=' . storage_path('app/chrome/cache'), // Use a custom cache directory
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                $options
            )
        );
    }
}
```

In the code above:

- We add the `--no-sandbox` flag to Chrome options to disable the sandbox, which can sometimes cause issues in headless mode.

- We use `--disable-web-security` to disable web security, which is akin to incognito mode and can prevent certain prompts.

- We specify custom directories for user data and cache to avoid any permission issues and to ensure files are downloaded to a location you control.

Please replace the paths (`storage_path('app/chrome')` and `storage_path('app/chrome/cache')`) with the actual paths you want to use for your user data and cache directories.

With these configurations, Laravel Dusk should run in a more incognito-like mode, and you should be able to download files without being prompted to save them every time.