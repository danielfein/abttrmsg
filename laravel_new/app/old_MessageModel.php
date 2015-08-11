<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
     protected $table = 'messages';

     protected $fillable = ['user_id','message','status','layout_type','type_block1','content_block1'];

}
