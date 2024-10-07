			</div>
			<div class="repotpage">
				<nav aria-label="Page navigation example">
				  <ul class="pagination">
				  	<?php if($nowblock != 1){ ?>
				    <li class="page-item">
				      <a class="page-link" href="<?=base_url()?>master?page=<?=$startpage-1?>" aria-label="Previous">
				        <span aria-hidden="true">&laquo;</span>
				      </a>
				    </li>
					<?php } ?>
					<?php for($i=$startpage;$i<=$endpage;$i++){ ?>
				    <li class="page-item"><a class="page-link <?php if($nowpage == $i){echo 'active';} ?>" 
				    	href="<?=base_url()?>master?page=<?=$i?>"><?=$i+1?></a></li>
					<?php } ?>
				    <?php if($nowblock != $maxblock){ ?>
				    <li class="page-item">
				      <a class="page-link" href="<?=base_url()?>master?page=<?=$endpage+1?>" aria-label="Next">
				        <span aria-hidden="true">&raquo;</span>
				      </a>
				    </li>
					<?php } ?>
				  </ul>
				</nav>
			</div>
		</div>
		<div class="middiv midr">
			<div class="searchdiv dn">
				<select id="category" class="category dn" name="">
					<option value="0">소설</option>
					<option value="1">댓글</option>
					<option value="2">회차</option>
					<option value="3">쪽지</option>
					<option value="4">공지</option>
				</select>
				<input id="search" class="search dn" type="number" placeholder="인덱스 넘버를 입력해주세요.">
				<button id="searchbtn" class="searchbtn dn"><img class="searchicon" src="/static/img/mastersearch.png" alt=""></button>
			</div>
			<div class="result">
				<div class="default">
					<div class="rdiv"><div class="rdiv1">활동 유저 수 : </div><div class="rdiv2"><?=$auser?></div></div>
					<div class="rdiv"><div class="rdiv1">정지 유저 수 : </div><div class="rdiv2"><?=$suser?></div></div>
					<div class="rdiv"><div class="rdiv1">총 유저 수 : </div><div class="rdiv2"><?=$user?></div></div>
				</div>
				<div class="default">
					<div class="rdiv"><div class="rdiv1">판타지 : </div>		<div class="rdiv2"><?=$category[0]?></div></div>
					<div class="rdiv"><div class="rdiv1">무협 : </div>		<div class="rdiv2"><?=$category[1]?></div></div>
					<div class="rdiv"><div class="rdiv1">로맨스 : </div>		<div class="rdiv2"><?=$category[2]?></div></div>
					<div class="rdiv"><div class="rdiv1">드라마 : </div>		<div class="rdiv2"><?=$category[3]?></div></div>
					<div class="rdiv"><div class="rdiv1">라이트 노벨 : </div><div class="rdiv2"><?=$category[4]?></div></div>
					<div class="rdiv"><div class="rdiv1">패러디 : </div>		<div class="rdiv2"><?=$category[5]?></div></div>
					<div class="rdiv"><div class="rdiv1">기타 : </div>		<div class="rdiv2"><?=$category[6]?></div></div>
					<div class="rdiv"><div class="rdiv1">전체 : </div>		<div class="rdiv2"><?=$novel?></div></div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	let defaultradio = '';
	let openflag;
	$('#searchbtn').on('click',()=>{
		if($('#search').val()==null){
			alert('인덱스 넘버를 입력해주세요.');
			return false
		}
		$.post('<?=base_url()?>master/search',{'category': $('#category').val() ,'idx': $('#search').val() },function(data){
            let obj = JSON.parse(data);
            let result = '';
            if(obj == null){
            	alert('등록된 인덱스가 아닙니다.');
				return false
            }

            switch ($('#category').val()) {
            	case '1':
            		result = 'comment';
            		break;
            	case '2':
            		result = 'novel';
            		break;
            	case '3':
            		result = 'mail';
            		break;
            	case '4':
            		result = 'notice'
            		break;	
            	default:
            		result = 'novellist';
            		break;
            }

            $('.result').load('<?=base_url()?>master/'+result,obj);
        })
	})
	$('#moveall').on('click',()=>{
		location.href = '<?=base_url()?>master/user';
	})
</script>
</html>