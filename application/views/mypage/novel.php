<style type="text/css">
	#subject{
		border: none;
		width: 100%;
		font-size: 2vw;
		text-align: center;
	}
	#subject:focus{
		border:none;
		outline: none;
	}
	.middle{
		display: flex;
		justify-content: space-between;
	}
	.w50p{
		display: flex;
		justify-content: center;
    	align-content: center;
	}
	#profile{
		width: 10vw;
		height: 16vw;
	}
	.profileimg{
		border: 1px solid #eef0f2;
		border-radius: 2vw;
		display: flex;
		justify-content: center;
    	align-items: center;
    	width: 12vw;
		height: 18vw;
	}
	.h6vw{
		height: 6vw;
	}
	.middler{
		    display: flex;
    		flex-direction: column;
    		align-content: center;
    		justify-content: center;
	}

	div#editor {
    	padding: 16px 24px;
        border: 1px solid #D6D6D6;
        border-radius: 4px;
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
    .novelmain{
        width: 40vw;
    }
    .novelfooter{
        display: flex;
        margin-top: 2vw;
        align-items: center;
        justify-content: center;

    }
    .novelbtn{
        width: 8vw;
        height: 3vw;

    }
    #novelselect{
        display: flex;
        align-content: center;
        align-items: center;
        justify-content: center;
    }
    .mvt_5{
        margin-top: 0.5vw;
    }
</style>
<div class="novelmain">
<form action="<?=base_url()?>novel/edit?index=<?=$idx?>" id="novel_list_form" method="post" enctype="multipart/form-data">
	<div>
		<input type="text" name="subject" id="subject" placeholder="소설 제목" autocomplete="off" value="<?=$subject?>"> 
	</div>
	<hr>
	<div class="middle mb-3">
		<div class="w50p">
			<div class="profileimg">
                <?php 
                    if(isset($img)){
                ?>
                <img id="profile" src="/static/upload/<?=$img?>" alt="">
                <?php        
                    } else{
                 ?>
				<img id="profile" src="/static/upload/default.png" alt="">
            <?php } ?>
			</div>
		</div>
		<div class="w50p">
			<div class="middler">
                <div class="form-floating">
                    <select class="form-select form-select h6vw" name="category" id="category" aria-label="Floating label select example">
                        <option value="0" <?php if($category==0){echo'selected';} ?>>판타지</option>
                        <option value="1" <?php if($category==1){echo'selected';} ?> >무협</option>
                        <option value="2" <?php if($category==2){echo'selected';} ?> >로맨스</option>
                        <option value="3" <?php if($category==3){echo'selected';} ?> >드라마</option>
                        <option value="4" <?php if($category==4){echo'selected';} ?> >라이트노벨</option>
                        <option value="5" <?php if($category==5){echo'selected';} ?> >패러디</option>
                        <option value="6" <?php if($category==6){echo'selected';} ?> >기타</option>
                    </select>
                    <label for="floatingSelect">category</label>
                </div>
				<div class="form-floating">
                    <select class="form-select form-select h6vw" name='status' id="status" aria-label="Floating label select example">
                        <option value="0" <?php if($status==0){echo'selected';} ?>>공개</option>
                        <option value="1" <?php if($status==1){echo'selected';} ?>>비공개</option>
                    </select>
                    <label for="floatingSelect">status</label>
                </div>
				<div class="form-floating h6vw">
				  	<input type="text" class="form-control h6vw" id="tag" placeholder="name@example.com" name="tag" value="<?=$tag?>">
				  	<label for="tag">태그 ex)#로맨스#판타지</label>
				</div>
				<div class="input-group">
					<label class="input-group-text" for="inputGroupFile01">프로필 이미지</label>
					<input type="file" class="form-control" id="inputGroupFile01" name='img' accept="image/*">
				</div>
                <div class="input-group mvt_5">
                    <select class="form-select novelbtn" aria-label="Default select example" name="" id="novelselect">
                        <option selected disabled>회차 수정</option>
                        <?php 
                            if($maxnovels != 0){
                                foreach ($novels as $novel) {
                        ?>
                        <option value="<?=$novel?>"><?=$maxnovels?> 회차</option>
                        <?php          
                                $maxnovels--;  
                                }
                            }
                         ?>
                    </select>
                </div>
			</div>
		</div>
	</div>
	<input type="hidden" name="introduce" id="introduce">
