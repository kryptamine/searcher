<?php

namespace App\Modules\Parser\Parsers;


/**
 * Class TextParser
 * @package App\Modules\Parser\Parsers
 */
class TextParser extends BaseParser
{
    /**
     * @return $this
     */
    public function parse()
    {
        $this->data[] = $this->parser->getSearchValue();

        return $this;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return substr_count(strip_tags($this->parser->getContent()), $this->parser->getSearchValue());
    }
}