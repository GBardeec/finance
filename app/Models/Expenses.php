<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $table = 'expenses';
    protected $guarded = false;

    public function category()
    {
        return $this->belongsTo(CategoryExpenses::class, 'category_id')->select('id', 'title');
    }
}
