<nav aria-label="Page navigation example">
  <ul class="pagination">
  	<?php if($nowblock>1){ ?>
    <li class="page-item">
      <a id="prev" class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
<?php } ?>
<?php for($i=$startpage;$i<=$endpage;$i++){ ?>
    <li id="page<?=$i?>" class="page-item <?php if($i==$nowpage){echo 'active';} ?>"><a class="page-link" href="#"><?=$i+1?></a></li>
<?php } ?>
<?php if($nowblock<$maxblock){ ?>
    <li class="page-item">
      <a id="next" class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
<?php } ?>
  </ul>
</nav>
<script type="text/javascript">
	$('#prev').on('click',()=>{
		event.preventDefault();
		$('.novellist').load('<?=base_url()?>novel/jslist/<?=$startpage-1?>',{'idx':<?=$idx?>,'option':$('#listrule').val()});
	})
	$('#next').on('click',()=>{
		event.preventDefault();
		$('.novellist').load('<?=base_url()?>novel/jslist/<?=$endpage+1?>',{'idx':<?=$idx?>,'option':$('#listrule').val()});
	})
	<?php for($i=$startpage;$i<=$endpage;$i++){ ?>
    $('#page<?=$i?>').on('click',()=>{
		event.preventDefault();
		$('.novellist').load('<?=base_url()?>novel/jslist/<?=$i?>',{'idx':<?=$idx?>,'option':$('#listrule').val()});
	})
	<?php } ?>
</script>