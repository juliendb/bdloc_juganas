app = {

	/*
	 * Chargement du DOM
	 */
	init: function() {
		// Autocompletion d'adresse
		this.adresses()

		$("#bdloc_appbundle_user").parent().on("submit", this.dataSave)
	},


	/*
	 * Autocomplete du champ adresse
	 */
	adresses: function() {

		// On choppe notre input
		var adress = document.getElementById("bdloc_appbundle_user_adress")
		var postal_code = document.getElementById("bdloc_appbundle_user_postalCode")

		var componentForm = {
		  bdloc_appbundle_user_adress: 'long_name',
		  bdloc_appbundle_user_postalCode: 'short_name',
		  bdloc_appbundle_user_longitude: 'long_name',
		  bdloc_appbundle_user_latitude: 'long_name'
		};

		// Paramètres
		var options = {
			//types: ['address'],
			type: ['geocode'],
			componentRestrictions: {
				country: 'fr'
			}
		}

		// On ajoute l'autocomplete
		var autocomplete = new google.maps.places.Autocomplete(adress, options)

		// Lors de la sélection d'adresse, on récupère les coordonnées
		google.maps.event.addListener(autocomplete, 'place_changed', function() {

			// On récupère
			var place = autocomplete.getPlace()

			var val = place.address_components[6].short_name
			console.log(place.address_components)
			$("#bdloc_appbundle_user_postalCode").val(val)

			if (navigator.geolocation) {
			    var geoloc = navigator.geolocation.getCurrentPosition(function(position){
			    	var geolocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			      	autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,    geolocation));
			    });
			    //console.log(geolocation);
			}


		})




	},

	dataSave: function(){
		//console.log("toto")

		var formData = JSON.stringify(jQuery($(this)).serializeArray())
		console.log(sessionStorage.getItem("dataAboStep1"))
		sessionStorage.setItem("dataAboStep1", formData)
		console.log("toto")
		
		//sessionStorage.getItem("dataAboStep1",geoloc )
		return false
	}
}



/*
 * Chargement du DOM
 */
$(function() {
	app.init()
})


