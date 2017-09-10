<?php

namespace App\Modules\Parser\Parsers;

/**
 * Class LinkParser
 * @package App\Modules\Parser\Parsers
 */
class LinkParser extends BaseParser
{
    /**
     * @return $this
     */
    public function parse()
    {
        if (preg_match_all('#<a\s[^>]*href=(\\"??)([^\\" >]*?)\\1[^>]*>(.*)<\/a>#siU',$this->content, $matches)) {
            $this->data = $matches[2];
        }

        return $this;
    }

}