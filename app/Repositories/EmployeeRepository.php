<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    use BaseRepository;

    /**
     * The validation instance.
     *
     * @var \App\Models\Employee
     */
    protected $model;

    /**
     * EmployeeRepository constructor.
     * @param Employee $model
     */
    public function __construct(Employee $model) {
        $this->model = $model;
    }



    public function findWithJoin(int $id , array  $columns )
    {
        return $this->model->select($columns)
            ->join('companies', function ($join){
                $join->on(
                    'companies.id',
                    '=',
                    'employees.company_id'
                );
            })
            ->find($id);
    }

}