</form>
<div class="editor-menu">
    <button id="btn-bold">
        <b>B</b>
    </button>
    <button id="btn-italic">
        <i>I</i>
    </button>
    <button id="btn-underline">
        <u>U</u>
    </button>
    <button id="btn-strike">
        <s>S</s>
    </button>
    <button id="btn-ordered-list">
        OL
    </button>
    <button id="btn-unordered-list">
        UL
    </button>
</div>
    <div id="editor" contenteditable="true"><?=$introduce?></div>
    <div class="novelfooter">
        <button class="btn btn-outline-primary novelbtn" id="novelbtn">작품 수정</button>
        
    </div>
</div>

<script type="text/javascript">
    $('#novelselect').on('change',()=>{
        location.href = '<?=base_url()?>mypage/novel?index='+$('#novelselect').val();
    })

    const img = document.querySelector('#inputGroupFile01');
    img.addEventListener('change',(e)=>{
        const reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);

        reader.onload = function(event){
            $('#profile').attr('src', event.target.result);
        }
    })

    $('#novelbtn').on('click',()=>{
        $('#introduce').val($('#editor').html())
        if($('#subject').val()==''){
           alert('소설 제목을 입력해주세요.');
           return false;
        }
        if($('#category').val()==null){
           alert('카테고리를 선택해주세요');
           return false;
        }
        if($('#status').val()==null){
           alert('상태에서 공개 또는 비공개를 선택해주세요.');
           return false;
        }
        if($('#tag').val()==''){
           alert('태그를 최소 1개 적어주세요.');
           return false;
        }
        const tag = document.querySelector('#tag')
        if(!tag.value.includes('#')){
           alert('태그는 #으로 시작합니다.');
           return false;
        }
        
        if($('#introduce').val()==''){
           alert('소설을 소개 해주세요.');
           return false;
        }

        history.replaceState(null, null, '<?=base_url()?>');
        document.querySelector('#novel_list_form').submit();
    })
</script>

<!-- editor -->
<script>
    const editor = document.getElementById('editor');
    const btnBold = document.getElementById('btn-bold');
    const btnItalic = document.getElementById('btn-italic');
    const btnUnderline = document.getElementById('btn-underline');
    const btnStrike = document.getElementById('btn-strike');
    const btnOrderedList = document.getElementById('btn-ordered-list');
    const btnUnorderedList = document.getElementById('btn-unordered-list');

    btnBold.addEventListener('click', function () {
        setStyle('bold');
    });

    btnItalic.addEventListener('click', function () {
        setStyle('italic');
    });

    btnUnderline.addEventListener('click', function () {
        setStyle('underline');
    });

    btnStrike.addEventListener('click', function () {
        setStyle('strikeThrough')
    });

    btnOrderedList.addEventListener('click', function () {
        setStyle('insertOrderedList');
    });

    btnUnorderedList.addEventListener('click', function () {
        setStyle('insertUnorderedList');
    });

    function setStyle(style) {
        document.execCommand(style);
        focusEditor();
    }
    editor.addEventListener('keydown', function () {
        checkStyle();
    });

    editor.addEventListener('mousedown', function () {
        checkStyle();
    });

    // 버튼 클릭 시 에디터가 포커스를 잃기 때문에 다시 에디터에 포커스를 해줌
    function focusEditor() {
        editor.focus({preventScroll: true});
    }
    function checkStyle() {
        if (isStyle('bold')) {
            btnBold.classList.add('active');
        } else {
            btnBold.classList.remove('active');
        }
        if (isStyle('italic')) {
            btnItalic.classList.add('active');
        } else {
            btnItalic.classList.remove('active');
        }
        if (isStyle('underline')) {
            btnUnderline.classList.add('active');
        } else {
            btnUnderline.classList.remove('active');
        }
        if (isStyle('strikeThrough')) {
            btnStrike.classList.add('active');
        } else {
            btnStrike.classList.remove('active');
        }
        if (isStyle('insertOrderedList')) {
            btnOrderedList.classList.add('active');
        } else {
            btnOrderedList.classList.remove('active');
        }
        if (isStyle('insertUnorderedList')) {
            btnUnorderedList.classList.add('active');
        } else {
            btnUnorderedList.classList.remove('active');
        }
    }

    function isStyle(style) {
        return document.queryCommandState(style);
    }
</script>
