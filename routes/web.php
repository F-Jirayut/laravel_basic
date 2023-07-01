<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
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

// http://localhost:8000/

// Request Method
// โดย method ที่สำคัญมี 4 ตัวคือ GET, POST, PUT, DELETE
// GET — เป็นการเรียกรับข้อมูลจาก URI ที่กำหนด method GET ควรใช้ในการดึงข้อมูลเท่านั้นและต้องไม่มีผลกระทบใด ๆ กับข้อมูล
// POST — ใช้สำหรับการสร้างข้อมูลใหม่โดยส่งข้อมูลผ่าน body
// PUT — ใช้สำหรับแทนที่ข้อมูลที่มีทั้งหมดด้วยข้อมูลใหม่ที่ส่งขึ้นไป
// DELETE — ใช้สำหรับลบข้อมูลที่มีอยู่ ของเป้าหมายที่กำหนดโดย URI

Route::get('/', function () {
    return view('welcome');
});

// http://localhost:8000/departments => https://kuse.csc.ku.ac.th/departments
// http://localhost:8000/form/ => https://kuse.csc.ku.ac.th/form
Route::get('departments', [DepartmentController::class, 'index'])->name('department.index');
Route::get('department/form/{id?}', [DepartmentController::class, 'form'])->name('department.form');
Route::post('department/form/{id?}', [DepartmentController::class, 'formSubmit'])->name('department.form.submit');
Route::post('department/delete/{id}', [DepartmentController::class, 'delete'])->name('department.delete');

Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'login']);

// http://localhost:8000/users  => https://kuse.csc.ku.ac.th/users
// Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::get('basic/select', [BasicController::class, 'select'])->name('basic.select');
Route::get('basic/insert', [BasicController::class, 'insert'])->name('basic.insert');
Route::get('basic/update', [BasicController::class, 'update'])->name('basic.update');
Route::get('basic/delete', [BasicController::class, 'delete'])->name('basic.delete');

Route::get('basic/mock/data', [BasicController::class, 'mockData'])->name('basic.mock.data');
Route::get('generate-mock-users', [UserController::class, 'generateMockUsers']);



