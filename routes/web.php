<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Http\Request;
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

Route::get('/post', 'PostController@index')->name("index");

Route::get('/test', function () {
    $user= new User();
    $all_users= $user::all();
    dd($all_users);
});

//Route::get('/home',function (){
//    $html="<h1>học lập trình laravel trên</h1>";
//    return $html;
//});



Route::post('/post12',function (){
  return 'Phương thức post của path/..';
});
Route::get('/show',function (){
   return view('form');
   // return 'Phương thức post của path/..';
});

Route::match(['get','post'],'/math',function (){
    // biến server sẽ nhận biết được phương thức đang sử dụng là gì (REQUEST_METHOD), và nó có thuộc mảng method không
    dd($_SERVER);
});
Route::any('/any',function (Request $request){
   // return 'Phương thức post của path/..';
    // đối với any cần tạo ra request thì mới lấy ra dc request hiện tại , khi mà ta đã custom lại
    return $request->method();
});

//Route::redirect('/redirect', 'show');// có thể chuyển hướng được cả đến 1 trang web cụ thể nếu k để gì thì statust mặc định là 302

Route::redirect('/redirect', 'show',302);// kiểm tra trong network all
// liên quan đến http response status code tìm hiểu thêm

Route::view('show-form','form');

Route::prefix('admin')->group(function (){
    Route::get('/home/{id}',function ($id){
        $html="<h1>học lập trình laravel</h1>";
        $content=$html.' với route truyền tham số id='.$id;
        return $content;
    });
    //chạy http://127.0.0.1:8000/admin/home/3

    Route::get('/home2/{slug}-{id}.html',function ($slug,$id){
        $html="<h1>học lập trình laravel</h1>";
        $content=$html." với route truyền tham số slug=". $slug. ",  id= ".$id;
        return $content;
    });
    //chạy http://127.0.0.1:8000/admin/home2/tintuc-3.html tuy nhiên cái $slug sẽ phải có thêm ràng buộc trong thực tế
    //note: các {tham số} sẽ tương ứng với lần lượt các biến bạn đặt trong callback
    //- ràng buộc tham số k bắt buộc: khai báo {id?} và trong callback có thể gán $id=null thì nó k lỗi

    Route::get('/hello', function () {
        return view('hello');
    })->name('admin.hello');

    Route::get('validate/{slug?}-{id?}', function ($slug=null,$id=null) {
        $html="<h1>học lập trình laravel</h1>";
        $content=$html." với route truyền tham số slug=". $slug. ",  id= ".$id;
        return $content;
    })->where('id', '[0,9]+')->where('slug','[.+]');

//        [để dạng mảng khá là tiện
//            'slug'=>'[a-z-]+',//'.+' đại diện cho tất cả các ký tự
//            'id'=>'[0-9]+'
//        ]

    Route::prefix('product')->group(function (){
        Route::get('list',function (){
            return "danh sách sản phẩm";
        });

        Route::get('add/{id}',function ($id){
            return "thêm sản phẩm:".$id;
        })->where('id','[0,9]+')->name('admin.product.add');
    });

    // phải thực hiện gõ /admin/+ route mong muốn nó mới hiển thị
});
