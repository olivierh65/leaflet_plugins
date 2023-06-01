/**
 * We are overriding the adding features functionality of the Leaflet module.
 */

(function ($, Drupal, drupalSettings) {
            $(document).on('leafletMapInit', function(e, settings, lMap, mapid) {
                console.log ("Init geoman");
                if ((drupalSettings.leaflet_plugins.geoman) && (drupalSettings.leaflet_plugins.geoman.control))  {
                    L.PM.reInitLayer(lMap);

                    lMap.pm.addControls({
                        'position': drupalSettings.leaflet_plugins.geoman.position,
                        'drawMarker': drupalSettings.leaflet_plugins.geoman.options['drawMarker'] == 0 ? false : true,
                        'drawCircleMarker': drupalSettings.leaflet_plugins.geoman.options['drawCircleMarker'] == 0 ? false : true,
                        'drawPolyline': drupalSettings.leaflet_plugins.geoman.options['drawPolyline'] == 0 ? false : true,
                        'drawRectangle': drupalSettings.leaflet_plugins.geoman.options['drawRectangle'] == 0 ? false : true,
                        'drawPolygon': drupalSettings.leaflet_plugins.geoman.options['drawPolygon'] == 0 ? false : true,
                        'drawCircle': drupalSettings.leaflet_plugins.geoman.options['drawCircle'] == 0 ? false : true,
                        'editMode': drupalSettings.leaflet_plugins.geoman.options['editMode'] == 0 ? false : true,
                        'dragMode': drupalSettings.leaflet_plugins.geoman.options['dragMode'] == 0 ? false : true,
                        'cutPolygon': drupalSettings.leaflet_plugins.geoman.options['cutPolygon'] == 0 ? false : true,
                        'removalMode': drupalSettings.leaflet_plugins.geoman.options['removalMode'] == 0 ? false : true,
                        'rotateMode': drupalSettings.leaflet_plugins.geoman.options['rotateMode'] == 0 ? false : true,
                        'oneBlock': drupalSettings.leaflet_plugins.geoman.options['oneBlock'] == 0 ? false : true,
                        'drawControls': drupalSettings.leaflet_plugins.geoman.options['drawControls'] == 0 ? false : true,
                        'editControls': drupalSettings.leaflet_plugins.geoman.options['editControls'] == 0 ? false : true,
                        'customControls': drupalSettings.leaflet_plugins.geoman.options['customControls'] == 0 ? false : true,
                    });
                }
            })
}(jQuery, Drupal, drupalSettings));
