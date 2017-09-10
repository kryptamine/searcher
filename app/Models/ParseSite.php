<?php

namespace App\Models;

/**
 * Class ParseSite
 * @package App\Models
 */
class ParseSite extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany(ParseResult::class);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public static function fillData(array $data)
    {
        if ($parseSite = self::firstOrCreate(['url' => $data['url']])) {
            return $parseSite->results()->firstOrCreate(['type' => $data['parse_type']],[
                'type'    => $data['parse_type'],
                'count'   => $data['count'],
                'results' => implode($data['data'], ',')
            ])->toArray();
        }

        return [];
    }
}