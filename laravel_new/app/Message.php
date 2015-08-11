<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     protected $table = 'messages';

     protected $fillable = ['user_id','status','type_block1','content_block1'];

}
