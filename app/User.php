<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Junges\ACL\Traits\UsersTrait;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use Notifiable;
    use UsersTrait;
    use HasApiTokens, HasFactory ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static $html_disabled = [
        'email',
    ];
    static $html_casts = [
        'general'=>
        [
            'email'=>'email',
            'name' => 'text',
            'password' => 'password',
            'Allocation'     => 'break',
            'groups'    => 'multi',
            'permissions' => 'multi',
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
        'email','name'
    ];
}
