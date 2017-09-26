<?php

namespace CMS\Middlewares;

class Auth 
{
   

    protected $app;
    protected $chave='qwefertyu45234dfgf45dfra2qe2zx';
    protected  $alg='HS256';
    protected $typ='JWT';

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function geraToken($usuario,$time = 1)
    {
        
        if($time== 1){
            $time= time() + 7200;
          
        }
        $cabecalho = [

        'alg' => $this->alg,
        'typ' =>  $this->typ,
        ];

    
        //payload
        $corpoDaInformacao = [
        'first_name' => $usuario['nome'],
        'last_name'  => $usuario['nome'],
        'email'      => $usuario['email'],
        'exp'        => $time,

        ];

        $cabecalho         = json_encode($cabecalho);
        $corpoDaInformacao = json_encode($corpoDaInformacao);
        //TRANFORMA EM BASE64
        $cabecalho         = base64_encode($cabecalho);
        $corpoDaInformacao = base64_encode($corpoDaInformacao);
        //CHERAR ASSINATURA
        $assinatura = hash_hmac('sha256', $cabecalho.'.'.$corpoDaInformacao, $this->chave, true);
         // print_r($assinatura);
        $assinatura = base64_encode($assinatura);
      
        //CRIAR TOKEN
        $token= $cabecalho.'.'.$corpoDaInformacao.'.'.$assinatura;
       
        return $token;
    }

    public function validaToken()
    {
         // $dados=explode('.', $this->app->request->headers->get('Token'));
          $tokenUsuario=getallheaders()['token'];
          $dados=explode('.', $tokenUsuario);
            if(count($dados) <= 1 ){
                $erro=array('erro'=>'-1','description'=>'Token Invalido');
                    return false;
            }

        
           $dados=json_decode(base64_decode($dados[1]));
             
             $usuario['nome']=trim($dados->first_name);
             $usuario['nome']=trim($dados->last_name);
             $usuario['email']=trim($dados->email);
            $time=$dados->exp;
           
           
           if($this->geraToken($usuario,$time) === $tokenUsuario ){
               
                if($time < time()){
                  //Token expirado
                    return false;
                }else{
                     return true;
                }
                
           }else{
                    // Token Invalido
                    return false;

           }

    }
}
