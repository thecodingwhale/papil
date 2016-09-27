<?php

Route::get('task/all', 'TaskController@all');

Route::resource('task', 'TaskController', ['only' => [
    'show', 'store', 'update', 'destroy'
]]);