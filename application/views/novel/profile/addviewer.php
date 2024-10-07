<tr class="notice">
	<td class="td1"></td>
	<td class='td2'><a id="addnotice" href=""><div class="viewerlist">더보기 +</div></a></td>
	<td class='td3'></td>
	<td class='td4'><div class="icon"></div></td>
</tr>
<script type="text/javascript">
	$('#addnotice').on('click',()=>{
		event.preventDefault();
		$('.novellist').load('<?=base_url()?>novel/jslist/<?=$page?>',{'idx':<?=$idx?>,'option':$('#listrule').val(),'add':<?=$maxnoidx-3?>});
	})
</script>