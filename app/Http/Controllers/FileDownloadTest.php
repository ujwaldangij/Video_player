In Laravel Dusk, you can simulate running your tests in "incognito" mode by using the `browsingAs` method with a custom browser instance that has specific settings. Here's how you can do it:

```php
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class YourDuskTest extends DuskTestCase
{
    public function testInIncognitoMode()
    {
        $this->browse(function (Browser $browser) {
            // Use a custom browser instance with incognito settings
            $browser->driver->capabilities->setCapability('chromeOptions', [
                'args' => ['--incognito'],
            ]);

            // Your test code here
            $browser->visit('/')
                    ->assertSee('Welcome to Your Website');
        });
    }
}
```

In this example, we set the `'--incognito'` command-line argument to simulate running the test in incognito mode. Replace `'/welcome'` with the URL you want to test.

Keep in mind that this method only simulates incognito mode for the Dusk test itself. It won't affect your regular browser sessions.