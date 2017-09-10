<?php

namespace App\Modules\Parser\Parsers;

/**
 * Class BaseParser
 * @package App\Modules\Parser\Parsers
 */
abstract class BaseParser
{
    /**
     * @var string
     */
    protected $content;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * BaseParser constructor.
     *
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return count($this->data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return $this
     */
    abstract public function parse();
}