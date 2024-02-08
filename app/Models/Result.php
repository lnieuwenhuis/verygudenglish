<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'lists';


    public $timestamps = false;

    public function wordlists()
    {
        return $this->hasMany(WordList::class, 'wordlist_id');

    }
    public function students()
    {
        return $this->hasMany(Student::class, 'student_id');

    }
    public function periods()
    {
        return $this->hasMany(Period::class, 'period_id');

    }

}
