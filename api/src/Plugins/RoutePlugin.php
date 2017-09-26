<?php

declare(strict_types=1);

namespace CMS\Plugins;

use Psr\Http\Message\RequestInterface;
use Aura\Router\RouterContainer;
use CMS\ServiceContainerInterface;
use Zend\Diactoros\ServerRequestFactory;
use Interop\Container\ContainerInterface;

class RoutePlugin implements PluginInterface
{

    public function register(ServiceContainerInterface $container)
    {

        $routerContainer = new RouterContainer();

                /* Registra as rotas de aplicação */
                $map = $routerContainer->getMap();

                /* Tem a função de indentificar a rota que esta sendo acessada */
                $matcher = $routerContainer->getMatcher();

                /* Tem a função  de gerar link com base nas rotas registradas */
                $generator = $routerContainer->getGenerator();
                $request = $this->getRequest();

                $container->add('routing',$map);
                $container->add('routing.matcher',$matcher);
                $container->add('routing.gererator',$generator);
                $container->add(RequestInterface::class,$request);

                $container->addLazy('route',function(ContainerInterface $container) {
                $matcher = $container->get('routing.matcher');
                $request = $container->get(RequestInterface::class);
                return $matcher->match($request);


                });

    }
    protected  function getRequest(): RequestInterface
    {

         return ServerRequestFactory::fromGlobals(  // Lib  zend diactoros
                 $_SERVER,$_GET,$_POST,$_COOKIE,$_FILES
         );
    }

}