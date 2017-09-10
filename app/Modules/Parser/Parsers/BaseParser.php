<?php

namespace App\Modules\Parser\Parsers;
use App\Modules\Parser\Parser;

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
     * @var Parser
     */
    protected $parser;

    /**
     * BaseParser constructor.
     *
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
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