<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'position', 'company_id'];
    protected $primaryKey = 'employee_id';
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
