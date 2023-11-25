<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['company_name', 'location'];
    protected $primaryKey = 'company_id';
    public function emloyees()
    {
        return $this->hasMany(Employee::class);
    }
}
