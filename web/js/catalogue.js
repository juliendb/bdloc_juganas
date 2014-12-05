catalogue =
{


	init:function()
	{
		var _this = catalogue
		
		_this.initElement()
		_this.popup()
	},



	initElement:function()
	{
		var _this = catalogue


		$(".link_detail_book").off().on("click", _this.getDetailBook)
		$("#filter_pages").off().on("click", "a", _this.rechargeCatalogue)

		$("#form_filter_cats").off().on("submit", _this.rechargePostCatalogue)
		$("#form_filter_pages").off().on("submit", _this.rechargePostCatalogue)
	},



	getDetailBook:function()
	{
		var _this = catalogue
		var link = $(this).attr("href")
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



	rechargePostCatalogue:function()
	{
		var _this = catalogue
		var url = $(this).attr("action")
		var data = $(this).attr("page")


		console.log($(this).serialize())
		/*
		$.ajax
		({
			type: "POST",
			url: url,
			data: data,
			success: function(reponse)
			{
				console.log(reponse)
			}
		});*/


		return false
	},



	rechargeCatalogue:function()
	{
		var _this = catalogue
		var link = $(this).attr("href")


		$.ajax
		({
			url: link,
			dataType: "html",
			success: function(html)
			{
				var content = ""
				
				content = $(html).filter("#catalogue")
				_this.changeContenu($("#catalogue"), content)

				content = $(html).find("#filter_pages")
				_this.changeContenu($("#filter_pages"), content, 0)

				content = $(html).find("#filter_cats")
				_this.changeContenu($("#filter_cats"), content, 0)


				setTimeout(function() { _this.initElement() }, 800)
			}
		})


		return false
	},



	changeContenu:function(container, content, time)
	{
		if (time == null) time = 400

		container.fadeOut(time, function()
		{
			$(this).empty().append(content).fadeIn(time)
		})
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
		
		}).appendTo("#popup")



		close.off().on("click", function()
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
