<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/3/17
 * Time: 10:18 PM
 */

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


interface RepositoryInterface
{
    public function search($query = "", $lat = null, $lng = null, $distance = null);

}