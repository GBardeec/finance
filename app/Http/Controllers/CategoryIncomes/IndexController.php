<?php

namespace App\Http\Controllers\CategoryIncomes;

use App\Http\Controllers\Controller;
use App\Models\CategoryIncomes;

class IndexController extends Controller
{
    public function __invoke()
    {
        return CategoryIncomes::all();
    }
}
