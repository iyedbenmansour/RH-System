<?php

namespace ContainerJ3x4kz5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_9pB_3ilService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.9pB.3il' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.9pB.3il'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'App\\Controller\\AdminController::dashboard' => ['privates', '.service_locator.9kKwU2t', 'get_ServiceLocator_9kKwU2tService', true],
            'App\\Controller\\AdminController::editProfile' => ['privates', '.service_locator.c9q37p5', 'get_ServiceLocator_C9q37p5Service', true],
            'App\\Controller\\CandidatController::editProfile' => ['privates', '.service_locator.ZmDpOOh', 'get_ServiceLocator_ZmDpOOhService', true],
            'App\\Controller\\CompanyController::editProfile' => ['privates', '.service_locator.FrOMotV', 'get_ServiceLocator_FrOMotVService', true],
            'App\\Kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Service\\CandidatFileUploader::upload' => ['privates', '.service_locator.BjMlj7V', 'get_ServiceLocator_BjMlj7VService', true],
            'App\\Service\\CompanyFileUploader::upload' => ['privates', '.service_locator.BjMlj7V', 'get_ServiceLocator_BjMlj7VService', true],
            'App\\Service\\FileUploader::upload' => ['privates', '.service_locator.BjMlj7V', 'get_ServiceLocator_BjMlj7VService', true],
            'kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Controller\\AdminController:dashboard' => ['privates', '.service_locator.9kKwU2t', 'get_ServiceLocator_9kKwU2tService', true],
            'App\\Controller\\AdminController:editProfile' => ['privates', '.service_locator.c9q37p5', 'get_ServiceLocator_C9q37p5Service', true],
            'App\\Controller\\CandidatController:editProfile' => ['privates', '.service_locator.ZmDpOOh', 'get_ServiceLocator_ZmDpOOhService', true],
            'App\\Controller\\CompanyController:editProfile' => ['privates', '.service_locator.FrOMotV', 'get_ServiceLocator_FrOMotVService', true],
            'App\\Service\\CandidatFileUploader:upload' => ['privates', '.service_locator.BjMlj7V', 'get_ServiceLocator_BjMlj7VService', true],
            'App\\Service\\CompanyFileUploader:upload' => ['privates', '.service_locator.BjMlj7V', 'get_ServiceLocator_BjMlj7VService', true],
            'App\\Service\\FileUploader:upload' => ['privates', '.service_locator.BjMlj7V', 'get_ServiceLocator_BjMlj7VService', true],
            'kernel:loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel:registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
        ], [
            'App\\Controller\\AdminController::dashboard' => '?',
            'App\\Controller\\AdminController::editProfile' => '?',
            'App\\Controller\\CandidatController::editProfile' => '?',
            'App\\Controller\\CompanyController::editProfile' => '?',
            'App\\Kernel::loadRoutes' => '?',
            'App\\Kernel::registerContainerConfiguration' => '?',
            'App\\Service\\CandidatFileUploader::upload' => '?',
            'App\\Service\\CompanyFileUploader::upload' => '?',
            'App\\Service\\FileUploader::upload' => '?',
            'kernel::loadRoutes' => '?',
            'kernel::registerContainerConfiguration' => '?',
            'App\\Controller\\AdminController:dashboard' => '?',
            'App\\Controller\\AdminController:editProfile' => '?',
            'App\\Controller\\CandidatController:editProfile' => '?',
            'App\\Controller\\CompanyController:editProfile' => '?',
            'App\\Service\\CandidatFileUploader:upload' => '?',
            'App\\Service\\CompanyFileUploader:upload' => '?',
            'App\\Service\\FileUploader:upload' => '?',
            'kernel:loadRoutes' => '?',
            'kernel:registerContainerConfiguration' => '?',
        ]);
    }
}
