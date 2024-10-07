		<tr class='mailtr'>
			<td class="mailstatus rbord">
				<?php if($status == 0){ ?>
				<img class="mailicon" src="/static/img/mail0.png" alt="">
				<?php } else if($status == 1){ ?>
				<img class="mailicon" src="/static/img/mail1.png" alt="">
				<?php } ?>
			</td>
			<td class="mailsubject"><a class="mailsubject" href="<?=base_url()?>mail/view?index=<?=$mailidx?>"><?=$subject?></a></td>
			<td class="maildate"><?=$subdate?></td>
			<td class="mailuser"><?php if($option==3){echo $touseridx;} else {echo $fromuseridx;} ?></td>
			<td class="mailexit">
				<a class="mailexit" href="<?=base_url()?>mail/remove?option=<?=$option?>&idx=<?=$mailidx?>">
					<button type="button" class="btn-close" aria-label="Close"></button>
				</a></td>
		</tr>