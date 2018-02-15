<?php
namespace tests;

use Psr\Container\ContainerInterface;
use Pimple\Container as PimpleContainer;
use Germania\PsrContainerFactory\PsrContainerFactory;

class PsrContainerFactoryTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideValidCtorArguments
     */
    public function testSimple( $data )
    {
        $sut = new PsrContainerFactory;

        $result = $sut( $data );

        $this->assertInstanceOf( ContainerInterface::class, $result );
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
        $container = $container_mock->reveal();

        return array(
            [ $container ],
            [ array() ],
            [ new PimpleContainer ]
        );
    }

    public function provideInvalidCtorArguments()
    {
        return array(
            [ 1 ],
            [ "anytext" ],
            [ null ],
            [ true ],
            [ false ],
            [ new \StdClass ]
        );
    }

}
