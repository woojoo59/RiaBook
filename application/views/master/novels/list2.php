<div id="lists<?=$novelidx?>" class="list2 bb">
	<div class="list2top">
		<div class="episode">Ep. <?=$episode?></div>
		<div class="list2status">상태 : <?=$statusn?></div>
		<div class="list2hit">조회 : <?=$hit?></div>
		<div class="updatenovel"><?=$updated?></div>
	</div>
	<div class="title">타이틀 : <?=$title?></div>
</div>
<div id="contents<?=$novelidx?>" class="content dn">
	<div class="tablecontenttop"><button type="button" id="list2close" class="btn-close list2close"></button></div>
	<?=$content?>
	<div class="editnoveldiv">
		<button id="editnovel<?=$novelidx?>" class="editnovel"><?php if($status==0){echo'비공개';}else{echo'공개';} ?> 전환</button>
	</div>
</div>
<script type="text/javascript">
	$('.list2close').on('click',()=>{
		if(flag == 0){
			$('.content').attr('class', 'content dn');
			$('.list2').attr('class', 'list2 bb');
		}
	})
	$('#lists<?=$novelidx?>').on('click',()=>{
		if(flag == 0){
			$('.content').attr('class', 'content dn');
			$('.list2').attr('class', 'list2 bb');
			$('#lists<?=$novelidx?>').attr('class', 'list2 selectline');
			$('#contents<?=$novelidx?>').attr('class', 'content bb');
		}
	})

	$('#editnovel<?=$novelidx?>').on('click',()=>{
		$.post('<?=base_url()?>master/episodec',{'status': <?=$status?> ,'novelidx': '<?=$novelidx?>' },function(){
			$('.midr').load('<?=base_url()?>master/novelslist/<?=$page?>',{'idx':<?=$idx?>, 'novelidx':<?=$novelidx?>});
		})
		
	})
</script>