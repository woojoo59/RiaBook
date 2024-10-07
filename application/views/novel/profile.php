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
    	flex-direction: column;
	}
	#profile{
		border-radius: 2vw;
    	width: 12vw;
		height: 18vw;
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
	.h4vw{
		height: 4vw;
	}
	.middler{
		    display: flex;
    		flex-direction: column;
    		align-content: center;
    		justify-content: center;
	}

	#editor {
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
        display: flex;
        flex-direction: column;
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
    .novelright{
    	width: 100%;
    	margin-left: 1vw;
    }
    .icons{
		display: flex;
		margin-bottom: 1vw;
	}
	.ml{
		margin-left: 1vw;
	}
	.tag{
		background-color: #eef0f2;
		padding: 0.4vw;
		border-radius: 1vw;
		margin-right: 0.5vw;
	}
	.tags{
		display: flex;
	}
	.icon{
		width: 30px;
		height: 30px;
	}
	.introduce{
		background-color: #eef0f2;
		width: 100%;
		height: 11vw;
		margin-top:1vw;
		border-radius: 1vw;
		padding: 0.5vw;
		overflow: auto;
	}

	.td1{
		display: flex;
		align-items: center;
        justify-content: center;
        width: 4vw;
        border-radius: 1vw;
        background-color: #eef0f2;
        margin-right: 1vw;
	}
	tr{
		display: flex;
		margin: 0.5vw;
		width: 39vw;
	}
	.novellist{
		border: 1px solid #eef0f2;
		border-radius:1vw;
	}
	.td2{
		width: 20vw;
		display: flex;
		align-items:center;
	}
	.td3{
		width: 8vw;
	}
	.viewerlist{
		width: 100%;
		height: 100%;
		display: flex;
		align-items:center;
	}
	td>a{
		width: 100%;
		height: 100%;
		color: black;
	}
	.notice{
		background-color: #eef0f2;
		border-radius: 0.5vw;
	}
	.td4{
		width:6vw;
	}
	#recommend:hover{
		cursor: pointer;
	}
	#prefer:hover{
		cursor: pointer;
	}
</style>
<div class="novelmain">
	<div class="middle mb-3">
		<div class="w50p">
			<div class="profileimg">
				<?php 
					if (isset($img)) {
				?>
				<img id="profile" src="/static/upload/<?=$img?>" alt="">
				<?php
					} else {
				 ?>
				<img id="profile" src="/static/upload/default.png" alt="">
			<?php } ?>
			</div>
			<select id="listrule" class="form-select" aria-label="Default select example">
				<option value="0" <?php if($option==0){echo 'selected';} ?>>첫화부터</option>
				<option value="1" <?php if($option==1){echo 'selected';} ?>>최신화부터</option>
			</select>
		</div>
		<div class="novelright">
			<div>
				<h2><?= $subject ?></h2>
			</div>
			<div class="icons">
				<div>
					<img class="icon" src="/static/img/hit.png"> : <?=($hit=='')?0:$hit?>
				</div>
				<div>
					<img class="icon ml" src="/static/img/novel.png"> : <?= $save ?>
				</div>
				<div>
					<img class="icon ml" id="recommend" src="/static/img/commend.png"> : <?= $recommendscnt ?>			
				</div>
				<div>
					<img class="icon ml" id="prefer" src="/static/img/prefer.png"> : <?= $prefercnt ?>			
				</div>
			</div>
			<div class="tags">
				<?php
					foreach ($tag as $tags) {
						?>
						<div class="tag">#<?= $tags ?></div>
						<?php
					}
				?>
			</div>
			<div class="introduce">
				<?= $introduce ?>
			</div>
		</div>
	</div>
<script type="text/javascript">
	    $(window).on('load',()=>{
	    	$('#recommend').on('click',()=>{
	    		<?php if(!isset($_SESSION['useridx'])){echo 'location.href="'.base_url().'/home/login";';} ?>
        	
		})
	    	<?php
	    		if(isset($recommend)){
	    	?>

	    	$('#recommend').attr('src','/static/img/recommend.png');
	    	<?php
	    		}
	    	?>

	    	$('#prefer').on('click',()=>{
	    		<?php if(!isset($_SESSION['useridx'])){echo 'location.href="'.base_url().'/home/login";';} ?>
        	$.post('<?=base_url()?>users/prefer',{'prefer':<?=$_GET['novelidx']?>},function(data){
        	    location.reload();
        	})
		})
	    	<?php
	    		if(isset($preference)){
	    	?>
	    	
	    	$('#prefer').attr('src','/static/img/prefers.png');
	    	<?php
	    		}
	    	?>
	    	$('#listrule').on('change',(e)=>{
	    		location.href='<?=base_url()?>novel/novel?novelidx=<?=$idx?>&option='+$('#listrule').val();
	    	})
    })
</script>