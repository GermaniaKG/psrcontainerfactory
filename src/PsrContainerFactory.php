<?php
namespace Germania\PsrContainerFactory;

use Psr\Container\ContainerInterface;
use DI\Container as PhpDiContainer;
use Pimple\Container as PimpleContainer;
use Pimple\Psr11\Container as PsrContainer;


/**
 * Callable for creating a PSR-11 Container from array, Pimple Container, or ContainerInterface
 */
class PsrContainerFactory
{

    protected $factory_callable;

    public function __construct()
    {
        if (class_exists(PhpDiContainer::class)) {
            $this->factory_callable = array($this, 'createPhpDiContainer');
        }
        elseif (class_exists(PimpleContainer::class)) {
            $this->factory_callable = array($this, 'createPimpleContainer');
        }
        else {
            throw new \RuntimeException("Expected class to exist, either \DI\Container or \Pimple\Container");
        }
    }

    /**
     * @param  array|ContainerInterface|Container $data Array, ContainerInterface or Pimple Container
     * @return ContainerInterface       \Pimple\Psr11\Container
     */
    public function __invoke($data)
    {
        $fc = $this->factory_callable;
        return $fc($data);
    }


    /**
     * @param  mixed $data         Array
     * @return ContainerInterface  \Pimple\Psr11\Container
     */
    public function createPimpleContainer($data)
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


    /**
     * @param  mixed $data         Array
     * @return ContainerInterface  \DI\Container
     */
    public function createPhpDiContainer( $data )
    {
        if ( is_array($data)) {
            $builder = new \DI\ContainerBuilder();
            $builder->addDefinitions($data);
            return $builder->build();
        }
        elseif ($data instanceOf PimpleContainer) {
            return new PsrContainer( $data );
        }
        elseif ($data instanceOf ContainerInterface) {
            return $data;
        }
        elseif ($data instanceOf \StdClass) {
            $builder = new \DI\ContainerBuilder();
            $builder->addDefinitions((array) $data);
            return $builder->build();
        }
        throw new \InvalidArgumentException( "Expected array, Pimple Container, or PSR ContainerInterface");
    }
}
