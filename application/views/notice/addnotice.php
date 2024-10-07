<style type="text/css">
	.title{
		padding: 0.5vw;
		width: 80vw;
		min-height: 3vw;
		border: 1px solid #eef0f2;
		border-radius: 0.5vw;
		font-size: 1.5vw;
		margin-bottom: 1vw;
	}
	.content{
		width: 80vw;
		padding: 0.5vw;
		min-height: 30vw;
	}
	div:focus{
		outline: none;
	}
	.statusplace{
		color: grey;
	}
	.btndiv{
		margin-top: 1vw;
		width: 80vw;
		display: flex;
		justify-content: center;
	}
</style>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<div class="addnoticemain">
	<form id="noticeform" method="post" action="<?=base_url()?>notice/addnotice">
		<div class="title statusplace" id="titlediv" contenteditable>제목을 입력해주세요.</div>
		<textarea id="summernote" name="content"></textarea>
		<input type="hidden" id="title" name="title">
	</form>
	<div class="btndiv">
		<button id="noticebtn" class="btn btn-outline-info">공지 작성</button>
	</div>
</div>
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
   	let titleflag = 0;
   	$('#titlediv').on('focus',()=>{
   		if($('#titlediv').attr('class')=='title statusplace'){
   			$('#titlediv').attr('class','title').html('');
   			titleflag = 1;
   		}
   	})
   	$('#titlediv').on('focusout',()=>{
   		if($('#titlediv').html()==''){
   			$('#titlediv').attr('class','title statusplace').html('제목을 입력해주세요.');
   			titleflag = 0;
   		}
   	})



   	$('#noticebtn').on('click',()=>{
   		if(titleflag==0){
   			alert('제목을 입력해주세요.');
   			return false;
   		}
   		if ($('#summernote').summernote('isEmpty')){
   			alert('내용을 입력해주세요.');
   			return false;
   		}
   		$('#title').val($('#titlediv').html());
   		history.replaceState(null, null, '<?=base_url()?>');
   		$('#noticeform').submit();
   	})
 </script>
