<?php



Route::get('/media/images/{path?}', array('as' => 'image', 'uses' => 'Poznet\Image\Controllers\ImageController@get'))->where('path', '(.*)'); //TODO jakieś  filtrowanie
Route::get('/media/images-min-{width?}/{path?}', array('as' => 'imagemin', 'uses' => 'Poznet\Image\Controllers\ImageController@getMin'))->where('path', '(.*)'); //TODO jakieś  filtrowanie




