<?php

namespace App\Controller;

use App\Models\ParseSite;
use App\Modules\Parser\Parser;
use Core\Router\Request;
use Core\Router\Response;
use Valitron\Validator;

/**
 * Class SearcherController
 * @package App\Controller
 */
class SearcherController
{
    const VALIDATION_RULES = [
        'url'        => ['required', 'url'],
        'parse_type' => ['required', ['in', ['image', 'text', 'link']]]
    ];

    /**
     * @return string|void
     * @throws \Exception
     */
    public function search()
    {
        $input     = json_decode(Request::rawBody(), true);
        $validator = new Validator($input);

        $validator->mapFieldsRules(static::VALIDATION_RULES);

        if (!$validator->validate()) {
            return Response::error($validator->errors(), 422);
        }

        if (!$siteContent = file_get_contents($input['url'])) {
            throw new \Exception('Cant get content from url');
        }

        $parser = Parser::build($input['parse_type'], $siteContent)->parse();

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
        return Response::success(ParseSite::findOrFail($id)->with('results')->first()->toArray());
    }
}