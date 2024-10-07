<style type="text/css">
	.wmain{

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
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<div class="wmain">
	<form action="<?=base_url()?>novel/write" method="post" id="wnovel">
		<div class="wtop">
			<div class="wetop1">
				<?= $cnt ?>회차
			</div>
			<div class="wetop2">
				<input type="text" name="title" id="title" placeholder="타이틀을 입력해주세요.">
			</div>
			<div class="wetop3">
				<select id="nstatus" name="nstatus">
					<option value="0">공개</option>
					<option value="1">비공개</option>
					<option value="공지">공지</option>
				</select>
			</div>
		</div>
		<div class="wmiddle">
			<textarea id="summernote" name="content"></textarea>
		</div>
		<input type="hidden" name="foridx" value="<?= $_GET['index'] ?>">
	</form>	
	<div class="wbottom">	
		<button class="btn btn-outline-primary" id="newbtn">연재 등록</button>
	</div>
</div>

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
	$('#nstatus').on('change',()=>{
		$('.wetop1').html('<?= $cnt ?>회차');
		if($('#nstatus').val()=='공지'){
			$('.wetop1').html('공지');
		}
	})
	$('#summernote').summernote({
   	  	placeholder: '내용을 입력해주세요.',
   	  	tabsize: 2,
   	  	height: 600,
   	  	addDefaultFonts: true,
   	  	toolbar: [
 			['style', ['style']],
 			['font', ['bold', 'underline', 'clear']],
 			['fontname', ['fontname']],
 			['color', ['color']],
 			['para', ['ul', 'ol', 'paragraph']],
 			['table', ['table']],
 			['insert', ['picture']],
 			['view', ['fullscreen', 'help']],
		]
   	});
</script>
