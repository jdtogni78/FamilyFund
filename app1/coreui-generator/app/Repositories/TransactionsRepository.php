<?php

namespace App\Repositories;

use App\Models\Transactions;
use App\Repositories\BaseRepository;

/**
 * Class TransactionsRepository
 * @package App\Repositories
 * @version January 4, 2022, 3:07 pm UTC
*/

class TransactionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'source',
        'type',
        'shares',
        'account_id',
        'matching_id'
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
        return Transactions::class;
    }
}
