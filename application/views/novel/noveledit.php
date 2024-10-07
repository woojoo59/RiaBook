<style type="text/css">
	.wmain{
		border: 1px solid #eef0f2;
		width: 60vw;
		border-radius: 3vw;
	}
	.wtop{
		border: 1px solid #eef0f2;
		width: 60vw;
		height: 6vw;
		border-radius: 3vw;
		display: flex;
	}
	.wetop1{
		display: flex;
		align-items: center;
    	justify-content: center;
    	width: 10vw;
    	font-size:2vw;
	}
	#title{
		width: 40vw;
		height: 100%;
		border: none;
		font-size: 2vw;
	}
	#nstatus{
		width: 10vw;
		height: 100%;
		border:none;
		border-radius:3vw;
		font-size:1vw;
	}
	#title:focus{
		outline: none;
	}
	select:focus{
		outline: none;
	}
	.wtop1_1{
		font-size: 2vw;
	}
	div#editor {
    	padding: 16px 24px;
        border-top: 1px solid #D6D6D6;
        border-radius: 4px;
        background-color:#ccffcc;
        min-height:30vw;
    }
    #editor:focus{
    	outline:none;
    }
    .editor-menu>button{
    	width: 2vw;
    	border: none;
    }
    button.active {
        background-color: purple;
        color: #FFF;
    }
    #editor{
    	min-height: 10vw;
    }
    .wmiddle{
    	margin-top: 1vw;
    }
    .wbottom{
    	height: 3vw;
    	display:flex;
    	justify-content:center;
    	align-items:center;
    }
    #newbtn{
    	width:6vw;
    	height:2vw;
    }
    #delbtn{
    	width:6vw;
    	height:2vw;    	
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<div class="wmain">
	<form action="<?=base_url()?>novel/noveledit" method="post" id="wnovel">
		<div class="wtop">
			<div id='subtite' class="wetop1">
				<?=$index?>회차
			</div>
			<div class="wetop2">
				<input type="text" name="title" id="title" placeholder="타이틀을 입력해주세요." value="<?=$title?>">
			</div>
			<div class="wetop3">
				<?php if(!isset($option)){ ?>
				<select id="nstatus" name="nstatus">
					<option value="0" <?php if($status==0){echo 'selected';} ?>>공개</option>
					<option value="1" <?php if($status==1){echo 'selected';} ?>>비공개</option>
				</select>
				<?php } ?>
			</div>
		</div>
		<div class="wmiddle">
			<textarea id="summernote" name="content" ><?=htmlspecialchars($content, ENT_QUOTES, 'UTF-8')?></textarea>
		</div>
		<input type="hidden" name="novelidx" value="<?php if(!isset($option)){echo $novelidx;}else{echo $noticeidx;} ?>">
	</form>	
	<div class="wbottom">	
		<button class="btn btn-outline-info" id="newbtn">수정</button>
		<button class="btn btn-outline-info" id="delbtn">삭제</button>
	</div>
</div>
<?php if(!isset($option)){ ?>
<script type="text/javascript">
	$('#newbtn').on('click',()=>{
		if($('#title').val()==''){
			alert('타이틀을 입력해주세요.');
			return false;
		}
		if ($('#summernote').summernote('isEmpty')){
   			alert('내용을 입력해주세요.');
   			return false;
   		}
		const wnovel = document.querySelector('#wnovel');
		history.replaceState(null, null, '<?=base_url()?>');
		wnovel.submit();
	})
	$('#delbtn').on('click',()=>{
		location.href = '<?=base_url()?>novel/delete?value=<?=$novelidx?>';
	})
	$('#summernote').summernote({
   	  	placeholder: '내용을 입력해주세요.',
   	  	height: 600,
   	  	addDefaultFonts: true,
   	});
</script>
<?php }else{ ?>
	<script>
		$('#subtite').html('공지');
		$('#wnovel').attr('action','<?=base_url()?>mypage/editnotice');
	$('#newbtn').on('click',()=>{
		if($('#title').val()==''){
			alert('타이틀을 입력해주세요.');
			return false;
		}
		if ($('#summernote').summernote('isEmpty')){
   			alert('내용을 입력해주세요.');
   			return false;
   		}
		const wnovel = document.querySelector('#wnovel');
		history.replaceState(null, null, '<?=base_url()?>mypage');
		wnovel.submit();
	})
	$('#delbtn').on('click',()=>{
		location.href = '<?=base_url()?>mypage/delnotice/<?=$noticeidx?>';
	})
	$('#summernote').summernote({
   	  	placeholder: '내용을 입력해주세요.',
   	  	height: 600,
   	  	addDefaultFonts: true,
   	});
	</script>
<?php } ?>
