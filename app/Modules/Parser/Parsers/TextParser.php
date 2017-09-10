<?php

namespace App\Modules\Parser\Parsers;


/**
 * Class TextParser
 * @package App\Modules\Parser\Parsers
 */
class TextParser extends BaseParser
{

    public function parse()
    {
        $xPath = new DOMXPath($this->domDocument);

        $xPath->query('всемайки');

    }

}