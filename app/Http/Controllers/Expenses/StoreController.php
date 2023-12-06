<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Income\StoreRequest;
use App\Models\Expenses;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request -> validated();
        $user = Auth::guard('sanctum')->user();

        Expenses::create([
            'value' => $data['value'],
            'category_id' => $data['selectedCategory'],
            'user_id' => $user->id,
        ]);

        echo true;
    }
}
