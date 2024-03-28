<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = ['title', 'content', 'type_id'];

    public function printImage(){
        return asset('storage/' . $this->image);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    // Accessor
    public function image(): Attribute
    {
        return Attribute::make(fn($value) => $value && app('request')->is('api/*') ? url('storage/' . $value) : $value);
    }
}
