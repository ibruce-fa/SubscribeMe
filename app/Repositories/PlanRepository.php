<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/3/17
 * Time: 10:37 PM
 */

namespace App\Repositories;
use App\Plan;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PlanRepository extends Repository implements RepositoryInterface
{
    private $model;

    public function __construct(Plan $planObject)
    {
        parent::__construct($planObject);

        $this->model = $planObject;
    }

    public function search($query = "")
    {
        $plan = $this->model;

        return $plan::where('stripe_plan_name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();
    }
}