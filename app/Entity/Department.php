<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property string $name
 *
 */
class Department extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];
}
