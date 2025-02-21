<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'tag_id',
        'user_id'
    ];

  // Define the relationship with User
  public function user()
  {
      return $this->belongsTo(User::class);
  }

  // Define the relationship with Tag
  public function tag()
  {
      return $this->belongsTo(Tag::class);
  }


  // Add this relationship method for answers
  public function answers()
  {
      return $this->hasMany(Answer::class);
  }
}
