		</table>
	</div>
	<div class="pagebtn">
		<nav aria-label="Page navigation example">
		  	<ul class="pagination">
		  		<?php 
		  		if($nowblock!=1){
		  		?>
		  	  	<li class="page-item">
		  	  	  	<a class="page-link"
		  	  	  	href="<?=base_url()?>notice/view?view=<?=$view?>&page=<?=$startpage-2?>" 
		  	  	  	aria-label="Previous">
		  	  	  	  	<span aria-hidden="true">&laquo;</span>
		  	  	  	</a>
		  	  	</li>
		  	  	<?php } ?>
		  	  	<?php for($i=$startpage;$i<=$endpage;$i++){ ?>
		  	  	<li class="page-item"><a class="page-link <?php if($nowpage==$i-1){echo 'active';} ?>" 
		  	  		href="<?=base_url()?>notice/view?view=<?=$view?>&page=<?=$i-1?>"><?=$i?></a></li>
		  	  	<?php } ?>
		  	  	<?php if($maxblock!=$nowblock and $maxblock!=0){ ?>
		  	  	<li class="page-item">
		  	  	  	<a class="page-link" 
		  	  	  	href="<?=base_url()?>notice/view?view=<?=$view?>&page=<?=$endpage?>" aria-label="Next">
		  	  	  	  	<span aria-hidden="true">&raquo;</span>
		  	  	  	</a>
		  	  	</li>
		  	  	<?php } ?>
		  	</ul>
		</nav>
	</div>	
</div>
<script type="text/javascript">
	$('#commentsubmit').on('click',()=>{
		event.preventDefault();

		$('#hiddencontent').val($('#commentcontent').html());
		$('#scroll').val($(window).scrollTop());
		if($('#hiddencontent').val()==''){
			alert('댓글을 입력해주세요.');
			return false;
		}
		$('#commentform').submit();
	})
	let recommentflag = 0;
</script>