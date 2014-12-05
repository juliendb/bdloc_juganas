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
	 * Autocomplete du champ adresse Server Error - NonUniqueResultException
	 */
	adresses: function() {

		// On choppe notre input
		var address = document.getElementById("bdloc_appbundle_user_adress")
		var postal_code = document.getElementById("bdloc_appbundle_user_postalCode")

		var componentForm = {
		  bdloc_appbundle_user_adress: 'long_name',
		  bdloc_appbundle_user_postalCode: 'short_name',
		  bdloc_appbundle_user_longitude: 'long_name',
		  bdloc_appbundle_user_latitude: 'long_name'
		};

		// Paramètres
		var options = {
			types: ['address'],
			componentRestrictions: {
				country: 'fr'
			}
		}

  		autocomplete = new google.maps.places.Autocomplete( address, options);


 		google.maps.event.addListener(autocomplete, 'place_changed', function() { 

			var place = autocomplete.getPlace();

      		var val = place.address_components[6].short_name
      		console.log(place.address_components)
      		$("#bdloc_appbundle_user_postalCode").val(val)


      		//ajout des coordonnées longitude/latitude
			var lon = place.geometry.location.k;
			var lat = place.geometry.location.B;
			$("#bdloc_appbundle_user_longitude").val(lon)
			$("#bdloc_appbundle_user_latitude").val(lat)
	
			//return true;
 		});
	},


	dataSave: function(){
		//console.log("toto")

		var formData = JSON.stringify(jQuery($(this)).serializeArray())
		//console.log(sessionStorage.getItem("dataAboStep1"))
		sessionStorage.setItem("dataAboStep1", formData)

		

		//return false
	}
}



/*
 * Chargement du DOM
 */
$(function() {
	app.init()
})


