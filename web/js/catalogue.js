catalogue =
{


	init:function()
	{
		var _this = catalogue

		$(".link_detail_book").on("click", _this.getDetailBook)


		_this.popup()
	},



	getDetailBook:function()
	{
		var _this = catalogue
		var link = $(this).attr("href");
		var isbn = "/"+$(this).attr("id")


		$.ajax
		({
			url: link,
			dataType: "html",
			success: function(html)
			{
				var content = $(html).filter("#detail_book")


				_this.affiche(content)
			}
		})


		return false;
	},



	popup:function()
	{
		var _this = catalogue

		var overlay = $("<div>", {id:"overlay"})
		overlay.fadeOut(0).appendTo("#popup")

		var close = $("<div>", {id:"close"})
		close.css({
			display:"block",
			width:"40px",
			height:"40px"
		})
		close.appendTo("#popup")



		close.on("click", function()
		{
			overlay.fadeOut(800, function()
			{
				overlay.empty()

				return false
			})
		})
	},


	affiche: function(content)
	{
		var _this = popup;


		$("#overlay").empty().append(content)
			.fadeOut(0).fadeIn(800)
	}

}




$(catalogue.init())
