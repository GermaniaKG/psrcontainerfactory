<?php
namespace Germania\PsrContainerFactory;

use Psr\Container\ContainerInterface;
use Pimple\Container as PimpleContainer;
use Pimple\Psr11\Container as PsrContainer;


/**
 * Callable for creating a PSR-11 Container from array, Pimple Container, or ContainerInterface
 */
class PsrContainerFactory
{

    /**
     * @param  array|ContainerInterface|Container $data Array, ContainerInterface or Pimple Container
     * @return ContainerInterface       \Pimple\Psr11\Container
     */
    public function __invoke($data)
    {
        if ( is_array($data)) {
            return new PsrContainer( new PimpleContainer( $data ) );
        }
        elseif ($data instanceOf PimpleContainer) {
            return new PsrContainer( $data );
        }
        elseif ($data instanceOf ContainerInterface) {
            return $data;
        }
        elseif ($data instanceOf \StdClass) {
            return new PsrContainer( new PimpleContainer((array) $data) );
        }
        throw new \InvalidArgumentException( "Expected array, Pimple Container, or PSR ContainerInterface");
    }
}
