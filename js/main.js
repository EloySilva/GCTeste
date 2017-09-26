

  $(document).ready(function(){
    carregaDados();
});

function carregaDados(){

    let token=localStorage.getItem('token');  
    console.log(token)
    if(token){
 
      //console.log(token);
     $('#tabela').empty(); //Limpando a tabela
     $.ajax({
         type:'get',		//Definimos o método HTTP usado
         dataType: 'json',	//Definimos o tipo de retorno
         url: 'api/posts',//Definindo o arquivo onde serão buscados os dados
         headers: {
             'token':token
         },
         success: function(dados){
             console.log(dados);
             for(var i=0;dados.length>i;i++){
                 //Adicionando registros retornados na tabela
                 $('#tabela').append("<article class='post'><h1>"+dados[i].titulo+"</h1><p>"+dados[i].post+"</p><span>Autor: <i>"+dados[i].autor+" Data: "+dados[i].created_at+"</i></span><br/><br/><a class='buttonCadastrar' onClick='editar("+dados[i].id+")' href='#'>Editar</a> <a class='buttonCadastrar' onClick='deletar("+dados[i].id+")' href='#'>Deletar</a></article><br/><hr/>");
             }
         }
     });
 
 
    }else{
        console.log('nao tem token no storage');
        $(location).attr('href','index.html');
        
    }
   

}

//logout
$( "#logout" ).click(function() {
    localStorage.clear();
    $(location).attr('href','index.html');
  });



 function editar (id) {
  	$('#formModal').empty();
  let token=localStorage.getItem('token');  
  console.log(token)
  if(token){
            $.ajax({
                type:'get',		//Definimos o método HTTP usado
                dataType: 'json',	//Definimos o tipo de retorno
                url: 'api/post/'+id,//Definindo o arquivo onde serão buscados os dados
                headers: {
                    'token':token
                },
                success: function(dados){
                    console.log(dados);

                    
                        //Adicionando registros retornados na tabela
                   $('#formModal').append("<div class='cadastro'><form  id='cadastro'> <input type='hidden' name='idPost' id='idPost' value='"+dados.id+"'><label>Titulo</label><input type='text' name='titulo' id='titulo' value='"+dados.titulo+"'/><div class='help'></div><label>Noticia</label>​<textarea  rows='10' cols='70' name='post' id='post'>"+dados.post+"</textarea><div class='help'><label onClick='salverEdit()' class='buttonModal' >SALVAR</label></div></form></div> " );
                    
                   
                    $(".mask").addClass("active");



                   
                }
            });
        }
  }

  function cadastraPost() {
    $('#formModal').empty();
    $('#formModal').append("<div class='cadastroNovo'><form id='formCadastro' > <label>Titulo</label><input type='text' name='titulo' id='titulo' value=''/><div class='help'></div><label>Noticia</label>​<textarea  rows='10' cols='70' name='post' id='post'></textarea><div class='help'><label  class='buttonModal' onClick='cadastrar()'>SALVAR</label></div></form></div> " );
    $(".mask").addClass("active");
  }
  $('#teste').on('click', function(){alert('sdfsd');});
  function deletar (id) {
    $('#formModal').empty();
                  //Adicionando registros retornados na tabela
                  $('#formModal').append("<div class='deleteDiv'><br/>Tem Certeza???<br/><button onClick='salvaDeletar("+id+")' class='buttonModal' id='SalvarEdit'>DELETAR</button></div>");
                  $(".mask").addClass("active");
        

    }

    function salvaDeletar (id) {
       
        let token=localStorage.getItem('token');  
        console.log(token)
        if(token){
              
   
                $.ajax({
                      type:'get',		//Definimos o método HTTP usado
                      dataType: 'json',	//Definimos o tipo de retorno
                      url: 'api/post-delete/'+id,//Definindo o arquivo onde serão buscados os dados
                      headers: {
                          'token':token
                      },
                      success: function(dados){
                          console.log(dados);
                          carregaDados()
                       
            
                         
                      }
                  });
                  $(".mask").removeClass("active");
    
              }
        }


  


  // Function for close the Modal
  
  function closeModal(){
    $(".mask").removeClass("active");
  }
  
  // Call the closeModal function on the clicks/keyboard
  
  $(".close, .mask").on("click", function(){
    closeModal();
  });
  
  $(document).keyup(function(e) {
    if (e.keyCode == 27) {
      closeModal();
    }
  });



  //Cadastro
function salverEdit(){
    let tokenCad=localStorage.getItem('token');  
   
    
     var titulo = $( "#titulo" ).val();
     var post = $( "#post" ).val();
     var idPost = $( "#idPost" ).val();
   
  
     if(tokenCad){
       
               if(titulo != ''  && post != ''){
                   $.ajax({
                       type:'post',		//Definimos o método HTTP usado
                       dataType: 'json',	//Definimos o tipo de retorno
                       url: 'api/post/'+idPost+'/edit',//Definindo o arquivo onde serão buscados os dados
                       headers: {
                         'token':tokenCad
                     },
                     data:{'autor':'Just','titulo':titulo,'post':post},
                      
                       success: function(dados){
                        $('#formModal').empty();
                        closeModal();
                        carregaDados();
                           
                       }
                   });
               }else if(titulo == ''){
                   $('input[type="text"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
               }else if(post == ''){
                   $('textarea').css({"border":"2px solid red","box-shadow":"0 0 5px red"});
               }
 
         
  
     }else{
         console.log('nao tem token no storage');
         $(location).attr('href','index.html');
         
     }
 
 
   }
  
   //Cadastro
function cadastrar(){
    let tokenCad=localStorage.getItem('token');  
     var titulo = $( "#titulo" ).val();
     var post = $( "#post" ).val();
     event.preventDefault(); // impede envio do formulário
     
    if(tokenCad){
        if(titulo != ''  && post != ''){
                   $.ajax({
                       type:'post',		//Definimos o método HTTP usado
                       dataType: 'json',	//Definimos o tipo de retorno
                       url: 'api/cadastra',//Definindo o arquivo onde serão buscados os dados
                       headers: {
                         'token':tokenCad
                     },
                     data:{'autor':'Just','titulo':titulo,'post':post},
                       success: function(dados){    
                        closeModal();            
                        carregaDados();                  
                       }
                   });
                    return false;
               }else if(titulo == ''){
                   $('input[type="text"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
               }else if(post == ''){
                   $('textarea').css({"border":"2px solid red","box-shadow":"0 0 5px red"});
               }

     }else{
         console.log('nao tem token no storage');
         $(location).attr('href','index.html');
         
     }
 
 
   }