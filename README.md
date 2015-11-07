# Simple Image procesing for Laravel 5
###### Wrapper for intervention/image
Bundle/Service created for simple dynamic image manipulation (resize for  example).
Stores manipulated images in cache for better performance.

###Requirments
- Laravel 5.0 +   (this bundle is for  Laravel5+ )
- intervention/image >= 2.3 


###Installation 

- Add to your composer.json 
- In config/app.php  register service in providers (add "Poznet\Image\PoznetImageProvider" to providers)

```'
providers' => [

		/*
		 * Laravel Framework Service Providers...
		 */
         ...
		'Poznet\Image\PoznetImageProvider',
],
```

###Usage
All paths is relative to /storage/app/  and it's get by Storage Facade (local), so it  can be easily change to ftp/scp/Amazon/Dropbox etc.

1. Resized  image
in Blade view   to get resized image with  widh of 450px use code below. 
Output is cached for  60 minutes with Cache Facade


`<img src="{{route('imagemin', ['width'=>'450','path'=>'logo.jpg'])}}">`



### Licence 
Intervention Imagecache Class is licensed under the MIT License.
Feel free to contribute. 


