


function loadMore(){
	document.getElementById("portfolioList").innerHTML="<b>Fetching...</b>";
        var dataString = '';
		$.ajax({
			type: "POST", crossDomain: true, cache: false,
			url: "pages/all_portfolio.php",
			dataType: 'text',
			data: dataString,
			catch: false,
			success: function(data) {
				document.getElementById("portfolioList").innerHTML=data;
			}
		});
}

