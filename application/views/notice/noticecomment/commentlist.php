			<tr class="commenttr">
				<td class="commenttd" colspan="2">
					<div class="creatorspan" >
						<?php 
							for($i=0;$i<$re;$i++){
						?>
						<img src="/static/img/recomment.png" alt="">
						<?php		
							}
						?>						
						<?=$creator?>
					</div>
					<div class="createdspan" ><?=$created?></div>
					<div class="contentspan" >
						<?=$content?>
					</div>
					<div class="recomment">
						<?php if(isset($_SESSION['useridx'])){ ?>
						<div class="recommentbtn" id="recommentbtn<?=$cidx?>">답글</div>
						<?php } ?>
						<img class="repot requierlogin" id="repot<?=$cidx?>" src="/static/img/repot.png" alt="">
					</div>
				</td>
			</tr>
			<tr class="df none" id="recomment<?=$cidx?>">
				<td>
					<form method="post" action="<?=base_url()?>comment/commentwrite?index=<?=$_GET['view']?>&forcategory=1" class="commentform" id='commentform<?=$cidx?>'>
						<div class="recommentcontent" id="commentcontent<?=$cidx?>" contenteditable></div>
						<button class="commentsubmit" id="commentsubmit<?=$cidx?>">댓글 작성</button>
						<input name="content" id="hiddencontent<?=$cidx?>" type="hidden">
						<input name="comg" type="hidden" value="<?=$cidx?>">
					</form>
				</td>
			</tr>
<script>
	let flag<?=$cidx?> = 0;
	$('#recommentbtn<?=$cidx?>').on('click',()=>{
		console.log(recommentflag);
		if(recommentflag==0){
			$('#recomment<?=$cidx?>').attr('class','df');
			recommentflag = 1;
			flag<?=$cidx?> = 1;
		} else if (flag<?=$cidx?>==1){
			$('#recomment<?=$cidx?>').attr('class','df none');
			recommentflag = 0;
			flag<?=$cidx?> = 0;
		}
	})
	$('#commentsubmit<?=$cidx?>').on('click',()=>{
		event.preventDefault();

		$('#hiddencontent<?=$cidx?>').val($('#commentcontent<?=$cidx?>').html());
		$('#scroll<?=$cidx?>').val($(window).scrollTop());
		if($('#hiddencontent<?=$cidx?>').val()==''){
			alert('댓글을 입력해주세요.');
			return false;
		}
		$('#commentform<?=$cidx?>').submit();
	})
	<?php if(isset($_SESSION['useridx'])){ ?>
	$('#repot<?=$cidx?>').on('click',()=>{
		location.href='<?=base_url()?>report/add?index=<?=$cidx?>&class=3';
	})
	<?php } ?>
</script>