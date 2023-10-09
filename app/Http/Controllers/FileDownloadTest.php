I apologize for any inconvenience you're facing. If the `--disable-web-security` flag is not working as expected, it's possible that Chrome's security mechanisms are preventing the download for safety reasons.

To bypass this issue, you can try using the `--safebrowsing-disable-download-protection` flag in addition to `--disable-web-security` when configuring ChromeOptions:

```php
protected function driver()
{
    $options = (new ChromeOptions())->addArguments([
        '--disable-web-security',
        '--safebrowsing-disable-download-protection', // Disable download protection (use with caution)
        '--disable-popup-blocking',
        '--no-sandbox',
        '--disable-dev-shm-usage',
        '--headless', // If you want headless mode
        '--disable-gpu', // If you want headless mode
    ]);

    return RemoteWebDriver::create(
        'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
            ChromeOptions::CAPABILITY, $options
        )
    );
}
```

Please use this option with caution, as it can disable download protection and may expose your testing environment to potential security risks.

If this still doesn't work, it's possible that the website or server you are testing against has specific security measures in place that cannot be easily bypassed. In such cases, it's essential to ensure that your testing is conducted in a responsible and ethical manner, and you may need to reach out to the website's administrators or support for guidance on testing their system.