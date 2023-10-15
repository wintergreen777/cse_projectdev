<!DOCTYPE html>
<html class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/hyper.css?v=1.3">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/app-lite.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/core/colors/palette-gradient.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  </head>
  <body class="vertical-layout" data-color="">   
  <div class="app-content content">
				<div class="content-wrapper">
				<div class="content-wrapper-before mb-3" style="display: contents;"></div>
					<div class="content-body container">
					<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body text-center">

				<textarea rows="10" class="form-control text-center form-checker mb-4" placeholder="CC HERE"></textarea>
					<div class="input-group mb-1">
					<input type="text" style="background-color:#000000;" class="form-control" id="sec" placeholder="SK_LIVE_NMBOP" name="sec">&nbsp;       
					<input type="number" style="background-color:#000000;" class="form-control" id="tgm" placeholder="TG ID" name="tgm">
                    </div>

					<button class="btn btn-play btn-glow btn-bg-gradient-x-blue-cyan text-black" style="width: 80%; float: middle;">HIT ME HARD </button>
								<button class="btn btn-stop btn-glow btn-bg-gradient-x-red-pink text-white" style="height:1px;visibility:hidden;width: 49%; float: right;" disabled=""><i class="fa fa-stop"></i> STFU</button>
				</div>
			</div>
		</div>
<div class="col-md-12">
  <div class="card mb-2">
  	<div class="card-body">

	  <h5>NMB TOTAL <span class="badge badge-dark float-right carregadas">0</span></h5><hr>
<h5>NMB HITS <span class="badge badge-success float-right charge">0</span></h5><hr>
<h5>NMB CVV <span class="badge badge-info float-right cvvs">0</span></h5><hr>
<h5>NMB CCN <span class="badge badge-primary float-right aprovadas">0</span></h5><hr>
<h5>DEAD CC <span class="badge badge-danger float-right reprovadas">0</span></h5>

                  </div> 
                </div>
              </div>
            		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="float-right">
						<button type="show" class="btn btn-primary btn-sm show-charge"><i class="fa fa-eye-slash"></i></button>
					<button class="btn btn-success btn-sm btn-copy1"><i class="fa fa-copy"></i></button>					
					</div>
					<h4 class="card-title mb-1"><i class="fa fa-check-circle text-success"></i>NMB HITS</h4>					
			<div id='lista_charge'></div>
				</div>				
			</div>
		</div>
		            		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="float-right">
						<button type="show" class="btn btn-primary btn-sm show-live"><i class="fa fa-eye-slash"></i></button>
					<button class="btn btn-success btn-sm btn-copy2"><i class="fa fa-copy"></i></button>					
					</div>
					<h4 class="card-title mb-1"><i class="fa fa-check text-success"></i>NMB CVV</h4>					
			<div id='lista_cvvs'></div>
				</div>				
			</div>
		</div>
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="float-right">
						<button type="show" class="btn btn-primary btn-sm show-lives"><i class="fa fa-eye-slash"></i></button>
					<button class="btn btn-success btn-sm btn-copy"><i class="fa fa-copy"></i></button>					
					</div>
					<h4 class="card-title mb-1"><i class="fa fa-times text-success"></i>NMB CCN</h4>					
			<div id='lista_aprovadas'></div>
				</div>				
			</div>
		</div>
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="float-right">
						<button type='hidden' class="btn btn-primary btn-sm show-dies"><i class="fa fa-eye"></i></button>
					<button class="btn btn-danger btn-sm btn-trash"><i class="fa fa-trash"></i></button>					
					</div>
					<h4 class="card-title mb-1"><i class="fa fa-times text-danger"></i> Moira gese/DECLINED</h4>		
						<div style='display: none;' id='lista_reprovadas'></div>
				</div>				
			</div>
		</div>
		
