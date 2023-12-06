<?php

namespace App\Exports;

use App\Models\Expenses;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FinanceExport implements WithMultipleSheets
{
    /**
     * @return array
     */
    public function sheets(): array
    {
        $user = Auth::guard('sanctum')->user();

        $expenses = Expenses::with('category')
            ->where('user_id', $user->id)
            ->get();

        $incomes = Income::with('category')
            ->where('user_id', $user->id)
            ->get();


        $expensesSheet = new ExpensesSheet($expenses);
        $incomesSheet = new IncomesSheet($incomes);

        return [
            'Expenses' => $expensesSheet,
            'Incomes' => $incomesSheet,
        ];
    }
}


