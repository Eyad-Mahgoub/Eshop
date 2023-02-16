$(document).ready(function () {
    initGeolocation();

    function initGeolocation()
    {
        if( navigator.geolocation )
        {
            // Call getCurrentPosition with success and failure callbacks
            navigator.geolocation.getCurrentPosition( success, fail );
        }
        else
        {
            alert("Sorry, your browser does not support geolocation services.");
        }
    }

    function success(position)
    {
        const API_KEY = 'I41nd6wTmdLl6RohMqAf7lsesO9W05rE';
        const APPLICATION_NAME = 'My Application';
        const APPLICATION_VERSION = '1.0';
        const CURRENT_LOCATION = {lng: 30.98, lat: 30.05}
        var marker;
        var markerList = new Array();
        var i = 0;
        var oldMarkers;
        var editPopup;
        var distance = new Array();

        tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);

        var map = tt.map({
            key: API_KEY,
            container: 'map-div',
            center: CURRENT_LOCATION,
            zoom: 12,
            language: 'english'
        });

        map.getLanguage();
        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
        getall();

        function getall()
        {
            $('.overlay-loading').removeClass('d-none');
            $('.sidenav').toggle(0);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/testgetall",
                success: function (response) {
                    $('.overlay-loading').addClass('d-none');
                    $('.sidenav').toggle(500);
                    for (i in response)
                    {
                        var markid = response[i].id;
                        var markname = response[i].name;
                        var markdesc = response[i].description;
                        var marklng = response[i].longitude;
                        var marklat = response[i].latitude;

                        oldMarkers = response;
                        i = oldMarkers[oldMarkers.length - 1].id + 1;
                        var popuphtml = '<div class="card markerPopup"><div class="card-header fs-5"><input class="d-none" id="markerId" value="'+markid+'"><input class="d-none" id="markerLng" value="'+marklng+'"><input class="d-none" id="markerLat" value="'+marklat+'"><input disabled class="w-100 mark-name" value="'+ markname +'"></b><div class="card-body fs-6"><input disabled class=" w-100 mark-description" value="'+ markdesc +'"></div><div class="card-footer"><button class="measureDist btn btn-danger w-100">Measure Distance</button><button class="edit-Marker btn btn-danger w-100">Edit</button><button class="deleteMarker btn btn-danger w-100">Delete</button></div></div>'
                        console.log(response);
                        var popup = new tt.Popup({offset: 30, closOnMove: true})
                        .setHTML(popuphtml)

                        var tempmarker = new tt.Marker()
                        .setLngLat([marklng, marklat])
                        .setPopup(popup)
                        // .setDraggable([shouldBeDraggable=true])
                        // .on('dragend', onDragEnd)
                        .addTo(map);

                        tempmarker.getElement().classList.add = 'markerElement'

                        tempmarker.getElement().id = "marker"+markid;
                    }
                }
            });
        }



        function updateLngLat(lnglat) {

            return tt.services.reverseGeocode({
                key: API_KEY,
                position: lnglat,
                language: 'en-US'
            }).then(callbackFn);
        }
        function callbackFn(response)
        {
            return response.addresses[0].address.freeformAddress;
        }

        $(document).on('click', '.deleteMarker' ,function () {
            var markId = $(this).closest('.markerPopup').find('#markerId').val();
            $('.overlay-loading').removeClass('d-none');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/testdeletemarker",
                data: {
                    'id': markId,
                },
                success: function (response) {
                    $(this).closest('.markerPopup').remove();
                    $('.overlay-loading').addClass('d-none');
                    $('#marker'+markId).remove();
                    console.log(response);
                }
            });
        });

        function onDragEnd(e) {
            var lnglat = e.target.getLngLat();

            markerList.forEach(function (value, index, array) {
                if (value.id == e.target.getElement().id)
                {
                    value.lng = lnglat.lng;
                    value.lat = lnglat.lat;
                    return;
                }
            });

            console.log(markerList);
        }

        function onclick(e) {
            e.preventDefault();

            marker = new tt.Marker()
            .setLngLat(e.lngLat)
            .setDraggable([shouldBeDraggable=true])
            .on('dragend', onDragEnd)
            .addTo(map);

            marker.getElement().id = i;

            $("#staticBackdrop").modal('toggle');
        }
        map.on('dblclick', onclick);


        $('#modalCancel').click(function () {
            marker.remove();
            $("#staticBackdrop").modal('toggle')
        });

        $(document).on('click', '.edit-Marker' ,function () {
            console.log('hellow');
            var markId = $(this).closest('.markerPopup').find('#markerId').val();
            var markname = $(this).closest('.markerPopup').find('.mark-name').val();
            var markdescription = $(this).closest('.markerPopup').find('.mark-description').val();
            editPopup = $(this).closest('.markerPopup');

            console.log(markId);
            console.log(markname);
            console.log(markdescription);

            $("#edit-Modal").modal('toggle');
            $('#markerEditId').val(markId);
            $('#markerEditName').val(markname);
            $('#markerEditDescription').val(markdescription);
        });

        $('#modalEditCancel').click(function () {
            $("#edit-Modal").modal('toggle');
        });

        $('#modalEditSave').click(function () {
            var mid = $('#markerEditId').val();
            var mn = $('#markerEditName').val();
            var md = $('#markerEditDescription').val();

            $('.overlay-loading').toggleClass('d-none');
            $("#edit-Modal").modal('toggle');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "/testupdate",
                data: {
                    'id': mid,
                    'name': mn,
                    'description': md,
                },
                dataType: "json",
                success: function (response) {
                    $('.overlay-loading').toggleClass('d-none');
                    editPopup.find('.mark-name').val(mn);
                    editPopup.find('.mark-description').val(md);
                    console.log(response);
                }
            });
        });

        $(document).on('click', '.measureDist' ,function () {
            var marklng = $(this).closest('.markerPopup').find('#markerLng').val();
            var marklat = $(this).closest('.markerPopup').find('#markerLat').val();

            distance.push(marklng, marklat);
            console.log(distance);

            if (distance.length == 4)
            {
                alert(getDistanceFromLatLonInKm(distance[0],  distance[1],  distance[2],  distance[3]));
                distance.length = 0;
            }
            else
            {
                alert('Select other point to measure distance');
            }
        });


        $('#modalSave').click(function () {
            let name = $('#markerName').val();
            let description = $('#markerDescription').val();
            let resaddress = updateLngLat(marker.getLngLat());
            let lnglat = marker.getLngLat();

            var popuphtmlnew = '<div class="card markerPopup"><div class="card-header fs-5"><input class="d-none" id="markerId" value="'+i+'"><input disabled class="w-100 mark-name" value="'+ name +'"></b><div class="card-body fs-6"><input disabled class="w-100 mark-description" value="'+ description +'"></div><div class="card-footer"><button class="measureDist btn btn-danger w-100">Measure Distance</button><button class="edit-Marker btn btn-danger w-100">Edit</button><button class="deleteMarker btn btn-danger w-100">Delete</button></div></div>'
            var popupnew = new tt.Popup({offset: 30, closOnMove: true})
            .setHTML(popuphtmlnew);

            marker.setPopup(popupnew);
            i++;

            $("#staticBackdrop").modal('toggle')

            $('.overlay-loading').removeClass('d-none');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "/testsave",
                data: {
                    'longitude': lnglat.lng,
                    'latitude': lnglat.lat,
                    'name': name,
                    'description': description,
                },
                dataType: "json",
                success: function (response) {
                    $('.overlay-loading').addClass('d-none');
                    console.log(response);
                }
            });

        });

        // function saveAll()
        // {
        //     console.log(markerList);
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     $.ajax({
        //         type: "post",
        //         url: "/testsave",
        //         data: {data : markerList},
        //         dataType: "json",
        //         success: function (response) {
        //             console.log(response);
        //             alert('Markers saved')
        //         }
        //     });
        // }

        function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
            var R = 6371; // Radius of the earth in km
            var dLat = deg2rad(lat2-lat1);  // deg2rad below
            var dLon = deg2rad(lon2-lon1);
            var a =
              Math.sin(dLat/2) * Math.sin(dLat/2) +
              Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
              Math.sin(dLon/2) * Math.sin(dLon/2)
              ;
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
            var d = R * c; // Distance in km
            return 'Distance is ' + (Math.round(d * 100) / 100).toFixed(2) + ' Km.';
        }

        function deg2rad(deg) {
            return deg * (Math.PI/180)
        }

    }





    function fail()
    {
        alert('failed')
    }
})




