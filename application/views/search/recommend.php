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
	#prev1:hover{
		cursor: pointer;
	}
	#next1:hover{
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
		<div class="topten">Ranking</div>
		<a href="<?=base_url()?>home/rank?date=0&category=7&sort=0"><div class="addrank">더 보기+</div></a>
	</div>
	<div class="rankmin">
		<div id="prev1"><img class="previmg" src="<?=base_url()?>static/img/daum.png" alt=""></div>
		<div id="rank5"></div>
		<div id="rank6"></div>
		<div id="rank7"></div>
		<div id="rank8"></div>
		<div id="rank9"></div>
		<div id="next1"><img src="<?=base_url()?>static/img/daum.png" alt=""></div>
	</div>

<script>
	let randomNumber1 = Math.floor(Math.random() * 10);
	const randomNum1 = Math.floor(Math.random() * 4);
	let page1 = randomNum1;
	let timeid1;
	const obj1 = JSON.parse('<?=json_encode($a)?>');
	let rank5 = 0+(5*page1);
	let rank6 = rank5 +1;
	let rank7 = rank6+1;
	let rank8 = rank7+1;
	let rank9 = rank8+1;

	rankload1();

	$('#next1').on('click',()=>{
		page1++;
		if(page1>3){page1=0}
		rankload1();
		clearTimeout(timeid1);
		time4();
	})

	$('#prev1').on('click',()=>{
		page1--;
		if(page1<0){page1=3}
		rankload1();
		clearTimeout(timeid1);
		time4();
	})
	time4();

	
	function time4(){
		if(timeid1){
			clearTimeout(timeid1);
		}
		timeid1 = setTimeout(()=>{
			$('#next1').trigger('click');
			time4();
		},5000)
	}
	function rankload1(){
		rank5 = 0+(5*page1);
		rank6 = rank5 +1;
		rank7 = rank6+1;
		rank8 = rank7+1;
		rank9 = rank8+1;
		$('#rank5').load('<?=base_url()?>home/rankminview2',obj1[rank5]);
		$('#rank6').load('<?=base_url()?>home/rankminview2',obj1[rank6]);
		$('#rank7').load('<?=base_url()?>home/rankminview2',obj1[rank7]);
		$('#rank8').load('<?=base_url()?>home/rankminview2',obj1[rank8]);
		$('#rank9').load('<?=base_url()?>home/rankminview2',obj1[rank9]);
	}

</script>
