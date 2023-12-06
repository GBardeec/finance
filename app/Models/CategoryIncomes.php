<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryIncomes extends Model
{
    use HasFactory;

    protected $table = 'category_incomes';

    protected $guarded = false;
}
