/**
 * We are overriding the adding features functionality of the Leaflet module.
 */

(function ($, Drupal, drupalSettings) {
  console.log("init StyleEditor");
  $(document).on("leafletMapInit", function (e, settings, lMap, mapid) {
    // console.log ("event  style editor");
    if ((drupalSettings.leaflet_plugins.styleeditor) && (drupalSettings.leaflet_plugins.styleeditor.control)) {
      lMap.addControl(
        L.control.styleEditor({
          position: drupalSettings.leaflet_plugins.styleeditor.position,
        })
      );
    }
  });
})(jQuery, Drupal, drupalSettings);
