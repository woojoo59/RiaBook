</div>
<script>
	$( function() {
		$( "#fromdate" ).datepicker({
			showOtherMonths: true,
			selectOtherMonths: true,
			dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'], // 요일의 한글 형식.

			changeYear: true ,	//콤보박스에서 년 선택 가능
            changeMonth: true,	 //콤보박스에서 월 선택 가능
            maxDate: new Date(),
  			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'], // 월의 한글 형식.
  			dateFormat: "yy-mm-dd"
		});
		$( "#fdate" ).datepicker({
			showOtherMonths: true,
			selectOtherMonths: true,
			dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'], // 요일의 한글 형식.

			changeYear: true ,	//콤보박스에서 년 선택 가능
            changeMonth: true,	 //콤보박스에서 월 선택 가능
            maxDate: new Date(),
  			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'], // 월의 한글 형식.
  			dateFormat: "yy-mm-dd"
		});
	});
</script>