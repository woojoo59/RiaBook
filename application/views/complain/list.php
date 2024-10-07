<tr class="noticetr">
	<td class="noticetd1"><a href="<?=base_url()?>other/complainview?view=<?=$complainidx?>"><?=$optiond?></a></td>
	<td class="noticetd2"><a href="<?=base_url()?>other/complainview?view=<?=$complainidx?>"><div class="noticetd1div">
		<?=$subject?>
	</div></a></td>
	<td class="noticetd3">
		<?php if($optiond != '완료' and $optiond != '삭제'){ ?>
			<a href="<?=base_url()?>other/editcomplain?view=<?=$complainidx?>"><img title="편집" src="/static/img/edit.png"></a>
		<?php } ?>
		<a href="" id="d<?=$complainidx?>"><img src="/static/img/remove.png"></a>
	</td>
</tr>
<script type="text/javascript">
	$('#d<?=$complainidx?>').on('click',()=>{
		event.preventDefault();
		sayopen(<?=$complainidx?>);
	})
</script>