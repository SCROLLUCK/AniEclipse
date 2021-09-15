<section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info" style="background: url(../<?=$usuarioLogado->background?>); background-size: cover; background:position: center center;">
                <div class="image">
                    <img src="../<?=$usuarioLogado->perfil?>" alt="<?=$usuarioLogado->nickname?>" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$usuarioLogado->nickname?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="fas fa-angle-down" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="perfil?id=<?=$usuarioLogado->id?>"><i class="fas fa-user"></i>Perfil</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="home.php?exit"><i class="fas fa-sign-out-alt"></i>Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="active">
                        <a href="/" title="Volte para o site">
                            <i class="fas fa-moon" style="font-size: 25px;"></i>
                            <span>Anie</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="/dashboard" title="Sua dashboard">
                            <i class="fas fa-home" style="font-size: 25px;"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <?php
                        if($usuarioLogado->dev){
                    ?>
                    <li>
                        <a href="god.php" title="Cuidado porra!">
                            <i class="fas fa-skull" style="font-size: 25px;"></i>
                            <span>God Mode</span>
                        </a>
                    </li>
                    <?php
                        }
                    ?>
                    <li>
                        <a href="upEpisodios.php" title="Cadastre um novo episódio">
                            <i class="fas fa-upload" style="font-size: 25px;"></i>
                            <span>Upload Episódio</span>
                        </a>
                    </li>
                    <li>
                        <a href="obras.php" title="Obras do Ani Eclipse">
                            <i class="fas fa-th-list" style="font-size: 25px;"></i>
                            <span>Obras</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>