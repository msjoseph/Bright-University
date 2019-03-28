<?php

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

Route::get('/', 'HomepageController@index');
Route::get('/students', 'StudentsPageController@index');
Route::resource('BrightDrive', 'BrightDriveController');
Route::resource('BrightDriveUpload', 'FileUploadController');
Route::resource('SharedFiles', 'DriveShareController');
Route::get('/DriveDownload/{file}', 'DriveDownloadController@download');
Route::resource('about', 'AboutController');
Route::resource('news', 'PostsController');
Route::resource('projects', 'ProjectsController');
Route::resource('StudentsManagement', 'StudentsController');
Route::resource('schools', 'SchoolsController');
Route::resource('courses', 'CoursesController');
Route::resource('AdminTodo', 'AdminTodoController');
Route::resource('units', 'UnitsController');
Route::resource('calendar', 'CalendarController');
Route::resource('UnitsRegistration', 'UnitsRegistrationController');
Route::resource('UnitsSubmission', 'ExamController');
Route::resource('lecturers', 'LecturersController');
Route::resource('finance', 'FinanceController');
Route::resource('hostels', 'HostelsController');
Route::resource('examcodes', 'ExamCodesController');
Route::resource('HostelOwners', 'HostelOwnerController');
Route::resource('HostelBooking', 'HostelBookingController');
Route::get('/dashboard', 'DashBoardController@index');
Route::get('/SubmitMarks', 'SubmitMarksController@index');
Auth::routes();


Route::resource('eatube', 'EaTubeController');
Route::get('/EaTubeStreaming', 'EaTubeController@proceed');
Route::resource('EaUpload', 'EaUploadController');
Route::resource('comments', 'EaCommentsController');


