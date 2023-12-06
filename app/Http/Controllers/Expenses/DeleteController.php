<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use App\Models\Expenses;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function __invoke($id)
    {
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            $expense = Expenses::find($id);

            if ($expense) {
                $expense->delete();
                return response()->json(['message' => 'Income deleted successfully'], 200);
            } else {
                return response()->json(['error' => 'Income not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
