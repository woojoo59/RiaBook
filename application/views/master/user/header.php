<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
		.margdiv{
			display: flex;
			height: 1vw;
			width: 90vw;
		}
		.marg{
			height: 1vw;
			width: 45vw;
		}
		.marg2{
			border-top:1px solid #e6e9ec;
			border-radius: 0 0.5vw 0 0;
		}
		.midd{
			width: 44vw;
			padding: 0.5vw;
			border-radius: 0.5vw;
			border:1px solid #e6e9ec;
			margin-bottom: 1vw;
		}
		.tline{
			display:flex;
			justify-content: center;
			align-items: center;
			padding-top: 0.5vw;
			padding-bottom: 0.5vw
		}
		.tline:hover{
			background: #e6e9ec;
		}
		.tablehead{
			display:flex;
			justify-content: center;
			align-items: center;
			padding-bottom: 0.5vw
		}
		.tablediv{
			display: flex;
		}
		.tds{
			width: 11vw;
			display:flex;
			justify-content: center;
			align-items: center;
			padding:0.5vw;
		}
		.th{
			font-weight: 600;
		}
		.bb{
			border-bottom:1px solid #e6e9ec;
		}
		.rdiv{
			display: flex;
			width: 44vw;
			padding-bottom:0.5vw;
		}
		.rdiv1{
			width: 8vw;
			display:flex;
			justify-content:flex-end;
			padding-right:1vw;
		}
		.rdiv2{
			width: 36vw;
		}
		.dn{
			display: none;
		}
		.listcontenthead{
			width: 44vw;
			display: flex;
			justify-content:flex-end;
			padding-top:1vw;
			padding-right:2vw;
		}
		.searchdiv{
			width: 44vw;
			margin:0.5vw;
		}
		.sresult{
			width: 44vw;
			margin-left:0.5vw;
		}
		#searchform{
			display: flex;
		}
		#searchform>*:focus{
			outline: none;
		}
		#searchform>*{
			border:1px solid #e6e9ec;
			border-radius: 0.5vw;
			height: 3vw;
			padding:0.5vw;
		}
		.searchc{
			width: 6vw;
			margin-right: 1vw;
		}
		.searchi{
			width: 15vw;
			margin-right: 1vw;
		}
		.searchb{
			width: 5vw;
		}
		.searchb:hover{
			background-color: grey;
			font-weight:bold;
		}
		.profile{
			width: 5vw;
			height: 5vw;
		}
		.df{
			display: flex;
			flex-wrap: wrap;
		}
		.pdh5vw{
			padding: 0.5vw;
		}
		.one{
			font-size: 1vw;
			font-weight: 600;
		}
		.rmain{
			width: 44vw;
			border-bottom:1px solid #e6e9ec;;
		}
		.mr1{
			margin-right: 1vw;
		}
		.divi{
			width: 6vw;
			display:flex;
			justify-content: center;
			align-items: center;
		}
		.divii{
			width: 38vw;
		}
		.tag{
			padding: 0.5vw;
			background-color: #AFEEEE;
			border-radius: 0.5vw;
			margin: 0.2vw;
		}
		.midr{
			overflow-x: hidden;
			overflow-y: auto;
		}
		.page1div{
			margin-top: 1vw;
			display: flex;
			justify-content: center;
		}
		.rmain:hover{
			background: #e6e9ec;
			cursor: pointer;
		}
		.rdiv-2{
			width: 15vw;
		}
		.userbtn{
			width: 3vw;
			border-radius:0.2vw;
			border:1px solid #e6e9ec;
			background-color: #ffffff;
		}
		.userbtn:hover{
			background-color:#8e9fb0;
		}    
		.say{
    	    width: 15vw;
    	    height: 10vw;
    	    border-radius:0.5vw;
    	    border:1px solid;
    	    position: fixed;
    	    top: 7vw;
    	    left: 42.5vw;
    	    padding: 0.5vw;
    	    background-color: #E3FDFD;
    	    pointer-events: auto;
    	}
    	.sayhead{
    	    display: flex;
    	    justify-content:flex-end;
    	    padding-bottom: 0.5vw;
    	    margin-bottom:0.5vw;
    	    border-bottom: 1px solid;
    	}
    	.saysec{
    	    margin-right:1vw;
    	    color: grey;
    	    font-size:0.6vw;
    	    display:flex;
    	    align-items:center;
    	}
    	.saymain{
    	    background-color: white;
    	    height:6.5vw;
    	    border-radius:0.5vw;
    	    padding: 0.5vw;
    	    font-size:0.8vw;
    	}
    	.tline:hover{
    		cursor: pointer;
    	}
    	.midl{
    		margin-right: 1vw;
    	}
    	.opensay{
    		pointer-events: none;
    	    overflow:hidden;
    	}
    	.listcontent{
    		padding:0.5vw;
    		background-color:#FFECC8;
    	}
    	.comma{
    		font-size:0.9vw;
    		font-weight:600;
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
					<a class="nav-link active" href="<?=base_url()?>master/user">유저</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url()?>master/novels">소설</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url()?>master/recommend">추천</a>
				</li>
			</ul>
		</div>
		<div class="mid">
			<div class="searchdiv">
				<form id="searchform" action="<?=base_url()?>master/user">
					<select class="searchc" name="category">
						<option selected disabled>검색조건</option>
						<option value="0" <?php if($category===0)echo 'selected'; ?>>아이디</option>
						<option value="1" <?php if($category===1)echo 'selected'; ?>>닉네임</option>
						<option value="2" <?php if($category===2)echo 'selected'; ?>>이름</option>
						<option value="3" <?php if($category===3)echo 'selected'; ?>>연락처</option>
						<option value="4" <?php if($category===4)echo 'selected'; ?>>상태</option>
					</select>
					<input class="searchi" type="text" name="input" value="<?=$input?>">
					<button class="searchb">검색</button>
				</form>
			</div>
			<div class="sresult">총 <?=$cnt?>명</div>
			<div class="tablediv">
				<div class="midd midl">
					<div class="tablehead bb">
						<div class="tds th">아이디</div>
						<div class="tds th">닉네임</div>
						<div class="tds th">이름</div>
						<div class="tds th">상태</div>
					</div>
					
