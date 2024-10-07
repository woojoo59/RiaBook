	</div>
		<a title="<?=$_POST['subject']?>" href="<?=base_url()?>novel/novel?novelidx=<?=$_POST['idx']?>">
			<div class="novel">
				<div class="imgdiv rankd<?=$_POST['rank']?>">
					<div class="ranking">
						<?=$_POST['rank']?>
					</div>
					<div class="underimgdiv">
						<div class="recomenddiv">
							★ <?=$_POST['hit']?>
						</div>
						<div class="savediv">
							Ep. <?=$_POST['episode']?>
						</div>
					</div>
				</div>
				<div class="subjectdiv">
					<?=$_POST['subject']?>
				</div>
				<div class="creatordiv">
					<?=$_POST['nick']?>
				</div>
			</div>
		</a>
<style type="text/css">
	.rankd<?=$_POST['rank']?>{
		background-image:url('/static/upload/<?=$_POST['img']?>');
		background-repeat : no-repeat
	}
	.imgdiv{
		width: 10vw;
		height: 12vw;
		background-size: 10vw 12vw;
	}
	.subjectdiv{
		margin-top: 0.5vw;
	}
</style>