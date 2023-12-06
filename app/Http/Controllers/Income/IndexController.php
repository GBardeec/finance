<?php

namespace App\Http\Controllers\Income;

use App\Http\Controllers\Controller;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke()
    {
        $user = Auth::guard('sanctum')->user();

        $incomes = Income::with('category')->where('user_id', $user->id)->get();

        return response()->json($incomes);
    }
}
