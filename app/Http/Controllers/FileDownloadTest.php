As of my last knowledge update in September 2021, Laravel Dusk did not have built-in methods named `disableSecurityChecks()` or `enableSecurityChecks()`. If you want to create custom methods to handle security checks in your Laravel Dusk tests, you can define these methods within your Dusk test class. Here's an example of how you can create custom methods to disable and enable security checks:

```php
<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class YourDuskTest extends DuskTestCase
{
    /**
     * Disable security checks.
     *
     * @param \Laravel\Dusk\Browser $browser
     * @return void
     */
    public function disableSecurityChecks(Browser $browser)
    {
        $browser->script([
            'window.__dusk__disableSecurityChecks = true;',
        ]);
    }

    /**
     * Enable security checks.
     *
     * @param \Laravel\Dusk\Browser $browser
     * @return void
     */
    public function enableSecurityChecks(Browser $browser)
    {
        $browser->script([
            'window.__dusk__disableSecurityChecks = false;',
        ]);
    }

    /**
     * Example test using custom security checks.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            // Disable security checks before visiting the page
            $this->disableSecurityChecks($browser);

            $browser->visit('https://example.com/some-page-with-xml-download')
                ->click('.download-xml-button')
                ->download('downloaded-file.xml');

            // Enable security checks after download is complete
            $this->enableSecurityChecks($browser);

            // Perform assertions on the downloaded file
            $this->assertTrue(file_exists('downloaded-file.xml'));
        });
    }
}
```

In this example, we've created two custom methods, `disableSecurityChecks()` and `enableSecurityChecks()`, that use JavaScript to manipulate a variable to control security checks. These methods can be used in your Dusk tests as shown in the `testExample()` method.

Please note that this code assumes that you need to bypass security checks via JavaScript manipulation, and it's not a standard feature of Laravel Dusk. If your requirements are different or if Laravel Dusk has introduced new features or methods since my last update, you may need to adapt your approach accordingly.