<?php

namespace App\Http\Controllers\ExportToExcel;

use App\Exports\FinanceExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class IndexController extends Controller
{
    public function __invoke()
    {
        return Excel::download(new FinanceExport, 'finance.xlsx');
    }
}
