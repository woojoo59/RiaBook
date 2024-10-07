<style type="text/css">
		.ranks{
		width: 10vw;
		height: 10vw;
		border: 1px solid black;
	}
	.rankmin{
		display: flex;
		align-items: center;
	}
	.novel{
		width: 10vw;
		height: 16vw;
		margin-right:1vw;
	}
	.imgdiv{
		width: 10vw;
		height: 12vw;
		background-size: 10vw 12vw;
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
		margin-top: 8vw;
		width: 10vw;
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
		height: 18vw;
		display: flex;
	}
	#prev:hover{
		cursor: pointer;
	}
	#next:hover{
		cursor: pointer;
	}
	.rankmin{
		margin-top:1vw;
	}
	.previmg{
		transform:rotate(180deg);
		margin-right:1vw;
	}
	.rankminhead{
		margin-top:2vw;
		display: flex;
		justify-content:space-between;
		width: 60vw;
		align-items: flex-end;
	}
	.topten{
		font-size:1.3vw;
	}
</style>
	<div class="rankminhead">
		<div class="topten">추천 리스트</div>
	</div>
	<div class="rankmin">
		<div id="prev"><img class="previmg" src="<?=base_url()?>static/img/daum.png" alt=""></div>
		<div id="rank0"></div>
		<div id="rank1"></div>
		<div id="rank2"></div>
		<div id="rank3"></div>
		<div id="rank4"></div>
		<div id="next"><img src="<?=base_url()?>static/img/daum.png" alt=""></div>
	</div>

<script>
	let randomNumber = Math.floor(Math.random() * 10);
	const randomNum = Math.floor(Math.random() * 4);
	let page = randomNum;
	let timeid;
	const obj = JSON.parse('<?=json_encode($a)?>');
	let rank0 = 0+(5*page);
	let rank1 = rank0 +1;
	let rank2 = rank1+1;
	let rank3 = rank2+1;
	let rank4 = rank3+1;

	rankload();

	$('#next').on('click',()=>{
		page++;
		if(page>3){page=0}
		rankload();
		clearTimeout(timeid);
		time3();
	})

	$('#prev').on('click',()=>{
		page--;
		if(page<0){page=3}
		rankload();
		clearTimeout(timeid);
		time3();
	})
	time3();

	
	function time3(){
		if(timeid){
			clearTimeout(timeid);
		}
		timeid = setTimeout(()=>{
			$('#next').trigger('click');
			time3();
		},5000)
	}
	function rankload(){
		rank = 0+(5*page);
		rank1 = rank +1;
		rank2 = rank1+1;
		rank3 = rank2+1;
		rank4 = rank3+1;
		$('#rank0').load('<?=base_url()?>home/rankminview',obj[rank]);
		$('#rank1').load('<?=base_url()?>home/rankminview',obj[rank1]);
		$('#rank2').load('<?=base_url()?>home/rankminview',obj[rank2]);
		$('#rank3').load('<?=base_url()?>home/rankminview',obj[rank3]);
		$('#rank4').load('<?=base_url()?>home/rankminview',obj[rank4]);
	}

</script>
