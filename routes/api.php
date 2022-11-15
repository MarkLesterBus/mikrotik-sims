<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\BridgeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DeviceController;

use App\Models\Router;
use RouterOS\Client;
use RouterOS\Query;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/me', [AuthController::class, 'me']);
// });
// Route::middleware('auth:sanctum')->group(function () {
// });
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('/users', UserController::class);
Route::resource('/routers', RouterController::class);
Route::resource('/bridges', BridgeController::class);
Route::resource('/profile', ProfileController::class);
Route::resource('/devices', DeviceController::class);

// Route::group(['prefix' => '/devices'], function () {
//     Route::get('/{uuid}', [DeviceController::class, 'index']);
//     Route::get('/{uuid}/logs', [DeviceController::class, 'logs']);

//     Route::get('/{uuid}/system/clock', [DeviceController::class, 'clock']);
//     Route::get('/{uuid}/system/resource/', [DeviceController::class, 'resource']);

//     Route::get('/{uuid}/interface', [DeviceController::class, 'interfaces']);
//     Route::get('/{uuid}/interface/traffic/{interface}', [DeviceController::class, 'traffic']);

//     Route::get('/{uuid}/ip/hotspot', [DeviceController::class, 'servers']);
//     Route::get('/{uuid}/ip/hotspot/profiles', [DeviceController::class, 'server_profiles']);
//     Route::get('/{uuid}/ip/dhcp', [DeviceController::class, 'dhcp']);
//     Route::get('/{uuid}/ip/pool', [DeviceController::class, 'pool']);
//     Route::get('/{uuid}/ip/addresses', [DeviceController::class, 'addresses']);
//     Route::get('/{uuid}/ip/queue/simple', [DeviceController::class, 'queue_simple']);
//     Route::get('/{uuid}/ip/queue/tree', [DeviceController::class, 'queue_tree']);
// });
// Route::group(['prefix'=>'/bridges'],function(){

//     Route::get('/', function(Router $router) {
//         $client = new Client(['host' => '192.168.88.1','user' => 'admin','pass' =>  'bossM4rkl3st3r4n0','port' => 8728,]);
//         $bridge = $client->query('/interface/bridge/print')->read();
//         return $bridge;
//     });
//     Route::post('/', function(Request $request,Router $router) {
//         $client = new Client(['host' => (string)env('MIKROTIK_HOST'),'user' => (string)env('MIKROTIK_USER'),'pass' =>  (string)env('MIKROTIK_PASS'),'port' => (int) env('MIKROTIK_PORT'),]);
//         $query = (new Query('/interface/bridge/add'))->equal('name', $request->name);
//         $rs = $client->query($query)->read();
//         return $rs;
//     });
//     // Route::get('/hotspot', function(Request $request, Router $router){
//     //     $client = RouterOS::client(['host' => $router->host,'user' => $router->user,'pass' => $router->pass,'port' => (int)$router->port,]);
//     //     $hotspot = $client->query('/ip/hotspot/getall')->read();
//     //     return $hotspot;
//     // });
// });