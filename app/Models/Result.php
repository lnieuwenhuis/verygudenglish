<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'results';


    public $timestamps = false;

    public function wordlists()
    {
        return $this->hasMany(WordList::class, 'id', 'wordlist_id');
    }
    public function students()
    {
        return $this->hasMany(User::class, 'id', 'student_id');
    }
    public function periods()
    {
        return $this->hasMany(Period::class, 'id', 'period_id');
    }
}
