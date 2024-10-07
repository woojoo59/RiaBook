<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		body{
    		background-color: #95E7F8;
    		display: flex;
    		align-items: center;
    		justify-content: center;
    		flex-direction: column;
		}
		.main{
			background-color:#ccffcc;
			width: 60vw;
			height: 30vw;
			margin-top: 1vw;
			border-radius: 1vw;
			padding: 0.5vw;
			display: flex;
    		align-items: center;
    		flex-direction: column;
		}
		.logo{
			margin-top: 1vw;
			height: 11vw;
			display: flex;
    		align-items: center;
    		justify-content: center;
		}
		.logoimg{
			width:11vw;
			height:11vw;
		}
		.a2{
			width:30vw;
			display:flex;
			justify-content:space-between;
		}
		.btns{
			display:flex;
			flex-direction:column;
		}
		.btns:hover{
			cursor: pointer;
		}
		img{
			width: 3vw;
			height: 3vw;
		}
		.a3{
			display:flex;
			font-size: 1vw;
		}
		p{
			display: flex;
			justify-content:center;
		}
		.a1{
			min-height:10vw;
			display:flex;
			align-items:center;
			justify-content:center;
			flex-direction:column;
			font-size:1vw;
		}
		h1{
			color: red;
		}
		.a1>*{
			margin:1vw;
			width: 40vw;
		}
	</style>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
	<div class="logo">
		<img class="logoimg" src="/static/img/Ria.png" alt="">
	</div>
	<div class="main">
		<h1>경 고</h1>
		<div class="a1">
			<p>
				<?=$say?>
			</p>
			<p><?=$say2?></p>
		</div>
		<div class="a2">
			<div id="home" class="btns">
				<img src="/static/img/home.png" alt="">
				<p>홈으로</p>
			</div>
			<div id="back" class="btns">
				<img src="/static/img/backpage.png" alt="">
				<p>뒤로가기</p>
			</div>
		</div>
		<div class="a3">
			<div id="sec" class="sec"></div>
			<p>초후 홈으로 돌아갑니다.</p>
		</div>
	</div>
</body>
<script type="text/javascript">
	$('#home').on('click',()=>{
		location.href = '<?=base_url()?>';
	})
	$('#back').on('click',()=>{
		history.back();
	})
	let a = 10;
	sec(a);

	function sec(a){
		$('#sec').html(a);
		if(a==0){
			$('body').load('<?=base_url()?>home/loading',()=>{
				location.href = '<?=base_url()?>';
			});
		}
		
		if(a>0){
			setTimeout(()=>{
				a--;
				sec(a);
			},1000)
		}
	}
</script>
</html>
