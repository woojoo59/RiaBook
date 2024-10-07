		<tr class="noticetr">
			<td class="noticetd1"><a href="<?=base_url()?>notice/view?view=<?=$noticeidx?>">공지</a></td>
			<td class="noticetd2"><a href="<?=base_url()?>notice/view?view=<?=$noticeidx?>"><div class="noticetd1div">
				<?=$title?> <?php if($img==1){ ?><img src="<?=base_url()?>static/img/img.png" alt=""><?php } else {echo'';} ?>
			</div></a></td>
			<td class="noticetd3"></td>
		</tr>