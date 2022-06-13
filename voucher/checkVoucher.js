function checkVoucher() {
	
	var voucher = $("#voucherCode").val();
	//loading sequnce
	jQuery.ajax({
	url: "ajax/check_availability.php",
	data:{voucher: $("#voucherCode").val(),
		  gamename:$("#game_name").text(),
		  date:$("#date").text(),
		  time:$("#time").text(),
		  ppl: $("#players").text().charAt(0)
		},
	//data: { code: code, userid: userid }
	type: "POST",
	success:function(data){
		var dataArray = $.parseJSON(data);

		$("#voucherCode").val(dataArray.message);
		$("#cost_number").text(dataArray.extra_price);
		$("#voucherCode").prop('disabled', true);

		
	},
	error:function (){}
	});
}
