	</table>
</div>
<?php if(isset($_SESSION['useridx']) and $_SESSION['useridx']==1){ ?>
<div class="masterdiv">
	<a href="<?=base_url()?>notice/add"><button class="btn btn-outline-info">공지 작성</button></a>
</div>
<?php } ?>
<div class="pagebtndiv">
	<nav aria-label="Page navigation example">
  		<ul class="pagination">
  			<?php if($nowblock>1){ ?>
  		  <li class="page-item">
  		    <a class="page-link" href="<?=base_url()?>home/notice?page=<?=$startpage-2?>" aria-label="Previous">
  		      <span aria-hidden="true">&laquo;</span>
  		    </a>
  		  </li>
  		<?php } for($i=$startpage;$i<=$endpage;$i++){ ?>
  		  <li class="page-item"><a class="page-link <?php if($nowpage==$i-1){echo 'active';} ?>" 
  		  	href="<?=base_url()?>home/notice?page=<?=$i-1?>"><?=$i?></a></li>
  		<?php } if($nowblock<$maxblock){ ?>
  		  <li class="page-item">
  		    <a class="page-link" href="<?=base_url()?>home/notice?page=<?=$endpage?>" aria-label="Next">
  		      <span aria-hidden="true">&raquo;</span>
  		    </a>
  		  </li>
  		<?php } ?>
  		</ul>
	</nav>
</div>
