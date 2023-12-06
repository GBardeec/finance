<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet as PhpSpreadsheetWorksheet;

class ExpensesSheet implements FromCollection, WithTitle, WithHeadings, WithColumnFormatting, WithColumnWidths, WithStyles
{
    protected $expenses;

    public function __construct($expenses)
    {
        $this->expenses = $expenses;
    }

    public function title(): string
    {
        return 'Расходы';
    }

    public function collection(): Collection
    {
        $index = 0;

        $data = $this->expenses->map(function ($expense) use (&$index) {
            unset($expense['id'], $expense['user_id'], $expense['created_at'], $expense['updated_at']);

            return [
                '№' => ++$index,
                'Значение' => $expense->value,
                'Категория' => $expense->category->title,
            ];
        });

        $totalValue = $this->expenses->sum('value');
        $data->push([
            '№' => 'Итог',
            'Значение' => $totalValue,
            'Категория' => '',
        ]);

        return $data;
    }

    public function headings(): array
    {
        $categoryTitles = $this->expenses->map(function ($expense) {
            return $expense->category->title;
        });

        return [
            '№',
            'Значение',
            'Категория'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
        ];
    }


    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 25,
            'C' => 35,
        ];
    }

    public function styles(PhpSpreadsheetWorksheet $sheet)
    {
        return [
            'A' => ['alignment' => ['horizontal' => 'center']],
            'B' => ['alignment' => ['horizontal' => 'center']],
            'C' => ['alignment' => ['horizontal' => 'center']],
        ];
    }
}
