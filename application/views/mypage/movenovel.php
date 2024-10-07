<script type="text/javascript">
	$('.movenovel').on('change',(e)=>{
		let move = $(e.target);
		let movevalue = move.val();
		let cmove = Math.floor(movevalue/10);

		if(movevalue%2==1){
			location.href='<?=base_url()?>mypage/novel?index='+cmove;
		} else{
			location.href='<?=base_url()?>mypage/novelnotice?index='+cmove;
		}
		
	})

</script>