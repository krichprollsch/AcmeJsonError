<?php

namespace Acme\JsonErrorBundle\Formatter;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\FlattenException;

class JsonApi implements FormatterInterface
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function format(Request $request, FlattenException $e)
    {
        $id = $this->getId($e);

        return array(
            'errors' => array (
                array(
                    'id' => $id,
                    // TODO add a way to retrive details about error
                    //'href' => $request->getBaseUrl() . '/' .$this->path,
                    'status' => $e->getStatusCode(),
                    'code' => $e->getCode(),
                    'title' => $e->getMessage(),
                    'detail' => sprintf('%s:%d', $e->getFile(), $e->getLine()),
                    // TODO add a way to retrieve resources from request
                    //'links' => ,
                    'path' => $this->path
                )
            )
        );
    }

    private function getId(FlattenException $e) {
        return sha1(serialize($e));
    }
}
