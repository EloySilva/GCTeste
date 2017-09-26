<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use CMS\Models\Posts;


$auth = function ()  {
$authe= new \CMS\Middlewares\Auth($app);
       $res=$authe->validaToken();
/*
        if($res !== 'success'){
                  $app->getLog()->info("Error: ".print_r($res,1));
                  $app->render('error.php',["data"=>$res] );
                  exit;
        }*/
     
        return  $res;
};

$app->get('/api',function(ServerRequestInterface $request) use($app,$auth){
  
    if($auth() != true){
      return new \Zend\Diactoros\Response\RedirectResponse('/api/error');
    }
    return new \Zend\Diactoros\Response\JsonResponse('OK',200,[ 'Content-Type' => ['application/hal+json']]);
   
});

    $app->get('/api/home/{name}/{id}',function(ServerRequestInterface $request){
      $response = new \Zend\Diactoros\Response();
      $response->getBody()->write("response com emiter do diactoros");
      return $response;
    
    });


    $app->get('/api/posts',function() use ($app,$auth){
      
      if($auth() !== true){
              return new \Zend\Diactoros\Response\JsonResponse('Usuario Não autorizado',401,[ 'Content-Type' => ['application/hal+json']]);

      }
       $response= new \CMS\Controllers\Post();
        return  $response->listaPost();
       });
    

      $app->post('/api/cadastra',function(ServerRequestInterface $request) use ($auth){
       
        if($auth() !== true){
          return new \Zend\Diactoros\Response\RedirectResponse('/api/error');
        }
            $response= new \CMS\Controllers\Post();
          return  $response->cadastraPost($request);
       
      });
      $app->get('/api/post/{id}',function(ServerRequestInterface $request) use($auth) {
      
        if($auth() !== true){
          return new \Zend\Diactoros\Response\RedirectResponse('/api/error');
        }
        $response= new \CMS\Controllers\Post();
        return  $response->pegarPost($request);
       
      });
      $app->post('/api/post/{id}/edit',function(ServerRequestInterface $request) use($auth) {
        if($auth() !== true){
          return new \Zend\Diactoros\Response\RedirectResponse('/api/error');
        }
        $response= new \CMS\Controllers\Post();
        return  $response->editPost($request);
        
       });   
       $app->get('/api/post-delete/{id}',function(ServerRequestInterface $request)  use($auth){
        if($auth() !== true){
          return new \Zend\Diactoros\Response\RedirectResponse('/api/error');
        }
         $id= $request->getAttribute('id');
         $post= \CMS\Models\Posts::destroy($id);
       //  $post->destroy();
        return new \Zend\Diactoros\Response\JsonResponse('0',200,[ 'Content-Type' => ['application/hal+json']]);
        
       });  
       $app->post('/api/login',function(ServerRequestInterface $request) {
        $response= new \CMS\Controllers\Post();
        return  $response->login($request);
        
       });   
    $app->get('/api/error',function() {
         return new \Zend\Diactoros\Response\JsonResponse('Usuario Não autorizado',401,[ 'Content-Type' => ['application/hal+json']]);
          }); 


$app->start();