<?php

namespace App\Http\Controllers;

use App\News;

class NewsController extends Controller {

    public function index() {
        return News::all();
    }
}
