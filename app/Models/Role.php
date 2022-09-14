<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Role extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function users() {
        return $this->belongsToMany(User::class);
    }
    public static function getRoles()
    {
        /*
         * This Condation to check if We have a Table call roles or not and that cuz we call this method in AuthServiceProvider
         * And The AuthService Work Before a migration level so we must to do that to ِavoid no table error
         */
        if (!Schema::hasTable('roles')) {
            return [];
        }
        return self::all()->reduce(function($carry, $role) {
            $carry[$role->role] = str_replace('.',' can ',$role->role);
            return $carry;
        }, []);
    }

}
