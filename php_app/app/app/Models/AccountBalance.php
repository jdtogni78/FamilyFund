<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AccountBalance
 *
 * @property $id
 * @property $type
 * @property $shares
 * @property $account_id
 * @property $tran_id
 * @property $created
 * @property $updated
 * @property $active
 *
 * @property Account $account
 * @property Transaction $transaction
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AccountBalance extends Model
{
    
    static $rules = [
		'account_id' => 'required',
		'created' => 'required',
		'active' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['type','shares','account_id','tran_id','created','updated','active'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account()
    {
        return $this->hasOne('App\Models\Account', 'id', 'account_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction()
    {
        return $this->hasOne('App\Models\Transaction', 'id', 'tran_id');
    }
    

}
