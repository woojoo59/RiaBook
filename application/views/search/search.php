<style type="text/css">
	.searchmain{
		display: flex;
		flex-direction: column;
		align-items: center;
	}
	.searchform{
		width: 40vw;
		border: 1px solid #eef0f2;
		border-radius:1vw;
		display: flex;
		flex-direction: column;
    	align-items: center;
	}
	.searchtop{
		display: flex;
		margin: 2vw;
	}
	.soption{
		width: 5vw;
		height: 3vw;
		margin-right: 1vw;
		border-radius: 0.5vw;
		display: flex;
		outline: none;
		border:2px solid #eef0f2;
	}
	.soption:focus{
		border:3px solid #2ECCFA;
	}
	.inputs:focus{
		border:3px solid #2ECCFA;
	}
	.inputs{
		width: 20vw;
		height: 3vw;
		margin-right: 1vw;
		border-radius: 0.5vw;
		border:2px solid #eef0f2;
		outline:none;
	}
	.submit{
		width: 5vw;
		height: 3vw;
		border-radius: 0.5vw;
		border:2px solid #eef0f2;
		background-color: white;
	}
	.submit:hover{
		background-color:#eef0f2;
	}

	.namelabel{
		width: 10vw;
		height: 3vw;
		display: flex;
    	align-items: center;
    	font-size: 1vw;
	}

	.optiondiv{
		display: flex;
		width: 30vw;
		margin:1vw;
	}
	.optiondivr{
		width: 20vw;
		height: 3vw;
		border-radius:0.5vw;
		outline:none;
		border:2px solid #eef0f2;
	}
	.optiondivr:focus{
		border:3px solid #2ECCFA;
	}
	#profile{
			width: 10vw;
			height: 10vw;
			margin-right: 2vw;

		}
		.icon{
			width: 30px;
			height: 30px;
		}
		.list>tr{
			border-bottom: 1px solid #eef0f2;
			width: 100%;
			display: flex;
			justify-content: center;
    		align-items: center;
    		height: 10vw;
		}
		.icons{
			display: flex;
		}
		.ml{
			margin-left: 1vw;
		}
		.td2div{
			width: 100%;
			height: 100%;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
		.td1{
			display: flex;
    		justify-content: center;
    		align-items: center;
		}
		.td3div{
			display: flex;
			flex-direction: column;
			width: 10vw;
			align-items: flex-end;
		}
		.mr{
			margin-right: 0.5vw;
		}

		.df{
			display: flex;
		}

		.td_a{
			color: black;
			height: 100%;
		}
		.td2{
			width: 30vw;
			height: 100%;
		}
		.tag{
			background-color: #eef0f2;
			padding: 0.4vw;
			border-radius: 1vw;
			margin-right: 1vw;
			max-width: 5vw;
			text-wrap: nowrap;
			overflow:hidden;
			text-overflow : ellipsis
		}
		table{
			width: 100%;
		}
		.introduce{
			width: 30vw;
			height:1.2vw;
			text-wrap: nowrap;
			overflow:hidden;
			text-overflow : ellipsis
		}
		.creator{
			font-weight : bold;
			font-style: italic;
			padding-right: 0.3vw;
			background-color:#99ccff;
			border-radius:0.5vw;
			display: flex;
			align-items: center;
    		justify-content: center;
		}
		.creatordiv{
			display: flex;
			min-width: 1vw;
		}
		.td3{
			display: flex;
			height: 100%;
			align-items: flex-end;
		}
		.pagebtnsdiv{
			display: flex;
			width: 50vw;
			align-items: center;
    		justify-content: center;
    		align-content: center;

		}
		.pagebtns{
			margin-top: 1vw;
		}
		.freetopt{
			border-bottom : 3px solid black;
			display: flex;
			justify-content:space-between;
			align-items:center;
		}
		.freetoptl{
			font-size: 1.5vw;
		}
		.category{
			font-size:0.8vw;
			color:grey;
		}
		.nowcategory{
			background-color:black;
			color:white;
		}
		.categorydiv{
			display: flex;
			justify-content: flex-end;
    		align-items: center;
		}
		.freetopb{
			border-bottom:1px solid #eef0f2;
    		margin-bottom: 0.5vw;
		}
		.sort{
			font-size:0.8vw;
			color:grey;
		}
		.sortnow{
			font-size:1vw;
			font-weight:bold;
			color:black;
		}
		.listdiv{
			margin-bottom:1vw;
		}
		.resultcnt{
			font-size:0.9vw;
			padding:0.5vw;
		}
		.searchdate{
			width: 9vw;
			text-align: center;
		}
		.spacedate{
			width: 2vw;
			padding: 0.5vw;
			display: flex;
			justify-content:center;
			align-items:center;
		}
		.subjectdiv1{
			height: 2vw;
			width: 30vw;
			text-wrap: nowrap;
			overflow:hidden;
			text-overflow : ellipsis
		}
		td{
			padding:0.2vw;
		}
		#profile{
			border-radius:0.3vw;
		}
