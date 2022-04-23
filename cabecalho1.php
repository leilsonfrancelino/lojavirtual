<!-- Create header fir all of pages -->

<!-- Function validate login -->
<?php
	if(!isset($_SESSION)){
	session_start();
	}
	$idPedido = @$_SESSION["LJPEDIDO"];
    $qtdeTotal = $_SESSION["LJQTDE"];	
	$idCliente = $_SESSION ["LJCLIENTE"]["id_cliente"];
	if($idCliente) {
		$txtLogin = "Logoff";
		$urlLogin = URL_BASE. "logoff";
		$nomeCliente = $_SESSION ["LJCLIENTE"]["cliente"];
	}else{
		$txtLogin = "Login";
		$urlLogin = URL_BASE. "nao-logado";
		$nomeCliente = "Visitante";
	}
	if($qtdeTotal) {
		$Total = $qtdeTotal;
	}else{
		$Total = 0;
	}
	
?>	
	



<header>

	<!-- MAIN HEADER -->
	<div id="header">
		<!-- TOP HEADER -->
		<nav class="navbar navbar-default navbar-inverse" role="navigation">
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo "#"?>">HOME </a></li> 
					<li><a href="<?php echo "meus-dados"?>">Meus dados </a></li>					
					<!-- <li><a href="<?php echo "cadastro"?>"> Cadastrar	</a></li>						 -->
					
					<?php echo "<li><a href=$urlLogin>$txtLogin</a></li> "; ?>
					
				</ul>
				<!-- <ul class="header-links pull-right">
				
					<li><a href="<?php echo "cadastro"?>" title="usuario" class="usuario"><p><i class="fa fa-user-o"></i><?php echo $nomeCliente ?> </p></a></li>
				
				</ul> -->

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b><i class="fa fa-user-o"></i>  <?php echo $nomeCliente ?> </b> <span class="caret"></span></a>
						<ul id="login-dp" class="dropdown-menu">
							<li>
								<div class="row">
										<div class="col-md-12">
	
											<form class="form" role="form" method="post" action="op_login.php" accept-charset="UTF-8" id="login-nav">
													<div class="form-group">
														<label class="sr-only" for="exampleInputEmail2">Email</label>
														<span class="error_login" style="background-color: red; display:block;">Email ou senha inválidos</span>
														<input type="email" name="tx_email" class="form-control" id="exampleInputEmail2" placeholder="Email" required>
													</div>
													<div class="form-group">
														<label class="sr-only" for="exampleInputPassword2">Senha</label>
														<input type="password" name="tx_senha" class="form-control" id="exampleInputPassword2" placeholder="Senha" required>
														<div class="help-block text-right"><a href="index.php?link=10">Esqueci a senha</a></div>
													</div>
													<div class="form-group">
														<button type="submit" class="btn btn-primary btn-block">Entrar</button>
													</div>
													<!-- <div class="checkbox">
														<label>
														<input type="checkbox"> keep me logged-in
														</label>
													</div> -->
											</form>
											
										</div>
										<div>
										<button class="btn btn-primary btn-block" href="<?php echo "cadastro"?>"><b>Cadastre-se Aqui</b></button>
										</div>
								</div>
							</li>
						</ul>
					</li>
				</ul>

			</div>
		</nav>
		<!-- /TOP HEADER -->


		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- LOGO -->
				<div class="col-md-3">
					<div class="header-logo">
						<a href="#" class="logo">
							<img src="./img/logo.png" alt="">
						</a>
					</div>
				</div>
				<!-- /LOGO -->

				<!-- SEARCH BAR -->
				<div class="col-md-6">
					<div class="newsletter">

						<form>
								<input class="input"  placeholder="Encontre seu produto">
								<button class="newsletter-btn"><i class="fa fa-search"></i> Pesquisar</button>
							</form>

					</div>
				</div>
				<!-- /SEARCH BAR -->

				<!-- ACCOUNT -->
				<div class="col-md-3 clearfix">
					<div class="header-ctn">

						<!-- Wishlist -->
						<!-- <div>
							<a href="#">
								<i class="fa fa-heart-o"></i>
								<span>Favoritos</span>
								<div class="qty">23</div>
							</a>
						</div> -->
						<!-- /Wishlist -->

						<!-- Cart -->
						<div class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<i class="fa fa-shopping-cart"></i>
								<span>Carrinho</span>
								<div class="qty"><?php echo $Total ?></div>
							</a>
							<div class="cart-dropdown">
								<div class="cart-list">
									<?php 
										if(!$qtdeTotal) {
												
										}else{
											$lst_carrinho = consultar("carrinho c, produto p "," c.id_produto = p.id_produto and  id_pedido = $idPedido");									
											foreach ($lst_carrinho as $carrinho){						   						
									?>
								
									<div class="product-widget">
										
										<div class="product-img">
											<img src="<?php echo URL_BASE ?>/produtos/<?php echo  $carrinho["imagem"] ?>">
										</div>
										<div class="product-body">
											<h3 class="product-name"><a href="#"><?php echo limita_caracteres($carrinho["produto"], 40) ?></a></h3>
											<h4 class="product-price"><span class="qty">R$ <?php echo  $carrinho["preco"] ?></h4>
										</div>
	
											
											
										

										<a href="<?php echo URL_BASE. "carrinho/?p=$carrinho[id_produto]"?>" class="delete"><i class="fa fa-close"></i></a>
									</div>



									<!-- <div class="product-widget">
										<div class="product-img">
											<img src="./img/product02.png" alt="">
										</div>
										<div class="product-body">
											<h3 class="product-name"><a href="#">product name goes here</a></h3>
											<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
										</div>
										<button class="delete"><i class="fa fa-close"></i></button>
									</div> -->
								
									<?php } } ?>
								</div>

									
								<div class="cart-btns">
									<?php 
											if($qtdeTotal) {
												?>
												<a href="<?php echo URL_BASE ?>carrinho" class='comprar'>Carrinho</a>	
											<?php }else{ 
													echo "";
											}
									?>	
									<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
								</div>

							</div>
						</div>
						<!-- /Cart -->

						<!-- Menu Toogle -->
						<div class="menu-toggle">
							<a href="#">
								<i class="fa fa-bars"></i>
								<span>Menu</span>
							</a>
						</div>
						<!-- /Menu Toogle -->

					</div>
				</div>
				<!-- /ACCOUNT -->
			</div>
			<!-- row -->
		</div>
		<!-- container -->
	</div>
	<!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						
						<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
						aria-expanded="false">Todos os departamentos </a>

							<!-- Inserindos as categorias na Aba Todos os departamentos -->
							<ul class="dropdown-menu row">
								<?php
									$categorias = consultar ("categoria","ativo_categoria='S' ");
									foreach($categorias as $categoria) {
										$id_cat = $categoria["id_categoria"];
								?>
								
								<!-- Inserindos subcategorias na categoria -->
								<li class="col-sm-4">
									<h5 style="text-align: center; color: red;"><a href="<?php echo URL_BASE ."categoria/?c=$id_cat" ?>"><?php echo $categoria["categoria"]?> </a></h5>
									<?php
										$subcategorias = consultar ("subcategoria","ativo_subcategoria = 'S' and id_categoria = $id_cat");
										if($subcategorias) {
											foreach ($subcategorias as $subcategoria) {
												$url_sub = URL_BASE ."subcategorias/?s=".$subcategoria["id_subcategoria"];
												echo "<a style='font-size: 12px;' href=$url_sub >$subcategoria[subcategoria] </a>";
											}
										}
									?>
								
								</li>
								<?php } ?>

							</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->
