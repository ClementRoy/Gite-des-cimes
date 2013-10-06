<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

	<div class="container">

		<div class="page-header">
		  <h1>Les enfants <small>ajout, édition, suppression</small></h1>
		</div>

		<table class="table table-striped">
		  <thead>
		  	<tr>
		  		<td>Nom & prénom</td>
		  		<td>Date de naissance</td>
		  		<td>Editer</td>
		  		<td>Supprimer</td>
		  	</tr>
		  </thead>
		  <tbody>
		  	<tr>
		  		<td><a href="">Christophe Béghin</a></td>
		  		<td>2 janvier 1990</td>
		  		<td><a href=""><i class="icon-edit"></i></a></td>
		  		<td><a href=""><i class="icon-remove"></i></a></td>
		  	</tr>
		  	<tr>
		  		<td><a href="">Clément Roy</a></td>
		  		<td>2 mai 1990</td>
		  		<td><a href=""><i class="icon-edit"></i></a></td>
		  		<td><a href=""><i class="icon-remove"></i></a></td>
		  	</tr>
		  	<tr>
		  		<td><a href="">Nedjma Behlouli</a></td>
		  		<td>1 décembre 1989</td>
		  		<td><a href=""><i class="icon-edit"></i></a></td>
		  		<td><a href=""><i class="icon-remove"></i></a></td>
		  	</tr>
		  	<tr>
		  		<td><a href="">Coraline Assimon</a></td>
		  		<td>22 avril 1989</td>
		  		<td><a href=""><i class="icon-edit"></i></a></td>
		  		<td><a href=""><i class="icon-remove"></i></a></td>
		  	</tr>

		  </tbody>
		</table>
	</div><!-- /.container -->


<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>