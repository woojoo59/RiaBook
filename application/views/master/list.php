<div id="list<?=$reportidx?>" class="tableline">
	<div class="t1"><?=$nick?></div>
	<div class="t2"><?=htmlspecialchars($title, ENT_QUOTES, 'UTF-8')?></div>
	<div class="t3"><?=$classname.'/'.$foridx?></div>
	<div class="t4"><button type="button" id="btn<?=$reportidx?>" class="btn-close"></button></div>
</div>
<div id="content<?=$reportidx?>" class="duce dn">
	<div>DateTime : <?=$repotdate?></div>
	<div class="content"><?=$content?></div>
	<div class="repot">
		<button id="reporter<?=$reportidx?>" class="repotbtn">신고 유저</button>
		<?php if($baduser != 0){ ?>
			<button id="comd<?=$reportidx?>" class="repotbtn">대상 유저</button>
		<?php } ?>
		<button id="detail<?=$reportidx?>" class="repotbtn">상세보기</button>
	</div>
</div>
<script>
	$('#list<?=$reportidx?>').on('click',()=>{
		if(openflag == <?=$reportidx?>){
			$('.tableline').attr('class','tableline');
			$('.duce').attr('class','duce dn');
			openflag = '';
			return false;
		}
		$('.tableline').attr('class','tableline');
		$('.duce').attr('class','duce dn');
		$('#list<?=$reportidx?>').attr('class','tableline selectrepot');
		$('#content<?=$reportidx?>').attr('class','duce');
		openflag = <?=$reportidx?>;
		$('#detail<?=$reportidx?>').trigger('click');
	})
	$('#btn<?=$reportidx?>').on('click',()=>{
		event.stopPropagation();
		location.href = '<?=base_url()?>report/delete/<?=$reportidx?>';
	})
	$('#reporter<?=$reportidx?>').on('click',()=>{
		$('.result').load('<?=base_url()?>master/hereuser/'+<?=$useridx?>);
	})
	$('#detail<?=$reportidx?>').on('click',()=>{
		$('#search').val(<?=$foridx?>);
		$('#category').val(<?=$class?>);
		$('#searchbtn').trigger('click');
	})
	$('#comd<?=$reportidx?>').on('click',()=>{
		$('.result').load('<?=base_url()?>master/hereuser/'+<?=$baduser?>);
	})
</script>
