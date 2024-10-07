<div class="pagebtn">
	<nav aria-label="Page navigation example">
	  <ul class="pagination">
	  	<?php if($nowblock>1){ ?>
	    <li class="page-item">
	      <a class="page-link" id="prev" href="#" aria-label="Previous">
	        <span aria-hidden="true">&laquo;</span>
	      </a>
	    </li>
		<?php } ?>
		<?php for($i=$startpage;$i<=$endpage;$i++){ ?>
	    <li class="page-item"><a class="page-link <?php if($i==$nowpage){echo 'active';} ?>" id="page<?=$i?>" href="#"><?=$i+1?></a></li>
		<?php } ?>
		<?php if($nowblock<$maxblock){ ?>
	    <li class="page-item">
	      <a class="page-link" id="next" href="#" aria-label="Next">
	        <span aria-hidden="true">&raquo;</span>
	      </a>
	    </li>
		<?php } ?>
	  </ul>
	</nav>
</div>
<script type="text/javascript">
	$('#next').on('click',()=>{
		event.preventDefault();
		$('.midr').load('<?=base_url()?>master/novelslist/<?=$endpage+1?>',{'idx':<?=$idx?>});
	})
	$('#prev').on('click',()=>{
		event.preventDefault();
		$('.midr').load('<?=base_url()?>master/novelslist/<?=$startpage-1?>',{'idx':<?=$idx?>});
	})
	<?php for($i=$startpage;$i<=$endpage;$i++){ ?>
	$('#page<?=$i?>').on('click',()=>{
		event.preventDefault();
		$('.midr').load('<?=base_url()?>master/novelslist/<?=$i?>',{'idx':<?=$idx?>})
	})
	<?php } ?>
	<?php if($open!=''){ ?>
		$('#lists<?=$open?>').trigger('click');
	<?php } ?>
</script>