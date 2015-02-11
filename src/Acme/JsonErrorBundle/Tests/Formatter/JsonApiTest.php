<?php

namespace Acme\JsonErrorBundle\Tests\Formatter;

use Acme\JsonErrorBundle\Formatter\JsonApi;
use Symfony\Component\HttpFoundation\Request;
use \Mockery as m;

class JsonApiTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown() {
        m::close();
    } 

    public function errorProvider()
    {
        return array(
            array(
                'params' => array(
                    'message' => 'this is a message',
                    'path' => '/api/v1',
                    'status_code' => 500
                ),
                'expected' => array(
                    'id' => true,
                    'title' => 'this is a message',
                    'path' => '/api/v1',
                    'status' => 500
                )
            )
        );
    }

    /**
     * @dataProvider errorProvider 
     */
    public function testJsonStructureShouldBeValid($params, $expected)
    {
        $formatter = new JsonApi($params['path']);
        $exception = m::mock('Symfony\Component\HttpKernel\Exception\FlattenException');
        $exception
            ->shouldReceive('getMessage')
            ->andReturn($params['message'])
            ->shouldReceive('getStatusCode')
            ->andReturn($params['status_code'])
            ->shouldReceive('getLine')
            ->andReturn(null)
            ->shouldReceive('getFile')
            ->andReturn(null)
            ->shouldReceive('getCode')
            ->andReturn(null)
            ;
        $request = new Request();

        $json = $formatter->format($request, $exception);

        $this->assertTrue(isset($json['errors']), 'errors must be present');
        $this->assertEquals(1, count($json['errors']));

        $error = $json['errors'][0];
        foreach ($expected as $key => $expectedValue) {
            if ($expectedValue === true) {
                $this->assertTrue(
                    isset($error[$key]),
                    sprintf('key %s must be present', $key)
                );
            } else {
                $this->assertEquals($expectedValue, $error[$key]);
            }
        }
    }
}
