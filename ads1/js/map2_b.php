<?php 
if(empty($_SESSION['lat'])){ $lat=-6.5951935;$lng=106.791892;}
else
{$lat=$_SESSION['lat'];$lng=$_SESSION['lng'];}


?>
<script>
$(document).ready(function() {
                var mapCenter = new google.maps.LatLng(<?php echo $lat ?>,<?php echo $lng?>); //Google map Coordinates 
                var map;
                map_initialize(); // initialize google map 
                function map_initialize()
                {
                    var googleMapOptions =
                            {
                                center: mapCenter, // map center
                                zoom: 16, //zoom level, 0 = earth view to higher value
                                //maxZoom: 18,
                                //minZoom: 16,
                                //zoomControlOptions: {
                                    //style: google.maps.ZoomControlStyle.SMALL //zoom control size
                               // },
                                scaleControl: true, // enable scale control
                                mapTypeId: google.maps.MapTypeId.ROADMAP // google map type
                            };

                    map = new google.maps.Map(document.getElementById("google_map"), googleMapOptions);

                    //Ambil data XML File, Lihat (map_process.php)
                    
					
					
					
					 $.get("map_process.php", function(data) {
                        $(data).find("marker1").each(function() {
                            var name = $(this).attr('name');
                            var address = '<p>' + $(this).attr('address') + '</p>';
                           var type = $(this).attr('type');
                            var point = new google.maps.LatLng(parseFloat($(this).attr('lat')), parseFloat($(this).attr('lng')));
                            create_marker(point, name, address, false, false, false,"http://localhost/tes/img/merah.png");
                        });
                    });
					
					<?php if (($_SESSION['milik']=="punya") AND ($_SESSION['level']=="member")) {?>
					
					$.get("map_process.php", function(data) {
                        $(data).find("marker2").each(function() {
                            var name = $(this).attr('name');
                            var address = '<p>' + $(this).attr('address') + '</p>';
                           var type = $(this).attr('type');
                            var point = new google.maps.LatLng(parseFloat($(this).attr('lat')), parseFloat($(this).attr('lng')));
                            create_marker(point, name, address, false, false, false,"http://localhost/tes/img/biru.png");
                        });
                    });
					
					
					$.get("map_process.php", function(data) {
                        $(data).find("marker").each(function() {
                            var name = $(this).attr('name');
                            var address = '<p>' + $(this).attr('address') + '</p>';
                            var type = $(this).attr('type');
                            var point = new google.maps.LatLng(parseFloat($(this).attr('lat')), parseFloat($(this).attr('lng')));
                            create_marker(point, name, address, false, false, false,"http://localhost/tes/img/hijau.png");
                        });
                    });
					
					<?php }else{?>
					
					<?php if ($_SESSION['level']=="member") {?>
					$.get("map_process.php", function(data) {
                        $(data).find("marker").each(function() {
                            var name = $(this).attr('name');
                            var address = '<p>' + $(this).attr('address') + '</p>';
                            var type = $(this).attr('type');
                            var point = new google.maps.LatLng(parseFloat($(this).attr('lat')), parseFloat($(this).attr('lng')));
                            create_marker1(point, name, address, false, false, false,"http://localhost/tes/img/hijau.png");
                        });
                    }); <?php } else {?>  
					
					$.get("map_process.php", function(data) {
                        $(data).find("marker").each(function() {
                            var name = $(this).attr('name');
                            var address = '<p>' + $(this).attr('address') + '</p>';
                            var type = $(this).attr('type');
                            var point = new google.maps.LatLng(parseFloat($(this).attr('lat')), parseFloat($(this).attr('lng')));
                            create_marker3(point, name, address, false, false, false,"http://localhost/tes/img/hijau.png");
                        });
                    }); 
					
					<?php } ?>
					
					<?php }?>

                    //Right Click to Drop a New Marker ---> jika ini dikomen maka fungsi klik kanan akan hilang dan cocok utk hlmn index home
                   <?php if ($_SESSION['level']=="petugas"){?>
				   google.maps.event.addListener(map, 'rightclick', function(event) {
                        //Edit form to be displayed with new marker
                        var EditForm = '<p><div class="marker-edit">' +
                                '<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">' +
                                
                                
                                '</form>' +
                                '</div></p><button name="save-marker" class="save-marker">Simpan Marker</button>';

                        //Drop a new Marker with our Edit Form
                        create_marker1(event.latLng, 'New Marker', EditForm, true, true, true, "http://localhost/tes/img/biru.png");
                    });<?php } else { ?> <?php }?>

                }

                //############### Create Marker Function ##############
				
				function create_marker1(MapPos, MapTitle, MapDesc, InfoOpenDefault, DragAble, Removable, iconPath)
                {

                    //new marker
                    var marker = new google.maps.Marker({
                        position: MapPos,
                        map: map,
                        draggable: DragAble,
                        animation: google.maps.Animation.DROP,
                        title: "Hello World!",
                        icon: iconPath
                    });

                    //Content structure of info Window for the Markers
					
					<?php if ($_SESSION['level']=="member"){?>
					
					var contentString = $('<div class="marker-info-win">' +
                            '<div class="marker-inner-win"><span class="info-content">' +
                            '<h1 class="marker-heading">' + MapTitle + '</h1>' +
                            MapDesc +
                            '<button name="remove-marker" class="remove-marker" title="Hapus Marker"></button>' + '</span><button name="save-marker" class="save-marker" title="Miliki Tempat Sampah Ini">Accepted</button>'+
                            '</div></div>');
					<?php }else {?>
					
					var contentString = $('<div class="marker-info-win">' +
                            '<div class="marker-inner-win"><span class="info-content">' +
                            '<h1 class="marker-heading">' + MapTitle + '</h1>' +
                            MapDesc +
                            '<button name="remove-marker" class="remove-marker" title="Hapus Marker"></button>' + '</span><button name="save-marker" class="save-marker" title="Tambah Lokasi ini"></button>'+
                            '</div></div>');
					
					<?php }?>
                    


                    //Create an infoWindow
                    var infowindow = new google.maps.InfoWindow();
                    //set the content of infoWindow
                    infowindow.setContent(contentString[0]);

                    //Find remove button in infoWindow
                    var removeBtn = contentString.find('button.remove-marker')[0];
                    var saveBtn = contentString.find('button.save-marker')[0];

                    //add click listner to remove marker button
                    google.maps.event.addDomListener(removeBtn, "click", function(event) {
                        remove_marker(marker);
                    });

                    if (typeof saveBtn !== 'undefined') //continue only when save button is present
                    {
                        //add click listner to save marker button
                        google.maps.event.addDomListener(saveBtn, "click", function(event) {
                            var mReplace = contentString.find('span.info-content'); //html to be replaced after success
                    //        var mName = contentString.find('input.save-name')[0].value; //name input field value
                      //      var mDesc = contentString.find('textarea.save-desc')[0].value; //description input field value
                        //    var mType = contentString.find('select.save-type')[0].value; //type of marker

                         /*   if (mName == '' || mDesc == '')
                            {
                                alert("Please enter Name and Description!");
                            } else {*/
                                save_marker(marker, mReplace); //call save marker function
                        // }
                        });
                    }

                    //add click listner to save marker button		 
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map, marker); // click on marker opens info window 
                    });

                    if (InfoOpenDefault) //whether info window should be open by default
                    {
                        infowindow.open(map, marker);
                    }
                }
				
				
                function create_marker(MapPos, MapTitle, MapDesc, InfoOpenDefault, DragAble, Removable, iconPath)
                {

                    //new marker
                    var marker = new google.maps.Marker({
                        position: MapPos,
                        map: map,
                        draggable: DragAble,
                        animation: google.maps.Animation.DROP,
                        title: "Hello World!",
                        icon: iconPath
                    });

                    //Content structure of info Window for the Markers
                    var contentString = $('<div class="marker-info-win">' +
                            '<div class="marker-inner-win"><span class="info-content">' +
                            '<h1 class="marker-heading">' + MapTitle + '</h1>' +
                            
                            '</span><button name="remove-marker" class="remove-marker" title="Hapus Marker"></button>' +
                            '</div></div>');


                    //Create an infoWindow
                    var infowindow = new google.maps.InfoWindow();
                    //set the content of infoWindow
                    infowindow.setContent(contentString[0]);

                    //Find remove button in infoWindow
                    var removeBtn = contentString.find('button.remove-marker')[0];
                    var saveBtn = contentString.find('button.save-marker')[0];

                    //add click listner to remove marker button
                   /* google.maps.event.addDomListener(removeBtn, "click", function(event) {
                        remove_marker(marker);
                    });*/

                    if (typeof saveBtn !== 'undefined') //continue only when save button is present
                    {
                        //add click listner to save marker button
                        google.maps.event.addDomListener(saveBtn, "click", function(event) {
                            var mReplace = contentString.find('span.info-content'); //html to be replaced after success
                    //        var mName = contentString.find('input.save-name')[0].value; //name input field value
                      //      var mDesc = contentString.find('textarea.save-desc')[0].value; //description input field value
                        //    var mType = contentString.find('select.save-type')[0].value; //type of marker

                         /*   if (mName == '' || mDesc == '')
                            {
                                alert("Please enter Name and Description!");
                            } else {*/
                                save_marker(marker, mReplace); //call save marker function
                        // }
                        });
                    }

                    //add click listner to save marker button		 
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map, marker); // click on marker opens info window 
                    });

                    if (InfoOpenDefault) //whether info window should be open by default
                    {
                        infowindow.open(map, marker);
                    }
                }
				
				function create_marker3(MapPos, MapTitle, MapDesc, InfoOpenDefault, DragAble, Removable, iconPath)
                {

                    //new marker
                    var marker = new google.maps.Marker({
                        position: MapPos,
                        map: map,
                        draggable: DragAble,
                        animation: google.maps.Animation.DROP,
                        title: "Hello World!",
                        icon: iconPath
                    });

                    //Content structure of info Window for the Markers
                    var contentString = $('<div class="marker-info-win">' +
                            '<div class="marker-inner-win"><span class="info-content">' +
                            '<h1 class="marker-heading">' + MapTitle + '</h1>' +
                            
                            '</span><button name="remove-marker" class="remove-marker" title="Hapus Bak Ini">Hapus</button>' +
                            '</div></div>');


                    //Create an infoWindow
                    var infowindow = new google.maps.InfoWindow();
                    //set the content of infoWindow
                    infowindow.setContent(contentString[0]);

                    //Find remove button in infoWindow
                    var removeBtn = contentString.find('button.remove-marker')[0];
                    var saveBtn = contentString.find('button.save-marker')[0];

                    //add click listner to remove marker button
                   google.maps.event.addDomListener(removeBtn, "click", function(event) {
                        remove_marker(marker);
                    });

                    if (typeof saveBtn !== 'undefined') //continue only when save button is present
                    {
                        //add click listner to save marker button
                        google.maps.event.addDomListener(saveBtn, "click", function(event) {
                            var mReplace = contentString.find('span.info-content'); //html to be replaced after success
                    //        var mName = contentString.find('input.save-name')[0].value; //name input field value
                      //      var mDesc = contentString.find('textarea.save-desc')[0].value; //description input field value
                        //    var mType = contentString.find('select.save-type')[0].value; //type of marker

                         /*   if (mName == '' || mDesc == '')
                            {
                                alert("Please enter Name and Description!");
                            } else {*/
                                save_marker(marker, mReplace); //call save marker function
                        // }
                        });
                    }

                    //add click listner to save marker button		 
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map, marker); // click on marker opens info window 
                    });

                    if (InfoOpenDefault) //whether info window should be open by default
                    {
                        infowindow.open(map, marker);
                    }
                }

                //Remove Marker Function
                function remove_marker(Marker)
                {

                    /* determine whether marker is draggable 
                     new markers are draggable and saved markers are fixed */
                    if (Marker.getDraggable())
                    {
                        Marker.setMap(null); //just remove new marker
                    }
                    else
                    {
                        //Remove saved marker from DB and map using jQuery Ajax
                        var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
                        var myData = {del: 'true', latlang: mLatLang}; //post variables
                        $.ajax({
                            type: "POST",
                            url: "map_process.php",
                            data: myData,
                            success: function(data) {
                                Marker.setMap(null);
                                alert(data);
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(thrownError); //throw any errors
                            }
                        });
                    }

                }

                // Save Marker Function
                function save_marker(Marker, replaceWin)
                {
                    //Save new marker using jQuery Ajax
                    var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
                    var myData = {latlang: mLatLang}; //post variables
                    console.log(replaceWin);
                    $.ajax({
                        type: "POST",
                        url: "map_process.php",
                        data: myData,
                        success: function(data) {
                            replaceWin.html(data); //replace info window with new html
                            Marker.setDraggable(false); //set marker to fixed
                            Marker.setIcon('http://localhost/tes/img/biru.png'); //replace icon
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError); //throw any errors
                        }
                    });
                }

            });
			</script>