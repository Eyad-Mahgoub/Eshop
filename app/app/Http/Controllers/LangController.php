<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function index($lang)
    {
        app()->setLocale($lang);
        return redirect()->back();
    }
}
