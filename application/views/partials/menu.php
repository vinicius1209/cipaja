<?= link_tag("application/libraries/menu.css") ?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?= anchor("system/index", "Dashboard", "class='navbar-brand'") ?>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="simulacao.html">Simulação</a></li>
                <?php //if ($usuario instanceof \Administrador): ?>
                <li><?= anchor("cipa/cadastrarAction", "Cadastrar Votação") ?></li>
                <?php //endif; ?>
                <li><?= anchor("cipa/votacaoAction", "Votação") ?></li>
                <li><a href="importacao.html">Funcionários</a></li>
                <li><?= anchor("cipa/divulgacaoAction", "Resultados") ?></li>
                <li><a href="aprovacao_candidatura.html">Candidaturas</a></li>
                <li><?= anchor("system/desconectarAction", "<i class=\"glyphicon glyphicon-option-horizontal\"></i>") ?></li>
            </ul>
        </div>
    </div>
</nav>
