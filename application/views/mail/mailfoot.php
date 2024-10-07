	</table>
</div>
<div class="mailpage">
	<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php if($nowblock>1){ ?>
    <li class="page-item">
      <a class="page-link" href="<?=base_url()?>mypage/mail?option=<?=$option?>&page=<?=$startpage-2?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
  <?php } ?>
  <?php for($i=$startpage;$i<=$endpage;$i++){ ?>
    <li class="page-item"><a class="page-link <?php if($nowpage==$i-1){echo 'active';} ?>" href="<?=base_url()?>mypage/mail?option=<?=$option?>&page=<?=$i-1?>"><?=$i?></a></li>
  <?php } ?>
  <?php if($nowblock<$maxblock){ ?>
    <li class="page-item">
      <a class="page-link" href="<?=base_url()?>mypage/mail?option=<?=$option?>&page=<?=$endpage?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  <?php } ?>
  </ul>
</nav>
</div>
<script type="text/javascript">
  $('#mailoption').on('change',()=>{
    location.href='<?=base_url()?>mypage/mail?option='+$('#mailoption').val();
  })
  $('#mailwrite').on('click',()=>{
    location.href='<?=base_url()?>mail/write';
  })
</script>