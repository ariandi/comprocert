<?php

Route::get('/cobapakage', function(){
	echo 'Hello from the calculator package!';
});

Route::get('/cobapakage/terusan', 'Ariandin1411\Menus\MenusController@index');