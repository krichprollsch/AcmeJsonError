<?php

namespace Acme\JsonErrorBundle\Formatter;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\FlattenException;

interface FormatterInterface
{
    public function format(Request $request, FlattenException $e);
}
