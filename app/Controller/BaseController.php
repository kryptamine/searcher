<?php

namespace App\Controller;

use App\Requests\BaseRequest;
use Valitron\Validator;

/**
 * Class BaseController
 * @package App\Controller
 */
class BaseController
{
    /**
     * @var Validator
     */
    protected $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    /**
     * @param array $input
     * @param       $class
     *
     * @return bool
     * @throws \Exception
     */
    public function validate(array $input, $class)
    {
        $this->validator = $this->validator->withData($input);

        $this->validator->mapFieldsRules($class::rules());

        return $this->validator->validate();
    }

    /**
     * @return array|bool
     */
    public function validationErrors()
    {
        return $this->validator->errors();
    }
}