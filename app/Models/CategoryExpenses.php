<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryExpenses extends Model
{
    use HasFactory;

    protected $table = 'category_expenses';

    protected $guarded = false;
}
