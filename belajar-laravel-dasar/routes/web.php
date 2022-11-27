<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\RedirectController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\InputController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/aw', function () {
    return "Hello Awonapa";
});

Route::redirect('/youtube', '/aw', 301);

Route::fallback(function () {
    return "404 Awonapa";
});

Route::view('/hello', 'hello', ['name' => 'Wahyu']);

Route::get('/helloagain', function () {
    return view('hello', ['name' => "Udin"]);
});

Route::get('/hello-world', function () {
    return view('hello.world', ['name' => "Udin"]);
});


Route::get('/products/{id}', function ($productId) {
    return "Product " . $productId;
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

Route::get('/categories/{id}', function ($categoryId) {
    return "Category " . $categoryId;
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function ($userId = '404') {
    return "User $userId";
});


Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});

// routing request
Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);

Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);

Route::post('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirstName']);

// route get input all
Route::post('/input/hello/input', [\App\Http\Controllers\InputController::class, 'helloInput']);

// get array input
Route::post('/input/hello/array', [\App\Http\Controllers\InputController::class, 'helloArray']);

// input type
Route::post('/input/type', [\App\Http\Controllers\InputController::class, 'inputType']);

// filter request input
Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept']);

// filter merge
Route::post('/input/filter/merge', [\App\Http\Controllers\InputController::class, 'filterMerge']);

// file upload
Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload']);

// response
Route::get('/response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);
Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);

// // file response view, json, file, download
// Route::get('/response/type/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
// Route::get('/response/type/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
// Route::get('/response/type/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
// Route::get('/response/type/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);

// file response view, json, file, download dengan route group prefix
Route::prefix("/response/type")->group(function () {
    Route::get('/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
    Route::get('/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
    Route::get('/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
    Route::get('/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);
});

// cookie pada laravel
// Route::get('/cookie/set', [\App\Http\Controllers\CookieController::class, 'createCookie']);
// Route::get('/cookie/get', [\App\Http\Controllers\CookieController::class, 'getCookie']);
// Route::get('/cookie/clear', [\App\Http\Controllers\CookieController::class, 'clearCookie']);

// cookie menggunakan router controller
Route::controller(CookieController::class)->group(function () {
    Route::get('/cookie/set', 'createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');
});


// redirect
Route::get('/redirect/from', [\App\Http\Controllers\RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [\App\Http\Controllers\RedirectController::class, 'redirectTo']);

// redirect with route
Route::get('/redirect/name', [\App\Http\Controllers\RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [\App\Http\Controllers\RedirectController::class, 'redirectHello'])->name('redirect-hello');

// URL Generation - route url named
Route::get('/redirect/named', function () {
    // route function
    // return route('redirect-hello', ['name' => 'wahyu']);

    // url route
    // return url()->route('redirect-hello', ['name' => 'wahyu']);

    // facades url
    return \Illuminate\Support\Facades\URL::route('redirect-hello', ['name' => 'wahyu']);
});

Route::get('/redirect/action', [RedirectController::class, 'redirectAction']);

// redirect luar domain
Route::get('/redirect/away', [RedirectController::class, 'redirectAway']);
// Route::get('/redirect/away', [\App\Http\Controllers\RedirectController::class, 'redirectAway']);


// penggunaan middleware
// Route::get('/middleware/api', function() {
//     return "OK";
// // })->middleware([\App\Http\Middleware\ContohMiddleware::class]);
// })->middleware(['contoh']);


// // middleware dengan parameter
// Route::get('/middleware/api', function () {
//     return "OK";
//     // })->middleware([\App\Http\Middleware\ContohMiddleware::class]);
// })->middleware(['contoh:awonapa, 401']);

// // middleware menggunakan group
// Route::get('/middleware/group', function () {
//     return "GROUP";
//     // })->middleware([\App\Http\Middleware\ContohMiddleware::class]);
// })->middleware(['awonapa']);

// // middleware menggunakan route
// Route::middleware(['contoh:awonapa,401'])->group(function () {
//     // middleware dengan parameter
//     Route::get('/middleware/api', function () {
//         return "OK";
//     });

//     // middleware menggunakan group
//     Route::get('/middleware/group', function () {
//         return "GROUP";
//     });
// });


// middleware menggunakan multiple route group
Route::middleware(['contoh:awonapa,401'])->prefix('/middleware')->group(function () {
    // middleware dengan parameter
    Route::get('/api', function () {
        return "OK";
    });

    // middleware menggunakan group
    Route::get('/group', function () {
        return "GROUP";
    });
});

// without middleware upload
Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload'])
    ->withoutMiddleware([VerifyCsrfToken::class]);


// belajar csrf upload
Route::get('/form', [\App\Http\Controllers\FormController::class, 'form']);
Route::post('/form', [\App\Http\Controllers\FormController::class, 'submitForm']);

// URL Generation - form controller action

Route::get('/url/action', function () {
    // return action
    // return action([\App\Http\Controllers\FormController::class, 'form'], []);

    // return url action
    // return url()->action([\App\Http\Controllers\FormController::class, 'form'], []);

    // facades url action
    return \Illuminate\Support\Facades\URL::action([\App\Http\Controllers\FormController::class, 'form'], []);
});

// URL Generation
Route::get('/url/current', function () {
    //    url()->current();
    return \Illuminate\Support\Facades\URL::full();
});
