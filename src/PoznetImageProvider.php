<?php namespace Poznet\Image;

use Illuminate\Support\ServiceProvider;

class PoznetImageProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{

		$this->app->make('Poznet\Image\Controllers\ImageController');
		//rejestracja  providerów

		$this->app->register('Intervention\Image\ImageServiceProvider');

		$this->app->register('Illuminate\Html\HtmlServiceProvider');
		$loader = \Illuminate\Foundation\AliasLoader::getInstance();
		$loader->alias('Image', 'Intervention\Image\Facades\Image');

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		include __DIR__ . '/routes/image.php';
    
	}

}
