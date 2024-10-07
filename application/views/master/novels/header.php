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
			padding: 0;
			margin: 0;
		}
		.header{
			padding: 0.5vw;
			margin-bottom:1vw;
		}
		.main{
			width: 90vw;
			margin-left: 5vw;
		}
		.mid{
			padding: 1vw;
			border-left:1px solid #e6e9ec;
			border-right:1px solid #e6e9ec;
			border-bottom:1px solid #e6e9ec;
		}
		.dn{
			display: none;
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
		.tablehead{
			display:flex;
			border-bottom:1px solid #e6e9ec;
		}
		.tablehead>.td1,.tablehead>.td2,.tablehead>.td3,.tablehead>.td5{
			border-right:1px solid #e6e9ec;
		}
		.td1{
			width: 8vw;
			padding:0.5vw;
			display:flex;
			justify-content:center;
			align-items:center;
		}
		.td2{
			width: 14.5vw;
			padding:0.5vw;
			white-space: nowrap;         /* 줄바꿈을 방지 */
  			overflow: hidden;            /* 넘치는 부분을 숨김 */
  			text-overflow: ellipsis;     /* 말줄임표 처리 */
		}
		.td3{
			width: 7vw;
			padding:0.5vw;
			display:flex;
			justify-content:center;
			align-items:center;
		}
		.td4{
			width: 5vw;
			padding:0.5vw;
			display:flex;
			justify-content:center;
			align-items:center;
		}
		.td5{
			width: 8vw;
			padding: 0.5vw;
			display: flex;
			justify-content: center;
			align-items:center;
		}
		.tablediv{
			display: flex;
		}
		.midd{
			width: 43.5vw;
			padding:0.5vw;
			border-radius:0.5vw;
			border:1px solid #e6e9ec;
		}
		.midl{
			margin-right:1vw;
		}
		.th{
			display:flex;
			justify-content:center;
			align-items:center;
			font-size:vw;
			font-weight:bold;
		}
		.tableline{
			display:flex;
		}
		.tableline:hover{
			cursor: pointer;
			background: #e6e9ec;
		}
		.dn{
			display:none;
		}
		.bb{
			border-bottom:1px solid #e6e9ec;
		}
		.pagebtn{
			display:flex;
			justify-content:center;
			align-items:center;
			margin-bottom:1vw;
			margin-top:1vw;
		}
		.imgdiv{
			padding:0.5vw;
			display: flex;
			justify-content:center;
			align-items:center;
		}
		.profileimg{
			width:10vw;
			height:10vw;
			border-radius: 0.5vw;
			border:1px solid black;
		}
		.tablecontent{
			padding: 1vw;
			background-color:#FFECC8;
		}
		.tablecontenttop{
			display:flex;
			justify-content:flex-end;
			align-items:center;
		}
		.rdiv{
			margin-top:0.25vw;
			margin-bottom: 0.25vw;
			display: flex;
		}
		.rdiv1{
			width:8vw;
			display:flex;
			justify-content:flex-end;
			padding-right:1vw;
		}
		.rdiv2{
			width: 30vw;
		}
		.rdiv-1{
			width: 4;
			display:flex;
			justify-content:flex-end;
			margin-right:3vw;
		}
		.w7h5{
			width: 7.5vw;
		}
		.w5{
			width: 5vw;
		}
		.list2{
			padding:0.5vw;
		}
		.list2:hover{
			cursor: pointer;
			background: #e6e9ec;
		}
		.list2top{
			display: flex;
		}
		.episode{
			width: 5vw;
			border-right:1px solid #e6e9ec;
		}
		.list2status{
			width: 7vw;
			padding-left: 1vw;
			border-right:1px solid #e6e9ec;
		}
		.list2hit{
			width: 5vw;
			padding-left:1vw;
			border-right:1px solid #e6e9ec;
		}
		.updatenovel{
			padding-left:1vw;
		}
		.content{
			padding: 1vw;
		}
		.selectline{
			background: #e6e9ec;
		}
		.editnoveldiv{
			display:flex;
			justify-content:center;
			align-items:center;
			margin-top:1vw;
		}
		.editnovel{
			width: 5vw;
			height:2.5vw;
			outline:none;
			background-color:white;
			border-radius:0.3vw;
			border:1px solid #e6e9ec;
		}
		.editnovel:hover{
			background-color:#e6e9ec;
		}
		.spacelist{
			display:flex;
			justify-content: center;
			align-items: center;
			padding:0.5vw;
			font-size: 0.9vw;
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
					<a class="nav-link active" href="<?=base_url()?>master/novels">소설</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url()?>master/recommend">추천</a>
				</li>
			</ul>
		</div>
		<div class="mid">
			<div class="searchdiv">
				<form id="searchform" action="<?=base_url()?>master/novels">
					<select class="searchc" name="category">
						<option selected disabled>검색조건</option>
						<option value="0" <?php if($option === 0)echo 'selected'; ?>>제목</option>
						<option value="1" <?php if($option === 1)echo 'selected'; ?>>작가</option>
						<option value="2" <?php if($option === 2)echo 'selected'; ?>>카테고리</option>
						<option value="3" <?php if($option === 3)echo 'selected'; ?>>태그</option>
					</select>
					<input class="searchi" type="text" name="input" value="<?=$input?>">
					<button class="searchb">검색</button>
				</form>
			</div>
			<div class="sresult">총 <?=$cnt?>작품</div>
			<div class="tablediv">
				<div class="midd midl">
					<div class="tablehead">
						<div class="td1 th">작가</div>
						<div class="td2 th">제목</div>
						<div class="td5 th">총 에피소드 수</div>
						<div class="td3 th">카테고리</div>
						<div class="td4 th">상태</div>
					</div>
					
