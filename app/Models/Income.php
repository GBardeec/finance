<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'incomes';

    protected $guarded = false;

    public function category()
    {
        return $this->belongsTo(CategoryIncomes::class, 'category_id')->select('id', 'title');
    }
}
