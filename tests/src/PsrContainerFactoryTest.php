<?php
namespace tests;

use Psr\Container\ContainerInterface;
use Pimple\Container as PimpleContainer;
use Pimple\Psr11\Container as PsrContainer;
use DI\Container as PhpDiContainer;
use Germania\PsrContainerFactory\PsrContainerFactory;

class PsrContainerFactoryTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideValidCtorArguments
     */
    public function testSimple( $data, $key, $expected_value )
    {
        $sut = new PsrContainerFactory;

        $result = $sut( $data );

        $this->assertInstanceOf( ContainerInterface::class, $result );
        $this->assertEquals($expected_value, $result->get($key));
        $this->assertTrue($result->has($key));
    }


    /**
     * @dataProvider provideValidCtorArguments
     */
    public function testPimpleContainerCreation( $data, $key, $expected_value, $is_mock )
    {
        $sut = new PsrContainerFactory;

        $result = $sut->createPimpleContainer( $data );

        if (!$is_mock) {
            $this->assertInstanceOf( PsrContainer::class, $result );
        }
        $this->assertInstanceOf( ContainerInterface::class, $result );
        $this->assertEquals($expected_value, $result->get($key));
        $this->assertTrue($result->has($key));
    }


    /**
     * @dataProvider provideValidCtorArguments
     */
    public function testPhpDiContainerCreation( $data, $key, $expected_value, $is_mock )
    {
        $sut = new PsrContainerFactory;

        $result = $sut->createPhpDiContainer( $data );

        if (!$is_mock) {
            $this->assertInstanceOf( PhpDiContainer::class, $result );
        }
        $this->assertInstanceOf( ContainerInterface::class, $result );
        $this->assertEquals($expected_value, $result->get($key));
        $this->assertTrue($result->has($key));
    }




    /**
     * @dataProvider provideInvalidCtorArguments
     */
    public function testInvalidArgumentException( $data )
    {
        $sut = new PsrContainerFactory;

        $this->expectException( \InvalidArgumentException::class );
        $result = $sut( $data );
    }




    public function provideValidCtorArguments()
    {
        $container_mock = $this->prophesize( ContainerInterface::class );
        $container_mock->get('foo')->willReturn('bar');
        $container_mock->has('foo')->willReturn(true);
        $container = $container_mock->reveal();

        return array(
            "Container mock"   => [ $container, "foo", "bar", (bool) "mock" ],
            "StdClass"         => [ (object) array('foo' => 'bar'), "foo", "bar", false ],
            "plain array"      => [ array('foo' => 'bar'), "foo", "bar", false ],
            "Pimple Container" => [ new PimpleContainer(array('foo' => 'bar')), "foo", "bar", (bool) "mock" ],
            "PHP-DI Container" => [ (new \DI\ContainerBuilder())->addDefinitions(array('foo' => 'bar'))->build(), "foo", "bar", (bool) "mock" ]
        );
    }

    public function provideInvalidCtorArguments()
    {
        return array(
            "Integer value" => [ 1 ],
            "String value" => [ "anytext" ],
            "NULL" => [ null ],
            "TRUE" => [ true ],
            "FALSE" => [ false ],
            "DateTime object" => [ new \DateTime ]
        );
    }

}
