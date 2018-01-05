<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/6/17
 * Time: 10:54 PM
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

class Repository
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}