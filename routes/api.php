<?php


use App\Http\Resources\UnReadNotification;

Route::group([

    // 'middleware' => 'api',
    
    'namespace' => 'Api'

], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    
    Route::apiResource('questions', 'ForumController');
    Route::apiResource('/{question}/reply', 'ReplyController');
    Route::delete('/reply/{reply}', 'ReplyController@destroy');
    Route::put('/reply/{reply}', 'ReplyController@update');

    Route::delete('/reply/{reply}/favorite', 'ReplyController@unFavoriteIt');
    Route::post('/reply/{reply}/favorite', 'ReplyController@favoriteIt');

    Route::post('notification', function () {
        return [
            'read' => UnReadNotification::collection(auth()->user()->readNotifications),
            'unread' => UnReadNotification::collection(auth()->user()->unReadNotifications)];
    })->middleware('jwt');

    Route::post('markAsRead', function () {
        return auth()->user()->notifications->where('id', request('id'))->markAsRead();
    });

    Route::post('category/all', 'CategoryController@index');
    Route::post('category', 'CategoryController@store');
});
