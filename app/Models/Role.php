<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'role_permission','role_name','role_status','role_id'
    ];
    public function setRolePermissionAttribute($value)
    {
        $this->attributes['role_permission'] = json_encode($value);
    }

    public function getRolePermissionAttribute($value)
    {
        return $this->attributes['role_permission'] = json_decode($value);
    }
}
