<style type="text/css">
	.title{
		width: 60vw;
		height: 3vw;
		padding: 0.5vw;
		font-size: 1.3vw;
		margin-bottom: 1vw;
		border-radius: 0.3vw;
		border: 1px solid #eef0f2;
	}
	.title:focus{
		outline: none;
	}
	.buttondiv{
		padding: 0.5vw;
		width: 60vw;
		display: flex;
		justify-content: center;
	}
	#alertdiv{
		display: none;
	}
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<form id="repotform" method="post" action="<?=base_url()?>report/repot">
	<input id="title" class="title" type="text" name="title" placeholder="제목을 입력해주세요.">
	<textarea id="summernote" name="content"></textarea>
	<input type="hidden" name="class" value="<?=$_GET['class']?>">
	<input type="hidden" name="foridx" value="<?=$_GET['index']?>">
	<?php if(isset($_GET['forcategory'])) { ?>
		<input type="hidden" name="forcategory" value="<?=$_GET['forcategory']?>">
	<?php } ?>
	<div class="buttondiv">
		<button id="repot" class="btn btn-outline-info">신고</button>
	</div>
	<div id="alertdiv" class="alert alert-info" role="alert">d</div>
</form>
<script>
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
   	$('#repot').on('click',()=>{
   		event.preventDefault();
   		if($('#title').val()==''){
   			$('#alertdiv').html('제목을 입력해주세요.')
   			$('#alertdiv').css('display','block')
   			return false;
   		}
   		if ($('#summernote').summernote('isEmpty')){
   			$('#alertdiv').html('내용을 입력해주세요.')
   			$('#alertdiv').css('display','block')
   			return false;
   		}
   		history.replaceState(null, null, '<?=base_url()?>');
   		$('#repotform').submit();
   	})
</script>
