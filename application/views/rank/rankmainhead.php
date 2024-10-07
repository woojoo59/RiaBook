<style type="text/css">
	.novel{
		width: 12vw;
		height: 18vw;
		margin-right:0.5vw;
		margin-left: 0.5vw;
	}
	.imgdiv{
		width: 12vw;
		height: 14vw;
		background-size: 12vw 14vw;
		display: flex;
		flex-direction: column;
		border-radius: 0vw 1vw 1vw 1vw;
	}
	.ranking{
		width: 2vw;
		height: 2vw;
		background-color: grey;
		opacity: 0.8;
		color: white;
		font-size:1vw;
		display: flex;
		justify-content: center;
    	align-items: center;
	}
	.underimgdiv{
		margin-top: 10vw;
		width: 12vw;
		height: 2vw;
		display: flex;
		align-items: center;
    	justify-content: space-between;
    	padding: 0.3vw;
	}
	.recomenddiv{
		width: 5vw;
		height: 2vw;
		font-size:1vw;
		display: flex;
		color:white;
		align-items: flex-end;
    	justify-content: flex-start;
		text-shadow: 2px 2px 2px black;
	}
	.savediv{
		width: 5vw;
		height: 2vw;
		font-size:1vw;
		display: flex;
		color:white;
		text-shadow: 2px 2px 2px black;
		justify-content: flex-end;
		margin-right: 0.3vw;
		align-items: flex-end;
	}

	.rankicon{
		width: 1.3vw;
		height: 1.3vw;
	}
	.subjectdiv{
		font-size: 1.5vw;
		width: 100%;
		height: 2vw;
		overflow: hidden;
		color:black;
		white-space: nowrap;
		text-overflow: ellipsis;
	}
	.creatordiv{
		color: grey;
		font-size: 1vw;
		overflow: hidden;
		width: 100%;
		height: 2vw;
		white-space: nowrap;
		text-overflow: ellipsis;
	}
	.fivenovel{
		display: flex;
	}
	.nav-link{
		width: 21.66667vw;
		height: 3vw;
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
	.addrankdiv{
		display: flex;
		justify-content:center;
	}
</style>
<div class="rankmain">
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link <?php if($date==0){echo'active" aria-current="page';} ?>" 
				href="<?=base_url()?>home/rank?date=0&category=<?=$category?>&sort=<?=$sort?>">Today</a>
		</li>
		<li class="nav-item">
		  	<a class="nav-link <?php if($date==1){echo'active" aria-current="page';} ?>" 
		  		href="<?=base_url()?>home/rank?date=1&category=<?=$category?>&sort=<?=$sort?>">Week</a>
		</li>
		<li class="nav-item">
		  	<a class="nav-link <?php if($date==2){echo'active" aria-current="page';} ?>"  
		  		href="<?=base_url()?>home/rank?date=2&category=<?=$category?>&sort=<?=$sort?>">Month</a>
		</li>
	</ul>
<div class="freetopt">
	<div class="freetoptr">
		<a class="sort <?php if($sort==0){echo 'sortnow';} ?>" href="<?=base_url()?>home/rank?date=<?=$date?>&category=<?=$category?>&sort=0">조회 순</a>
		<a class="sort <?php if($sort==1){echo 'sortnow';} ?>" href="<?=base_url()?>home/rank?date=<?=$date?>&category=<?=$category?>&sort=1">추천 순</a>
		<a class="sort <?php if($sort==2){echo 'sortnow';} ?>" href="<?=base_url()?>home/rank?date=<?=$date?>&category=<?=$category?>&sort=2">선작 순</a>
	</div>
</div>
<div class="freetopb">
	<div class="categorydiv">
		<a href="<?=base_url()?>home/rank?date=<?=$date?>&category=7&sort=<?=$sort?>" class="category <?php if($category==7){echo 'nowcategory';} ?>">전체</a>
		<a href="<?=base_url()?>home/rank?date=<?=$date?>&category=0&sort=<?=$sort?>" class="category <?php if($category==0){echo 'nowcategory';} ?>">판타지</a>
		<a href="<?=base_url()?>home/rank?date=<?=$date?>&category=1&sort=<?=$sort?>" class="category <?php if($category==1){echo 'nowcategory';} ?>">무협</a>
		<a href="<?=base_url()?>home/rank?date=<?=$date?>&category=2&sort=<?=$sort?>" class="category <?php if($category==2){echo 'nowcategory';} ?>">로맨스</a>
		<a href="<?=base_url()?>home/rank?date=<?=$date?>&category=3&sort=<?=$sort?>" class="category <?php if($category==3){echo 'nowcategory';} ?>">드라마</a>
		<a href="<?=base_url()?>home/rank?date=<?=$date?>&category=4&sort=<?=$sort?>" class="category <?php if($category==4){echo 'nowcategory';} ?>">라이트 노벨</a>
		<a href="<?=base_url()?>home/rank?date=<?=$date?>&category=5&sort=<?=$sort?>" class="category <?php if($category==5){echo 'nowcategory';} ?>">패러디</a>
		<a href="<?=base_url()?>home/rank?date=<?=$date?>&category=6&sort=<?=$sort?>" class="category <?php if($category==6){echo 'nowcategory';} ?>">기타</a>
	</div>
</div>