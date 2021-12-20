<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\NextOfKinController;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\PrescriptionController;

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

// header("Cache-Control: no-cache, must-revalidate");
// header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function() {

    Route::group(['middleware' => ['api'], 'prefix' => 'auth'], function () {
        Route::post('register-as-doctor', [AuthController::class, 'registerAsDoctor']);
        Route::post('register-as-nurse', [AuthController::class, 'registerAsNurse']);
        Route::post('register-as-staff', [AuthController::class, 'registerAsStaff']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('profile',[AuthController::class, 'profile']);
        Route::get('create-roles',[AuthController::class, 'createRoles']);
        Route::get('getUserRoles',[AuthController::class, 'getUserRoles']);

    });

    Route::group(['middleware' => ['auth.jwt', 'api'], 'prefix' => 'patients'], function() {
        Route::get('/', [PatientController::class, 'index']);
        Route::post('/', [PatientController::class, 'store']);
        Route::get('/{patient}', [PatientController::class, 'show']);
        Route::put('/{patient}', [PatientController::class, 'update']);
        Route::delete('/{patient}', [PatientController::class, 'destroy']);
    });

    Route::group(['middleware' => ['auth.jwt', 'api'], 'prefix' => 'nextofkins'], function() {
        Route::get('/{patient}', [NextOfKinController::class, 'index']);
        Route::post('/{patient}', [NextOfKinController::class, 'store']);
        Route::get('/{nextofkin}/patient/{patientId}', [NextOfKinController::class, 'show']);
        Route::put('/{nextofkin}', [NextOfKinController::class, 'update']);
        Route::delete('/{nextofkin}', [NextOfKinController::class, 'destroy']);
    });

    Route::group(['middleware' => ['auth.jwt', 'api'], 'prefix' => 'healthrecords'], function() {
        Route::get('/{patient}', [HealthRecordController::class, 'index']);
        Route::post('/{patient}', [HealthRecordController::class, 'store']);
        Route::get('/{healthrecord}/patient/{patientId}', [HealthRecordController::class, 'show']);
        // Route::put('/{healthrecord}', [HealthRecordController::class, 'update']);
        Route::delete('/{healthrecord}', [HealthRecordController::class, 'destroy']);
    });

    Route::group(['middleware' => ['auth.jwt', 'api'], 'prefix' => 'prescriptions'], function() {
        Route::get('/{patient}', [PrescriptionController::class, 'index']);
        Route::post('/{patient}', [PrescriptionController::class, 'store']);
        Route::get('/{prescription}/patient/{patientId}', [PrescriptionController::class, 'show']);
        Route::put('/{nextofkin}', [PrescriptionController::class, 'update']);
        Route::delete('/{nextofkin}', [PrescriptionController::class, 'destroy']);
    });
});

