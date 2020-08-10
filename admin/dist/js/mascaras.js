 $(document).ready(function(){ 
    
        // coloca máscara nos campos moedas;
    
        $("#adesao").mask("#.##0,00", {reverse: true});
        $("#mensalidade").mask("#.##0,00", {reverse: true});
        $("#cep").mask("00000-000");
    
        
});

function setaDadosModal(valor){
      document.getElementById("id").value = valor;
}

function confTel(){
      if(document.getElementById("telefonefixo").value.length == 10){
      jQuery(function($){
            $("#telefonefixo").mask('(00)0000-0000');
      });
      
      } else if(document.getElementById("telefonefixo").value.length == 11){
      jQuery(function($){
            $("#telefonefixo").mask('(00)00000-0000');
      });
      }
}

function zeraTel(){
      jQuery(function($){
      $("#telefonefixo").unmask();
      });
}

function confCel(){
      if(document.getElementById("celular").value.length == 10){
      jQuery(function($){
            $("#celular").mask('(00)0000-0000');
      });
      
      } else if(document.getElementById("celular").value.length == 11){
      jQuery(function($){
            $("#celular").mask('(00)00000-0000');
      });
      }
}

function zeraCel(){
      jQuery(function($){
      $("#celular").unmask();
      });
}

function confRec(){
      if(document.getElementById("recado").value.length == 10){
      jQuery(function($){
            $("#recado").mask('(00)0000-0000');
      });
      
      } else if(document.getElementById("recado").value.length == 11){
      jQuery(function($){
            $("#recado").mask('(00)00000-0000');
      });
      }
}

function zeraRec(){
      jQuery(function($){
      $("#recado").unmask();
      });
}

function colocaMask() {
      if(document.getElementById("cnpj").value.length == 11){
      jQuery(function($){
            $("#cnpj").mask('000.000.000-00', {reverse: true});
      });
      
      } else if(document.getElementById("cnpj").value.length == 14){
      jQuery(function($){
            $("#cnpj").mask('00.000.000/0000-00', {reverse: true});
      });
      }
}

function zeraMask(){
      jQuery(function($){
      $("#cnpj").unmask();
      });
}

function limpa_formulário_cep() {
      //Limpa valores do formulário de cep.
      document.getElementById('logradouro').value=("");
      document.getElementById('bairro').value=("");
      document.getElementById('cidade').value=("");
      document.getElementById('uf').value=("");
}

function meu_callback(conteudo) {
  if (!("erro" in conteudo)) {
      //Atualiza os campos com os valores.
      document.getElementById('logradouro').value=(conteudo.logradouro);
      document.getElementById('bairro').value=(conteudo.bairro);
      document.getElementById('cidade').value=(conteudo.localidade);
      document.getElementById('uf').value=(conteudo.uf);
  } //end if.
  else {
      //CEP não Encontrado.
      limpa_formulário_cep();
      alert("CEP não encontrado.");
  }
}
  
function pesquisacep(valor) {

  //Nova variável "cep" somente com dígitos.
  var cep = valor.replace(/\D/g, '');

  //Verifica se campo cep possui valor informado.
  if (cep != "") {

      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;

      //Valida o formato do CEP.
      if(validacep.test(cep)) {

          //Preenche os campos com "..." enquanto consulta webservice.
          document.getElementById('logradouro').value="...";
          document.getElementById('bairro').value="...";
          document.getElementById('cidade').value="...";
          document.getElementById('uf').value="...";

          //Cria um elemento javascript.
          var script = document.createElement('script');

          //Sincroniza com o callback.
          script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

          //Insere script no documento e carrega o conteúdo.
          document.body.appendChild(script);

      } //end if.
      else {
          //cep é inválido.
          limpa_formulário_cep();
          alert("Formato de CEP inválido.");
      }
  } //end if.
  else {
      //cep sem valor, limpa formulário.
      limpa_formulário_cep();
  }
};



