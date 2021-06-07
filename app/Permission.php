<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Junges\ACL\Traits\PermissionsTrait;

class Permission extends Model
{
   use HasFactory,PermissionsTrait;
   
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
           'Allocation'     => 'break',
           'groups'    => 'multi',
           'users' => 'multi',
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

   public function convertToGroupIds($groups)
    {
        $model = app(config('acl.models.group'));
        $groups = ! is_array($groups) ? [$groups] : $groups;

        return collect(array_map(function ($group) use ($model) {
            if ($group instanceof $model) {
                return $group->id;
            } elseif (is_numeric($group)) {
                $_group = $model->find($group);
                if ($_group instanceof $model) {
                    return $_group->id;
                } else {
                    throw GroupDoesNotExistException::withId($group);
                }
            } elseif (is_string($group)) {
                $_group = $model->where('slug', $group)->first();
                if ($_group instanceof $model) {
                    return $_group->id;
                } else {
                    throw GroupDoesNotExistException::withSlug($group);
                }
            }
        }, $groups));
    }

}
