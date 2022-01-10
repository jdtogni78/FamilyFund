<?php

namespace App\Repositories;

use App\Models\AccountsExt;
use App\Repositories\BaseRepository;

/**
 * Class AccountsRepository
 * @package App\Repositories
 * @version January 4, 2022, 6:08 pm UTC
*/

class AccountsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'nickname',
        'email_cc',
        'user_id'
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
        return AccountsExt::class;
    }
}