</style>
<div class="searchmain">
	<form class="searchform" method="get" action="<?=base_url()?>home/search">
		<div class="searchtop">
			<select class="soption" name="soption" id="">
				<option <?php if(isset($_GET['soption'])and$_GET['soption']==0){echo'selected';} ?> value="0">제목</option>
				<option <?php if(isset($_GET['soption'])and$_GET['soption']==1){echo'selected';} ?> value="1">작가</option>
				<option <?php if(isset($_GET['soption'])and$_GET['soption']==2){echo'selected';} ?> value="2">태그</option>
			</select>
			<input class="inputs" name="input" type="text" <?php if(isset($_GET['input'])){?> value="<?=$_GET['input']?>"<?php } ?>>
			<input class="submit" type="submit" value="검색">
		</div>
		<div class="seearchdatediv optiondiv">
			<div class="namelabel">연재 날짜</div>
			<input class="searchdate optiondivr" type="text" name="date" id="fromdate" readonly value="<?php if(isset($_GET['date']))echo $_GET['date']; ?>">
			<div class="spacedate">~</div>
			<input class="searchdate optiondivr" type="text" name="fdate" id="fdate" readonly value="<?php if(isset($_GET['fdate']))echo $_GET['fdate']; ?>">
		</div>
		<div class="categorydiv optiondiv">
			<div class="namelabel">카테고리</div>
			<select class="category optiondivr" name="category" id="">
				<option <?php if(isset($_GET['category'])and$_GET['category']==7){echo "selected";} ?> value="7">전체</option>
				<option <?php if(isset($_GET['category'])and$_GET['category']==0){echo "selected";} ?> value="0">판타지</option>
				<option <?php if(isset($_GET['category'])and$_GET['category']==1){echo "selected";} ?> value="1">무협</option>
				<option <?php if(isset($_GET['category'])and$_GET['category']==2){echo "selected";} ?> value="2">로맨스</option>
				<option <?php if(isset($_GET['category'])and$_GET['category']==3){echo "selected";} ?> value="3">드라마</option>
				<option <?php if(isset($_GET['category'])and$_GET['category']==4){echo "selected";} ?> value="4">라이트 노벨</option>
				<option <?php if(isset($_GET['category'])and$_GET['category']==5){echo "selected";} ?> value="5">패러디</option>
				<option <?php if(isset($_GET['category'])and$_GET['category']==6){echo "selected";} ?> value="6">기타</option>
			</select>
		</div>
		<div class="sortdiv optiondiv">
			<div class="namelabel">정렬기준</div>
			<select class="sort optiondivr" name="sort" id="">
				<option <?php if(isset($_GET['sort'])and$_GET['sort']==0){echo "selected";} ?> value="0">최신 순</option>
				<option <?php if(isset($_GET['sort'])and$_GET['sort']==1){echo "selected";} ?> value="1">추천 순</option>
				<option <?php if(isset($_GET['sort'])and$_GET['sort']==2){echo "selected";} ?> value="2">선작 순</option>
				<option <?php if(isset($_GET['sort'])and$_GET['sort']==3){echo "selected";} ?> value="3">조회 순</option>
			</select>
		</div>
	</form>

			


