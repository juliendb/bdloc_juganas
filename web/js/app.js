app = {

	/*
	 * Chargement du DOM
	 */
	init: function() {
		// Autocompletion d'adresse
		this.adresses()
//console.log($("bdloc_appbundle_user"));
		$("bdloc_appbundle_user").on("submit", function(){
			return false;
		})
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
		 // route: 'long_name',
		 // locality: 'long_name',
		  //administrative_area_level_1: 'short_name',
		  //country: 'long_name',
		  bdloc_appbundle_user_postalCode: 'short_name'
		};

		// Paramètres
		var options = {
			types: ['address'],
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
			$("#bdloc_appbundle_user_postalCode").val(val)


		})

	}




}



/*
 * Chargement du DOM
 */
$(function() {
	app.init()
})


