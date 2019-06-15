<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Models\Company;
use App\Repositories\BaseRepository;

class CompanyRepository implements CompanyRepositoryInterface
{
    use BaseRepository;

    /**
     * The validation instance.
     *
     * @var \App\Models\Company
     */
    protected $model;

    /**
     * CompanyRepository constructor.
     * @param Company $model
     */
    public function __construct(Company $model) {
        $this->model = $model;
    }

}
