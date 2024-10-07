	<div class="viewerbot">
		<div class="viewerbtns">
			<div class="viewerbtn">
			</div>
			<div class="viewerbtn"><a class="requierlogin" href="<?=base_url()?>report/add?index=<?=$_GET['index']?>&class=1">
				<img src="/static/img/repot.png" alt="">
			</a></div>
			<div class="viewerbtn">				
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
	$('.viewermain').on('click',()=>{
		$('.viewertop').attr('style','')
		$('.viewerbot').attr('style','')
	})
</script>
