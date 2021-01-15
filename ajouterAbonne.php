<?php
session_start();

if (isset($_GET['connexion']) OR !isset($_SESSION['name']) OR !isset($_SESSION['time'])) {
	session_destroy(); // destruction de session
	header("location:index.php");
}

if (isset($_POST['submit'])) {
	
$noms=$_POST['noms']; // nom d'utilisateur
$cni=$_POST['cni']; // le numéro de la CNI de l'utilisateur
$phone=$_POST['phone'];// numéro du téléphone de l'utilisateur 

if(!empty($noms) AND !empty($cni) AND !empty($phone) AND isset($_POST['forfait'])){
		$forfait=$_POST['forfait'];

		if($connect = mysqli_connect("localhost","root","root","biblio")){
			$req="INSERT INTO listeAbonnes(noms, cni, phone, forfait, dateAjout) VALUES('$noms', '$cni', '$phone', '$forfait', NOW())";
			$exec=mysqli_query($connect, $req) or die(mysqli_error($connect));

			$msg='<font color="green" size="4px">Abonné ajouté avec succès!</font>';
		}else{
			mysqli_error();
		}
	
}else{
	$msg='<font color="red" size="4px">Les champs doivent tous être remplis</font>';
}

	}
?>

<!DOCTYPE html PUBLIC "­//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1­strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta charset="utf-8">
	<title>Ajout d'un nouvel abonné</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
	<link rel="stylesheet" href="styles/style1.css">
	<script src="jquery.js"></script>
	<style type="text/css">
	
	html {
		background-image: url(images/bg.jpg);
		background-size: 100%;
		background-repeat: no-repeat;
		padding-top: 23px;
		width: 100%;
		background-attachment: fixed;
	}
	body{

		padding-top: 10px;
		background:rgba(255,255,255,0.5);
		box-shadow: 0px 0px 10px #fff;
		margin: 7em 0px 0px 20%;
		border: 1px solid #000;
		position: relative;
		background-attachment: fixed;
		width: 78.5%;
	}
	
.specialBurger{
	margin-top: 120px;
	padding: 2% 3%;
	width: 340px;
}
.specialBurger ul li{
	transition: .2s;
}
.specialBurger ul li:hover{
	transform: scale(1.1);
	text-shadow: 3px 3px 3px #5bc0de;

}
.specialBurger span{
	color: #fff;
	font-size: 30px;
	float: left;
	margin: 16px 10px 0px -10px;
}
.specialBurger ul{
	list-style-type: none;
	margin: 0px -10px;
}
.specialBurger ul ul{
	list-style-type: none;
	position: absolute;
	width: 65%;
	left: -45px;
	top:-120px;
	padding: 10px 15px;
	background-color: #eee;
	border: 1px solid black;
	border-radius: 5px;
	box-shadow: 0px 0px 25px 0px #5bc0de;
}
.specialBurger a{
	color: #000;
	font-size: 15px;
}
.btn-default{
	border: 2px solid red;
	box-shadow: 0 0 1px black, inset 0px 0px 5px red, 0 0 5px 5px yellow ;

}
.conteneur .first .row div.menu{
	padding: 50px 70px;
}
.acc{
	padding-right: 32px;
	padding-left: 32px;
}
.first{
	width: 100%;
}
.formContainer{
	width: 65%;
	padding: 20px;
	background: rgba(255,255,255,0.8);
	/*border-radius: 15px;*/
	border: 1px solid black
}
form input[type="text"]{
	border: 1px solid black;
}

	</style>
</head>
<body>
<?php 
$title="Ajout d'un nouvel abonné";
include('header.php'); 
?>

<div class="row conteneur">
	<div class="col-lg-4 hamburger">
		<img src="images/Books.gif" width="100px">

		<br><br>
		<a href="accueil.php" class="btn acc btn-warning">
				 <span class="glyphicon glyphicon-home"></span> Accueil 
		</a>
		<a onclick="goBack()" class="btn btn-success acc">
		<span class="glyphicon glyphicon-arrow-left"></span> Retour
		</a>
		<a href="accueil.php?connexion=off" class="btn btn-danger">
				<span class="glyphicon glyphicon-log-out"></span> Déconnexion
		</a>

		<br>
		<br><br>
	<div class="col-lg-8 specialBurger">
		<ul>
				<ul>
					<a href="listeDocuments.php"><li>Liste documents disponibles</li></a>
					<a href="ajouterAbonne.php"><li>Ajouter un nouvel abonné</li></a>
					<a href="listeAbonnes.php"><li>Liste des abonnés</li></a>
					<a href="enregistrerEmprunt.php"><li>Enregistrer un emprunt</li></a>
					<a href="listeEmprunts.php"><li>Liste des emprunts</li></a>
            	</ul>
 
		</ul>
	</div>
		
	</div>

	<div class="col-lg-8 first">
		<div class="row">
			<div class="col-lg-4">
				<div class="monMenu">
					Contactez-nous
					<hr wid5h="60%" style="" align="left">
					<span class="title">Fac Sciences</span>
				</div>
			</div>
			<div class="col-lg-8 formContainer">
					<form method="POST" class="form-horizontal form col-lg-8">
	<div class="form-group">
		<legend><u><b>Formulaire d'ajout d'un nouvel abonné</b></u></legend>
	</div>
	<div class="row">
		<div class="form-group">
		<label for="noms" class="col-lg-4">Nom et prénom : </label>
			<div class="col-lg-8">
			<input type="text" class="form-control" id="noms" name="noms" placeholder="Entrez votre nom et prénom...">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group">
		<label for="cni" class="col-lg-4">Numéro CNI: </label>
			<div class="col-lg-8">
			<input type="text" class="form-control" id="cni" name="cni" placeholder="Entrez le numéro de la CNI">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group">
		<label for="phone" class="col-lg-4">Numéro de téléphone : </label>
			<div class="col-lg-8">
			<input type="text" class="form-control" id="phone" name="phone" placeholder="Entrez le numéro de téléphone">
			</div>
		</div>
	</div>	

		<div class="row">
		<div class="form-group">
		<label for="forfait" class="col-lg-5">Abonnement(Forfait) : </label>
			<div class="col-lg-7">
			<input type="radio" id="mois" name="forfait" value="Mensuel" DEFAULT><label for="mois"> Forfait Mensuel </label><br>
			<input type="radio" id="trim" name="forfait" value="Trimestriel"><label for="trim"> 	Forfait Trimestriel </label><br>
			<input type="radio" id="sem" name="forfait" value="Semestriel"><label for="sem"> 	Forfait Semestriel</label> <br>
			<input type="radio" id="an" name="forfait" value="Annuel"><label for="an"> 	Forfait Annuel</label> <br>
			</div>
		</div>
	</div>	

	<div class="row">
		<div class="col-lg-4">
			<button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Ajouter</button>
		</div>
<? if(isset($msg)) echo $msg; ?>
	</div>
	</form>
			</div>
		</div>
		<br><br>

	</div>
</div>


<!--************************************************************************************-->


<?php include('footer.php'); ?>
<script>
	
	  $(document).ready(function(){
			$('#toImport').click(function(){
			$('.a_cacher').hide(500);
			$('.FormulaireImportation').show('slow');
		});
			$('#toConsult').click(function(){
			$('.a_cacher').hide(500);
			$('.liste').show('slow');
		});
	});
</script>

<script type="text/javascript">
	function goBack(){
		history.back();
	}
</script>
</body>
</html>
