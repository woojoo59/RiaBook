<style type="text/css">
	.pagemain{
		width: 80vw;
	}
	.title{
		padding: 0.5vw;
		width: 80vw;
		min-height: 3vw;
		border-bottom: 1px solid #eef0f2;
		font-size: 1.3vw;
	}
	.content{
		padding: 0.5vw;
		margin-top: 1vw;
		width: 80vw;
		min-height: 16vw;
		font-size:1vw;
		border-bottom: 1px solid #eef0f2;
		margin-bottom: 1vw;
	}
	.echobody{
		height: 10vw;
		display: flex;
		align-items: center;
    	justify-content: center;
    	font-size:1.2vw;
	}
	.echobtn{
		width: 5vw;
	}
	.noticebtnsdiv{
		width: 80vw;
		display: flex;
		justify-content: flex-end;
	}
	.editdiv{
		margin-top:0.5vw;
		width: 80vw;
		display: flex;
		justify-content:center;
	}
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<div class="pagemain">
	<div class="title"><?=$subject?></div>
	<div class="content"><?=$content?></div>
	<form id="editform" method="post" action="<?=base_url()?>other/editcomplainm?view=<?=$_GET['view']?>">
		<textarea id="summernote" name="content"><?=$comment?></textarea>
		<div class="editdiv">
			<input id="editbtn" class="btn btn-outline-info" type="subject" value="수정">
		</div>
	</form>
</div>
<script>
	$('#summernote').summernote({
   	  	placeholder: '내용을 입력해주세요.',
   	  	tabsize: 2,
   	  	height: 600,
   	  	addDefaultFonts: true,
   	});
   	$('#editbtn').on('click',()=>{
   		   	if ($('#summernote').summernote('isEmpty')){
   			alert('내용을 입력해주세요.');
   			return false;
   		}
   		$('#editform').submit();
   	})
</script>