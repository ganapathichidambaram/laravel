<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
   use HasFactory;
   
   protected $fillable = [
      'slug', 'name',
   ];
   
   static $html_disabled = [
       
   ];
   static $html_casts = [
       'general'=>
       [
           'name' => 'text',
           'slug' => 'text',
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
    public function roles() {

        return $this->belongsToMany(Role::class,'roles_permissions');
            
     }
     
     public function users() {
     
        return $this->belongsToMany(User::class,'users_permissions');
            
     }
}
