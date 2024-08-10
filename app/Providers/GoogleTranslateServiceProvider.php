<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stichoza\GoogleTranslate\GoogleTranslate;

class GoogleTranslateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GoogleTranslate::class, function ($app) {
            return new GoogleTranslate('en'); // Default language
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Custom Blade directive for translation
        \Blade::directive('translate', function ($expression) {
            return "<?php echo app(Stichoza\GoogleTranslate\GoogleTranslate::class)->translate($expression); ?>";
        });
    }
}
