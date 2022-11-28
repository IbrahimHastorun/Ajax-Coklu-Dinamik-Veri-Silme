<?php
require_once('../database.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Jquery dinamik silme</title>
	
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"crossorigin="anonymous">
	<script>
    	$(document).ready(function() {
			$(".sil").click(function() {
				var id = $(this).data('id'); // ==> tıklanan link'in data-id'sini id değişkenine ata
				var div = $(this).parents('#veriler'); // ==> tıklanan linkin divini div değişkenine ata
				
				$.ajax({
					type : "POST",
					url : "sil.php",
					data : {"id":id},
					success : function(cevap) {
						div.fadeOut();
					}
				});
			});

			$("#sec").click(function() {
				$('input[type = checkbox]').prop('checked',true); // prop => bir elemente özellik ekleme 
			});

			$("#kaldir").click(function() {
				$('input[type = checkbox]').prop('checked',false);
			});

			$("#sil").click(function(e) {
				$('input[type = checkbox]:checked').each(function() { //==> seçili ne kadar checkbox varsa hepsine burada yazan işlemleri uygula
					$(this).prev().trigger('click'); //==> seçilen elementten bir önceki elemente tıklanmış gibi yap prev() yerine next() deseydim bir sonraki element olurdu.
				});
			});

    	});
    </script>
	<style>
		.arkaplan {
		background-color: #E0DDDD;
		border-radius: 5px;
		border:1px solid #C4C0C0;
		}

		#veriler {
		background-color: #F9F8F8;
		border:1px solid #C4C0C0;
		}

		input[type=checkbox] {
		width: 20px;
		height: 20px;
		}	
	</style>
</head>
<body>
	<div class="container" >
		<div class="row text-center ">
			<div class="col-lg-5 mx-auto arkaplan mt-3">
				<div class="row mt-2  text-center text-dark bg-warning m-2">
					<div class="col-lg-12 pt-2">
						<h4>
							KAYITLAR
						</h4>
					</div>
				</div>				
				<div class="row mt-2  text-center text-dark m-2">
					<div class="col-lg-4">
						<input type="button" id="sec" class="btn btn-success btn-sm btn-block" value="Tümünü Seç">
					</div>
					<div class="col-lg-4">
						<input type="button" id="kaldir" class="btn btn-success btn-sm btn-block" value="Seçileni Kaldır">
					</div>
					<div class="col-lg-4">
						<input type="button" id="sil" class="btn btn-dark btn-sm btn-block" value="sil">
					</div>
				</div>
				<?php
					$verial = $database->prepare("SELECT * FROM bilgiler");
					$verial->execute();
					while ($vericek = $verial->fetch(PDO::FETCH_ASSOC)) { ?>
						
						<div class="row  text-center text-dark m-2 p-2" id="veriler">
							<div class="col-lg-8 pt-2 ">
								<?php echo $vericek['ad'] ?>
							</div>
							<div class="col-lg-3 ">
								<a  data-id="<?php echo $vericek['id'] ?>" href="" class="btn ml-2 btn-danger sil">Sil</a>
								<input class="ml-6" type="checkbox">
							</div>	
						</div> <?php

					}
				?>	
				<div id="sonucgor">

				</div>
			</div>
		</div>
	</div>	
</body>   
</html>	