<?php

namespace App\Repositories\Interfaces;

interface EmployeeRepositoryInterface
{
    public  function findWithJoin(int $id , array  $columns );
}

