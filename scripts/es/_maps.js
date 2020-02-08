// Export Functions
export default jQuery(document).ready(function ($) {

    'use strict';

    class Map {

        /** == CONSTRUCTOR FUNCTION == */
        /** ================================================== */

        constructor() {
            // Define Properties
            this._mapboxToken = capstone_args.mapbox_access_token;

            // Initiate Public Methods
            this.initMapBox();
        }
        
        /** == PUBLIC METHODS == */
        /** ================================================== */

        initMapBox() {
            var isMapWrapper = $('#map-wrapper').length > 0;
            var isTouch = $('html').hasClass('touch-view') ? true : false;

            // proceed if mapbox token is defined and map wrapper exist
            if (this._mapboxToken && isMapWrapper) {
                mapboxgl.accessToken = this._mapboxToken;

                // initialize map
                var map = new mapboxgl.Map({
                    container: 'map-wrapper',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    center: this._defaultCoordinates(), // starting position
                    zoom: Number(capstone_args.map_default_zoom), // starting zoom
                });

                // Add zoom and rotation controls to the map.
                map.addControl(new mapboxgl.NavigationControl());

                // Disable map zoom when using scroll
                map.scrollZoom.disable();

                // Disable tap on mobile devices
                if (isTouch) {
                    map.dragPan.disable();
                }

                // Handle maps when listing updates
                this._handleListingUpdate(map);
            }

        }

        /** == PRIVATE METHODS == */
        /** ================================================== */

        // get default coordinates
        _defaultCoordinates() {
            return capstone_args.map_default_location.split(',').map(function (point) {
                return Number(point);
            });
        }

        // execute different steps whenever listing updates
        _handleListingUpdate(map) {
            var self = this; // bind current scope to `self` for later use

            function coreHandlingListingUpdate() {
                // remove all previous markers
                self._removeMarkers();

                // get updated list of locations
                var geojson = {
                    "type": "FeatureCollection",
                    "features": self._getFreshListings()
                };

                // add new markers to the map
                geojson.features.forEach(function(item) {
                    self._createMarkers(item, map);
                });

                // calculate and apply bounding box
                var bbox = new mapboxgl.LngLatBounds();
                geojson.features.forEach(function(item) {
                    bbox.extend(item.geometry.coordinates);
                });
                map.fitBounds(bbox, {
                    padding: {top: 100, bottom:100, left: 150, right: 150},
                    maxZoom: Number(capstone_args.map_default_zoom),
                });

            }

            // when the listing updates
            let isFacetWP = $('.page-content .facetwp-template').length;
            if (isFacetWP) {
                coreHandlingListingUpdate();
            } else {
                $('.job_listings, .resumes').on('updated_result updated_results load', function (e) {
                    coreHandlingListingUpdate();
                });
            }
        }

        // clear all markers from map
        _removeMarkers() {
            // console.log('Removing all markers NOW!!!');
            // some magic goes here
            $('.marker').remove();
            // some magic goes here
            // console.log('All Markers REMOVED!!!');
        }

        // update data obj whenever called
        _getFreshListings() {
            // console.log('Getting FRESH listings!!!');

            // make a blank canvas
            var listingLocations = [];

            // add all "visible" listing items to the canvas
            $('ul.job_listings > li, ul.resumes > li').map(function (index) {
                // capture listing data
                var id = $(this).attr('data-listing-id');
                var title = $(this).attr('data-title');
                var link = $('> a', this).attr('href');
                var icon = $('.company_logo, .candidate_photo', this).attr('src');
                var latitude = $(this).attr('data-latitude');
                var longitude = $(this).attr('data-longitude');
                
                // check if listing has coordinates
                var hasCoordinates = latitude && longitude;

                // check if item already populated
                var hasPopulated = false;
                for(var i = 0; i < listingLocations.length; i++) {
                    if (listingLocations[i].id == id) {
                        hasPopulated = true;
                        continue;
                    }
                }

                // push the item if its new and has coordinates
                if (!hasPopulated && hasCoordinates) {
                    listingLocations.push(
                        {
                            "id": id,
                            "type": "Feature",
                            "properties": {
                                "message": title,
                                "url": link,
                                "iconSize": [60, 60],
                                "iconSrc": icon,
                            },
                            "geometry": {
                                "type": "Point",
                                "coordinates": [
                                    Number(latitude),
                                    Number(longitude),
                                ]
                            }
                        },
                    );
                }
            });

            // return the updated canvas for use by others
            return listingLocations;
        }

        // create markers on the map
        _createMarkers(item, map) {
            // console.log('Create all markers!!!');

            // check if item is already populated
            var hasPopulated = $('.marker[data-id="'+ item.id +'"]').length > 0;

            // console.log(item);
            // console.log(hasPopulated)

            if (hasPopulated) {
                // console.log('Has already populated', item.id);
                return;
            }

            // create a DOM element for the marker
            var marker = document.createElement('div');
            $(marker).addClass('marker');
            $(marker).attr('data-id', item.id);
            if (item.properties.iconSrc) {
                marker.style.backgroundImage = 'url('+ item.properties.iconSrc +')';
            }
            marker.style.width = item.properties.iconSize[0] + 'px';
            marker.style.height = item.properties.iconSize[1] + 'px';

            // create the popup
            var popup = new mapboxgl.Popup({ offset: 25 })
            .setHTML('<h4><a href="' + item.properties.url + '">' + item.properties.message + '</a></h4>')

            // add marker to map
            new mapboxgl.Marker(marker)
                .setLngLat(item.geometry.coordinates)
                .setPopup(popup) // attach popup with marker
                .addTo(map);
        }

    }

    $(window).on('load', function () {
        let map = new Map();
    });

    $(document).on('facetwp-loaded', function () {
        let map = new Map();
    });

});