	</table>
</div>
<div class="masterdiv">
	<?php if($_SESSION['useridx']==1){ ?>
	<form id="complainform" action="<?=base_url()?>other/complain">
		<select id="complainoption" name="option" class="form-select form-select-lg mb-3" aria-label="Large select example">
		  <option value="0" <?php if($option==0){echo'selected';} ?> >전체</option>
		  <option value="1" <?php if($option==1){echo'selected';} ?> >대기</option>
		  <option value="2" <?php if($option==2){echo'selected';} ?> >완료</option>
		</select>
	</form>
	<script type="text/javascript">
		$('#complainoption').on('change',()=>{
			$('#complainform').submit();
		})
	</script>
	<?php } else { ?>
	<a href="<?=base_url()?>other/addcomplain"><button class="btn btn-outline-info">문의하기</button></a>
	<?php } ?>	
</div>
<div class="pagebtndiv">
	<nav aria-label="Page navigation example">
  		<ul class="pagination">
  			<?php if($nowblock>1){ ?>
  		  <li class="page-item">
  		    <a class="page-link" href="<?=base_url()?>other/complain?option=<?=$option?>&page=<?=$startpage-2?>" aria-label="Previous">
  		      <span aria-hidden="true">&laquo;</span>
  		    </a>
  		  </li>
  		<?php } for($i=$startpage;$i<=$endpage;$i++){ ?>
  		  <li class="page-item"><a class="page-link <?php if($nowpage==$i-1){echo 'active';} ?>" 
  		  	href="<?=base_url()?>other/complain?option=<?=$option?>&page=<?=$i-1?>"><?=$i?></a></li>
  		<?php } if($nowblock<$maxblock){ ?>
  		  <li class="page-item">
  		    <a class="page-link" href="<?=base_url()?>other/complain?option=<?=$option?>&page=<?=$endpage?>" aria-label="Next">
  		      <span aria-hidden="true">&raquo;</span>
  		    </a>
  		  </li>
  		<?php } ?>
  		</ul>
	</nav>
</div>
