<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property string $name
 * @property string $color
 *
 */
class Country extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];
}
