<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\di\contracts;

use yii\di\AbstractContainer;

/**
 * Represents a component responsible for class registration in the Container.
 *
 * The goal of service providers is to centralize and organize in one place
 * registration of classes bound by any logic or classes with complex dependencies.
 *
 * You can simply organize registration of service and it's dependencies in a single
 * provider class except of creating bootstrap file or configuration array for the Container.
 *
 * Example:
 * ```php
 * class CarProvider implements ServiceProvider
 * {
 *    protected $container;
 *
 *    public function __construct(ContainerInterface $container)
 *    {
 *        $this->container = $container;
 *    }
 *
 *    public function register(): void
 *    {
 *        $this->registerDependencies();
 *        $this->registerService();
 *    }
 *
 *    protected function registerDependencies(): void
 *    {
 *        $container = $this->container;
 *        $container->set(EngineInterface::class, SolarEngine::class);
 *        $container->set(WheelInterface::class, [
 *            '__class' => Wheel::class,
 *            'color' => 'black',
 *        ]);
 *    }
 *
 *    protected function registerService(): void
 *    {
 *        $this->container->set(Car::class, [
 *              '__class' => Car::class,
 *              'color' => 'red',
 *        ]);
 *    }
 * }
 * ```
 */
interface ServiceProviderInterface
{
    /**
     * Registers classes in the container.
     *
     * - This method should only set classes definitions to the Container preventing any side-effects.
     * - This method should be idempotent
     * This method may be called multiple times with different container objects, or multiple times with the same object.
     *
     * @param AbstractContainer $container the container in which to register the services.
     */
    public function register(AbstractContainer $container): void;
}
