<style type="text/css">
    .main{
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    }
    td>a{
      color: black;
    }
</style>
<div>
	<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link <?php if($tap==0){echo'active';} ?>" href="<?=base_url()?>home/notice">공지 사항</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if($tap==1){echo'active';} ?>" href="<?=base_url()?>other/complain">문의 사항</a>
  </li>
</ul>
</div>