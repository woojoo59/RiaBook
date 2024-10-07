<?php if(isset($rank[100*$tear])){ ?>
	<div class="addrankdiv">
		<button id="addrank" class="btn btn-outline-primary">더보기+</button>
	</div>
	<script type="text/javascript">
		$('#addrank').on('click',()=>{
			location.href = '<?=base_url()?>home/rank?date=<?=$_GET['date']?>&category=<?=$_GET['category']?>&sort=<?=$_GET['sort']?>&page=<?=$tear+1?>#line<?=$tear*20?>';
		})
	</script>
<?php } ?>
<script>
	$(window).on('load',()=>{
		if (window.location.hash) {
    		history.replaceState(null, null, ' '); // 해시를 없애면서 브라우저 기록을 수정
  		}
	})
</script>
<script type="text/javascript">
	let col = <?=$sort?>;
	$('.recomenddiv').attr('title','별 아이콘은 정렬에 따라 달라집니다.')
</script>
</div>
