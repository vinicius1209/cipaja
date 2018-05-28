function vencedores(cipa_id){
    $.ajax({
        type: "POST",
        url: "http://localhost/cipaja/index.php/cipa/vencedores",
        data:{
            cipa_id: cipa_id
        },
        async: false,
        success: function(vencedores)
        {
            vencedores = JSON.parse(vencedores);
            console.log(vencedores);
            if (typeof vencedores === 'string' || vencedores instanceof String){
                alert(vencedores);
                return;
            }

            var efetivos = $("#efetivos");
            efetivos.empty();

            $.each(vencedores.efetivos, function(i, el){
                var linha = $("<tr>");
                var nome = $("<td>").html(el.nome);
                var votos = $("<td>").html(el.votos);
                linha.append(nome).append(votos);
                efetivos.append(linha);
            });

            var suplentes = $("#suplentes");
            suplentes.empty();

            $.each(vencedores.suplentes, function(i, el){
                var linha = $("<tr>");
                var nome = $("<td>").html(el.nome);
                var votos = $("<td>").html(el.votos);
                linha.append(nome).append(votos);
                suplentes.append(linha);
            });
        }
    });
}