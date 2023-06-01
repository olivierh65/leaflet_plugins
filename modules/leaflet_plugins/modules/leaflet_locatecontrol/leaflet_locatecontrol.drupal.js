/**
 * We are overriding the adding features functionality of the Leaflet module.
 */

(function ($, Drupal, drupalSettings) {
  console.log("init locatecontrol");
  $(document).on("leafletMapInit", function (e, settings, lMap, mapid) {
    // console.log ("event locateconrol");
    if ((drupalSettings.leaflet_plugins.locatecontrol) && (drupalSettings.leaflet_plugins.locatecontrol.control)) {
      lMap.addControl(
        L.control.locate({
          strings: { title: "Où suis-je ???" },
          position: "topright",
        })
      );
    }
  });
})(jQuery, Drupal, drupalSettings);
