	<tr id="list<?=$idx?>" class="tableline cursorp">
		<td class="t1 tablecell df"><?=$rank?></td>
		<td class="t2 tablecell"><?=$subject?></td>
		<td class="t3 tablecell df"><?=$nick?></td>
		<td class="t4 tablecell df"><button type="button" id="cbtn<?=$idx?>" class="btn-close" aria-label="Close"></button></td>
	</tr>
<script type="text/javascript">
	$('#cbtn<?=$idx?>').on('click',()=>{
		event.stopPropagation();
		sayopen(<?=$idx?>);
	})
	$('#list<?=$idx?>').on('click',()=>{
		$('.list2').load('<?=base_url()?>master/selectnovel/<?=$idx?>');
	})
	<?php if($rank == 1){ ?>
		$('.list2').load('<?=base_url()?>master/selectnovel/<?=$idx?>');
	<?php } ?>
</script>