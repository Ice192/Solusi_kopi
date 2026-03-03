/**
 * Main
 * Lightweight fallback for layouts that include /assets/js/main.js.
 */
'use strict';

(function () {
  // Optional globals from helpers.js/config.js
  if (typeof window.Helpers !== 'undefined') {
    try {
      window.isRtl = window.Helpers.isRtl();
      window.isDarkStyle = window.Helpers.isDarkStyle();
      if (typeof window.Helpers.initCustomOptionCheck === 'function') {
        setTimeout(function () {
          window.Helpers.initCustomOptionCheck();
        }, 1000);
      }
      if (typeof window.Helpers.setAutoUpdate === 'function') {
        window.Helpers.setAutoUpdate(true);
      }
    } catch (e) {
      // Keep silent: this script is used across multiple page structures.
    }
  }

  // Button waves (if Waves is available)
  if (typeof window.Waves !== 'undefined') {
    try {
      window.Waves.init();
      window.Waves.attach(
        ".btn[class*='btn-']:not(.position-relative):not([class*='btn-outline-']):not([class*='btn-label-'])",
        ['waves-light']
      );
      window.Waves.attach("[class*='btn-outline-']:not(.position-relative)");
      window.Waves.attach("[class*='btn-label-']:not(.position-relative)");
    } catch (e) {
      // no-op
    }
  }

  // Bootstrap tooltips
  if (typeof window.bootstrap !== 'undefined' && typeof window.bootstrap.Tooltip === 'function') {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (el) {
      try {
        new window.bootstrap.Tooltip(el);
      } catch (e) {
        // no-op
      }
    });
  }

  // Menu init only when the required DOM + globals exist.
  if (
    typeof window.Menu !== 'undefined' &&
    typeof window.Helpers !== 'undefined' &&
    document.getElementById('layout-menu')
  ) {
    try {
      var layoutMenu = document.getElementById('layout-menu');
      var isHorizontalLayout = layoutMenu.classList.contains('menu-horizontal');
      window.mainMenuInstance = new window.Menu(layoutMenu, {
        orientation: isHorizontalLayout ? 'horizontal' : 'vertical',
        closeChildren: isHorizontalLayout
      });
      if (typeof window.Helpers.scrollToActive === 'function') {
        window.Helpers.scrollToActive(false);
      }
      window.Helpers.mainMenu = window.mainMenuInstance;
    } catch (e) {
      // no-op
    }
  }
})();
