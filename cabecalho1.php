<!-- Create header fir all of pages -->

<!-- Function validate login -->
<?php
	session_start();
    $qtdeTotal = $_SESSION["LJQTDE"];	
	$idCliente = $_SESSION ["LJCLIENTE"]["id_cliente"];
	if($idCliente) {
		$txtLogin = "Logoff";
		$urlLogin = URL_BASE. "logoff";
		$nomeCliente = $_SESSION ["LJCLIENTE"]["cliente"];
	}else{
		$txtLogin = "Login";
		$urlLogin = URL_BASE. "nao-logado";
		$nomeCliente = "Olá Visitante";
	}
	if($qtdeTotal) {
		$Total = $qtdeTotal;
	}else{
		$Total = 0;
	}
?>		
	



<header>
	<!-- TOP HEADER -->
	<div id="top-header">
		<div class="container">
			<ul class="header-links pull-left">
				<li><a href="<?php echo "#"?>">HOME </a></li> 
				<li><a href="<?php echo "meus-dados"?>">Meus dados </a></li>					
				<li><a href="<?php echo "cadastro"?>"> Cadastrar	</a></li>						
				
				<?php echo "<li><a href=$urlLogin>$txtLogin</a></li> "; ?>
				
			</ul>
			<ul class="header-links pull-right">
			
				<li><a href="<?php echo "cadastro"?>" title="usuario" class="usuario"><p><i class="fa fa-user-o"></i><?php echo $nomeCliente ?> </p></a></li>
			
			</ul>
		</div>
	</div>
	<!-- /TOP HEADER -->

	<!-- MAIN HEADER -->
	<div id="header">
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
						<div>
							<a href="#">
								<i class="fa fa-heart-o"></i>
								<span>Favoritos</span>
								<div class="qty">23</div>
							</a>
						</div>
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
									<div class="product-widget">
										<div class="product-img">
											<img src="./img/product01.png" alt="">
										</div>
										<div class="product-body">
											<h3 class="product-name"><a href="#">product name goes here</a></h3>
											<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
										</div>
										<button class="delete"><i class="fa fa-close"></i></button>
									</div>

									<div class="product-widget">
										<div class="product-img">
											<img src="./img/product02.png" alt="">
										</div>
										<div class="product-body">
											<h3 class="product-name"><a href="#">product name goes here</a></h3>
											<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
										</div>
										<button class="delete"><i class="fa fa-close"></i></button>
									</div>
								</div>
								<div class="cart-summary">
									<small>3 Item(s) selected</small>
									<h5>SUBTOTAL: $2940.00</h5>
								</div>
								<div class="cart-btns">
									<a href="#">View Cart</a>
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
