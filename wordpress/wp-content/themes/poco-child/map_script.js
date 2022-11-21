jQuery(document).ready(function($) {
  var map, infoWindow, myLatLng, geocoder;

  if(!shipping_obj_empty) {
    switch (shipping_obj.p_shipping_state) {
      case 'PIU':
        myLatLng = {lat: -5.201246, lng: -80.631406};
        break;
      case 'LAM':
        myLatLng = {lat: -6.766132, lng: -79.835484};
        break;
      case 'ANC':
        myLatLng = {lat: -9.122618, lng: -78.530505};
        break;
      default:
        myLatLng = {lat: -8.106090, lng: -79.023707};
        break;
    }
  } else {
    myLatLng = {lat: -8.106090, lng: -79.023707};
  }

  // Define the LatLng coordinates for the geofences
  const geofenceTrujilloCords = [
    {lat: -8.137832900, lng: -79.057415200},
    {lat: -8.140828000, lng: -79.052780500},
    {lat: -8.153339000, lng: -79.038232000},
    {lat: -8.152882300, lng: -79.035270800},
    {lat: -8.143589100, lng: -79.027116900},
    {lat: -8.136949200, lng: -79.026947000},
    {lat: -8.131413800, lng: -79.020854900},
    {lat: -8.130369000, lng: -79.012511500},
    {lat: -8.108523500, lng: -78.995911600},
    {lat: -8.105467200, lng: -78.999718000},
    {lat: -8.100031600, lng: -79.003867700},
    {lat: -8.094018600, lng: -78.998566500},
    {lat: -8.094229900, lng: -78.997900300},
    {lat: -8.093824100, lng: -78.996009800},
    {lat: -8.088636300, lng: -78.994246000},
    {lat: -8.085908300, lng: -79.002992000},
    {lat: -8.085000200, lng: -79.014150200},
    {lat: -8.088384200, lng: -79.024707800},
    {lat: -8.077629800, lng: -79.030845300},
    {lat: -8.081767800, lng: -79.038077300},
    {lat: -8.066952300, lng: -79.046175300},
    {lat: -8.069217700, lng: -79.051612700},
    {lat: -8.090022200, lng: -79.042059400},
    {lat: -8.090288800, lng: -79.047114300},
    {lat: -8.088017700, lng: -79.055529100},
    {lat: -8.091909400, lng: -79.056780400},
    {lat: -8.093765700, lng: -79.051300800},
    {lat: -8.095970000, lng: -79.051885800},
    {lat: -8.096767100, lng: -79.048614000},
    {lat: -8.100634400, lng: -79.049537600},
    {lat: -8.101460500, lng: -79.045435400},
    {lat: -8.105898000, lng: -79.048135300},
    {lat: -8.114305400, lng: -79.050724200},
    {lat: -8.115188000, lng: -79.048262900},
    {lat: -8.117484200, lng: -79.048833500},
    {lat: -8.119208900, lng: -79.046799000},
    {lat: -8.121094200, lng: -79.048445900},
    {lat: -8.124046900, lng: -79.045119800},
    {lat: -8.137832900, lng: -79.057415200}
  ];

  const geofencePiuraCords = [
    {lat: -5.176223100, lng: -80.692457100},
    {lat: -5.178104400, lng: -80.687994400},
    {lat: -5.183062500, lng: -80.690140300},
    {lat: -5.185199700, lng: -80.686149200},
    {lat: -5.192508200, lng: -80.686986000},
    {lat: -5.197530100, lng: -80.679507800},
    {lat: -5.202978000, lng: -80.670141100},
    {lat: -5.196610100, lng: -80.666278800},
    {lat: -5.202572100, lng: -80.660227800},
    {lat: -5.218844600, lng: -80.667931100},
    {lat: -5.226765000, lng: -80.656865500},
    {lat: -5.237127900, lng: -80.641779400},
    {lat: -5.230973300, lng: -80.633538300},
    {lat: -5.233964200, lng: -80.629932100},
    {lat: -5.228642700, lng: -80.625789400},
    {lat: -5.227338400, lng: -80.623835400},
    {lat: -5.229689000, lng: -80.621239000},
    {lat: -5.230736000, lng: -80.617537500},
    {lat: -5.226259300, lng: -80.611051900},
    {lat: -5.225003900, lng: -80.611800200},
    {lat: -5.222765600, lng: -80.616539700},
    {lat: -5.220372000, lng: -80.615466300},
    {lat: -5.216952800, lng: -80.620294000},
    {lat: -5.198404500, lng: -80.615712700},
    {lat: -5.198019900, lng: -80.618228800},
    {lat: -5.194611600, lng: -80.617463000},
    {lat: -5.194745200, lng: -80.615063100},
    {lat: -5.193444300, lng: -80.610902000},
    {lat: -5.196075400, lng: -80.609487500},
    {lat: -5.196513400, lng: -80.606104000},
    {lat: -5.200365200, lng: -80.605270600},
    {lat: -5.202462100, lng: -80.598759900},
    {lat: -5.198039900, lng: -80.588380600},
    {lat: -5.175795700, lng: -80.593494200},
    {lat: -5.178360000, lng: -80.602806900},
    {lat: -5.174171500, lng: -80.606197200},
    {lat: -5.172675700, lng: -80.610124100},
    {lat: -5.169812100, lng: -80.620917300},
    {lat: -5.162802600, lng: -80.617548200},
    {lat: -5.154767000, lng: -80.615638500},
    {lat: -5.150490400, lng: -80.618435400},
    {lat: -5.149462100, lng: -80.627841300},
    {lat: -5.153414700, lng: -80.634411100},
    {lat: -5.146595900, lng: -80.660721800},
    {lat: -5.149200700, lng: -80.662016700},
    {lat: -5.152615100, lng: -80.661344800},
    {lat: -5.152952100, lng: -80.671916700},
    {lat: -5.159428800, lng: -80.672490600},
    {lat: -5.158533900, lng: -80.675355100},
    {lat: -5.165976200, lng: -80.677822700},
    {lat: -5.167867600, lng: -80.673574000},
    {lat: -5.174385700, lng: -80.675462300},
    {lat: -5.169812300, lng: -80.689195200},
    {lat: -5.176223100, lng: -80.692457100}
  ];

  function initShippingForm() {
    var form = document.getElementById("shipping_popup");
    var now_popup = new Date();

    if(now_popup.getHours() < 7 || now_popup.getHours() >= 13){
      var radio=document.getElementsByName("form_fields[p_shipping_delivery_type]");
      radio[1].disabled = true;
    }

    if(shipping_obj_empty){
			document.getElementById("shipping_popup_submit").disabled = true;
		}
    
    if(!shipping_obj_empty){
			for (const property in shipping_obj) {
        if (property == "p_shipping_delivery_type"){
          radiobtn = document.getElementById(shipping_obj[property]);
          radiobtn.checked = true;
          update_shipping_type_detail(shipping_obj[property]);
        } else {
          document.getElementById("form-field-" + property).value = shipping_obj[property];
        }
      }
		} else {
      radiobtn = document.getElementById('programmed');
      radiobtn.checked = true;
      update_shipping_type_detail('programmed');
    }

    map = new google.maps.Map(document.getElementById('map_popup'), {center: myLatLng, zoom: 16, mapTypeControl: false, streetViewControl: false, fullscreenControl: false, zoomControl: false, clickableIcons: false});
    marker = new google.maps.Marker({map: map});
    // marker.addListener('dragend', get_address_by_dragend);
    infoWindow = new google.maps.InfoWindow;
    geocoder = new google.maps.Geocoder;

    // Position marker and map depending on user previous selection or HTML geolocation if is available
    if(document.getElementById('form-field-p_shipping_lat_gmaps').value.length > 0 && document.getElementById('form-field-p_shipping_lng_gmaps').value.length) {
      var pos = {lat: Number(document.getElementById('form-field-p_shipping_lat_gmaps').value), lng: Number(document.getElementById('form-field-p_shipping_lng_gmaps').value)};
      marker.setPosition(pos);
      map.setCenter(pos);
      validate_coordinates_geofence(new google.maps.LatLng(pos.lat, pos.lng));
    } else {
      // Try HTML5 geolocation.
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          marker.setPosition(pos);
          map.setCenter(pos);
          validate_coordinates_geofence(new google.maps.LatLng(pos.lat, pos.lng));
          fill_address_by_location(pos);
        }, function() {
          handleLocationError(true, infoWindow, map.getCenter());
        });
      } else {
        // Browser doesn't support Geolocation
        marker.setPosition(myLatLng);
        map.setCenter(myLatLng);
        validate_coordinates_geofence(new google.maps.LatLng(myLatLng.lat, myLatLng.lng));
        handleLocationError(false, infoWindow, map.getCenter());
      }
    }
    
    // Construct the geofences
    const geofenceTrujillo = new google.maps.Polygon({
      paths: geofenceTrujilloCords,
      strokeColor: "#00ff00",
      strokeOpacity: 1,
      strokeWeight: 1,
      fillColor: "#00ff00",
      fillOpacity: 0.05
    });

    const geofencePiura = new google.maps.Polygon({
      paths: geofencePiuraCords,
      strokeColor: "#00ff00",
      strokeOpacity: 1,
      strokeWeight: 1,
      fillColor: "#00ff00",
      fillOpacity: 0.05
    });

    geofenceTrujillo.setMap(map);
    geofencePiura.setMap(map);
    
    // Listen click events on map and geofences
    map.addListener("click", (event) => {
      marker.setPosition(event.latLng);
      document.getElementById('form-field-p_valid_map_location').value = '0';
      document.getElementById("shipping_popup_submit").disabled = true;
      infoWindow.setPosition(event.latLng);
      infoWindow.setContent('El lugar de entrega se encuentra fuera de nuestra zona de cobertura, por favor corregir.');
      infoWindow.open(map);
    });

    geofenceTrujillo.addListener("click",(event) => {
      click_event_on_geofence(event);
    });

    geofencePiura.addListener("click",(event) => {
      click_event_on_geofence(event);
    });

    // Listen events of form
    form.addEventListener("change", function( event ) {
      if(event.target.name != "form_fields[p_shipping_delivery_type]"){
        if(event.target.name == "form_fields[p_shipping_city]"){
          switch (true) {
            case event.target.value.includes("Trujillo"):
              document.getElementById("form-field-p_shipping_state").value = 'LAL';
              break;
            case event.target.value.includes("Piura"):
              document.getElementById("form-field-p_shipping_state").value = 'PIU';
              break;
            default:
              break;
          }
        }

        p_shipping_address_1 = document.getElementById("form-field-p_shipping_address_1").value;
        p_shipping_address_2 = document.getElementById("form-field-p_shipping_address_2").value;
        p_shipping_urbanization = document.getElementById("form-field-p_shipping_urbanization").value;
        p_shipping_city = document.getElementById("form-field-p_shipping_city").value.split(" ")[0];
        p_shipping_state = document.getElementById("form-field-p_shipping_state").value;
        p_shipping_reference = document.getElementById("form-field-p_shipping_reference").value;
        
        if(p_shipping_address_1.length > 0 && p_shipping_address_2.length > 0 && p_shipping_urbanization.length > 0 && p_shipping_city.length > 0 && p_shipping_state.length > 0 && p_shipping_reference.length > 0){
          address = p_shipping_address_1 + " " + p_shipping_address_2 + " " + p_shipping_urbanization;
          setMarkerPosition(address, p_shipping_city, p_shipping_state);
        } else {
          document.getElementById("shipping_popup_submit").disabled = true;
        }
      } else {
        if(document.getElementsByClassName("count")[0].innerText == 0){
          var radios = document.getElementsByName('form_fields[p_shipping_delivery_type]');

          for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
              var delivery_type = radios[i].value;
              break;
            }
          }
          update_shipping_type_detail(delivery_type);
        } else {
          radiobtn = document.getElementById(shipping_obj.p_shipping_delivery_type);
          radiobtn.checked = true;
          update_shipping_type_detail(shipping_obj.p_shipping_delivery_type);
          alert("Si su carrito tiene productos no puede cambiar el tipo de entrega, si desea cambiar por favor eliminar todos los productos de su carrito.")
          event.preventDefault();
        }
      }
    }, true);

    $( document ).on('submit_success', function( event, response ){
      // console.log("1")
			// if ( response.data.output ) {
			// 	alert( response.data.output.p_shipping_delivery_type  );
			// }

      var d = new Date();
      d.setTime(d.getTime() + 12*60*60*1000);
      var expires = "expires=" + d.toGMTString();
      var radios = document.getElementsByName('form_fields[p_shipping_delivery_type]');

      for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
          var delivery_type = radios[i].value;
          break;
        }
      }

      shipping_obj = {};
      shipping_obj.p_shipping_delivery_type = delivery_type;
      shipping_obj.p_shipping_address_1 = capitalize_words(response.data.output.p_shipping_address_1);
      shipping_obj.p_shipping_address_2 = response.data.output.p_shipping_address_2;
      shipping_obj.p_shipping_urbanization = capitalize_words(response.data.output.p_shipping_urbanization);
      shipping_obj.p_shipping_city = response.data.output.p_shipping_city;
      shipping_obj.p_shipping_state = response.data.output.p_shipping_state;
      shipping_obj.p_shipping_reference = response.data.output.p_shipping_reference.charAt(0).toUpperCase() + response.data.output.p_shipping_reference.slice(1).toLowerCase();
      shipping_obj.p_shipping_lat_gmaps = response.data.output.p_shipping_lat_gmaps;
      shipping_obj.p_shipping_lng_gmaps = response.data.output.p_shipping_lng_gmaps;

			address_text = shipping_obj.p_shipping_address_1 + " " + shipping_obj.p_shipping_address_2 + ", " + shipping_obj.p_shipping_urbanization;
			delivery_type_text = (shipping_obj.p_shipping_delivery_type == 'programmed') ? "Delivery Programado" : "Delivery Xpress";
			target = document.getElementById("header-shipping-button").getElementsByClassName("elementor-button-text")[0];
			target2 = document.getElementById("header-shipping-button-mobile").getElementsByClassName("elementor-button-text")[0];
			target3 = document.getElementById("header-shipping-type").getElementsByClassName("elementor-text-editor")[0];
			target.textContent = address_text;
			target2.textContent = delivery_type_text + " en: " + address_text;
			target3.textContent = delivery_type_text;

      if(is_checkout && !is_order_recived){
        update_ckeckout_fields();
        $('body').trigger('update_checkout');
      } else if(is_cart){
        $("[name='update_cart']").removeAttr('disabled');
        $("[name='update_cart']").trigger("click");
      }

      update_products_stock(shipping_obj.p_shipping_delivery_type, shipping_obj.p_shipping_state);

      document.cookie = [user_name + '_shipping_obj=', JSON.stringify(shipping_obj), '; domain=.', window.location.host.toString(), '; ', expires, '; path=/;'].join('');
      sessionStorage.setItem(user_name + '_shipping_obj', JSON.stringify(shipping_obj));

      window.jQuery.ajax({
        type: "POST",
        datatype: 'json',
        url: url_update_usermeta,
        data: {
          user_id: user_id,
          shipping_delivery_type: shipping_obj.p_shipping_delivery_type,
          shipping_address_1: shipping_obj.p_shipping_address_1,
          shipping_address_2: shipping_obj.p_shipping_address_2,
          shipping_urbanization: shipping_obj.p_shipping_urbanization,
          shipping_city: shipping_obj.p_shipping_city,
          shipping_state: shipping_obj.p_shipping_state,
          shipping_reference: shipping_obj.p_shipping_reference,
          shipping_lat_gmaps: shipping_obj.p_shipping_lat_gmaps,
          shipping_lng_gmaps: shipping_obj.p_shipping_lng_gmaps
        },
        success: function (output) {
          if(output.status == 'error'){
            console.log("Hubo un error actualizando el user meta en la bd")
          }
        }
      });

      shipping_obj_empty = false;
		});

    // form.addEventListener("submit", function(event) {
    //   event.preventDefault();
    //   return;
    //   console.log(event);
    //   var d = new Date();
    //   d.setTime(d.getTime() + 12*60*60*1000);
    //   var expires = "expires=" + d.toGMTString();
    //   var radios = document.getElementsByName('form_fields[p_shipping_delivery_type]');

    //   for (var i = 0, length = radios.length; i < length; i++) {
    //     if (radios[i].checked) {
    //       var delivery_type = radios[i].value;
    //       break;
    //     }
    //   }

    //   shipping_obj = {};
    //   shipping_obj.p_shipping_delivery_type = delivery_type;
    //   shipping_obj.p_shipping_address_1 = capitalize_words(document.getElementById("form-field-p_shipping_address_1").value);
    //   shipping_obj.p_shipping_address_2 = document.getElementById("form-field-p_shipping_address_2").value;
    //   shipping_obj.p_shipping_urbanization = capitalize_words(document.getElementById("form-field-p_shipping_urbanization").value);
    //   shipping_obj.p_shipping_city = document.getElementById("form-field-p_shipping_city").value;
    //   shipping_obj.p_shipping_state = document.getElementById("form-field-p_shipping_state").value;
    //   shipping_obj.p_shipping_reference = document.getElementById("form-field-p_shipping_reference").value.charAt(0).toUpperCase() + document.getElementById("form-field-p_shipping_reference").value.slice(1).toLowerCase();
    //   shipping_obj.p_shipping_lat_gmaps = document.getElementById("form-field-p_shipping_lat_gmaps").value;
    //   shipping_obj.p_shipping_lng_gmaps = document.getElementById("form-field-p_shipping_lng_gmaps").value;

		// 	address_text = shipping_obj.p_shipping_address_1 + " " + shipping_obj.p_shipping_address_2 + ", " + shipping_obj.p_shipping_urbanization;
		// 	delivery_type_text = (shipping_obj.p_shipping_delivery_type == 'programmed') ? "Delivery Programado" : "Delivery Xpress";
		// 	target = document.getElementById("header-shipping-button").getElementsByClassName("elementor-button-text")[0];
		// 	target2 = document.getElementById("header-shipping-button-mobile").getElementsByClassName("elementor-button-text")[0];
		// 	target3 = document.getElementById("header-shipping-type").getElementsByClassName("elementor-text-editor")[0];
		// 	target.textContent = address_text;
		// 	target2.textContent = delivery_type_text + " en: " + address_text;
		// 	target3.textContent = delivery_type_text;

    //   if(is_checkout && !is_order_recived){
    //     update_ckeckout_fields();
    //     $('body').trigger('update_checkout');
    //   } else if(is_cart){
    //     $("[name='update_cart']").removeAttr('disabled');
    //     $("[name='update_cart']").trigger("click");
    //   }

    //   update_products_stock(shipping_obj.p_shipping_delivery_type, shipping_obj.p_shipping_state);

    //   document.cookie = [user_name + '_shipping_obj=', JSON.stringify(shipping_obj), '; domain=.', window.location.host.toString(), '; ', expires, '; path=/;'].join('');
    //   shipping_obj_empty = false;
    //   setTimeout(function(){ elementorProFrontend.modules.popup.closePopup( {}, event ); }, 1000);
    // }, true)
  }
  
  function click_event_on_geofence(event) {
    infoWindow.close(map);
    marker.setPosition(event.latLng);
    fill_address_by_location(event.latLng);
    document.getElementById('form-field-p_valid_map_location').value = '1';
    document.getElementById("shipping_popup_submit").disabled = false;
  }

  function fill_address_by_location(pos){
    geocoder.geocode({'location': pos}, function(results, status) {
      if (status === 'OK') {
        if (results[0]) {
					document.getElementById('form-field-p_shipping_lat_gmaps').value = results[0].geometry.location.lat();
					document.getElementById('form-field-p_shipping_lng_gmaps').value = results[0].geometry.location.lng();
        } else {
          window.alert('No se encontraron resutados');
        }
      } else {
        window.alert('Geocoder falló debido a: ' + status);
      }
    });
  }

  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ? 'Error: Por favor permitir el acceso a la ubicación.' : 'Error: El navegador no soporta la geolocalización.');
    infoWindow.open(map);
  }

  function setMarkerPosition(address, city, department) {
    var has_street_number = false;
    geocoder.geocode( { address: address + ',' + city + ',' + state_val[department], componentRestrictions: {
      // administrativeArea: department,
      // country: 'PE'
    }}, function(results, status) {
      for (var i = 0; i < results[0].address_components.length; i++) {
        var addressType = results[0].address_components[i].types[0];
        if (addressType == 'street_number') {
          has_street_number = true;
        }
      }
      if (status == 'OK' && has_street_number) {
        marker.setPosition(results[0].geometry.location);
        map.setCenter(results[0].geometry.location);
        fill_address_by_location(results[0].geometry.location);
        validate_coordinates_geofence(results[0].geometry.location);
      } else if(status == 'ZERO_RESULTS' || !has_street_number) {
        switch (state_val[department]) {
          case 'Piura':
            tmpLatLng = {lat: -5.201246, lng: -80.631406};
            break;
          case 'Lambayeque':
            tmpLatLng = {lat: -6.766132, lng: -79.835484};
            break;
          case 'Ancash':
            tmpLatLng = {lat: -9.122618, lng: -78.530505};
            break;
          default:
            tmpLatLng = {lat: -8.106090, lng: -79.023707};
            break;
        }
        // console.log(tmpLatLng)
        marker.setPosition(tmpLatLng);
        map.setCenter(tmpLatLng);
        fill_address_by_location(tmpLatLng);
        validate_coordinates_geofence(new google.maps.LatLng(tmpLatLng.lat, tmpLatLng.lng));
      } else {
        alert('Geocode no se pudo ejecutar: ' + status);
      }
    });
  }

  function validate_coordinates_geofence(lat_lng) {
    geofenceT = new google.maps.Polygon({paths: geofenceTrujilloCords});
    geofenceP = new google.maps.Polygon({paths: geofencePiuraCords});

    p_shipping_address_1 = document.getElementById("form-field-p_shipping_address_1").value;
    p_shipping_address_2 = document.getElementById("form-field-p_shipping_address_2").value;
    p_shipping_urbanization = document.getElementById("form-field-p_shipping_urbanization").value;
    p_shipping_reference = document.getElementById("form-field-p_shipping_reference").value;

    if(google.maps.geometry.poly.containsLocation(lat_lng, geofenceT) || google.maps.geometry.poly.containsLocation(lat_lng, geofenceP)){
      infoWindow.close(map);
      document.getElementById('form-field-p_valid_map_location').value = '1';
      if(p_shipping_address_1.length > 0 && p_shipping_address_2.length > 0 && p_shipping_urbanization.length > 0 && p_shipping_reference.length > 0){
        document.getElementById("shipping_popup_submit").disabled = false;
      } else {
        document.getElementById("shipping_popup_submit").disabled = true;
      }
    } else {
      document.getElementById('form-field-p_valid_map_location').value = '0';
      document.getElementById("shipping_popup_submit").disabled = true;
      infoWindow.setPosition(lat_lng);
      infoWindow.setContent('El lugar de entrega se encuentra fuera de nuestra zona de cobertura, por favor corregir.');
      infoWindow.open(map);
    }
  }

  function open_popup(){
    if (user_id > 0) {
      elementorProFrontend.modules.popup.showPopup( { id: id_shipping_popup } );
    } else {
      elementorProFrontend.modules.popup.showPopup( { id: id_login_popup } );
    }
  }

  function capitalize_words(sentence){
    var words = sentence.split(" ");

    for (let i = 0; i < words.length; i++) {
        words[i] = words[i][0].toUpperCase() + words[i].substr(1);
    }

    return words.join(" ");
  }

  function update_ckeckout_fields(){
    if(!shipping_obj_empty){
      for (const property in shipping_obj) {
        field_id = property.substring(2);
        if (field_id == 'shipping_city'){
          document.getElementById(field_id).value = shipping_obj[property];
          document.getElementById('billing_city').value = shipping_obj[property];
        } else if (field_id == 'shipping_state'){
          document.getElementById(field_id).value = shipping_obj[property];
          document.getElementById('billing_state').value = shipping_obj[property];
        } else {
          document.getElementById(field_id).value = shipping_obj[property];
        }
      }
      billing_address_text = shipping_obj.p_shipping_address_1 + ' ' + shipping_obj.p_shipping_address_2 + ', ' + shipping_obj.p_shipping_urbanization;
      document.getElementById('billing_address_1').value = billing_address_text;
    }
  }

  function update_shipping_type_detail(shipping_type){
    if(shipping_type == 'programmed'){
      document.getElementById('shipping_type_detail_text').innerHTML = 'Envíos a partir de 24 horas'
    } else {
      document.getElementById('shipping_type_detail_text').innerHTML = 'Envíos el mismo día, sujeto a disponibilidad de stock'
    }
  }

  function update_products_stock(shipping_delivery_type, shipping_state){
    window.jQuery.ajax({
      type: "GET",
      datatype: 'json',
      url: url_api_product_stock,
      data: {
          state: shipping_state,
          delivery_type: shipping_delivery_type
      },
      beforeSend: function () {
        // document.getElementById("loader").style.display = "block";
      },
      success: function (output) {
        for (let index = 0; index < output.length; index++) {
          var elements = document.querySelectorAll('[data-product_sku="' + output[index]['sku'] + '"]');
          for (let i = 0; i < elements.length; i++) {
            var node_parent = elements[i].parentElement;
            if(output[index]['stock'] == 0) {
              if (node_parent.parentElement.className == "product-block") {
                node_parent.parentElement.style.pointerEvents = "none";
                node_parent.parentElement.style.opacity = "0.5";
              }
              inputs = node_parent.getElementsByTagName('input');
              for (var x = 0; x < inputs.length; x++) {
                input = inputs[x];
                input.value = 1;
              }
            } else {
              if (node_parent.parentElement.className == "product-block") {
                node_parent.parentElement.style.pointerEvents = "all";
                node_parent.parentElement.style.opacity = "1";
              }
              inputs = node_parent.getElementsByTagName('input');
              for (var x = 0; x < inputs.length; x++) {
                input = inputs[x];
                input.setAttribute("max",output[index]['stock']);
                input.value = 1;
              }
            }
          }
        }
      },
      complete: function () {
        // document.getElementById("loader").style.display = "none";
      }
    });
  }

  $( document ).on( 'elementor/popup/show', (event, id, instance) => {
    if(id == id_shipping_popup){
      initShippingForm();
    }
  } );

  $('#header-shipping-button').click(open_popup);
  $('#header-shipping-button-mobile').click(open_popup);

  $('#choose-delivery a').click(function(){
    if (user_id > 0) {
      elementorProFrontend.modules.popup.showPopup( { id: id_shipping_popup } );
    } else {
      elementorProFrontend.modules.popup.showPopup( { id: id_login_popup } );
    }
  });

  // if(shipping_obj_empty){
  if(!is_checkout && shipping_obj_empty && user_id != 0){
    $('#header-shipping-button').tooltip({
      content: function(){
          return "Ingresa acá para elegir el tipo de entrega así como la dirección donde deseas recibir tu pedido.";
      },
      tooltipClass: "bottom"
    });

    $('#header-shipping-button-mobile').tooltip({
      content: function(){
          return "Ingresa acá para elegir el tipo de entrega así como la dirección donde deseas recibir tu pedido.";
      },
      tooltipClass: "bottom"
    });
    $('#header-shipping-button').tooltip().mouseover();
    $('#header-shipping-button-mobile').tooltip().mouseover();
  }
  
});
