<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AccountHolder
 *
 * @property $id
 * @property $first_name
 * @property $last_name
 * @property $email
 * @property $type
 * @property $created
 * @property $updated
 *
 * @property Account[] $accounts
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AccountHolder extends Model
{
    
    static $rules = [
		'first_name' => 'required',
		'last_name' => 'required',
		'email' => 'required',
		'type' => 'required',
		'created' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','email','type','created','updated'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accounts()
    {
        return $this->hasMany('App\Models\Account', 'user_id', 'id');
    }
    

}
