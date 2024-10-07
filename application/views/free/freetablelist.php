	<tr>
		<td class="td1">
			<a href="<?=base_url()?>novel/novel?novelidx=<?=$idx?>">
				<img id="profile" src="/static/upload/<?=$img?>">
			</a>
		</td>
		<td class="td2">
			<a class="td_a" href="<?=base_url()?>novel/novel?novelidx=<?=$idx?>">
				<div class="td2div">
					<h2 class="subjectdiv"><?= $subject?></h1>
					<div class="creatordiv">
						<div class="creator">
							<?=$creator?>
						</div>
					</div>	
					
					<p class="introduce"><?=$introduce?></p>
					<div class="icons">
						<?php
							foreach ($tag as $tags) {
						?>
							<div class="tag"># <?= $tags ?></div>
						<?php		
							}
						?>
					</div>
					
				<div class="icons">
					<div>
						<img class="icon " src="/static/img/hit.png"> : <?= ($hit=='')?0:$hit ?>
					</div>
					<div>
						<img class="icon ml" src="/static/img/novel.png"> : <?= $save ?>
					</div>
					<div>
						<img class="icon ml" src="/static/img/commend.png"> : <?= $recommendscnt ?>
					</div>
				</div>
			</a>
		</td>
		<td class="td3">
			<div class="td3div"><?=$created?></div>
		</td>
	</tr>
