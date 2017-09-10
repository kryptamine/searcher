<?php

namespace App\Modules\Parser;

use App\Modules\Parser\Parsers\BaseParser;

/**
 * Class Parser
 * @package App\Modules\Parser
 */
class Parser
{
    /**
     * @param string $type
     * @param string $content
     *
     * @return BaseParser
     * @throws \Exception
     */
    public static function build(string $type, string $content) : BaseParser
    {
        $class = sprintf('%s\\Parsers\\%sParser', __NAMESPACE__, ucfirst($type));

        if (!class_exists($class)) {
            throw new \Exception("Class $class not found or doesn't implement $type parser");
        }

        /** @var BaseParser */
        return new $class($content);
    }
}