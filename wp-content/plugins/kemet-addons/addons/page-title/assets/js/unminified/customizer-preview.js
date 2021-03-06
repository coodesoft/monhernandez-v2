/**
 * Page Title customizer preview
 */
(function($) {
  /**
   * Page Title background
   */
  wp.customize("kemet-settings[page-title-bg-obj]", function(value) {
    value.bind(function(bg_obj) {
      var dynamicStyle =
        " .kmt-page-title-addon-content, .kemet-merged-header-title { {{css}} }";
      kemet_background_obj_css(
        wp.customize,
        bg_obj,
        "header-bg-obj",
        dynamicStyle
      );
    });
  });
  wp.customize("kemet_breadcrumb_separator", function(value) {
    value.bind(function(newval) {
      $(".kemet-breadcrumbs-trail ul li .breadcrumb-sep").text(newval);
    });
  });
  wp.customize("kemet-settings[page_title_alignment]", function(value) {
    value.bind(function(align) {
      $(".kmt-page-title.page-title-layout-1").css("text-align", align);
    });
  });

  kemet_responsive_spacing(
    "kemet-settings[page-title-space]",
    ".kmt-page-title-addon-content, .header-transparent .kmt-page-title-addon-content,.merged-header-transparent .kmt-page-title-addon-content",
    "padding",
    ["top", "right", "bottom", "left"]
  );
  kemet_css("kemet-settings[page-title-color]", "color", ".kemet-page-title");
  kemet_responsive_slider(
    "kemet-settings[page-title-font-size]",
    ".kemet-page-title",
    "font-size"
  );
  kemet_responsive_slider(
    "kemet-settings[page-title-letter-spacing]",
    ".kemet-page-title",
    "letter-spacing"
  );
  kemet_responsive_slider(
    "kemet-settings[breadcrumbs-font-size]",
    ".kemet-breadcrumb-trail",
    "font-size"
  );
  kemet_css(
    "kemet-settings[page-title-border-right-color]",
    "border-color",
    ".page-title-layout-3 .kmt-page-title-wrap"
  );
  kemet_css(
    "kemet-settings[pagetitle-text-transform]",
    "text-transform",
    ".kemet-page-title"
  );
  kemet_responsive_slider(
    "kemet-settings[pagetitle-line-height]",
    ".kemet-page-title",
    "line-height"
  );
  //Page Title Bottom Title
  kemet_css(
    "kemet-settings[pagetitle-bottomline-height]",
    "height",
    ".kemet-page-title::after",
    "px"
  );
  kemet_css(
    "kemet-settings[pagetitle-bottomline-width]",
    "width",
    ".kemet-page-title::after",
    "px"
  );
  kemet_css(
    "kemet-settings[pagetitle-bottomline-color]",
    "background-color",
    ".kemet-page-title::after"
  );
  // Breadcrumbs
  kemet_responsive_spacing(
    "kemet-settings[breadcrumbs-space]",
    ".kemet-breadcrumb-trail",
    "padding",
    ["top", "right", "bottom", "left"]
  );
  kemet_css(
    "kemet-settings[breadcrumbs-color]",
    "color",
    ".kemet-breadcrumb-trail li > span , .kemet-breadcrumb-trail li > span > span , .kemet-breadcrumb-trail > span"
  );
  kemet_css(
    "kemet-settings[breadcrumbs-link-color]",
    "color",
    ".kemet-breadcrumb-trail a span"
  );
  kemet_css(
    "kemet-settings[breadcrumbs-link-h-color]",
    "color",
    ".kemet-breadcrumb-trail a:hover span"
  );

  kemet_responsive_slider(
    "kemet-settings[breadcrumbs-letter-spacing]",
    ".kemet-breadcrumb-trail , .kemet-breadcrumb-trail *:not(.dashicons)",
    "letter-spacing"
  );
  kemet_responsive_slider(
    "kemet-settings[breadcrumbs-font-size]",
    ".kemet-breadcrumb-trail , .kemet-breadcrumb-trail *:not(.dashicons)",
    "font-size"
  );
  kemet_css(
    "kemet-settings[breadcrumbs-text-transform]",
    "text-transform",
    ".kemet-breadcrumb-trail , .kemet-breadcrumb-trail *:not(.dashicons)"
  );
  kemet_responsive_slider(
    "kemet-settings[breadcrumbs-line-height]",
    ".kemet-breadcrumb-trail , .kemet-breadcrumb-trail *:not(.dashicons)",
    "line-height"
  );

  kemet_css(
    "kemet-settings[sub-title-color]",
    "color",
    ".kemet-page-sub-title"
  );
  kemet_responsive_slider(
    "kemet-settings[sub-title-letter-spacing]",
    ".kemet-page-sub-title",
    "letter-spacing"
  );
  kemet_responsive_slider(
    "kemet-settings[sub-title-font-size]",
    ".kemet-page-sub-title",
    "font-size"
  );
  kemet_css(
    "kemet-settings[sub-title-text-transform]",
    "text-transform",
    ".kemet-page-sub-title"
  );
  kemet_responsive_slider(
    "kemet-settings[sub-title-line-height]",
    ".kemet-page-sub-title",
    "line-height"
  );
})(jQuery);
