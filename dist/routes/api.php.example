<?php
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
	//HelloWorld
	Route::resource('helloWorld', 'HelloWorldApiController');
});
