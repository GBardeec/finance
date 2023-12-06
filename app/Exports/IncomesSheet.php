<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet as PhpSpreadsheetWorksheet;

class IncomesSheet implements FromCollection, WithTitle, WithHeadings, WithColumnFormatting, WithColumnWidths, WithStyles
{
    protected $incomes;

    public function __construct($incomes)
    {
        $this->incomes = $incomes;
    }

    public function title(): string
    {
        return 'Доходы';
    }


    public function collection(): Collection
    {
        $index = 0;

        $data = $this->incomes->map(function ($income) use (&$index) {
            unset($income['id'], $income['user_id'], $income['created_at'], $income['updated_at']);

            return [
                '№' => ++$index,
                'Значение' => $income->value,
                'Категория' => $income->category->title,
            ];
        });

        $totalValue = $this->incomes->sum('value');
        $data->push([
            '№' => 'Итог',
            'Значение' => $totalValue,
            'Категория' => '',
        ]);

        return $data;
    }

    public function headings(): array
    {
        $categoryTitles = $this->incomes->map(function ($income) {
            return $income->category->title;
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

