<nav class="navbar navbar-default">
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
                <li><a href="./html/cadastra_votacao.php">Cadastro Votação</a></li>
                <?php //endif; ?>
                <li><?= anchor("cipa/votacao", "Votação") ?></li>
                <li><a href="importacao.html">Funcionários</a></li>
                <li><a href="divulgacao.html">Resultados</a></li>
                <li><a href="aprovacao_candidatura.html">Candidaturas</a></li>
                <li><?= anchor("system/desconectar", "<i class=\"glyphicon glyphicon-option-horizontal\"></i>") ?></li>
            </ul>
        </div>
    </div>
</nav>