</section>
        </div>
      </div>
    </div>
    <script src="theme-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
    <script>
    $(document).ready(function(){

$('.show-charge').click(function(){
var type = $('.show-charge').attr('type');
$('#lista_charge').slideToggle();
if(type == 'show'){
$('.show-charge').html('<i class="fa fa-eye"></i>');
$('.show-charge').attr('type', 'hidden');
}else{
$('.show-charge').html('<i class="fa fa-eye-slash"></i>');
$('.show-charge').attr('type', 'show');
}});

$('.show-live').click(function(){
var type = $('.show-live').attr('type');
$('#lista_cvvs').slideToggle();
if(type == 'show'){
$('.show-live').html('<i class="fa fa-eye"></i>');
$('.show-live').attr('type', 'hidden');
}else{
$('.show-live').html('<i class="fa fa-eye-slash"></i>');
$('.show-live').attr('type', 'show');
}});

$('.show-lives').click(function(){
var type = $('.show-lives').attr('type');
$('#lista_aprovadas').slideToggle();
if(type == 'show'){
$('.show-lives').html('<i class="fa fa-eye"></i>');
$('.show-lives').attr('type', 'hidden');
}else{
$('.show-lives').html('<i class="fa fa-eye-slash"></i>');
$('.show-lives').attr('type', 'show');
}});

$('.show-dies').click(function(){
var type = $('.show-dies').attr('type');
$('#lista_reprovadas').slideToggle();
if(type == 'show'){
$('.show-dies').html('<i class="fa fa-eye"></i>');
$('.show-dies').attr('type', 'hidden');
}else{
$('.show-dies').html('<i class="fa fa-eye-slash"></i>');
$('.show-dies').attr('type', 'show');
}});

$('.btn-trash').click(function(){
	Swal.fire({title: 'REMOVED DEAD', icon: 'error', showConfirmButton: false, toast: true, position: 'top-end', timer: 1000});
$('#lista_reprovadas').text('');
});

$('.btn-copy1').click(function(){
	Swal.fire({title: 'COPIED CHARGED', icon: 'success', showConfirmButton: false, toast: true, position: 'top-end', timer: 1000});
var lista_charge = document.getElementById('lista_charge').innerText;
var textarea = document.createElement("textarea");
textarea.value = lista_charge;
document.body.appendChild(textarea); 
textarea.select(); 
document.execCommand('copy');           document.body.removeChild(textarea); 
});

$('.btn-copy2').click(function(){
	Swal.fire({title: 'COPIED CVV', icon: 'success', showConfirmButton: false, toast: true, position: 'top-end', timer: 1000});
var lista_live = document.getElementById('lista_cvvs').innerText;
var textarea = document.createElement("textarea");
textarea.value = lista_live;
document.body.appendChild(textarea); 
textarea.select(); 
document.execCommand('copy');           document.body.removeChild(textarea); 
});

$('.btn-copy').click(function(){
	Swal.fire({title: 'COPIED CCN', icon: 'success', showConfirmButton: false, toast: true, position: 'top-end', timer: 1000});
var lista_lives = document.getElementById('lista_aprovadas').innerText;
var textarea = document.createElement("textarea");
textarea.value = lista_lives;
document.body.appendChild(textarea); 
textarea.select(); 
document.execCommand('copy');           document.body.removeChild(textarea); 
});


$('.btn-play').click(function(){
var sec = $("#sec").val();
var tgm = $("#tgm").val();
var e = document.getElementById("gate");
var lista = $('.form-checker').val().trim();
var array = lista.split('\n');
var charge = 0, live = 0, lives = 0, dies = 0, testadas = 0, txt = '';

if(!lista){
	Swal.fire({title: 'You did not provide a card :(', icon: 'error', showConfirmButton: false, toast: true, position: 'top-end', timer: 1000});
	return false;
}

Swal.fire({title: 'Your cards are being Checked :)', icon: 'success', showConfirmButton: false, toast: true, position: 'top-end', timer: 1000});

var line = array.filter(function(value){
if(value.trim() !== ""){
	txt += value.trim() + '\n';
	return value.trim();
}
});

/*
var line = array.filter(function(value){
return(value.trim() !== "");
});
*/

var total = line.length;


/*
line.forEach(function(value){
txt += value + '\n';
});
*/

$('.form-checker').val(txt.trim());
// ảo ma hả, đừng lấy code chứ !!
if(total > 50000){
  Swal.fire({title: 'YOU CAN NOT PERFORM THAT ACTION: REDUCE NUMBER OF CARDS TO <50000', icon: 'warning', showConfirmButton: false, toast: true, position: 'top-end', timer: 3000});
  return false;
}

$('.carregadas').text(total);
$('.btn-play').attr('disabled', true);
$('.btn-stop').attr('disabled', false);

line.forEach(function(data){
var callBack = $.ajax({
    url: 'api.php?lista=' + data + '&sec=' + sec + '&tgm=' + tgm,
	success: function(retorno){
		if(retorno.indexOf("CHARGED") >= 0){
			$('#lista_charge').append(retorno);
			removelinha();
			charge = charge +1;
			Swal.fire({title: '+1 LIVE', icon: 'success', showConfirmButton: false, toast: true, position: 'top-end', timer: 1000});}
			else if(retorno.indexOf("CVV") >= 0){
			$('#lista_cvvs').append(retorno);
			removelinha();
			live = live +1;
		    Swal.fire({title: '+1 Cvv', icon: 'success', showConfirmButton: false, toast: true, position: 'top-end', timer: 1000});}
			else if(retorno.indexOf("CCN") >= 0){
			$('#lista_aprovadas').append(retorno);
			removelinha();
			lives = lives +1;
		    Swal.fire({title: '+1 Ccn', icon: 'success', showConfirmButton: false, toast: true, position: 'top-end', timer: 1000});}
		    else if(retorno.indexOf("SK_DIE") >= 0){
Swal.fire({title: 'Your SK is DIE', icon: 'error', showConfirmButton: false, toast: true, position: 'top-end', timer: 1000});
			$('.btn-play').attr('disabled', false);
			$('.btn-stop').attr('disabled', true);
			callBack.abort();
      	return false;
		    }else if(retorno.indexOf("SK_INVALID") >= 0){
Swal.fire({title: 'Sk Invalid', icon: 'error', showConfirmButton: false, toast: true, position: 'top-end', timer: 1000});
			$('.btn-play').attr('disabled', false);
			$('.btn-stop').attr('disabled', true);
			callBack.abort();
      	return false;
		    }else{
			$('#lista_reprovadas').append(retorno);
			removelinha();
			dies = dies +1;
		}
		testadas = charge + live + lives + dies;
	    $('.charge').text(charge);
	    $('.cvvs').text(live);
		$('.aprovadas').text(lives);
		$('.reprovadas').text(dies);
		$('.testadas').text(testadas);
		
		if(testadas == total){
			Swal.fire({title: 'Completed!!!', icon: 'success', showConfirmButton: false, toast: true, position: 'top-end', timer: 1000});
			$('.btn-play').attr('disabled', false);
			$('.btn-stop').attr('disabled', true);
		}
        }
      });
      $('.btn-stop').click(function(){
      Swal.fire({title: 'PAUSED', icon: 'warning', showConfirmButton: false, toast: true, position: 'top-end', timer: 1000});
      $('.btn-play').attr('disabled', false);
      $('.btn-stop').attr('disabled', true);      
      	callBack.abort();
      	return false;
      });
    });
  });
});

function removelinha() {
var lines = $('.form-checker').val().split('\n');
lines.splice(0, 1);
$('.form-checker').val(lines.join("\n"));
}
</script>
</body>
</html>
