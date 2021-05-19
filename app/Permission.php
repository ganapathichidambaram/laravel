<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
   use HasFactory;
   
   protected $fillable = [
      'slug', 'name','description',
   ];
   
   static $html_disabled = [
       
   ];
   static $html_casts = [
       'general'=>
       [
           'name' => 'text',
           'slug' => 'text',
           'description' => 'text',
       ],
       'additional'=>
       [
           
       ],
       'list' => 'col-md-4',
       'view' => 'col-md-8',
       'layout' => 2, // 2- Column Layout
       'search' => true,
       'create' => true,
       'action_edit' => true,
       'action_delete' => true,
       
   ];
   static $table_list = [
       'name'
   ];

}
