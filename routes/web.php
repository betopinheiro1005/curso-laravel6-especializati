<?php

Route::any('products/search', 'ProductController@search')->name('products.search')->middleware('auth');

// CRUD

// Route::resource('/products', 'ProductController');
Route::resource('/products', 'ProductController')->middleware('auth');

/* Route::delete('/products/{id}', 'ProductController@destroy')->name('products.destroy');
Route::put('/products/{id}', 'ProductController@update')->name('products.update');
Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');
Route::get('/products/create', 'ProductController@create')->name('products.create');
Route::post('/products', 'ProductController@store')->name('products.store');
Route::get('/products/{id}', 'ProductController@show')->name('products.show');
Route::get('/products', 'ProductController@index')->name('products.index');
 */

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

 // ===================================================================

// Grupo de rotas


// Route::get('login', function () {
//     return 'Página de Login';
// })->name('login');

Route::group([
    'middleware' => [],
    'prefix' => 'admin',
    'namespace' => 'Admin' 
], function(){
    Route::get('/dashboard', 'TesteController@dashboard')->name('admin.dashboard');
    Route::get('/financeiro', 'TesteController@financeiro')->name('admin.financeiro');
    Route::get('/produtos', 'TesteController@produtos')->name('admin.produtos');
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
});

/* Route::middleware([])->group(function () {
    Route::prefix('/admin')->group(function() {
        Route::namespace('Admin')->group(function() {
            Route::get('/dashboard', 'TesteController@dashboard')->name('admin.dashboard');
            Route::get('/financeiro', 'TesteController@financeiro')->name('admin.financeiro');
            Route::get('/produtos', 'TesteController@produtos')->name('admin.produtos');
            Route::get('/', function () {
                return redirect()->route('admin.dashboard');
            });
        });
    });
});
 */

Route::middleware([])->group(function () {
    Route::prefix('/panel')->group(function() {
        Route::get('/dashboard', function () {
            return 'Home Panel';
        });
        
        Route::get('/financeiro', function () {
            return 'Financeiro Panel';
        });
        
        Route::get('/produtos', function () {
            return 'Produtos Panel';
        });
        
        Route::get('/', function () {
            return 'Panel';
        });
    });
});

// Route::get('login', function () {
//     return 'Página de Login';
// })->name('login');

// Route::get('/panel/dashboard', function () {
//     return 'Home Panel';
// })->middleware('auth');

// Route::get('/panel/financeiro', function () {
//     return 'Financeiro Panel';
// })->middleware('auth');

// Route::get('/panel/produtos', function () {
//     return 'Produtos Panel';
// })->middleware('auth');

// ===================================================================

// Rotas nomeadas

 Route::get('/exemplo1', function () {
     return redirect()->route('url.name');
 });

 Route::get('/name-url', function () {
    return 'Exemplo de rota nomeada';
})->name('url.name');


// ===================================================================

// Redirecionando para uma view

Route::view('/clientes', 'testes.customers');

// Redirecionando para uma outra rota

Route::redirect('/old_page', '/new_page');

// Route::get('/old_page', function () {
//     return redirect('/new_page');
// });

Route::get('/new_page', function () {
    return 'Redirecionado para a nova página';
});

// Rotas com view

Route::get('/redirect', function () {
    return redirect('/new_page');
});

Route::get('/new_page', function () {
    return 'Redirecionado para a nova página';
});

// ===================================================================

// Rotas com parâmetros opcionais

/* Route::get('/products/{id?}', function ($id = '') {
    if ($id == '') {
        return "Listagem de produtos";
    } else {
        return "Produtos da categoria {$id}";
    }
});
 */
// Rotas com parâmetros

Route::get('/category/{id}/posts', function ($id) {
    return "Posts da categoria {$id}";
});

Route::get('/category/{id}', function ($id) {
    return "Produtos da categoria {$id}";
});

// ===================================================================

Route::match(['get', 'post'],'/match', function () {
    return 'Exemplo de rota do tipo match';
});

Route::any('/any', function () {
    return 'A rota any permite todos tipos de acesso de verbo HTTP.';
});

Route::get('/customers', function () {
    return view('testes.customers');
});

Route::get('/contact', function () {
    return 'Página de Contato';
});

Route::get('/', function () {
    return view('welcome');
});

