<?php

namespace App\Models;

/**
 * Class ParseResult
 * @package App\Models
 */
class ParseResult extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'count', 'results', 'type'
    ];
}