					<div class="pagebtn">
						<nav aria-label="Page navigation example">
						  <ul class="pagination">
						  	<?php if($nowblock != 1){ ?>
						    <li class="page-item">
						      <a class="page-link" 
						      href="<?=base_url()?>master/novels/<?=$startpage-1?>?category=<?=$category?>&input=<?=$input?>" aria-label="Previous">
						        <span aria-hidden="true">&laquo;</span>
						      </a>
						    </li>
							<?php } ?>
							<?php for($i=$startpage;$i<=$endpage;$i++){ ?>
						    <li class="page-item">
						    	<a class="page-link <?php if($nowpage==$i){echo'active';} ?>" 
						    		href="<?=base_url()?>master/novels/<?=$i?>?category=<?=$category?>&input=<?=$input?>">
						    		<?=$i+1?>
						    	</a>
						    </li>
							<?php } ?>
						    <?php if($nowblock < $maxblock){ ?>
						    <li class="page-item">
						      <a class="page-link" 
						      href="<?=base_url()?>master/novels/<?=$endpage+1?>?category=<?=$category?>&input=<?=$input?>" aria-label="Next">
						        <span aria-hidden="true">&raquo;</span>
						      </a>
						    </li>
							<?php } ?>
						  </ul>
						</nav>
					</div>
				</div>
				<div class="midd midr">
					
				</div>
			</div>
		</div>	
	</div>
	<div id="saydiv" class="say dn">
	    <div class="sayhead">
	        <div id="saysec" class="saysec">10 seconds ago</div>
	        <button type="button" id="saybtn" class="btn-close" aria-label="Close"></button>
	    </div>
	    <div id="saymain" class="saymain">닉네임 중복확인이 필요합니다.</div>
	</div>
</body>
<script type="text/javascript">
	$('#saybtn').on('click',()=>{
		flag = 0;
        $('#saydiv').attr('class','say dn');
        $('.statusc').removeAttr('disabled');
    })


	let flag = 0;


    let timeoutId;  // 타이머 ID 저장 변수

    function dn10() {
        $('#saydiv').attr('class','say');
        let sec = 10;
        $('#saysec').html(sec + ' seconds ago');
        sec1(sec);
    }
    
    function sec1(sec){
        // 이전 타이머가 있으면 중지
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
    
        // 새로운 타이머 시작
        timeoutId = setTimeout(() => {
            $('#signinbtn').on('click', () => {
                // 기존 실행 중인 타이머 중지
                clearTimeout(timeoutId);
                // 새로운 카운트다운 시작
                dn10();
                return false;
            });
    
            sec--;
            $('#saysec').html(sec + ' seconds ago');
    
            if (sec == 0) {
                $('#saybtn').trigger('click');
                return false;
            }
    
            sec1(sec);
    
        }, 1000);
    }

    <?php if($open != ''){ ?>
    	$('#list<?=$open?>').trigger('click');
    <?php } ?>
</script>
</html>