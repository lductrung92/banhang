<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use Session;

class BaseAdminController extends Controller
{
    public function index() {
        return View::make('page_admin.index');
    } 

    /** chooser language */

    public function chooser($lang) {
        Session::put('locale', $lang);
        return back();
    }
}
