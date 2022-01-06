<?php

namespace App\Repositories;

use App\Models\AccountBalances;
use App\Repositories\BaseRepository;

/**
 * Class AccountBalancesRepository
 * @package App\Repositories
 * @version January 4, 2022, 3:06 pm UTC
*/

class AccountBalancesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'shares',
        'account_id',
        'tran_id',
        'start_dt',
        'end_dt'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AccountBalances::class;
    }
}
