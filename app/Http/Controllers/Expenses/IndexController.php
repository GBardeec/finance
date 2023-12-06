<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use App\Models\Expenses;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke()
    {
        $user = Auth::guard('sanctum')->user();

        $expenses = Expenses::with('category')->where('user_id', $user->id)->get();

        return response()->json($expenses);
    }
}
