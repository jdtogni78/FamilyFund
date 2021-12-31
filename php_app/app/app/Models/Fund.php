<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Fund
 *
 * @property $id
 * @property $name
 * @property $goal
 * @property $total_shares
 * @property $created
 * @property $updated
 *
 * @property Account[] $accounts
 * @property Portfolio[] $portfolios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Fund extends Model
{
    
    static $rules = [
		'name' => 'required',
		'total_shares' => 'required',
		'created' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','goal','total_shares','created','updated'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accounts()
    {
        return $this->hasMany('App\Models\Account', 'fund_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function portfolios()
    {
        return $this->hasMany('App\Models\Portfolio', 'fund_id', 'id');
    }
    

}
