				<div class="page1div">
					<nav aria-label="Page navigation example">
					  <ul class="pagination">
					  	<?php if($nowpage>0){ ?>
					  	<li class="page-item">
					      <a class="page-link" 
					      href="<?=base_url()?>master/user?category=<?=$category?>&input=<?=$input?>" aria-label="Previous">
					        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="20" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
  <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
</svg>
					      </a>
					    </li>	
					  	<?php } ?>
					  	<?php if($nowblock != 1){ ?>
					    <li class="page-item">
					      <a class="page-link" 
					      href="<?=base_url()?>master/user/<?=$startpage-1?>?category=<?=$category?>&input=<?=$input?>" aria-label="Previous">
					        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="20" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
</svg>
					      </a>
					    </li>
						<?php } ?>
						<?php for($i=$startpage;$i<=$endpage;$i++){ ?>
					    <li class="page-item" width="14">
					    	<a class="page-link <?php if($nowpage==$i){echo'active';} ?>" 
					    		href="<?=base_url()?>master/user/<?=$i?>?category=<?=$category?>&input=<?=$input?>">
					    		<?=$i+1?>
					    	</a>
					    </li>
						<?php } ?>
					    <?php if($nowblock < $maxblock){ ?>
					    <li class="page-item">
					      <a class="page-link" 
					      href="<?=base_url()?>master/user/<?=$endpage+1?>?category=<?=$category?>&input=<?=$input?>" aria-label="Next">
					        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="20" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
</svg>
					      </a>
					    </li>
						<?php } ?>
						<?php if($maxpage>$nowpage){ ?>
							<li class="page-item">
					      <a class="page-link" 
					      href="<?=base_url()?>master/user/<?=$maxpage?>?category=<?=$category?>&input=<?=$input?>" aria-label="Next">
					        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="20" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708"/>
  <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708"/>
</svg>
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

</body>
	<div id="saydiv" class="say dn">
	    <div class="sayhead">
	        <div id="saysec" class="saysec">10 seconds ago</div>
	        <button type="button" id="saybtn" class="btn-close" aria-label="Close"></button>
	    </div>
	    <div id="saymain" class="saymain">닉네임 중복확인이 필요합니다.</div>
	</div>
<script>
	$('.xcontent').on('click',()=>{
		$('.tline').attr('class','tline bb');
		$('.listcontent').attr('class','listcontent dn');
	})


	function senddata(idx){
		const form = document.createElement('form');
		form.setAttribute('method', 'post');
		form.setAttribute('action', '<?=base_url()?>master/novels')

		const data = document.createElement('input');
		data.setAttribute('type', 'hidden');
		data.setAttribute('name', 'input');
		data.setAttribute('value', idx);

		form.appendChild(data);
		document.body.appendChild(form);

		form.submit();
	}
	$('#saybtn').on('click',()=>{
		flag = 0;
        $('#saydiv').attr('class','say dn');
        $('body').attr('class','');
    })

	let flag = 0;


    let timeoutId;  // 타이머 ID 저장 변수

    function dn10() {
        $('#saydiv').attr('class','say');
        $('body').attr('class','opensay');
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

</script>
</html>