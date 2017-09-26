
$(function(){
    $('#upusuario').on('submit', function(e) {
      var resultado = $('#resultado');
      var pass = this.pass.value;
      var user = this.user.value;
      e.preventDefault(); // impede envio do formulário
       
        if(pass != ''  && user != ''){
            $.ajax({
                type:'post',		//Definimos o método HTTP usado
                dataType: 'json',	//Definimos o tipo de retorno
                url: 'api/login',//Definindo o arquivo onde serão buscados os dados
                data:{'pass':pass,'user':user},
               
                success: function(dados){
                    console.log(dados.token);
                    localStorage.setItem('token',dados.token);
                   $(location).attr('href','home.html');
                    
                }
            });
        }else if(user == ''){
            $('input[type="text"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
        }else if(pass == ''){
            $('input[type="password"]').css({"border":"2px solid red","box-shadow":"0 0 5px red"});
        }

    });
  });