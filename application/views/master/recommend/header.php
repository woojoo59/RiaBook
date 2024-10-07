<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		.header{
			padding:0.5vw;
			margin-bottom:1vw;
		}
		.main{
			width: 90vw;
			margin-left: 5vw;
			margin-bottom: 5vw;
		}
		.mid{
			min-height: 30vw;
			border-left: 1px solid #e6e9ec;
			border-right: 1px solid #e6e9ec;
			border-bottom: 1px solid #e6e9ec;
			padding: 1vw;
		}
		.midtop{
			width: 43.5vw;
		}
		.resultdiv{
			border: 1px solid #e6e9ec;
			border-radius: 1vw;
			min-height:30vw;
			padding: 1vw;
			width: 43.5vw;
			display:flex;
			flex-direction: column;
		}
		.df{
			display:flex;
			justify-content:center;
			align-items:center;
		}
		.tableline{
			display: flex;
			border-bottom: 1px solid #e6e9ec;
		}
		.tablecell{
			padding: 0.3vw;
		}
		.t1{
			width: 5vw;
			border-right:1px dashed #e6e9ec;
		}
		.t2{
			width: 20vw;
		}
		.t3{
			width: 10vw;		
		}
		.t4{
			width: 3vw;
		}
		.cursorp{
			cursor: pointer;
		}
		.list2{
			margin-left:1vw;
			border: 1px solid #e6e9ec;
			border-radius: 1vw;
			min-height:30vw;
			padding: 0.5vw;
			width: 43.5vw;
			display:flex;
			flex-direction: column;
		}
		.midmain{
			display: flex;
		}
	</style>
</head>
<body>
	<div class="header"><a href="<?=base_url()?>"><img src="/static/img/backpage.png" alt=""></a></div>
	<div class="main">
		<div class="top">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url()?>master">신고</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url()?>master/user">유저</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url()?>master/novels">소설</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?=base_url()?>master/recommend">추천</a>
				</li>
			</ul>
		</div>
		<div class="mid">
			<div class="midtop">
				<div class="input-group mb-3">
				  <span class="input-group-text" id="basic-addon1">추천 리스트 날짜</span>
				  <input class="searchdate form-control" type="text" name="date" id="fromdate" autocomplete="off" value="<?php if(isset($_GET['date'])){echo $_GET['date'];}else{echo date('Y-m-d');} ?>" 
				  aria-label="Username" aria-describedby="basic-addon1" readonly>
				</div>
			</div>
			<div class="midmain">
				<div class="resultdiv"></div>
				<div class="list2"></div>
			</div>
		</div>
	</div>
</body>
<script>
	$( function() {
		$( "#fromdate" ).datepicker({
			showOtherMonths: true,
			selectOtherMonths: true,
			dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'], // 요일의 한글 형식.

			changeYear: true ,	//콤보박스에서 년 선택 가능
            changeMonth: true,	 //콤보박스에서 월 선택 가능
  			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'], // 월의 한글 형식.
  			dateFormat: "yy-mm-dd"
		});
	});
	$('.resultdiv').load('<?=base_url()?>master/recommendlist/'+$('#fromdate').val());
	$('#fromdate').on('change',()=>{
		$('.resultdiv').load('<?=base_url()?>master/recommendlist/'+$('#fromdate').val());
	})
	history.replaceState({}, null, location.pathname);
</script>
</html>