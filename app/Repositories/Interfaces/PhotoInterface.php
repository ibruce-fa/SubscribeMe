<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 4/28/18
 * Time: 5:04 PM
 */

namespace App\Repositories\Interfaces;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

interface PhotoInterface
{

    public function store(UploadedFile $file, $folderName);

    public function retrieve($filename);

    public function unlink($filename);
}