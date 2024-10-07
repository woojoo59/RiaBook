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
	.viewermain{
		margin-top: 6vw;
		margin-left: 20vw;
		width: 60vw;
		min-height: 40vw;
		border-radius: 0.5vw;
		margin-bottom: 6vw;
		/*font-size:10px;
		color: red;*/
		background-color: #ccffcc;
	}
	.viewertop{
		width: 100vw;
		height: 4vw;
		position: fixed;
		top: 0px;
		display: flex;
		align-items: center;
		border-bottom: 1px solid #eef0f2;
		background-color:white;
	}
	.viewerbot{
		width: 100vw;
		height: 4vw;
		position: fixed;
		background-color: white;
		bottom: 0px;
		border-top: 1px solid #eef0f2;
		display: flex;
		align-items:center;
		justify-content:center;
	}
	.viewertop1{
		margin-left:0.5vw;
		width: 19.5vw;
	}
	.viewertop3{
		margin-right: 0.5vw;
		width: 19.5vw;
		display: flex;
		justify-content: flex-end;
		padding-right: 1vw;
	}
	.icons8{
		width: 2.5vw;
		height: 2.5vw;
	}
	.viewertop2{
		width: 60vw;
		height: 3vw;
		border-radius: 1vw;
		display: flex;
		align-items:center;
	}
	.mlv{
		margin-left:1vw;
		font-size: 1vw;
	}
	.viewerbtns{

		width:60vw;
		height: 3vw;
		display: flex;
	}
	.viewerbtn{
		width: 20vw;
		height: 3vw;

		display: flex;
		align-items:center;
		justify-content:center;
	}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
	<div class="viewertop">
		<div class="viewertop1">
			<a href="<?=base_url()?>novel/novel?novelidx=<?= $foridx ?>"><img src="/static/img/icons8-왼쪽-화살표-64.png" class="icons8"></a>
		</div>
		<div class="viewertop2">
	  		<h3>공지</h3>
	  		<span class="mlv"><?= $title ?></span>
		</div>
		<div class="viewertop3">

			<a href="<?php if(isset($test) && $test==0){echo base_url().'notice/viewer?index='.$_GET['index'];}else{echo base_url().'notice/viewerlist?index='.$_GET['index'];} ?>">
				<img class="icons8" src="/static/img/icons8-페이지-개요-(4)-48.png">
			</a>
			<a class="requierlogin" href="<?php if(isset($test) && $test==1){echo base_url().'notice/viewer?index='.$_GET['index'];}else{echo base_url().'comment/comments?index='.$_GET['index'].'&forcategory=1';} ?>">
				<img class="icons8" src="/static/img/icons8-댓글-40.png">
			</a>
			<a class="requierlogin" href="" data-bs-toggle="modal" data-bs-target="#Modal"><img src="../../static/img/icons8-설정-50.png" alt=""></a>
		</div>
	</div>