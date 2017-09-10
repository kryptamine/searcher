<?php

namespace App\Modules\Parser\Parsers;

/**
 * Class ImageParser
 * @package App\Modules\Parser\Parsers
 */
class ImageParser extends BaseParser
{
    /**
     * @return $this
     */
    public function parse()
    {
        if (preg_match_all('/<img[^>]+src="?\'?([^"\']+)"?\'?[^>]*>/i', $this->content, $matches)) {
            $this->data = $matches[1];
        }

        return $this;
    }
}