function imprimeNotificacao(tipo, mensagem){
    
  if (tipo == "erro"){
      
        $.notify({
            icon: 'glyphicon glyphicon-warning-sign',
            message: mensagem
        },{
            type: 'danger',
            placement: {
                from: "bottom",
                align: "center"
            }
        });  
      
      
  }else if (tipo == "sucesso"){
    
        $.notify({
            message: mensagem
        },{
            type: 'success',
            placement: {
                from: "bottom",
                align: "center"
            }
        }
    ); 
      
  }else if (tipo == "info"){
        
        $.notify({
            icon: 'glyphicon glyphicon-warning-sign',
            message: mensagem
        },{
            placement: {
                from: "bottom",
                align: "center"
            }
        });  
      
  }  
}