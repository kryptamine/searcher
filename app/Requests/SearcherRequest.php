<?php

namespace App\Requests;

/**
 * Class SearcherRequest
 */
class SearcherRequest extends BaseRequest
{
    /**
     * @return array
     */
    public static function rules()
    {
        return [
            'url'        => ['required', 'url'],
            'parse_type' => ['required', ['in', ['image', 'text', 'link']]]
        ];
    }
}