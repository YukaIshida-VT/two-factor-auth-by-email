<?php

namespace TwoFactorAuthByEmail;

use Illuminate\Database\Eloquent\Model;

class TwoFactorAuthByEmailTable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'two_factor_auth_by_email';

    public $timestamps = false; // updated_atカラムが存在しないため
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'auth_code',
        'created_at',
    ];
}
