    </div>
    <div class="footer">
        <div class="footer_left">
            <p class="mb1em">제작자 : 이우주</p>
            <p class="mb1em">이메일 : dldnwn59@naver.com</p>
            <a href="<?=base_url()?>other/complain?option=0">고객센터</a>
        </div>
        <div class="footer_right">
            <?php if(isset($_SESSION['useridx']) and $_SESSION['useridx'] == 1){ ?>
            <a href="<?=base_url()?>master"><img src="<?=base_url()?>static/img/RB_흑백.png" id="logo"></a>
        <?php } else{ ?>
            <img src="<?=base_url()?>static/img/RB_흑백.png" id="logo">
        <?php } ?>
        </div>
    </div>
</body>
<script type="text/javascript">
    $('#notice').on('click',()=>{
        location.href='<?=base_url()?>home/notice';
    })
    $('#free').on('click',()=>{
        location.href='<?=base_url()?>home/free?category=7&sort=0';
    })
    $('#rank').on('click',()=>{
        location.href='<?=base_url()?>home/rank?date=0&category=7&sort=0';
    })
    $('#help').on('click',()=>{
        location.href='<?=base_url()?>home/search';
    })


    
</script>
</html>