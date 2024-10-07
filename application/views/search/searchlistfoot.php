		</table>
		<?php if($maxpage>0){ ?>
		<nav aria-label="Page navigation example" class="pagebtnsdiv">
	  		<ul class="pagination pagination-lg pagebtns">
	  			<?php if($nowpage>0){ ?>
	  				<li class="page-item">
	    	  			<a class="page-link" href="<?=base_url()?>home/search?soption=<?=$soptiond?>&input=<?=$_GET['input']?>&date=<?=$date?>&fdate=<?=$fdate?>&category=<?=$categoryd?>&sort=<?=$sortd?>" aria-label="Previous">
	    	    			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" fill="currentColor" class="bi bi-chevron-bar-left" viewBox="0 0 16 16">
 				 				<path fill-rule="evenodd" d="M11.854 3.646a.5.5 0 0 1 0 .708L8.207 8l3.647 3.646a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708 0M4.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 1 0v-13a.5.5 0 0 0-.5-.5"/>
							</svg>
	    	  			</a>
	    			</li>
	  			<?php } ?>
	  			<?php 
	  				if($nowblock > 0){
	  			?>
	  				<li class="page-item">
	  		  	  		<a class="page-link" href="<?=base_url()?>home/search?soption=<?=$soptiond?>&input=<?=$_GET['input']?>&date=<?=$date?>&fdate=<?=$fdate?>&category=<?=$categoryd?>&sort=<?=$sortd?>&page=<?=$startpage-1?>" aria-label="Previous">
	    	    			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
							  <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
							  <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
							</svg>
	  		  	  		</a>
	  		  		</li>
	  			<?php	
	  				} 
	  			?>
		
	  		  <?php 
	  		  	for($i=$startpage;$i<=$endpage;$i++){
	  		  ?>
	  		  	<li class="page-item <?php if($i==$nowpage){echo 'active';} ?>">
	  		  		<a class="page-link" 
	  		  		href="<?=base_url()?>home/search?soption=<?=$soptiond?>&input=<?=$_GET['input']?>&date=<?=$date?>&fdate=<?=$fdate?>&category=<?=$categoryd?>&sort=<?=$sortd?><?php if($i!=0){echo'&page='.$i;} ?>"><?=$i+1?></a></li>
	  		  <?php
	  		  	} 
	  		  ?>
	  		  
	  			<?php 
	  				if($nowblock < $maxblock){
	  			?>
	  		  	<li class="page-item">
	  		  	  <a class="page-link" 
	  		  	  href="<?=base_url()?>home/search?soption=<?=$soptiond?>&input=<?=$_GET['input']?>&date=<?=$date?>&fdate=<?=$fdate?>&category=<?=$categoryd?>&sort=<?=$sortd?>&page=<?=$endpage+1?>" aria-label="Next">
	  		  	    	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
						  <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708"/>
						  <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708"/>
						</svg>
	  		  	  </a>
	  		  	</li>
	  			<?php	
	  				} 
	  			?>
				<?php if($nowpage<$maxpage){ ?>
					<li class="page-item">
	    			  <a class="page-link" href="<?=base_url()?>home/search?soption=<?=$soptiond?>&input=<?=$_GET['input']?>&date=<?=$date?>&fdate=<?=$fdate?>&category=<?=$categoryd?>&sort=<?=$sortd?>&page=<?=$maxpage?>" aria-label="Next">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" fill="currentColor" class="bi bi-chevron-bar-right" viewBox="0 0 16 16">
						  <path fill-rule="evenodd" d="M4.146 3.646a.5.5 0 0 0 0 .708L7.793 8l-3.647 3.646a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708 0M11.5 1a.5.5 0 0 1 .5.5v13a.5.5 0 0 1-1 0v-13a.5.5 0 0 1 .5-.5"/>
						</svg>
	    			  </a>
	    			</li>
				<?php } ?>
			</ul>
		</nav>
	<?php } ?>
	</div>