<div class="pagebtnsdiv">
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <?php 
        if($nowblock!=0){
      ?>
      <li class="page-item">
        <a class="page-link" href="<?=base_url()?>notice/viewerlist?index=<?=$_GET['index']?>&page=<?=1+(5*($nowblock-1))?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <?php
        }
      ?>
     <?php 
        for($i=$startblock;$i<=$endblock;$i++){
      ?>
      <li class="page-item"><a class="page-link <?php if($nowpage==$i){echo'active';} ?>" 
        href="<?=base_url()?>notice/viewerlist?index=<?=$_GET['index']?>&page=<?=$i?>"><?=$i?></a></li>
      <?php    
        }
      ?>
      <?php
        if($allpage!=$endblock){
      ?>
      <li class="page-item">
        <a class="page-link" href="<?=base_url()?>notice/viewerlist?index=<?=$_GET['index']?>&page=<?=1+(5*($nowblock+1))?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
      <?php    
        }
      ?>
    </ul>
  </nav>
</div>
</div>

<style type="text/css">
  .pagebtnsdiv{
    margin-top: 1vw;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>


