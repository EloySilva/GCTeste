<?php

namespace CMS\Controllers;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
//use Psr\Http\Message\MessageInterface;



class Post{

    public function login($request){
        $data =$request->getParsedBody();
      
        $user= $data['user'];//='admin';
        $pass= $data['pass'];//='admin';

        $comments =  \CMS\Models\Usuario::where('user', '=', $user)
        ->orderBy('id', 'desc')
        ->get(); 
      
        if($comments[0][user]){
            if($comments[0][pass] == $pass){
               // print_r('certo');
                
                $usuario['nome']=$comments[0][nome];
                $usuario['email']=$comments[0][email];
                $token= new \CMS\Middlewares\Auth($request);
                $tokenGerado['token']=$token->geraToken($usuario);

            }else{
                return new \Zend\Diactoros\Response\JsonResponse('Senha Invalida!!',401,[ 'Content-Type' => ['application/hal+json']]);
            }
        }else{
            return new \Zend\Diactoros\Response\JsonResponse('Usuario Invalido!!',401,[ 'Content-Type' => ['application/hal+json']]);
        
        }
        return new \Zend\Diactoros\Response\JsonResponse($tokenGerado,200,[ 'Content-Type' => ['application/hal+json']]);
    }

    public function listaPost(){
        $meuModel = new \CMS\Models\Posts();
        $posts = $meuModel->all();
        return new \Zend\Diactoros\Response\JsonResponse($posts,200,[ 'Content-Type' => ['application/hal+json']]);
    }
    public function cadastraPost($request){
        $data =$request->getParsedBody();
        \CMS\Models\Posts::create($data);
        return new \Zend\Diactoros\Response\JsonResponse('0',200,[ 'Content-Type' => ['application/hal+json']]);
    }
    public function pegarPost($request){
        $id= $request->getAttribute('id');
        $posts= \CMS\Models\Posts::find($id);
        return new \Zend\Diactoros\Response\JsonResponse($posts,200,[ 'Content-Type' => ['application/hal+json']]);
    }
    public function editPost($request){
        $id= $request->getAttribute('id');
        $post= \CMS\Models\Posts::find($id);
        $data= $request->getParsedBody();
        $post->fill($data);
        $post->save();
        return new \Zend\Diactoros\Response\JsonResponse($post,200,[ 'Content-Type' => ['application/hal+json']]);
    }
    
}
