<?php
Route::view('/', 'inicio')-> name('inicio');
Route::view('/location', 'location') -> name('location');
Route::view('/usuarios', 'usuarios') -> name('usuarios');

Route::get('/roles', function(){
    return \App\Role::all();
});
Route::get('/roles', function(){
    return \App\Role::with('user')->get();
});

Route::view('/contacto', 'contacto') -> name('contacto');
Route::post('/contacto', 'MensajeController@store')->name('contacto.send');

Route::get('/add-to-cart/{product}', 'CartController@add')->name('cart.add')->middleware('auth');
Route::get('/cart', 'CartController@index')->name('cart.index')->middleware('auth');
Route::get('/cart/destroy/{itemId}', 'CartController@destroy')->name('cart.destroy')->middleware('auth');
Route::get('/cart/update/{itemId}', 'CartController@update')->name('cart.update')->middleware('auth');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout')->middleware('auth');

Route::get('/orders', 'OrderController@index')->name('orders.index');
Route::resource('orders','OrderController')->middleware('auth');
Route::resource('email','OrderPaid')->middleware('auth');

// Usuarios

Route::resource('usuarios','UsersController');

// Mis Pedidos

Route::resource('MisPedidos','MisPedidosController')->middleware('auth');

// Detalles de Pedidos
Route::resource('orders_items', 'OrderItemsController');

// Producto

Route::resource('product','ProductController');
Route::get('/products/admin', 'ProductController@admin')->name('products.index');

Route::view('/admin', 'admin')->middleware('auth') -> name('admin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Notificaciones

Route::resource('notification', 'NotificationController');
Route::get('notification/getMembers/{id}','NotificationController@getMembers');
Route::get('notification/howManyNotifications/{id}','NotificationController@howManyNotifications');
Route::get('notification/getMsgSend/{id}','NotificationController@getMsgSend');

