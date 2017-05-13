<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     //指定表名
    protected $table = 'users';

    protected $fillable = [
        'id',
        'nickname',
        'username',
        'phone',
        'email',
        'location',
        'age',
        'sex',
        'role_id',
        'alipay',
        'alipay_tips',
        'icon',
        'wechat',
        'wechat_tips',
        'averagelists_id',
        'password',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        //不让回传密码
        'password',
    ];
}
