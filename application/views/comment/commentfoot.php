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
		  	  	  	href="<?=base_url()?>comment/comments?index=<?=$_GET['index']?>&forcategory=0&page=<?=$startpage-2?>" 
		  	  	  	aria-label="Previous">
		  	  	  	  	<span aria-hidden="true">&laquo;</span>
		  	  	  	</a>
		  	  	</li>
		  	  	<?php } ?>
		  	  	<?php for($i=$startpage;$i<=$endpage;$i++){ ?>
		  	  	<li class="page-item"><a class="page-link <?php if($nowpage==$i-1){echo 'active';} ?>" 
		  	  		href="<?=base_url()?>comment/comments?index=<?=$_GET['index']?>&forcategory=0&page=<?=$i-1?>"><?=$i?></a></li>
		  	  	<?php } ?>
		  	  	<?php if($maxblock!=$nowblock and $maxblock!=0){ ?>
		  	  	<li class="page-item">
		  	  	  	<a class="page-link" 
		  	  	  	href="<?=base_url()?>comment/comments?index=<?=$_GET['index']?>&forcategory=0&page=<?=$endpage?>" aria-label="Next">
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
		console.log($('#hiddencontent').val())
		$('#commentform').submit();
	})
	let recommentflag = 0;
</script>