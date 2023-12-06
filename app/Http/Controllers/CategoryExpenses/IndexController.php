<?php

namespace App\Http\Controllers\CategoryExpenses;

use App\Http\Controllers\Controller;
use App\Models\CategoryExpenses;

class IndexController extends Controller
{
    public function __invoke()
    {
        return CategoryExpenses::all();
    }
}
