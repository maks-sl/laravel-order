<?php

namespace App\Entity\Parsers\Single;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Eloquent
 *
 * @property int $id
 * @property int $parser_id
 * @property string $value
 * @property Carbon $created_at
 *
 * @property Parser $parser
 */
class Result extends Model
{
    public $timestamps = false;

    protected $fillable = ['value'];

    protected $table = "parser_single_results";

    // ########### RELATIONS #############

    public function parser()
    {
        return $this->belongsTo(Parser::class);
    }
}
