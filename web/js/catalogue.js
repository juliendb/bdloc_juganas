cart =
{


	init:function()
	{
		var _this = cart


		$(".link_cart_book").off().on("click", _this.getCartItem)
	},


	getCartItem:function()
	{
		var _this = cart
		var url = $(this).attr("href")


		$.ajax
		({
			url: url,
			dataType: "json",
			success: function(json)
			{
				var response = json.response
				var id = json.id
				var action = json.action

				var stock_book = response.stock_book
				var count_cart = response.count_cart

				
				if (response != "")
				{

					// adding
					if (action == "adding")
					{
						// affiche le nouveau stock bd
						$("#"+id+" .stock").text(stock_book+" en stock")
					}


					// sorting
					if (action == "sorting")
					{
						$("#"+id).fadeOut(600)
					}

				}
			}
		})


		return false
	}

}







catalogue =
{


	init:function()
	{
		var _this = catalogue
		
		_this.initElement()
		_this.popup()

		cart.init()
	},



	initElement:function()
	{
		var _this = catalogue


		$(".link_detail_book").off().on("click", _this.getDetailBook)
		$("#filter_pages").off().on("click", "a", _this.rechargeCatalogue)

		$("#form_filter_pages").off().on("submit", _this.rechargePostCatalogue)


		$(".genres").off().on("click", "label", _this.clickCheckbox)
	},



	clickCheckbox:function()
	{
		var _this = catalogue
		var input = $(this).prev("input")
		var checked = !input.prop("checked")

		input.prop("checked", checked)
	},



	rechargePostCatalogue:function()
	{
		var _this = catalogue
		var url = $(this).attr("action")+"/1"
		var limit = "/"+$("#limit").val()
		var choice = "/"+$("#choice").val()
		var availability = "/"+$("#availability").val()
		var order = "/"+$("#order").val()

		var genres = ""


		$("input[type='checkbox']").each(function() 
		{
			if ($(this).is(':checked'))
			{
				genres += ","+$(this).val()
				genres = "/"+genres.substring(1)
			}
		})


		url += limit+choice+availability+order+genres

		$(this).attr("href", url)
		_this.rechargeCatalogue.call($(this))


		return false
	},



	getDetailBook:function()
	{
		var _this = catalogue
		var link = $(this).attr("href")


		$.ajax
		({
			url: link,
			dataType: "html",
			success: function(html)
			{
				var content = $(html).find("#detail_book")
				_this.affiche(content)
			}
		})


		return false
	},



	rechargeCatalogue:function()
	{
		var _this = catalogue
		var url = $(this).attr("href")


		$.ajax
		({
			url: url,
			dataType: "html",
			success: function(html)
			{
				var content = ""

				content = $(html).find("#catalogue")
				_this.changeContenu($("#catalogue"), content)

				content = $(html).find("#filter_pages")
				_this.changeContenu($("#filter_pages"), content, 0)

			}
		})


		return false
	},



	changeContenu:function(container, content, time)
	{
		var _this = catalogue

		if (time == null) time = 400
		container.fadeOut(time, function()
		{
			$(this).replaceWith(content).fadeOut(0).fadeIn(time)
			
			_this.initElement()
			cart.init()
		})
	},





	popup:function()
	{
		var _this = catalogue

		var overlay = $("<div>", {id:"overlay"})
		overlay.fadeOut(0).appendTo("#popup")

		var close = $("<div>", {id:"close"})
		close.css
		({
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
