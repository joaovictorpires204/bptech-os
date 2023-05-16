<nav class="navbar-default navbar-static-side sidebar" role="navigation">
	<div class="sidebar-collapse">
	    <ul class="nav" id="side-menu">
	        <li class="nav-header">
				<img src="images/painel.png" alt=""/>
			</li>

			<?php if ($_SESSION['UserTipo'] === '1' ) { ?>

			<li <?php if($page == 'setor-novo.php' || $page == 'atividade.php' || $page == 'atividade-novo.php' || $page == 'colaborador-novo.php' || $page == 'cliente-novo.php' || $page == 'penalidade-novo.php'){echo 'class="active"';} ?>>
				<a data-toggle="collapse" data-target="#menu1" data-parent="#myGroup" data-collapse-group="myDivs">
					<i class="fa fa-pencil"></i>
					<span class="nav-label">Cadastrar</span>
				</a>

				<ul id="menu1" class="collapse submenunav <?php if($page == 'setor-novo.php' || $page == 'atividade.php' || $page == 'atividade-novo.php' || $page == 'colaborador-novo.php' || $page == 'cliente-novo.php' || $page == 'penalidade-novo.php'){echo 'in';} ?>">
					<?php if ($_SESSION['UserNivel'] <= $nivel_necessario ) { ?>
						<li><a href="colaborador-novo.php">Novo Colaborador</a></li>
						<li><a href="setor-novo.php">Novo Projeto</a></li>
						<li><a href="atividade-novo.php">Nova Atividade</a></li>
						<li><a href="cliente-novo.php">Novo Setor</a></li>
						<li><a href="fornecedor-novo.php">Novo Fornecedor</a></li>
						<li><a href="aviso-novo.php">Novo Aviso</a></li>
					<?php } ?>
                </ul>
			</li>
			<?php } ?>

			<li <?php if($page == 'setor-novo.php' || $page == 'atividade.php' || $page == 'atividade-novo.php' || $page == 'colaborador-novo.php' || $page == 'cliente-novo.php' || $page == 'penalidade-novo.php'){echo 'class="active"';} ?>>
				<a data-toggle="collapse" data-target="#menu3" data-parent="#myGroup" data-collapse-group="myDivs">
					<i class="fa fa-file-o"></i>
					<span class="nav-label">Chamados</span>
				</a>

				<ul id="menu3" class="collapse submenunav <?php if($page == 'chamados.php' || $page == 'chamado-novo.php' || $page == 'chamado.php'){echo 'in';} ?>">
					<li><a href="chamado-novo.php">Abrir Chamado</a></li>
						<?php if ($_SESSION['UserTipo'] === '1') { ?>
					<li><a href="meus-chamados.php">Meus Tickets</a></li>
					<?php } ?>

					<li><a href="chamados.php">Gestão</a></li>
                </ul>
			</li>


			<?php if ($_SESSION['UserNivel'] <= $nivel_necessario) { ?>

	        <li <?php if($page == 'relatorio.php' || $page == 'colaboradores.php' || $page == 'clientes.php' || $page == 'setores.php' || $page == 'atividades.php' || $page == 'metas.php' || $page == 'penalidades.php'){echo 'class="active"';} ?>>
				<a data-toggle="collapse" data-target="#menu2" data-parent="#myGroup" data-collapse-group="myDivs">
					<i class="fa fa-file-text-o"></i>
					<span class="nav-label">Relatórios</span>
				</a>

				<ul id="menu2" class="collapse submenunav  <?php if($page == 'fornecedores.php' || $page == 'colaboradores.php' || $page == 'clientes.php' || $page == 'setores.php' || $page == 'atividades.php' || $page == 'chamados.php'){ echo 'in'; } ?>">
						<li><a href="colaboradores.php">Colaboradores</a></li>
						<li><a href="setores.php">Projetos</a></li>
						<li><a href="atividades.php">Atividades</a></li>
						<li><a href="clientes.php">Setores</a></li>
						<li><a href="fornecedores.php">Fornecedor</a></li>
						<li><a href="chamados.php">Chamados</a></li>
                </ul>

			</li>
			<?php } ?>

			<?php if ($_SESSION['UserTipo'] === '1') { ?>
				<li>
					<a href="emails.php">
						<i class="fa fa-envelope-o"></i>
						<span class="nav-label">E-mails de destino</span>
					</a>
				</li>
			<?php } ?>


	        <li>
				<a href="https://www.teamviewer.com/pt/" target='blank'>
					<i class="fa fa-laptop"></i>
					<span class="nav-label">Download Teamviewer</span>
				</a>
			</li>

	   	</ul>
	</div>
</nav>
