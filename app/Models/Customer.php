<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function invoice () {
        return $this->hasMany(Invoice::class);
    }
    public function quotation () {
        return $this->hasMany(Quotation::class);
    }
    public function contract () {
        return $this->hasMany(Contract::class);
    }
}
