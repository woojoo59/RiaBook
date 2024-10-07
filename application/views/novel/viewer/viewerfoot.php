	<div class="viewerbot">
		<div class="viewerbtns">
			<div class="viewerbtn">
				<?php if($prev != 0){ ?>
				<a href="<?=base_url()?>novel/viewer?index=<?=$prev?>"><img style="transform: rotate(180deg);" src="/static/img/daum.png" alt=""></a>
				<?php } ?>
			</div>
			<div class="viewerbtn">
				<?php if(isset($index)){ ?>
				<a class="requierlogin" href="<?=base_url()?>report/add?index=<?=$index?>&class=0">
					<img title="이 소설 신고하기" src="/static/img/repot.png" alt="">
				</a>
				<?php } ?>
			</div>
			<div class="viewerbtn">
				<?php
					if($next != 0){
				?>
				<a href="<?=base_url()?>novel/viewer?index=<?= $next ?>"><img title="다음화보기" src="/static/img/daum.png" alt=""></a>
				<?php		
					}
				?>
				
			</div>
		</div>
	</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(window).on('scroll',()=>{
		$('.viewertop').attr('style','display:none')
		$('.viewerbot').attr('style','display:none')
		if($(window).scrollTop()==0 || $(window).scrollTop()==($(document).height()-$(window).height())){
			$('.viewertop').attr('style','')
			$('.viewerbot').attr('style','')
		}
		
	})
</script>

