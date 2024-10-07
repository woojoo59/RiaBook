

		<a href="<?=base_url()?>novel/novel?novelidx=<?=$idx?>">
			<div class="novel">
				<div class="imgdiv rank<?=$rank?>">
					<div class="ranking">
						<?=$rank?>
					</div>
					<div class="underimgdiv">
						<div class="recomenddiv">
							★ <?php switch ($sort) {
								case 1:
									echo $dayrecommend;
									$sort = 1;
									break;
								case 2:
									echo $dayprefer;
									$sort = 2;
									break;
								default:
									echo $dayhit;
									$sort = 0;
									break;
							} ?>
						</div>
						<div class="savediv">
							Ep. <?=$save?>
						</div>
					</div>
				</div>
				<div class="subjectdiv">
					<?=$subject?>
				</div>
				<div class="creatordiv">
					<?=$creator?>
				</div>
			</div>
		</a>
<style type="text/css">
	.rank<?=$rank?>{
		background-image:url('/static/upload/<?=$img?>');
	}
</style>

