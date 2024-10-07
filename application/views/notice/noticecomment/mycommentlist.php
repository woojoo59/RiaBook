			<tr class="commenttr">
				<div>
					<td class="commenttd1">
						<div class="creator" >
							<?php 
								for($i=0;$i<$re;$i++){
							?>
							<img src="/static/img/recomment.png" alt="">
							<?php		
								}
							?>
							<?=$creator?>				
						</div>
						<div class="mycreated" ><?=$created?></div>
						<div class="mycommentcontent" >
							<?=$content?>
						</div>
						<div class="recomment">
							<div class="recommentbtn" id="recommentbtn<?=$cidx?>">답글</div>
						</div>
					</td>
					<td class="commenttd2">
						<div><button id="editbtn<?=$cidx?>" class="commentbtn btn btn-outline-info">수정</button></div>
						<div><a href="<?=base_url()?>comment/delete?index=<?=$_GET['view']?>&forcategory=1&cidx=<?=$cidx?>"><button class="commentbtn btn btn-outline-info">삭제</button></a></div>
					</td>
				</div>
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
		if(recommentflag==0){
			$('#recomment<?=$cidx?>').attr('class','df');
			recommentflag = 1;
			flag<?=$cidx?> = 1;
			$('#commentform<?=$cidx?>').attr('action','<?=base_url()?>comment/commentwrite?index=<?=$_GET['view']?>&forcategory=1')
		} else if (flag<?=$cidx?>==1){
			$('#recomment<?=$cidx?>').attr('class','df none');
			recommentflag = 0;
			flag<?=$cidx?> = 0;
		}
	})
		$('#editbtn<?=$cidx?>').on('click',()=>{
		if(recommentflag==0){
			$('#recomment<?=$cidx?>').attr('class','df');
			recommentflag = 1;
			flag<?=$cidx?> = 1;
			$('#commentform<?=$cidx?>').attr('action','<?=base_url()?>comment/edit?index=<?=$_GET['view']?>&forcategory=1')
			console.log($('#commentform<?=$cidx?>').attr('action'))
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
</script>