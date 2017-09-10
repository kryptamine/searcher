<?php

namespace App\Controller;

use App\Models\ParseSite;
use App\Modules\Parser\Parser;
use App\Modules\Parser\Parsers\TextParser;
use App\Requests\SearcherRequest;
use Core\Router\Request;
use Core\Router\Response;

/**
 * Class SearcherController
 * @package App\Controller
 */
class SearcherController extends BaseController
{
    /**
     * @return string|void
     * @throws \Exception
     */
    public function search()
    {
        $input = json_decode(Request::rawBody(), true);

        if (!$this->validate($input, SearcherRequest::class)) {
            return Response::error($this->validationErrors(), 422);
        }

        if (!$siteContent = file_get_contents($input['url'])) {
            throw new \Exception('Cant get content from url');
        }

        /** @var Parser $parser */
        $parserBuilder = (new Parser())->setContent($siteContent);

        $parser = $parserBuilder->build($input['parse_type']);

        if ($parser instanceof TextParser) {
            $parserBuilder->setSearchValue($input['value']);
        }

        $parser->parse();

        return Response::success(ParseSite::fillData([
            'data'       => $parser->getData(),
            'count'      => $parser->getCount(),
            'parse_type' => $input['parse_type'],
            'url'        => $input['url']
        ]));
    }

    /**
     * @return string
     */
    public function index()
    {
        return Response::success(ParseSite::with('results')->get()->toArray());
    }

    /**
     * @param int $id
     *
     * @return string
     */
    public function show(int $id)
    {
        return Response::success(ParseSite::whereId($id)->with('results')->get()->first()->toArray());
    }
}