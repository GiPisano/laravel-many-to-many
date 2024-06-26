<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'color'];

    public function projects(){
        return $this->belongsToMany(project::class);
    }

    public function getTechnologyBadge(){
        return "<span class='badge' style='background-color:$this->color'>$this->label</span>";
    }
}
