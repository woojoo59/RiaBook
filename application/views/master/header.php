<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>리아북 운영자</title>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style type="text/css">
    	*{
    		margin: 0;
    		padding: 0;
    	}
    	button{
    		background-color:white;
    	}
    	.header{
    		padding: 0.5vw;
    		margin-bottom: 1vw;
    	}
    	.main{
    		width: 90vw;
    		margin-left: 5vw;
    	}
    	.mid{
    		border-left: 1px solid #e6e9ec;
    		border-right: 1px solid #e6e9ec;
    		border-bottom: 1px solid #e6e9ec;
    		padding: 1vw;
    		display: flex;
    	}
    	.middiv{
    		width: 43.5vw;
    		padding: 1vw;
    		border-radius: 0.5vw;
    		border: 1px solid #e6e9ec;
    	}
    	.midl{
    		margin-right: 1vw;
    	}
    	.dn{
    		display:none;
    	}
    	.tablehead{
    		display:flex;
    	}
    	.t1{
    		width: 7vw;
    		padding:0.4vw;
    		display:flex;
    		justify-content:center;
    		align-items:center;
    	}
    	.t2{
    		width: 22.5vw;
    		padding:0.4vw;
    	}
    	.t3{
    		width: 9vw;
    		padding:0.4vw;
    		display:flex;
    		justify-content:center;
    		align-items:center;
    	}
    	.t4{
    		width: 5vw;
    		padding:0.4vw;
    		display:flex;
    		justify-content:center;
    		align-items:center;
    	}
    	.bordr{
    		border-right:1px solid #e6e9ec;
    	}
    	.thead{
    		display: flex;
    		justify-content: center;
    		align-items: center;
    		font-weight: bold;
    		font-size: 0.9vw;
    	}
    	.tableline{
    		display:flex;
    		font-size: 0.8vw;
    		border-top: 1px solid #e6e9ec;
    	}
    	.tableline:hover{
    		cursor: pointer;
    	}
    	.listtable{
    		border-bottom:1px solid #e6e9ec;
    	}
    	.repot{
    		display: flex;
    		justify-content:center;
    		align-items:center;
    		margin-bottom:1vw;
    	}
    	.contentdiv{
    		padding: 1vw;
    	}
    	.content{
    		margin-top: 1vw;
    		min-height: 10vw;
    	}
    	.repotbtn{
    		width: 5vw;
    		height:2.5vw;
    		margin-right:0.5vw;
    		margin-left:0.5vw;
    		border-radius:0.5vw;
    		border:1px solid grey;
    	}
    	.repotbtn:hover{
    		background-color:#e6e9ec;
    	}
    	.repotpage{
    		margin-top:1vw;
    		display:flex;
    		justify-content:center;
    		align-items:center;
    	}
    	.result{
    		min-height:27vw;
    		padding: 1vw;
    		border-radius: 0.5vw;
    	}
    	.rdiv{
			display: flex;
			margin-bottom:0.5vw;
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
			margin-right: 2vw;
		}
		.botdiv{
			display:flex;
			justify-content:center;
			align-items:center;
		}
		.profileimg{
			width: 10vw;
			height: 10vw;
			margin-bottom:0.5vw;
			border-radius:0.3vw;
		}
		.selectrepot{
			background-color:#98FB98;
		}
		.center{
    		width: 100%;
    		display: flex;
    		justify-content:center;
    		align-items:center;
    	}
    	.duce{
    		background-color:#FFECC8;
    		padding:0.5vw;
    	}
    </style>
</head>
<body>
	<div class="header"><a href="<?=base_url()?>"><img src="/static/img/backpage.png" alt=""></a></div>
	<div class="main">
		<div class="top">
			<div class="topl">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active disabled" href="<?=base_url()?>master">신고</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url()?>master/user">유저</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url()?>master/novels">소설</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url()?>master/recommend">추천</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="mid">
			<div class="middiv midl">
				<div class="listtable">
					<div class="tablehead">
						<div class="t1 thead bordr">신고자</div>
						<div class="t2 thead bordr">제목</div>
						<div class="t3 thead bordr">소속</div>
						<div class="t4 thead"></div>
					</div>
