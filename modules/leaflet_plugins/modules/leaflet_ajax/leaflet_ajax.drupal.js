/**
 * We are overriding the adding features functionality of the Leaflet module.
 */

(function ($, Drupal, drupalSettings) {
    console.log('Init Ajax');
    $(document).on("leafletMapInit", function (e, settings, lMap, mapid) {
      if ((drupalSettings.leaflet_plugins.ajax) && (drupalSettings.leaflet_plugins.ajax.control)) {
        console.log("Ajax");
      }
    });
})(jQuery, Drupal, drupalSettings);
