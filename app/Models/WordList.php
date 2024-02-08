<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordList extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'lists';

    public $timestamps = false;

    public function words()
    {
        return $this->hasMany(Word::class, 'list_id');
    }
    public function result()
    {
        return $this->belongsTo(Result::class, 'id', 'wordlist_id');
    }
}
