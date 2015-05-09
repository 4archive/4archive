<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class MainController extends BaseController
{
    /** Not used. View routes.php **/
    public function index()
    {
        return view('home');
    }
}
