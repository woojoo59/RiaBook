<style type="text/css">
	.mailview{
		width: 60vw;
	}
	.mailtitle{
		font-size: 1.5vw;
		padding: 0.5vw;
		width: 60vw;
		border-radius: 0.3vw;
		border:1px solid #eef0f2;
	}
	.mailtitle:focus{
		outline: none;
	}
	.mailsub{
		margin-top: 0.5vw;
		padding-bottom: 0.5vw;
		margin-bottom:0.5vw;
		border-bottom:1px solid #eef0f2;
	}
	.touser{
		display: flex;
		font-size:0.8vw;
		padding-left:0.5vw;
	}
	.datet{
		display:flex;
		font-size:0.8vw;
		padding-left:0.5vw;
		color:grey;
	}
	.subdata{
		margin-right:0.3vw;
	}
	.mailcontent{
		font-size:1vw;
		min-height: 15vw;
		padding:1vw;
		
	}
	.mailbottom{
		display: flex;
		justify-content: center;
	}
	.btn-outline-info{
		margin:0.2vw;
		width: 5vw;
		height: 2vw;
	}
	.repot{
		width: 60vw;
		display: flex;
		justify-content:flex-end;
		padding-bottom:0.2vw;
		border-bottom:1px solid #eef0f2;
	}
	.repotbtn{
		width: 1.5vw;
		height:1.5vw;
	}
	.repotbtn:hover{
		cursor: pointer;
	}
	#touser{
		border-radius:0.3vw;
		border:1px solid #eef0f2;
	}
	#touser:focus{
		outline:none;
	}
	#alertdiv{
		margin-top:0.5vw;
		display: none;
	}
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<form id="mailform" action="<?=base_url()?>mail/mailwrite" method="post">
<div class="mailview">
	<input name="subject" id="mailsubject" class="mailtitle" type="text" placeholder="제목을 입력해주세요.">
	<span id="subjectck"></span>
	<div class="mailsub">
		<div class="touser"><div class="subdata">받는 사람 : </div><div><input id="touser" type="text" value="<?=$user?>"></div></div>
		<input type="hidden" id="touseridx" name='touseridx'>
	</div>
	<div class="mailcontent"><textarea id="summernote" name="content"></textarea></div>
	<div class="mailbottom">
		<button id="commentmail" class="btn btn-outline-info">전송</button>
	</div>
</div>
	<div id="alertdiv" class="alert alert-info" role="alert">
	</div>
</form>
<script>
	$('#summernote').summernote({
   	  	placeholder: '<p>내용을 입력해주세요.</p><br><p style="font-size:0.8vw">※ 전송 후 취소가 불가능 하오니 신중히 작성해주세요.</p>',
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
   	$('#commentmail').on('click',()=>{
   		event.preventDefault();
   		if($('#mailsubject').val()==''){
   			$('#alertdiv').html('제목을 입력해주세요.')
   			$('#alertdiv').css('display','block')
   			return false;
   		}
   		if ($('#summernote').summernote('isEmpty')){
   			$('#alertdiv').html('내용을 입력해주세요.')
   			$('#alertdiv').css('display','block')
   			return false;
   		}
   		
   		$.post('<?=base_url()?>users/nickname',{'nickname':$('#touser').val()},function(data){
            let obj = JSON.parse(data);
            if(obj == null){
            	$('#alertdiv').html('닉네임을 정확하게 입력해주세요.')
            	$('#alertdiv').css('display','block')
   				return false;
            } else {
            	$('#touseridx').val(obj.useridx);
            	history.replaceState(null, null, '<?=base_url()?>');
            	$('#mailform').submit();
            }
        })

   	})
</script>
