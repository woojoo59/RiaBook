<style type="text/css">
		#profile{
			width: 10vw;
			height: 10vw;
			margin-right: 2vw;
			padding:0.5vw;
			border-radius:0.3vw;
		}
		.icon{
			width: 30px;
			height: 30px;
		}
		tr{
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
			height:1.2vw;
			text-wrap: nowrap;
			overflow:hidden;
			text-overflow : ellipsis;
		}
		.creator{
			font-weight : bold;
			font-style: italic;
			padding:0.3vw;
			padding-right: 0.5vw;
			background-color:#99ccff;
			border-radius:0.5vw;
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
			color:black;
			font-size: 1vw;
			border-radius: 5px;
			margin:0.5vw;
			padding:0.2vw;
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
		.subjectdiv{
			height: 2vw;
			text-wrap: nowrap;
			overflow:hidden;
			text-overflow : ellipsis
		}
	</style>
<div class="freemain">
<div class="freetopt">
	<div class="freetoptl">총 <?=$count?>개의 작품</div>
	<div class="freetoptr">
		<a class="sort <?php if($sort==0){echo 'sortnow';} ?>" href="
			<?=base_url()?>home/free?category=<?=$_GET['category']?>&sort=0
			">최신 순</a>
		<a class="sort <?php if($sort==1){echo 'sortnow';} ?>" href="
			<?=base_url()?>home/free?category=<?=$_GET['category']?>&sort=1
			">추천 순</a>
		<a class="sort <?php if($sort==2){echo 'sortnow';} ?>" href="
			<?=base_url()?>home/free?category=<?=$_GET['category']?>&sort=2
			">선작 순</a>
		<a class="sort <?php if($sort==3){echo 'sortnow';} ?>" href="
			<?=base_url()?>home/free?category=<?=$_GET['category']?>&sort=3
			">조회 순</a>
	</div>
</div>
<div class="freetopb">
	<div class="categorydiv">
		<a href="
		<?=base_url()?>home/free?category=7&sort=<?=$sort?>
		" class="category <?php if($category==7){echo 'nowcategory';} ?>">전체</a>
		<a href="
		<?=base_url()?>home/free?category=0&sort=<?=$sort?>
		" class="category <?php if($category==0){echo 'nowcategory';} ?>">판타지</a>
		<a href="
		<?=base_url()?>home/free?category=1&sort=<?=$sort?>
		" class="category <?php if($category==1){echo 'nowcategory';} ?>">무협</a>
		<a href="
		<?=base_url()?>home/free?category=2&sort=<?=$sort?>
		" class="category <?php if($category==2){echo 'nowcategory';} ?>">로맨스</a>
		<a href="
		<?=base_url()?>home/free?category=3&sort=<?=$sort?>
		" class="category <?php if($category==3){echo 'nowcategory';} ?>">드라마</a>
		<a href="
		<?=base_url()?>home/free?category=4&sort=<?=$sort?>
		" class="category <?php if($category==4){echo 'nowcategory';} ?>">라이트 노벨</a>
		<a href="
		<?=base_url()?>home/free?category=5&sort=<?=$sort?>
		" class="category <?php if($category==5){echo 'nowcategory';} ?>">패러디</a>
		<a href="
		<?=base_url()?>home/free?category=6&sort=<?=$sort?>
		" class="category <?php if($category==6){echo 'nowcategory';} ?>">기타</a>
	</div>
</div>
<table>

