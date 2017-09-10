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
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $searchValue;

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getSearchValue()
    {
        return $this->searchValue;
    }

    /**
     * @param string $searchValue
     *
     * @return $this
     */
    public function setSearchValue(string $searchValue)
    {
        $this->searchValue = $searchValue;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return BaseParser
     * @throws \Exception
     */
    public function build(string $type) : BaseParser
    {
        $class = sprintf('%s\\Parsers\\%sParser', __NAMESPACE__, ucfirst($type));

        if (!class_exists($class)) {
            throw new \Exception("Class $class not found or doesn't implement $type parser");
        }

        if (!$this->content) {
            throw new \Exception('Content must be set');
        }

        /** @var BaseParser */
        return new $class($this);
    }
}