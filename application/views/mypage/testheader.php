<style type="text/css">
	.mypage{
		width: 80vw;

/*        border: 1px solid  #eef0f2;*/

	}
/*	.nav{
		justify-content: space-between;
	}*/
	.nav-link{
		height: 3vw;
		width: 6vw;
		display: flex;
		justify-content:center;
		align-items: center;
	}

	img{
		height: 100%;
	}
/*	.topr{
		display: flex;
	}*/


	table{
		margin-top: 10vw;
		border-top: 1px solid #eef0f2;
		width: 100%;
	}
</style>
<div class="mypage">
	<div class="top">
		<ul class="nav nav-tabs">
  			<li class="nav-item">
				<a class="nav-link active" aria-current="page" href="#">내 작품</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">선호작</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">이어보기</a>
			</li>
			<li class="nav-item">
				<a class="nav-link"><img src="<?=base_url()?>static/img/free-icon-mail-8699939.png"></a>
			</li>
  			<div class="topr">
				<img src="<?=base_url()?>static/img/icons8-설정-50.png" alt="">
				<button class="btn btn-outline-primary" id="myinformation">회원 정보</button>
			</div>
		</ul>
	</div>
	<table>
		

