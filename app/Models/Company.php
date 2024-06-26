<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory,SoftDeletes;
    use SoftDeletes;
    protected $fillable = [
        'name', 'email', 'logo', 'website', 'status'
        
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($company) {
            $company->employees()->delete();
        });
    }
    
    
}
