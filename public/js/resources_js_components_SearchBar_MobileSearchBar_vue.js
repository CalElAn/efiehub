"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_SearchBar_MobileSearchBar_vue"],{

/***/ "./node_modules/@headlessui/vue/dist/_virtual/_rollupPluginBabelHelpers.js":
/*!*********************************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/_virtual/_rollupPluginBabelHelpers.js ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "arrayLikeToArray": () => (/* binding */ _arrayLikeToArray),
/* harmony export */   "createForOfIteratorHelperLoose": () => (/* binding */ _createForOfIteratorHelperLoose),
/* harmony export */   "extends": () => (/* binding */ _extends),
/* harmony export */   "objectWithoutPropertiesLoose": () => (/* binding */ _objectWithoutPropertiesLoose),
/* harmony export */   "unsupportedIterableToArray": () => (/* binding */ _unsupportedIterableToArray)
/* harmony export */ });
function _extends() {
  _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];

      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }

    return target;
  };

  return _extends.apply(this, arguments);
}

function _objectWithoutPropertiesLoose(source, excluded) {
  if (source == null) return {};
  var target = {};
  var sourceKeys = Object.keys(source);
  var key, i;

  for (i = 0; i < sourceKeys.length; i++) {
    key = sourceKeys[i];
    if (excluded.indexOf(key) >= 0) continue;
    target[key] = source[key];
  }

  return target;
}

function _unsupportedIterableToArray(o, minLen) {
  if (!o) return;
  if (typeof o === "string") return _arrayLikeToArray(o, minLen);
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) n = o.constructor.name;
  if (n === "Map" || n === "Set") return Array.from(o);
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);
}

function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) len = arr.length;

  for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i];

  return arr2;
}

function _createForOfIteratorHelperLoose(o, allowArrayLike) {
  var it;

  if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) {
    if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") {
      if (it) o = it;
      var i = 0;
      return function () {
        if (i >= o.length) return {
          done: true
        };
        return {
          done: false,
          value: o[i++]
        };
      };
    }

    throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
  }

  it = o[Symbol.iterator]();
  return it.next.bind(it);
}


//# sourceMappingURL=_rollupPluginBabelHelpers.js.map


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/components/popover/popover.esm.js":
/*!*****************************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/components/popover/popover.esm.js ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Popover": () => (/* binding */ Popover),
/* harmony export */   "PopoverButton": () => (/* binding */ PopoverButton),
/* harmony export */   "PopoverGroup": () => (/* binding */ PopoverGroup),
/* harmony export */   "PopoverOverlay": () => (/* binding */ PopoverOverlay),
/* harmony export */   "PopoverPanel": () => (/* binding */ PopoverPanel)
/* harmony export */ });
/* harmony import */ var _virtual_rollupPluginBabelHelpers_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../_virtual/_rollupPluginBabelHelpers.js */ "./node_modules/@headlessui/vue/dist/_virtual/_rollupPluginBabelHelpers.js");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _utils_match_esm_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../utils/match.esm.js */ "./node_modules/@headlessui/vue/dist/utils/match.esm.js");
/* harmony import */ var _utils_render_esm_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../utils/render.esm.js */ "./node_modules/@headlessui/vue/dist/utils/render.esm.js");
/* harmony import */ var _keyboard_esm_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../../keyboard.esm.js */ "./node_modules/@headlessui/vue/dist/keyboard.esm.js");
/* harmony import */ var _hooks_use_id_esm_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../hooks/use-id.esm.js */ "./node_modules/@headlessui/vue/dist/hooks/use-id.esm.js");
/* harmony import */ var _utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../utils/focus-management.esm.js */ "./node_modules/@headlessui/vue/dist/utils/focus-management.esm.js");
/* harmony import */ var _hooks_use_window_event_esm_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../hooks/use-window-event.esm.js */ "./node_modules/@headlessui/vue/dist/hooks/use-window-event.esm.js");
/* harmony import */ var _utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../utils/dom.esm.js */ "./node_modules/@headlessui/vue/dist/utils/dom.esm.js");
/* harmony import */ var _internal_open_closed_esm_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../internal/open-closed.esm.js */ "./node_modules/@headlessui/vue/dist/internal/open-closed.esm.js");
/* harmony import */ var _hooks_use_resolve_button_type_esm_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../../hooks/use-resolve-button-type.esm.js */ "./node_modules/@headlessui/vue/dist/hooks/use-resolve-button-type.esm.js");












var PopoverStates;

(function (PopoverStates) {
  PopoverStates[PopoverStates["Open"] = 0] = "Open";
  PopoverStates[PopoverStates["Closed"] = 1] = "Closed";
})(PopoverStates || (PopoverStates = {}));

var PopoverContext = /*#__PURE__*/Symbol('PopoverContext');

function usePopoverContext(component) {
  var context = (0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(PopoverContext, null);

  if (context === null) {
    var err = new Error("<" + component + " /> is missing a parent <" + Popover.name + " /> component.");
    if (Error.captureStackTrace) Error.captureStackTrace(err, usePopoverContext);
    throw err;
  }

  return context;
}

var PopoverGroupContext = /*#__PURE__*/Symbol('PopoverGroupContext');

function usePopoverGroupContext() {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(PopoverGroupContext, null);
}

var PopoverPanelContext = /*#__PURE__*/Symbol('PopoverPanelContext');

function usePopoverPanelContext() {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(PopoverPanelContext, null);
} // ---


var Popover = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({
  name: 'Popover',
  props: {
    as: {
      type: [Object, String],
      "default": 'div'
    }
  },
  setup: function setup(props, _ref) {
    var slots = _ref.slots,
        attrs = _ref.attrs;
    var buttonId = "headlessui-popover-button-" + (0,_hooks_use_id_esm_js__WEBPACK_IMPORTED_MODULE_1__.useId)();
    var panelId = "headlessui-popover-panel-" + (0,_hooks_use_id_esm_js__WEBPACK_IMPORTED_MODULE_1__.useId)();
    var popoverState = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(PopoverStates.Closed);
    var button = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var panel = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var api = {
      popoverState: popoverState,
      buttonId: buttonId,
      panelId: panelId,
      panel: panel,
      button: button,
      togglePopover: function togglePopover() {
        var _match;

        popoverState.value = (0,_utils_match_esm_js__WEBPACK_IMPORTED_MODULE_2__.match)(popoverState.value, (_match = {}, _match[PopoverStates.Open] = PopoverStates.Closed, _match[PopoverStates.Closed] = PopoverStates.Open, _match));
      },
      closePopover: function closePopover() {
        if (popoverState.value === PopoverStates.Closed) return;
        popoverState.value = PopoverStates.Closed;
      },
      close: function close(focusableElement) {
        api.closePopover();

        var restoreElement = function () {
          if (!focusableElement) return (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button);
          if (focusableElement instanceof HTMLElement) return focusableElement;
          if (focusableElement.value instanceof HTMLElement) return (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(focusableElement);
          return (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button);
        }();

        restoreElement == null ? void 0 : restoreElement.focus();
      }
    };
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.provide)(PopoverContext, api);
    (0,_internal_open_closed_esm_js__WEBPACK_IMPORTED_MODULE_4__.useOpenClosedProvider)((0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(function () {
      var _match2;

      return (0,_utils_match_esm_js__WEBPACK_IMPORTED_MODULE_2__.match)(popoverState.value, (_match2 = {}, _match2[PopoverStates.Open] = _internal_open_closed_esm_js__WEBPACK_IMPORTED_MODULE_4__.State.Open, _match2[PopoverStates.Closed] = _internal_open_closed_esm_js__WEBPACK_IMPORTED_MODULE_4__.State.Closed, _match2));
    }));
    var registerBag = {
      buttonId: buttonId,
      panelId: panelId,
      close: function close() {
        api.closePopover();
      }
    };
    var groupContext = usePopoverGroupContext();
    var registerPopover = groupContext == null ? void 0 : groupContext.registerPopover;

    function isFocusWithinPopoverGroup() {
      var _groupContext$isFocus, _dom, _dom2;

      return (_groupContext$isFocus = groupContext == null ? void 0 : groupContext.isFocusWithinPopoverGroup()) != null ? _groupContext$isFocus : ((_dom = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(button)) == null ? void 0 : _dom.contains(document.activeElement)) || ((_dom2 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(panel)) == null ? void 0 : _dom2.contains(document.activeElement));
    }

    (0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(function () {
      return registerPopover == null ? void 0 : registerPopover(registerBag);
    }); // Handle focus out

    (0,_hooks_use_window_event_esm_js__WEBPACK_IMPORTED_MODULE_5__.useWindowEvent)('focus', function () {
      if (popoverState.value !== PopoverStates.Open) return;
      if (isFocusWithinPopoverGroup()) return;
      if (!button) return;
      if (!panel) return;
      api.closePopover();
    }, true); // Handle outside click

    (0,_hooks_use_window_event_esm_js__WEBPACK_IMPORTED_MODULE_5__.useWindowEvent)('mousedown', function (event) {
      var _dom3, _dom4;

      var target = event.target;
      if (popoverState.value !== PopoverStates.Open) return;
      if ((_dom3 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(button)) == null ? void 0 : _dom3.contains(target)) return;
      if ((_dom4 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(panel)) == null ? void 0 : _dom4.contains(target)) return;
      api.closePopover();

      if (!(0,_utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.isFocusableElement)(target, _utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.FocusableMode.Loose)) {
        var _dom5;

        event.preventDefault();
        (_dom5 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(button)) == null ? void 0 : _dom5.focus();
      }
    });
    return function () {
      var slot = {
        open: popoverState.value === PopoverStates.Open,
        close: api.close
      };
      return (0,_utils_render_esm_js__WEBPACK_IMPORTED_MODULE_7__.render)({
        props: props,
        slot: slot,
        slots: slots,
        attrs: attrs,
        name: 'Popover'
      });
    };
  }
}); // ---

var PopoverButton = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({
  name: 'PopoverButton',
  props: {
    as: {
      type: [Object, String],
      "default": 'button'
    },
    disabled: {
      type: [Boolean],
      "default": false
    }
  },
  render: function render$1() {
    var api = usePopoverContext('PopoverButton');
    var slot = {
      open: api.popoverState.value === PopoverStates.Open
    };
    var propsWeControl = this.isWithinPanel ? {
      ref: 'el',
      type: this.type,
      onKeydown: this.handleKeyDown,
      onClick: this.handleClick
    } : {
      ref: 'el',
      id: api.buttonId,
      type: this.type,
      'aria-expanded': this.$props.disabled ? undefined : api.popoverState.value === PopoverStates.Open,
      'aria-controls': (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel) ? api.panelId : undefined,
      disabled: this.$props.disabled ? true : undefined,
      onKeydown: this.handleKeyDown,
      onKeyup: this.handleKeyUp,
      onClick: this.handleClick
    };
    return (0,_utils_render_esm_js__WEBPACK_IMPORTED_MODULE_7__.render)({
      props: (0,_virtual_rollupPluginBabelHelpers_js__WEBPACK_IMPORTED_MODULE_8__["extends"])({}, this.$props, propsWeControl),
      slot: slot,
      attrs: this.$attrs,
      slots: this.$slots,
      name: 'PopoverButton'
    });
  },
  setup: function setup(props, _ref2) {
    var attrs = _ref2.attrs;
    var api = usePopoverContext('PopoverButton');
    var groupContext = usePopoverGroupContext();
    var closeOthers = groupContext == null ? void 0 : groupContext.closeOthers;
    var panelContext = usePopoverPanelContext();
    var isWithinPanel = panelContext === null ? false : panelContext === api.panelId; // TODO: Revisit when handling Tab/Shift+Tab when using Portal's

    var activeElementRef = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var previousActiveElementRef = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(typeof window === 'undefined' ? null : document.activeElement);
    (0,_hooks_use_window_event_esm_js__WEBPACK_IMPORTED_MODULE_5__.useWindowEvent)('focus', function () {
      previousActiveElementRef.value = activeElementRef.value;
      activeElementRef.value = document.activeElement;
    }, true);
    var elementRef = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);

    if (!isWithinPanel) {
      (0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(function () {
        api.button.value = elementRef.value;
      });
    }

    return {
      isWithinPanel: isWithinPanel,
      el: elementRef,
      type: (0,_hooks_use_resolve_button_type_esm_js__WEBPACK_IMPORTED_MODULE_9__.useResolveButtonType)((0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(function () {
        return {
          as: props.as,
          type: attrs.type
        };
      }), elementRef),
      handleKeyDown: function handleKeyDown(event) {
        var _dom6, _dom7;

        if (isWithinPanel) {
          if (api.popoverState.value === PopoverStates.Closed) return;

          switch (event.key) {
            case _keyboard_esm_js__WEBPACK_IMPORTED_MODULE_10__.Keys.Space:
            case _keyboard_esm_js__WEBPACK_IMPORTED_MODULE_10__.Keys.Enter:
              event.preventDefault(); // Prevent triggering a *click* event

              event.stopPropagation();
              api.closePopover();
              (_dom6 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button)) == null ? void 0 : _dom6.focus(); // Re-focus the original opening Button

              break;
          }
        } else {
          switch (event.key) {
            case _keyboard_esm_js__WEBPACK_IMPORTED_MODULE_10__.Keys.Space:
            case _keyboard_esm_js__WEBPACK_IMPORTED_MODULE_10__.Keys.Enter:
              event.preventDefault(); // Prevent triggering a *click* event

              event.stopPropagation();
              if (api.popoverState.value === PopoverStates.Closed) closeOthers == null ? void 0 : closeOthers(api.buttonId);
              api.togglePopover();
              break;

            case _keyboard_esm_js__WEBPACK_IMPORTED_MODULE_10__.Keys.Escape:
              if (api.popoverState.value !== PopoverStates.Open) return closeOthers == null ? void 0 : closeOthers(api.buttonId);
              if (!(0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button)) return;
              if (!((_dom7 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button)) == null ? void 0 : _dom7.contains(document.activeElement))) return;
              event.preventDefault();
              event.stopPropagation();
              api.closePopover();
              break;

            case _keyboard_esm_js__WEBPACK_IMPORTED_MODULE_10__.Keys.Tab:
              if (api.popoverState.value !== PopoverStates.Open) return;
              if (!api.panel) return;
              if (!api.button) return; // TODO: Revisit when handling Tab/Shift+Tab when using Portal's

              if (event.shiftKey) {
                var _dom8, _dom9;

                // Check if the last focused element exists, and check that it is not inside button or panel itself
                if (!previousActiveElementRef.value) return;
                if ((_dom8 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button)) == null ? void 0 : _dom8.contains(previousActiveElementRef.value)) return;
                if ((_dom9 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel)) == null ? void 0 : _dom9.contains(previousActiveElementRef.value)) return; // Check if the last focused element is *after* the button in the DOM

                var focusableElements = (0,_utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.getFocusableElements)();
                var previousIdx = focusableElements.indexOf(previousActiveElementRef.value);
                var buttonIdx = focusableElements.indexOf((0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button));
                if (buttonIdx > previousIdx) return;
                event.preventDefault();
                event.stopPropagation();
                (0,_utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.focusIn)((0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel), _utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.Focus.Last);
              } else {
                event.preventDefault();
                event.stopPropagation();
                (0,_utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.focusIn)((0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel), _utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.Focus.First);
              }

              break;
          }
        }
      },
      handleKeyUp: function handleKeyUp(event) {
        var _dom10, _dom11;

        if (isWithinPanel) return;

        if (event.key === _keyboard_esm_js__WEBPACK_IMPORTED_MODULE_10__.Keys.Space) {
          // Required for firefox, event.preventDefault() in handleKeyDown for
          // the Space key doesn't cancel the handleKeyUp, which in turn
          // triggers a *click*.
          event.preventDefault();
        }

        if (api.popoverState.value !== PopoverStates.Open) return;
        if (!api.panel) return;
        if (!api.button) return; // TODO: Revisit when handling Tab/Shift+Tab when using Portal's

        switch (event.key) {
          case _keyboard_esm_js__WEBPACK_IMPORTED_MODULE_10__.Keys.Tab:
            // Check if the last focused element exists, and check that it is not inside button or panel itself
            if (!previousActiveElementRef.value) return;
            if ((_dom10 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button)) == null ? void 0 : _dom10.contains(previousActiveElementRef.value)) return;
            if ((_dom11 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel)) == null ? void 0 : _dom11.contains(previousActiveElementRef.value)) return; // Check if the last focused element is *after* the button in the DOM

            var focusableElements = (0,_utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.getFocusableElements)();
            var previousIdx = focusableElements.indexOf(previousActiveElementRef.value);
            var buttonIdx = focusableElements.indexOf((0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button));
            if (buttonIdx > previousIdx) return;
            event.preventDefault();
            event.stopPropagation();
            (0,_utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.focusIn)((0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel), _utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.Focus.Last);
            break;
        }
      },
      handleClick: function handleClick() {
        if (props.disabled) return;

        if (isWithinPanel) {
          var _dom12;

          api.closePopover();
          (_dom12 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button)) == null ? void 0 : _dom12.focus(); // Re-focus the original opening Button
        } else {
          var _dom13;

          if (api.popoverState.value === PopoverStates.Closed) closeOthers == null ? void 0 : closeOthers(api.buttonId);
          (_dom13 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button)) == null ? void 0 : _dom13.focus();
          api.togglePopover();
        }
      }
    };
  }
}); // ---

var PopoverOverlay = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({
  name: 'PopoverOverlay',
  props: {
    as: {
      type: [Object, String],
      "default": 'div'
    },
    "static": {
      type: Boolean,
      "default": false
    },
    unmount: {
      type: Boolean,
      "default": true
    }
  },
  render: function render$1() {
    var api = usePopoverContext('PopoverOverlay');
    var slot = {
      open: api.popoverState.value === PopoverStates.Open
    };
    var propsWeControl = {
      id: this.id,
      ref: 'el',
      'aria-hidden': true,
      onClick: this.handleClick
    };
    return (0,_utils_render_esm_js__WEBPACK_IMPORTED_MODULE_7__.render)({
      props: (0,_virtual_rollupPluginBabelHelpers_js__WEBPACK_IMPORTED_MODULE_8__["extends"])({}, this.$props, propsWeControl),
      slot: slot,
      attrs: this.$attrs,
      slots: this.$slots,
      features: _utils_render_esm_js__WEBPACK_IMPORTED_MODULE_7__.Features.RenderStrategy | _utils_render_esm_js__WEBPACK_IMPORTED_MODULE_7__.Features.Static,
      visible: this.visible,
      name: 'PopoverOverlay'
    });
  },
  setup: function setup() {
    var api = usePopoverContext('PopoverOverlay');
    var usesOpenClosedState = (0,_internal_open_closed_esm_js__WEBPACK_IMPORTED_MODULE_4__.useOpenClosed)();
    var visible = (0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(function () {
      if (usesOpenClosedState !== null) {
        return usesOpenClosedState.value === _internal_open_closed_esm_js__WEBPACK_IMPORTED_MODULE_4__.State.Open;
      }

      return api.popoverState.value === PopoverStates.Open;
    });
    return {
      id: "headlessui-popover-overlay-" + (0,_hooks_use_id_esm_js__WEBPACK_IMPORTED_MODULE_1__.useId)(),
      handleClick: function handleClick() {
        api.closePopover();
      },
      visible: visible
    };
  }
}); // ---

var PopoverPanel = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({
  name: 'PopoverPanel',
  props: {
    as: {
      type: [Object, String],
      "default": 'div'
    },
    "static": {
      type: Boolean,
      "default": false
    },
    unmount: {
      type: Boolean,
      "default": true
    },
    focus: {
      type: Boolean,
      "default": false
    }
  },
  render: function render$1() {
    var api = usePopoverContext('PopoverPanel');
    var slot = {
      open: api.popoverState.value === PopoverStates.Open,
      close: api.close
    };
    var propsWeControl = {
      ref: 'el',
      id: this.id,
      onKeydown: this.handleKeyDown
    };
    return (0,_utils_render_esm_js__WEBPACK_IMPORTED_MODULE_7__.render)({
      props: (0,_virtual_rollupPluginBabelHelpers_js__WEBPACK_IMPORTED_MODULE_8__["extends"])({}, this.$props, propsWeControl),
      slot: slot,
      attrs: this.$attrs,
      slots: this.$slots,
      features: _utils_render_esm_js__WEBPACK_IMPORTED_MODULE_7__.Features.RenderStrategy | _utils_render_esm_js__WEBPACK_IMPORTED_MODULE_7__.Features.Static,
      visible: this.visible,
      name: 'PopoverPanel'
    });
  },
  setup: function setup(props) {
    var focus = props.focus;
    var api = usePopoverContext('PopoverPanel');
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.provide)(PopoverPanelContext, api.panelId);
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.onUnmounted)(function () {
      api.panel.value = null;
    }); // Move focus within panel

    (0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(function () {
      var _dom14;

      if (!focus) return;
      if (api.popoverState.value !== PopoverStates.Open) return;
      if (!api.panel) return;
      var activeElement = document.activeElement;
      if ((_dom14 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel)) == null ? void 0 : _dom14.contains(activeElement)) return; // Already focused within Dialog

      (0,_utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.focusIn)((0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel), _utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.Focus.First);
    }); // Handle Tab / Shift+Tab focus positioning

    (0,_hooks_use_window_event_esm_js__WEBPACK_IMPORTED_MODULE_5__.useWindowEvent)('keydown', function (event) {
      var _dom15;

      if (api.popoverState.value !== PopoverStates.Open) return;
      if (!(0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel)) return;
      if (event.key !== _keyboard_esm_js__WEBPACK_IMPORTED_MODULE_10__.Keys.Tab) return;
      if (!document.activeElement) return;
      if (!((_dom15 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel)) == null ? void 0 : _dom15.contains(document.activeElement))) return; // We will take-over the default tab behaviour so that we have a bit
      // control over what is focused next. It will behave exactly the same,
      // but it will also "fix" some issues based on whether you are using a
      // Portal or not.

      event.preventDefault();
      var result = (0,_utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.focusIn)((0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel), event.shiftKey ? _utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.Focus.Previous : _utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.Focus.Next);

      if (result === _utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.FocusResult.Underflow) {
        var _dom16;

        return (_dom16 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button)) == null ? void 0 : _dom16.focus();
      } else if (result === _utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.FocusResult.Overflow) {
        if (!(0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button)) return;
        var elements = (0,_utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.getFocusableElements)();
        var buttonIdx = elements.indexOf((0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button));
        var nextElements = elements.splice(buttonIdx + 1) // Elements after button
        .filter(function (element) {
          var _dom17;

          return !((_dom17 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel)) == null ? void 0 : _dom17.contains(element));
        }); // Ignore items in panel
        // Try to focus the next element, however it could fail if we are in a
        // Portal that happens to be the very last one in the DOM. In that
        // case we would Error (because nothing after the button is
        // focusable). Therefore we will try and focus the very first item in
        // the document.body.

        if ((0,_utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.focusIn)(nextElements, _utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.Focus.First) === _utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.FocusResult.Error) {
          (0,_utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.focusIn)(document.body, _utils_focus_management_esm_js__WEBPACK_IMPORTED_MODULE_6__.Focus.First);
        }
      }
    }); // Handle focus out when we are in special "focus" mode

    (0,_hooks_use_window_event_esm_js__WEBPACK_IMPORTED_MODULE_5__.useWindowEvent)('focus', function () {
      var _dom18;

      if (!focus) return;
      if (api.popoverState.value !== PopoverStates.Open) return;
      if (!(0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel)) return;
      if ((_dom18 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel)) == null ? void 0 : _dom18.contains(document.activeElement)) return;
      api.closePopover();
    }, true);
    var usesOpenClosedState = (0,_internal_open_closed_esm_js__WEBPACK_IMPORTED_MODULE_4__.useOpenClosed)();
    var visible = (0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(function () {
      if (usesOpenClosedState !== null) {
        return usesOpenClosedState.value === _internal_open_closed_esm_js__WEBPACK_IMPORTED_MODULE_4__.State.Open;
      }

      return api.popoverState.value === PopoverStates.Open;
    });
    return {
      id: api.panelId,
      el: api.panel,
      handleKeyDown: function handleKeyDown(event) {
        var _dom19, _dom20;

        switch (event.key) {
          case _keyboard_esm_js__WEBPACK_IMPORTED_MODULE_10__.Keys.Escape:
            if (api.popoverState.value !== PopoverStates.Open) return;
            if (!(0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel)) return;
            if (!((_dom19 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.panel)) == null ? void 0 : _dom19.contains(document.activeElement))) return;
            event.preventDefault();
            event.stopPropagation();
            api.closePopover();
            (_dom20 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(api.button)) == null ? void 0 : _dom20.focus();
            break;
        }
      },
      visible: visible
    };
  }
}); // ---

var PopoverGroup = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({
  name: 'PopoverGroup',
  props: {
    as: {
      type: [Object, String],
      "default": 'div'
    }
  },
  render: function render$1() {
    var propsWeControl = {
      ref: 'el'
    };
    return (0,_utils_render_esm_js__WEBPACK_IMPORTED_MODULE_7__.render)({
      props: (0,_virtual_rollupPluginBabelHelpers_js__WEBPACK_IMPORTED_MODULE_8__["extends"])({}, this.$props, propsWeControl),
      slot: {},
      attrs: this.$attrs,
      slots: this.$slots,
      name: 'PopoverGroup'
    });
  },
  setup: function setup() {
    var groupRef = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var popovers = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)([]);

    function unregisterPopover(registerBag) {
      var idx = popovers.value.indexOf(registerBag);
      if (idx !== -1) popovers.value.splice(idx, 1);
    }

    function registerPopover(registerBag) {
      popovers.value.push(registerBag);
      return function () {
        unregisterPopover(registerBag);
      };
    }

    function isFocusWithinPopoverGroup() {
      var _dom21;

      var element = document.activeElement;
      if ((_dom21 = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_3__.dom)(groupRef)) == null ? void 0 : _dom21.contains(element)) return true; // Check if the focus is in one of the button or panel elements. This is important in case you are rendering inside a Portal.

      return popovers.value.some(function (bag) {
        var _document$getElementB, _document$getElementB2;

        return ((_document$getElementB = document.getElementById(bag.buttonId)) == null ? void 0 : _document$getElementB.contains(element)) || ((_document$getElementB2 = document.getElementById(bag.panelId)) == null ? void 0 : _document$getElementB2.contains(element));
      });
    }

    function closeOthers(buttonId) {
      for (var _iterator = (0,_virtual_rollupPluginBabelHelpers_js__WEBPACK_IMPORTED_MODULE_8__.createForOfIteratorHelperLoose)(popovers.value), _step; !(_step = _iterator()).done;) {
        var popover = _step.value;
        if (popover.buttonId !== buttonId) popover.close();
      }
    }

    (0,vue__WEBPACK_IMPORTED_MODULE_0__.provide)(PopoverGroupContext, {
      registerPopover: registerPopover,
      unregisterPopover: unregisterPopover,
      isFocusWithinPopoverGroup: isFocusWithinPopoverGroup,
      closeOthers: closeOthers
    });
    return {
      el: groupRef
    };
  }
});


//# sourceMappingURL=popover.esm.js.map


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/hooks/use-id.esm.js":
/*!***************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/hooks/use-id.esm.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useId": () => (/* binding */ useId)
/* harmony export */ });
var id = 0;

function generateId() {
  return ++id;
}

function useId() {
  return generateId();
}


//# sourceMappingURL=use-id.esm.js.map


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/hooks/use-resolve-button-type.esm.js":
/*!********************************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/hooks/use-resolve-button-type.esm.js ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useResolveButtonType": () => (/* binding */ useResolveButtonType)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils/dom.esm.js */ "./node_modules/@headlessui/vue/dist/utils/dom.esm.js");



function resolveType(type, as) {
  if (type) return type;
  var tag = as != null ? as : 'button';
  if (typeof tag === 'string' && tag.toLowerCase() === 'button') return 'button';
  return undefined;
}

function useResolveButtonType(data, refElement) {
  var type = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(resolveType(data.value.type, data.value.as));
  (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(function () {
    type.value = resolveType(data.value.type, data.value.as);
  });
  (0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(function () {
    var _dom;

    if (type.value) return;
    if (!(0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_1__.dom)(refElement)) return;

    if ((0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_1__.dom)(refElement) instanceof HTMLButtonElement && !((_dom = (0,_utils_dom_esm_js__WEBPACK_IMPORTED_MODULE_1__.dom)(refElement)) == null ? void 0 : _dom.hasAttribute('type'))) {
      type.value = 'button';
    }
  });
  return type;
}


//# sourceMappingURL=use-resolve-button-type.esm.js.map


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/hooks/use-window-event.esm.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/hooks/use-window-event.esm.js ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useWindowEvent": () => (/* binding */ useWindowEvent)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


function useWindowEvent(type, listener, options) {
  if (typeof window === 'undefined') return;
  (0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(function (onInvalidate) {
    window.addEventListener(type, listener, options);
    onInvalidate(function () {
      window.removeEventListener(type, listener, options);
    });
  });
}


//# sourceMappingURL=use-window-event.esm.js.map


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/internal/open-closed.esm.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/internal/open-closed.esm.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "State": () => (/* binding */ State),
/* harmony export */   "hasOpenClosed": () => (/* binding */ hasOpenClosed),
/* harmony export */   "useOpenClosed": () => (/* binding */ useOpenClosed),
/* harmony export */   "useOpenClosedProvider": () => (/* binding */ useOpenClosedProvider)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


var Context = /*#__PURE__*/Symbol('Context');
var State;

(function (State) {
  State[State["Open"] = 0] = "Open";
  State[State["Closed"] = 1] = "Closed";
})(State || (State = {}));

function hasOpenClosed() {
  return useOpenClosed() !== null;
}
function useOpenClosed() {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(Context, null);
}
function useOpenClosedProvider(value) {
  (0,vue__WEBPACK_IMPORTED_MODULE_0__.provide)(Context, value);
}


//# sourceMappingURL=open-closed.esm.js.map


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/keyboard.esm.js":
/*!***********************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/keyboard.esm.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Keys": () => (/* binding */ Keys)
/* harmony export */ });
// TODO: This must already exist somewhere, right? 🤔
// Ref: https://www.w3.org/TR/uievents-key/#named-key-attribute-values
var Keys;

(function (Keys) {
  Keys["Space"] = " ";
  Keys["Enter"] = "Enter";
  Keys["Escape"] = "Escape";
  Keys["Backspace"] = "Backspace";
  Keys["ArrowLeft"] = "ArrowLeft";
  Keys["ArrowUp"] = "ArrowUp";
  Keys["ArrowRight"] = "ArrowRight";
  Keys["ArrowDown"] = "ArrowDown";
  Keys["Home"] = "Home";
  Keys["End"] = "End";
  Keys["PageUp"] = "PageUp";
  Keys["PageDown"] = "PageDown";
  Keys["Tab"] = "Tab";
})(Keys || (Keys = {}));


//# sourceMappingURL=keyboard.esm.js.map


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/utils/dom.esm.js":
/*!************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/utils/dom.esm.js ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "dom": () => (/* binding */ dom)
/* harmony export */ });
function dom(ref) {
  var _ref$value$$el;

  if (ref == null) return null;
  if (ref.value == null) return null;
  return (_ref$value$$el = ref.value.$el) != null ? _ref$value$$el : ref.value;
}


//# sourceMappingURL=dom.esm.js.map


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/utils/focus-management.esm.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/utils/focus-management.esm.js ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Focus": () => (/* binding */ Focus),
/* harmony export */   "FocusResult": () => (/* binding */ FocusResult),
/* harmony export */   "FocusableMode": () => (/* binding */ FocusableMode),
/* harmony export */   "focusElement": () => (/* binding */ focusElement),
/* harmony export */   "focusIn": () => (/* binding */ focusIn),
/* harmony export */   "getFocusableElements": () => (/* binding */ getFocusableElements),
/* harmony export */   "isFocusableElement": () => (/* binding */ isFocusableElement)
/* harmony export */ });
/* harmony import */ var _match_esm_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./match.esm.js */ "./node_modules/@headlessui/vue/dist/utils/match.esm.js");


//  - https://stackoverflow.com/a/30753870

var focusableSelector = /*#__PURE__*/['[contentEditable=true]', '[tabindex]', 'a[href]', 'area[href]', 'button:not([disabled])', 'iframe', 'input:not([disabled])', 'select:not([disabled])', 'textarea:not([disabled])'].map( false ? // TODO: Remove this once JSDOM fixes the issue where an element that is
// "hidden" can be the document.activeElement, because this is not possible
// in real browsers.
// TODO: Remove this once JSDOM fixes the issue where an element that is
0 : function (selector) {
  return selector + ":not([tabindex='-1'])";
}).join(',');
var Focus;

(function (Focus) {
  /** Focus the first non-disabled element */
  Focus[Focus["First"] = 1] = "First";
  /** Focus the previous non-disabled element */

  Focus[Focus["Previous"] = 2] = "Previous";
  /** Focus the next non-disabled element */

  Focus[Focus["Next"] = 4] = "Next";
  /** Focus the last non-disabled element */

  Focus[Focus["Last"] = 8] = "Last";
  /** Wrap tab around */

  Focus[Focus["WrapAround"] = 16] = "WrapAround";
  /** Prevent scrolling the focusable elements into view */

  Focus[Focus["NoScroll"] = 32] = "NoScroll";
})(Focus || (Focus = {}));

var FocusResult;

(function (FocusResult) {
  FocusResult[FocusResult["Error"] = 0] = "Error";
  FocusResult[FocusResult["Overflow"] = 1] = "Overflow";
  FocusResult[FocusResult["Success"] = 2] = "Success";
  FocusResult[FocusResult["Underflow"] = 3] = "Underflow";
})(FocusResult || (FocusResult = {}));

var Direction;

(function (Direction) {
  Direction[Direction["Previous"] = -1] = "Previous";
  Direction[Direction["Next"] = 1] = "Next";
})(Direction || (Direction = {}));

function getFocusableElements(container) {
  if (container === void 0) {
    container = document.body;
  }

  if (container == null) return [];
  return Array.from(container.querySelectorAll(focusableSelector));
}
var FocusableMode;

(function (FocusableMode) {
  /** The element itself must be focusable. */
  FocusableMode[FocusableMode["Strict"] = 0] = "Strict";
  /** The element should be inside of a focusable element. */

  FocusableMode[FocusableMode["Loose"] = 1] = "Loose";
})(FocusableMode || (FocusableMode = {}));

function isFocusableElement(element, mode) {
  var _match;

  if (mode === void 0) {
    mode = FocusableMode.Strict;
  }

  if (element === document.body) return false;
  return (0,_match_esm_js__WEBPACK_IMPORTED_MODULE_0__.match)(mode, (_match = {}, _match[FocusableMode.Strict] = function () {
    return element.matches(focusableSelector);
  }, _match[FocusableMode.Loose] = function () {
    var next = element;

    while (next !== null) {
      if (next.matches(focusableSelector)) return true;
      next = next.parentElement;
    }

    return false;
  }, _match));
}
function focusElement(element) {
  element == null ? void 0 : element.focus({
    preventScroll: true
  });
}
function focusIn(container, focus) {
  var elements = Array.isArray(container) ? container : getFocusableElements(container);
  var active = document.activeElement;

  var direction = function () {
    if (focus & (Focus.First | Focus.Next)) return Direction.Next;
    if (focus & (Focus.Previous | Focus.Last)) return Direction.Previous;
    throw new Error('Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last');
  }();

  var startIndex = function () {
    if (focus & Focus.First) return 0;
    if (focus & Focus.Previous) return Math.max(0, elements.indexOf(active)) - 1;
    if (focus & Focus.Next) return Math.max(0, elements.indexOf(active)) + 1;
    if (focus & Focus.Last) return elements.length - 1;
    throw new Error('Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last');
  }();

  var focusOptions = focus & Focus.NoScroll ? {
    preventScroll: true
  } : {};
  var offset = 0;
  var total = elements.length;
  var next = undefined;

  do {
    var _next;

    // Guard against infinite loops
    if (offset >= total || offset + total <= 0) return FocusResult.Error;
    var nextIdx = startIndex + offset;

    if (focus & Focus.WrapAround) {
      nextIdx = (nextIdx + total) % total;
    } else {
      if (nextIdx < 0) return FocusResult.Underflow;
      if (nextIdx >= total) return FocusResult.Overflow;
    }

    next = elements[nextIdx]; // Try the focus the next element, might not work if it is "hidden" to the user.

    (_next = next) == null ? void 0 : _next.focus(focusOptions); // Try the next one in line

    offset += direction;
  } while (next !== document.activeElement); // This is a little weird, but let me try and explain: There are a few scenario's
  // in chrome for example where a focused `<a>` tag does not get the default focus
  // styles and sometimes they do. This highly depends on whether you started by
  // clicking or by using your keyboard. When you programmatically add focus `anchor.focus()`
  // then the active element (document.activeElement) is this anchor, which is expected.
  // However in that case the default focus styles are not applied *unless* you
  // also add this tabindex.


  if (!next.hasAttribute('tabindex')) next.setAttribute('tabindex', '0');
  return FocusResult.Success;
}


//# sourceMappingURL=focus-management.esm.js.map


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/utils/match.esm.js":
/*!**************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/utils/match.esm.js ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "match": () => (/* binding */ match)
/* harmony export */ });
function match(value, lookup) {
  if (value in lookup) {
    var returnValue = lookup[value];

    for (var _len = arguments.length, args = new Array(_len > 2 ? _len - 2 : 0), _key = 2; _key < _len; _key++) {
      args[_key - 2] = arguments[_key];
    }

    return typeof returnValue === 'function' ? returnValue.apply(void 0, args) : returnValue;
  }

  var error = new Error("Tried to handle \"" + value + "\" but there is no handler defined. Only defined handlers are: " + Object.keys(lookup).map(function (key) {
    return "\"" + key + "\"";
  }).join(', ') + ".");
  if (Error.captureStackTrace) Error.captureStackTrace(error, match);
  throw error;
}


//# sourceMappingURL=match.esm.js.map


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/utils/render.esm.js":
/*!***************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/utils/render.esm.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Features": () => (/* binding */ Features),
/* harmony export */   "RenderStrategy": () => (/* binding */ RenderStrategy),
/* harmony export */   "omit": () => (/* binding */ omit),
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var _virtual_rollupPluginBabelHelpers_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../_virtual/_rollupPluginBabelHelpers.js */ "./node_modules/@headlessui/vue/dist/_virtual/_rollupPluginBabelHelpers.js");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _match_esm_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./match.esm.js */ "./node_modules/@headlessui/vue/dist/utils/match.esm.js");




var Features;

(function (Features) {
  /** No features at all */
  Features[Features["None"] = 0] = "None";
  /**
   * When used, this will allow us to use one of the render strategies.
   *
   * **The render strategies are:**
   *    - **Unmount**   _(Will unmount the component.)_
   *    - **Hidden**    _(Will hide the component using the [hidden] attribute.)_
   */

  Features[Features["RenderStrategy"] = 1] = "RenderStrategy";
  /**
   * When used, this will allow the user of our component to be in control. This can be used when
   * you want to transition based on some state.
   */

  Features[Features["Static"] = 2] = "Static";
})(Features || (Features = {}));

var RenderStrategy;

(function (RenderStrategy) {
  RenderStrategy[RenderStrategy["Unmount"] = 0] = "Unmount";
  RenderStrategy[RenderStrategy["Hidden"] = 1] = "Hidden";
})(RenderStrategy || (RenderStrategy = {}));

function render(_ref) {
  var _ref$visible = _ref.visible,
      visible = _ref$visible === void 0 ? true : _ref$visible,
      _ref$features = _ref.features,
      features = _ref$features === void 0 ? Features.None : _ref$features,
      main = (0,_virtual_rollupPluginBabelHelpers_js__WEBPACK_IMPORTED_MODULE_1__.objectWithoutPropertiesLoose)(_ref, ["visible", "features"]);

  // Visible always render
  if (visible) return _render(main);

  if (features & Features.Static) {
    // When the `static` prop is passed as `true`, then the user is in control, thus we don't care about anything else
    if (main.props["static"]) return _render(main);
  }

  if (features & Features.RenderStrategy) {
    var _main$props$unmount, _match;

    var strategy = ((_main$props$unmount = main.props.unmount) != null ? _main$props$unmount : true) ? RenderStrategy.Unmount : RenderStrategy.Hidden;
    return (0,_match_esm_js__WEBPACK_IMPORTED_MODULE_2__.match)(strategy, (_match = {}, _match[RenderStrategy.Unmount] = function () {
      return null;
    }, _match[RenderStrategy.Hidden] = function () {
      return _render((0,_virtual_rollupPluginBabelHelpers_js__WEBPACK_IMPORTED_MODULE_1__["extends"])({}, main, {
        props: (0,_virtual_rollupPluginBabelHelpers_js__WEBPACK_IMPORTED_MODULE_1__["extends"])({}, main.props, {
          hidden: true,
          style: {
            display: 'none'
          }
        })
      }));
    }, _match));
  } // No features enabled, just render


  return _render(main);
}

function _render(_ref2) {
  var props = _ref2.props,
      attrs = _ref2.attrs,
      slots = _ref2.slots,
      slot = _ref2.slot,
      name = _ref2.name;

  var _omit = omit(props, ['unmount', 'static']),
      as = _omit.as,
      passThroughProps = (0,_virtual_rollupPluginBabelHelpers_js__WEBPACK_IMPORTED_MODULE_1__.objectWithoutPropertiesLoose)(_omit, ["as"]);

  var children = slots["default"] == null ? void 0 : slots["default"](slot);

  if (as === 'template') {
    if (Object.keys(passThroughProps).length > 0 || Object.keys(attrs).length > 0) {
      var _ref3 = children != null ? children : [],
          firstChild = _ref3[0],
          other = _ref3.slice(1);

      if (!isValidElement(firstChild) || other.length > 0) {
        throw new Error(['Passing props on "template"!', '', "The current component <" + name + " /> is rendering a \"template\".", "However we need to passthrough the following props:", Object.keys(passThroughProps).concat(Object.keys(attrs)).map(function (line) {
          return "  - " + line;
        }).join('\n'), '', 'You can apply a few solutions:', ['Add an `as="..."` prop, to ensure that we render an actual element instead of a "template".', 'Render a single element as the child so that we can forward the props onto that element.'].map(function (line) {
          return "  - " + line;
        }).join('\n')].join('\n'));
      }

      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.cloneVNode)(firstChild, passThroughProps);
    }

    if (Array.isArray(children) && children.length === 1) {
      return children[0];
    }

    return children;
  }

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(as, passThroughProps, children);
}

function omit(object, keysToOmit) {
  if (keysToOmit === void 0) {
    keysToOmit = [];
  }

  var clone = Object.assign({}, object);

  for (var _iterator = (0,_virtual_rollupPluginBabelHelpers_js__WEBPACK_IMPORTED_MODULE_1__.createForOfIteratorHelperLoose)(keysToOmit), _step; !(_step = _iterator()).done;) {
    var key = _step.value;
    if (key in clone) delete clone[key];
  }

  return clone;
}

function isValidElement(input) {
  if (input == null) return false; // No children

  if (typeof input.type === 'string') return true; // 'div', 'span', ...

  if (typeof input.type === 'object') return true; // Other components

  if (typeof input.type === 'function') return true; // Built-ins like Transition

  return false; // Comments, strings, ...
}


//# sourceMappingURL=render.esm.js.map


/***/ }),

/***/ "./node_modules/@vueform/slider/dist/slider.js":
/*!*****************************************************!*\
  !*** ./node_modules/@vueform/slider/dist/slider.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
function u(t){return-1!==[null,void 0,!1].indexOf(t)}function c(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function p(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?c(Object(r),!0).forEach((function(e){f(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):c(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function f(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}"undefined"!=typeof globalThis?globalThis:"undefined"!=typeof window?window:"undefined"!=typeof __webpack_require__.g?__webpack_require__.g:"undefined"!=typeof self&&self;function d(t){return t&&t.__esModule&&Object.prototype.hasOwnProperty.call(t,"default")?t.default:t}function h(t){var e={exports:{}};return t(e,e.exports),e.exports}function m(t){return(m="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}var v=h((function(t,e){t.exports=function(){var t=["decimals","thousand","mark","prefix","suffix","encoder","decoder","negativeBefore","negative","edit","undo"];function e(t){return t.split("").reverse().join("")}function r(t,e){return t.substring(0,e.length)===e}function n(t,e){return t.slice(-1*e.length)===e}function i(t,e,r){if((t[e]||t[r])&&t[e]===t[r])throw new Error(e)}function o(t){return"number"==typeof t&&isFinite(t)}function a(t,e){return t=t.toString().split("e"),(+((t=(t=Math.round(+(t[0]+"e"+(t[1]?+t[1]+e:e)))).toString().split("e"))[0]+"e"+(t[1]?+t[1]-e:-e))).toFixed(e)}function s(t,r,n,i,s,l,u,c,p,f,d,h){var m,v,g,b=h,y="",S="";return l&&(h=l(h)),!!o(h)&&(!1!==t&&0===parseFloat(h.toFixed(t))&&(h=0),h<0&&(m=!0,h=Math.abs(h)),!1!==t&&(h=a(h,t)),-1!==(h=h.toString()).indexOf(".")?(g=(v=h.split("."))[0],n&&(y=n+v[1])):g=h,r&&(g=e(g).match(/.{1,3}/g),g=e(g.join(e(r)))),m&&c&&(S+=c),i&&(S+=i),m&&p&&(S+=p),S+=g,S+=y,s&&(S+=s),f&&(S=f(S,b)),S)}function l(t,e,i,a,s,l,u,c,p,f,d,h){var m,v="";return d&&(h=d(h)),!(!h||"string"!=typeof h)&&(c&&r(h,c)&&(h=h.replace(c,""),m=!0),a&&r(h,a)&&(h=h.replace(a,"")),p&&r(h,p)&&(h=h.replace(p,""),m=!0),s&&n(h,s)&&(h=h.slice(0,-1*s.length)),e&&(h=h.split(e).join("")),i&&(h=h.replace(i,".")),m&&(v+="-"),""!==(v=(v+=h).replace(/[^0-9\.\-.]/g,""))&&(v=Number(v),u&&(v=u(v)),!!o(v)&&v))}function u(e){var r,n,o,a={};for(void 0===e.suffix&&(e.suffix=e.postfix),r=0;r<t.length;r+=1)if(void 0===(o=e[n=t[r]]))"negative"!==n||a.negativeBefore?"mark"===n&&"."!==a.thousand?a[n]=".":a[n]=!1:a[n]="-";else if("decimals"===n){if(!(o>=0&&o<8))throw new Error(n);a[n]=o}else if("encoder"===n||"decoder"===n||"edit"===n||"undo"===n){if("function"!=typeof o)throw new Error(n);a[n]=o}else{if("string"!=typeof o)throw new Error(n);a[n]=o}return i(a,"mark","thousand"),i(a,"prefix","negative"),i(a,"prefix","negativeBefore"),a}function c(e,r,n){var i,o=[];for(i=0;i<t.length;i+=1)o.push(e[t[i]]);return o.push(n),r.apply("",o)}function p(t){if(!(this instanceof p))return new p(t);"object"===m(t)&&(t=u(t),this.to=function(e){return c(t,s,e)},this.from=function(e){return c(t,l,e)})}return p}()}));function g(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function b(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}function y(e,n,i){var o=(0,vue__WEBPACK_IMPORTED_MODULE_0__.toRefs)(e),a=o.format,s=o.step,l=i.value,u=i.classList,c=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)((function(){return a&&a.value?"function"==typeof a.value?{to:a.value}:v(function(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?g(Object(r),!0).forEach((function(e){b(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):g(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}({},a.value)):v({decimals:s.value>=0?0:2})}));return{tooltipsFormat:(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)((function(){return Array.isArray(l.value)?l.value.map((function(t){return c.value})):c.value})),tooltipsMerge:function(t,e,r){var n="rtl"===getComputedStyle(t).direction,i="rtl"===t.noUiSlider.options.direction,o="vertical"===t.noUiSlider.options.orientation,a=t.noUiSlider.getTooltips(),s=t.noUiSlider.getOrigins();a.forEach((function(t,e){t&&s[e].appendChild(t)})),t.noUiSlider.on("update",(function(t,s,l,p,f){var d=[[]],h=[[]],m=[[]],v=0;a[0]&&(d[0][0]=0,h[0][0]=f[0],m[0][0]=c.value.to(parseFloat(t[0])));for(var g=1;g<t.length;g++)(!a[g]||t[g]-t[g-1]>e)&&(d[++v]=[],m[v]=[],h[v]=[]),a[g]&&(d[v].push(g),m[v].push(c.value.to(parseFloat(t[g]))),h[v].push(f[g]));d.forEach((function(t,e){for(var s=t.length,l=0;l<s;l++){var c=t[l];if(l===s-1){var p=0;h[e].forEach((function(t){p+=1e3-10*t}));var f=o?"bottom":"right",d=i?0:s-1,v=1e3-10*h[e][d];p=(n&&!o?100:0)+p/s-v,a[c].innerHTML=m[e].join(r),a[c].style.display="block",a[c].style[f]=p+"%",a[c].classList.contains(u.value.tooltipHidden)&&a[c].classList.remove(u.value.tooltipHidden)}else a[c].style.display="none",a[c].classList.add(u.value.tooltipHidden)}}))}))}}}function S(t){return(S="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}var x=d(h((function(t,e){!function(t){function e(t){return r(t)&&"function"==typeof t.from}function r(t){return"object"===S(t)&&"function"==typeof t.to}function n(t){t.parentElement.removeChild(t)}function i(t){return null!=t}function o(t){t.preventDefault()}function a(t){return t.filter((function(t){return!this[t]&&(this[t]=!0)}),{})}function s(t,e){return Math.round(t/e)*e}function l(t,e){var r=t.getBoundingClientRect(),n=t.ownerDocument,i=n.documentElement,o=g(n);return/webkit.*Chrome.*Mobile/i.test(navigator.userAgent)&&(o.x=0),e?r.top+o.y-i.clientTop:r.left+o.x-i.clientLeft}function u(t){return"number"==typeof t&&!isNaN(t)&&isFinite(t)}function c(t,e,r){r>0&&(h(t,e),setTimeout((function(){m(t,e)}),r))}function p(t){return Math.max(Math.min(t,100),0)}function f(t){return Array.isArray(t)?t:[t]}function d(t){var e=(t=String(t)).split(".");return e.length>1?e[1].length:0}function h(t,e){t.classList&&!/\s/.test(e)?t.classList.add(e):t.className+=" "+e}function m(t,e){t.classList&&!/\s/.test(e)?t.classList.remove(e):t.className=t.className.replace(new RegExp("(^|\\b)"+e.split(" ").join("|")+"(\\b|$)","gi")," ")}function v(t,e){return t.classList?t.classList.contains(e):new RegExp("\\b"+e+"\\b").test(t.className)}function g(t){var e=void 0!==window.pageXOffset,r="CSS1Compat"===(t.compatMode||"");return{x:e?window.pageXOffset:r?t.documentElement.scrollLeft:t.body.scrollLeft,y:e?window.pageYOffset:r?t.documentElement.scrollTop:t.body.scrollTop}}function b(){return window.navigator.pointerEnabled?{start:"pointerdown",move:"pointermove",end:"pointerup"}:window.navigator.msPointerEnabled?{start:"MSPointerDown",move:"MSPointerMove",end:"MSPointerUp"}:{start:"mousedown touchstart",move:"mousemove touchmove",end:"mouseup touchend"}}function y(){var t=!1;try{var e=Object.defineProperty({},"passive",{get:function(){t=!0}});window.addEventListener("test",null,e)}catch(t){}return t}function x(){return window.CSS&&CSS.supports&&CSS.supports("touch-action","none")}function w(t,e){return 100/(e-t)}function P(t,e,r){return 100*e/(t[r+1]-t[r])}function E(t,e){return P(t,t[0]<0?e+Math.abs(t[0]):e-t[0],0)}function N(t,e){return e*(t[1]-t[0])/100+t[0]}function C(t,e){for(var r=1;t>=e[r];)r+=1;return r}function O(t,e,r){if(r>=t.slice(-1)[0])return 100;var n=C(r,t),i=t[n-1],o=t[n],a=e[n-1],s=e[n];return a+E([i,o],r)/w(a,s)}function k(t,e,r){if(r>=100)return t.slice(-1)[0];var n=C(r,e),i=t[n-1],o=t[n],a=e[n-1];return N([i,o],(r-a)*w(a,e[n]))}function V(t,e,r,n){if(100===n)return n;var i=C(n,t),o=t[i-1],a=t[i];return r?n-o>(a-o)/2?a:o:e[i-1]?t[i-1]+s(n-t[i-1],e[i-1]):n}var A,M;t.PipsMode=void 0,(M=t.PipsMode||(t.PipsMode={})).Range="range",M.Steps="steps",M.Positions="positions",M.Count="count",M.Values="values",t.PipsType=void 0,(A=t.PipsType||(t.PipsType={}))[A.None=-1]="None",A[A.NoValue=0]="NoValue",A[A.LargeValue=1]="LargeValue",A[A.SmallValue=2]="SmallValue";var j=function(){function t(t,e,r){var n;this.xPct=[],this.xVal=[],this.xSteps=[],this.xNumSteps=[],this.xHighestCompleteStep=[],this.xSteps=[r||!1],this.xNumSteps=[!1],this.snap=e;var i=[];for(Object.keys(t).forEach((function(e){i.push([f(t[e]),e])})),i.sort((function(t,e){return t[0][0]-e[0][0]})),n=0;n<i.length;n++)this.handleEntryPoint(i[n][1],i[n][0]);for(this.xNumSteps=this.xSteps.slice(0),n=0;n<this.xNumSteps.length;n++)this.handleStepPoint(n,this.xNumSteps[n])}return t.prototype.getDistance=function(t){var e,r=[];for(e=0;e<this.xNumSteps.length-1;e++){var n=this.xNumSteps[e];if(n&&t/n%1!=0)throw new Error("noUiSlider: 'limit', 'margin' and 'padding' of "+this.xPct[e]+"% range must be divisible by step.");r[e]=P(this.xVal,t,e)}return r},t.prototype.getAbsoluteDistance=function(t,e,r){var n,i=0;if(t<this.xPct[this.xPct.length-1])for(;t>this.xPct[i+1];)i++;else t===this.xPct[this.xPct.length-1]&&(i=this.xPct.length-2);r||t!==this.xPct[i+1]||i++,null===e&&(e=[]);var o=1,a=e[i],s=0,l=0,u=0,c=0;for(n=r?(t-this.xPct[i])/(this.xPct[i+1]-this.xPct[i]):(this.xPct[i+1]-t)/(this.xPct[i+1]-this.xPct[i]);a>0;)s=this.xPct[i+1+c]-this.xPct[i+c],e[i+c]*o+100-100*n>100?(l=s*n,o=(a-100*n)/e[i+c],n=1):(l=e[i+c]*s/100*o,o=0),r?(u-=l,this.xPct.length+c>=1&&c--):(u+=l,this.xPct.length-c>=1&&c++),a=e[i+c]*o;return t+u},t.prototype.toStepping=function(t){return t=O(this.xVal,this.xPct,t)},t.prototype.fromStepping=function(t){return k(this.xVal,this.xPct,t)},t.prototype.getStep=function(t){return t=V(this.xPct,this.xSteps,this.snap,t)},t.prototype.getDefaultStep=function(t,e,r){var n=C(t,this.xPct);return(100===t||e&&t===this.xPct[n-1])&&(n=Math.max(n-1,1)),(this.xVal[n]-this.xVal[n-1])/r},t.prototype.getNearbySteps=function(t){var e=C(t,this.xPct);return{stepBefore:{startValue:this.xVal[e-2],step:this.xNumSteps[e-2],highestStep:this.xHighestCompleteStep[e-2]},thisStep:{startValue:this.xVal[e-1],step:this.xNumSteps[e-1],highestStep:this.xHighestCompleteStep[e-1]},stepAfter:{startValue:this.xVal[e],step:this.xNumSteps[e],highestStep:this.xHighestCompleteStep[e]}}},t.prototype.countStepDecimals=function(){var t=this.xNumSteps.map(d);return Math.max.apply(null,t)},t.prototype.hasNoSize=function(){return this.xVal[0]===this.xVal[this.xVal.length-1]},t.prototype.convert=function(t){return this.getStep(this.toStepping(t))},t.prototype.handleEntryPoint=function(t,e){var r;if(!u(r="min"===t?0:"max"===t?100:parseFloat(t))||!u(e[0]))throw new Error("noUiSlider: 'range' value isn't numeric.");this.xPct.push(r),this.xVal.push(e[0]);var n=Number(e[1]);r?this.xSteps.push(!isNaN(n)&&n):isNaN(n)||(this.xSteps[0]=n),this.xHighestCompleteStep.push(0)},t.prototype.handleStepPoint=function(t,e){if(e)if(this.xVal[t]!==this.xVal[t+1]){this.xSteps[t]=P([this.xVal[t],this.xVal[t+1]],e,0)/w(this.xPct[t],this.xPct[t+1]);var r=(this.xVal[t+1]-this.xVal[t])/this.xNumSteps[t],n=Math.ceil(Number(r.toFixed(3))-1),i=this.xVal[t]+this.xNumSteps[t]*n;this.xHighestCompleteStep[t]=i}else this.xSteps[t]=this.xHighestCompleteStep[t]=this.xVal[t]},t}(),U={to:function(t){return void 0===t?"":t.toFixed(2)},from:Number},D={target:"target",base:"base",origin:"origin",handle:"handle",handleLower:"handle-lower",handleUpper:"handle-upper",touchArea:"touch-area",horizontal:"horizontal",vertical:"vertical",background:"background",connect:"connect",connects:"connects",ltr:"ltr",rtl:"rtl",textDirectionLtr:"txt-dir-ltr",textDirectionRtl:"txt-dir-rtl",draggable:"draggable",drag:"state-drag",tap:"state-tap",active:"active",tooltip:"tooltip",pips:"pips",pipsHorizontal:"pips-horizontal",pipsVertical:"pips-vertical",marker:"marker",markerHorizontal:"marker-horizontal",markerVertical:"marker-vertical",markerNormal:"marker-normal",markerLarge:"marker-large",markerSub:"marker-sub",value:"value",valueHorizontal:"value-horizontal",valueVertical:"value-vertical",valueNormal:"value-normal",valueLarge:"value-large",valueSub:"value-sub"},L={tooltips:".__tooltips",aria:".__aria"};function T(t,e){if(!u(e))throw new Error("noUiSlider: 'step' is not numeric.");t.singleStep=e}function F(t,e){if(!u(e))throw new Error("noUiSlider: 'keyboardPageMultiplier' is not numeric.");t.keyboardPageMultiplier=e}function z(t,e){if(!u(e))throw new Error("noUiSlider: 'keyboardMultiplier' is not numeric.");t.keyboardMultiplier=e}function H(t,e){if(!u(e))throw new Error("noUiSlider: 'keyboardDefaultStep' is not numeric.");t.keyboardDefaultStep=e}function q(t,e){if("object"!==S(e)||Array.isArray(e))throw new Error("noUiSlider: 'range' is not an object.");if(void 0===e.min||void 0===e.max)throw new Error("noUiSlider: Missing 'min' or 'max' in 'range'.");t.spectrum=new j(e,t.snap||!1,t.singleStep)}function R(t,e){if(e=f(e),!Array.isArray(e)||!e.length)throw new Error("noUiSlider: 'start' option is incorrect.");t.handles=e.length,t.start=e}function B(t,e){if("boolean"!=typeof e)throw new Error("noUiSlider: 'snap' option must be a boolean.");t.snap=e}function _(t,e){if("boolean"!=typeof e)throw new Error("noUiSlider: 'animate' option must be a boolean.");t.animate=e}function X(t,e){if("number"!=typeof e)throw new Error("noUiSlider: 'animationDuration' option must be a number.");t.animationDuration=e}function Y(t,e){var r,n=[!1];if("lower"===e?e=[!0,!1]:"upper"===e&&(e=[!1,!0]),!0===e||!1===e){for(r=1;r<t.handles;r++)n.push(e);n.push(!1)}else{if(!Array.isArray(e)||!e.length||e.length!==t.handles+1)throw new Error("noUiSlider: 'connect' option doesn't match handle count.");n=e}t.connect=n}function I(t,e){switch(e){case"horizontal":t.ort=0;break;case"vertical":t.ort=1;break;default:throw new Error("noUiSlider: 'orientation' option is invalid.")}}function $(t,e){if(!u(e))throw new Error("noUiSlider: 'margin' option must be numeric.");0!==e&&(t.margin=t.spectrum.getDistance(e))}function W(t,e){if(!u(e))throw new Error("noUiSlider: 'limit' option must be numeric.");if(t.limit=t.spectrum.getDistance(e),!t.limit||t.handles<2)throw new Error("noUiSlider: 'limit' option is only supported on linear sliders with 2 or more handles.")}function G(t,e){var r;if(!u(e)&&!Array.isArray(e))throw new Error("noUiSlider: 'padding' option must be numeric or array of exactly 2 numbers.");if(Array.isArray(e)&&2!==e.length&&!u(e[0])&&!u(e[1]))throw new Error("noUiSlider: 'padding' option must be numeric or array of exactly 2 numbers.");if(0!==e){for(Array.isArray(e)||(e=[e,e]),t.padding=[t.spectrum.getDistance(e[0]),t.spectrum.getDistance(e[1])],r=0;r<t.spectrum.xNumSteps.length-1;r++)if(t.padding[0][r]<0||t.padding[1][r]<0)throw new Error("noUiSlider: 'padding' option must be a positive number(s).");var n=e[0]+e[1],i=t.spectrum.xVal[0];if(n/(t.spectrum.xVal[t.spectrum.xVal.length-1]-i)>1)throw new Error("noUiSlider: 'padding' option must not exceed 100% of the range.")}}function J(t,e){switch(e){case"ltr":t.dir=0;break;case"rtl":t.dir=1;break;default:throw new Error("noUiSlider: 'direction' option was not recognized.")}}function K(t,e){if("string"!=typeof e)throw new Error("noUiSlider: 'behaviour' must be a string containing options.");var r=e.indexOf("tap")>=0,n=e.indexOf("drag")>=0,i=e.indexOf("fixed")>=0,o=e.indexOf("snap")>=0,a=e.indexOf("hover")>=0,s=e.indexOf("unconstrained")>=0,l=e.indexOf("drag-all")>=0;if(i){if(2!==t.handles)throw new Error("noUiSlider: 'fixed' behaviour must be used with 2 handles");$(t,t.start[1]-t.start[0])}if(s&&(t.margin||t.limit))throw new Error("noUiSlider: 'unconstrained' behaviour cannot be used with margin or limit");t.events={tap:r||o,drag:n,dragAll:l,fixed:i,snap:o,hover:a,unconstrained:s}}function Q(t,e){if(!1!==e)if(!0===e||r(e)){t.tooltips=[];for(var n=0;n<t.handles;n++)t.tooltips.push(e)}else{if((e=f(e)).length!==t.handles)throw new Error("noUiSlider: must pass a formatter for all handles.");e.forEach((function(t){if("boolean"!=typeof t&&!r(t))throw new Error("noUiSlider: 'tooltips' must be passed a formatter or 'false'.")})),t.tooltips=e}}function Z(t,e){if(e.length!==t.handles)throw new Error("noUiSlider: must pass a attributes for all handles.");t.handleAttributes=e}function tt(t,e){if(!r(e))throw new Error("noUiSlider: 'ariaFormat' requires 'to' method.");t.ariaFormat=e}function et(t,r){if(!e(r))throw new Error("noUiSlider: 'format' requires 'to' and 'from' methods.");t.format=r}function rt(t,e){if("boolean"!=typeof e)throw new Error("noUiSlider: 'keyboardSupport' option must be a boolean.");t.keyboardSupport=e}function nt(t,e){t.documentElement=e}function it(t,e){if("string"!=typeof e&&!1!==e)throw new Error("noUiSlider: 'cssPrefix' must be a string or `false`.");t.cssPrefix=e}function ot(t,e){if("object"!==S(e))throw new Error("noUiSlider: 'cssClasses' must be an object.");"string"==typeof t.cssPrefix?(t.cssClasses={},Object.keys(e).forEach((function(r){t.cssClasses[r]=t.cssPrefix+e[r]}))):t.cssClasses=e}function at(t){var e={margin:null,limit:null,padding:null,animate:!0,animationDuration:300,ariaFormat:U,format:U},r={step:{r:!1,t:T},keyboardPageMultiplier:{r:!1,t:F},keyboardMultiplier:{r:!1,t:z},keyboardDefaultStep:{r:!1,t:H},start:{r:!0,t:R},connect:{r:!0,t:Y},direction:{r:!0,t:J},snap:{r:!1,t:B},animate:{r:!1,t:_},animationDuration:{r:!1,t:X},range:{r:!0,t:q},orientation:{r:!1,t:I},margin:{r:!1,t:$},limit:{r:!1,t:W},padding:{r:!1,t:G},behaviour:{r:!0,t:K},ariaFormat:{r:!1,t:tt},format:{r:!1,t:et},tooltips:{r:!1,t:Q},keyboardSupport:{r:!0,t:rt},documentElement:{r:!1,t:nt},cssPrefix:{r:!0,t:it},cssClasses:{r:!0,t:ot},handleAttributes:{r:!1,t:Z}},n={connect:!1,direction:"ltr",behaviour:"tap",orientation:"horizontal",keyboardSupport:!0,cssPrefix:"noUi-",cssClasses:D,keyboardPageMultiplier:5,keyboardMultiplier:1,keyboardDefaultStep:10};t.format&&!t.ariaFormat&&(t.ariaFormat=t.format),Object.keys(r).forEach((function(o){if(i(t[o])||void 0!==n[o])r[o].t(e,i(t[o])?t[o]:n[o]);else if(r[o].r)throw new Error("noUiSlider: '"+o+"' is required.")})),e.pips=t.pips;var o=document.createElement("div"),a=void 0!==o.style.msTransform,s=void 0!==o.style.transform;e.transformRule=s?"transform":a?"msTransform":"webkitTransform";var l=[["left","top"],["right","bottom"]];return e.style=l[e.dir][e.ort],e}function st(e,r,s){var u,d,S,w,P,E=b(),N=x()&&y(),C=e,O=r.spectrum,k=[],V=[],A=[],M=0,j={},U=e.ownerDocument,D=r.documentElement||U.documentElement,T=U.body,F="rtl"===U.dir||1===r.ort?0:100;function z(t,e){var r=U.createElement("div");return e&&h(r,e),t.appendChild(r),r}function H(t,e){var n=z(t,r.cssClasses.origin),i=z(n,r.cssClasses.handle);if(z(i,r.cssClasses.touchArea),i.setAttribute("data-handle",String(e)),r.keyboardSupport&&(i.setAttribute("tabindex","0"),i.addEventListener("keydown",(function(t){return dt(t,e)}))),void 0!==r.handleAttributes){var o=r.handleAttributes[e];Object.keys(o).forEach((function(t){i.setAttribute(t,o[t])}))}return i.setAttribute("role","slider"),i.setAttribute("aria-orientation",r.ort?"vertical":"horizontal"),0===e?h(i,r.cssClasses.handleLower):e===r.handles-1&&h(i,r.cssClasses.handleUpper),n}function q(t,e){return!!e&&z(t,r.cssClasses.connect)}function R(t,e){var n=z(e,r.cssClasses.connects);d=[],(S=[]).push(q(n,t[0]));for(var i=0;i<r.handles;i++)d.push(H(e,i)),A[i]=i,S.push(q(n,t[i+1]))}function B(t){return h(t,r.cssClasses.target),0===r.dir?h(t,r.cssClasses.ltr):h(t,r.cssClasses.rtl),0===r.ort?h(t,r.cssClasses.horizontal):h(t,r.cssClasses.vertical),h(t,"rtl"===getComputedStyle(t).direction?r.cssClasses.textDirectionRtl:r.cssClasses.textDirectionLtr),z(t,r.cssClasses.base)}function _(t,e){return!(!r.tooltips||!r.tooltips[e])&&z(t.firstChild,r.cssClasses.tooltip)}function X(){return C.hasAttribute("disabled")}function Y(t){return d[t].hasAttribute("disabled")}function I(){P&&(gt("update"+L.tooltips),P.forEach((function(t){t&&n(t)})),P=null)}function $(){I(),P=d.map(_),mt("update"+L.tooltips,(function(t,e,n){if(P&&r.tooltips&&!1!==P[e]){var i=t[e];!0!==r.tooltips[e]&&(i=r.tooltips[e].to(n[e])),P[e].innerHTML=i}}))}function W(){gt("update"+L.aria),mt("update"+L.aria,(function(t,e,n,i,o){A.forEach((function(t){var e=d[t],i=yt(V,t,0,!0,!0,!0),a=yt(V,t,100,!0,!0,!0),s=o[t],l=String(r.ariaFormat.to(n[t]));i=O.fromStepping(i).toFixed(1),a=O.fromStepping(a).toFixed(1),s=O.fromStepping(s).toFixed(1),e.children[0].setAttribute("aria-valuemin",i),e.children[0].setAttribute("aria-valuemax",a),e.children[0].setAttribute("aria-valuenow",s),e.children[0].setAttribute("aria-valuetext",l)}))}))}function G(e){if(e.mode===t.PipsMode.Range||e.mode===t.PipsMode.Steps)return O.xVal;if(e.mode===t.PipsMode.Count){if(e.values<2)throw new Error("noUiSlider: 'values' (>= 2) required for mode 'count'.");for(var r=e.values-1,n=100/r,i=[];r--;)i[r]=r*n;return i.push(100),J(i,e.stepped)}return e.mode===t.PipsMode.Positions?J(e.values,e.stepped):e.mode===t.PipsMode.Values?e.stepped?e.values.map((function(t){return O.fromStepping(O.getStep(O.toStepping(t)))})):e.values:[]}function J(t,e){return t.map((function(t){return O.fromStepping(e?O.getStep(t):t)}))}function K(e){function r(t,e){return Number((t+e).toFixed(7))}var n=G(e),i={},o=O.xVal[0],s=O.xVal[O.xVal.length-1],l=!1,u=!1,c=0;return(n=a(n.slice().sort((function(t,e){return t-e}))))[0]!==o&&(n.unshift(o),l=!0),n[n.length-1]!==s&&(n.push(s),u=!0),n.forEach((function(o,a){var s,p,f,d,h,m,v,g,b,y,S=o,x=n[a+1],w=e.mode===t.PipsMode.Steps;for(w&&(s=O.xNumSteps[a]),s||(s=x-S),void 0===x&&(x=S),s=Math.max(s,1e-7),p=S;p<=x;p=r(p,s)){for(g=(h=(d=O.toStepping(p))-c)/(e.density||1),y=h/(b=Math.round(g)),f=1;f<=b;f+=1)i[(m=c+f*y).toFixed(5)]=[O.fromStepping(m),0];v=n.indexOf(p)>-1?t.PipsType.LargeValue:w?t.PipsType.SmallValue:t.PipsType.NoValue,!a&&l&&p!==x&&(v=0),p===x&&u||(i[d.toFixed(5)]=[p,v]),c=d}})),i}function Q(e,n,i){var o,a,s=U.createElement("div"),l=((o={})[t.PipsType.None]="",o[t.PipsType.NoValue]=r.cssClasses.valueNormal,o[t.PipsType.LargeValue]=r.cssClasses.valueLarge,o[t.PipsType.SmallValue]=r.cssClasses.valueSub,o),u=((a={})[t.PipsType.None]="",a[t.PipsType.NoValue]=r.cssClasses.markerNormal,a[t.PipsType.LargeValue]=r.cssClasses.markerLarge,a[t.PipsType.SmallValue]=r.cssClasses.markerSub,a),c=[r.cssClasses.valueHorizontal,r.cssClasses.valueVertical],p=[r.cssClasses.markerHorizontal,r.cssClasses.markerVertical];function f(t,e){var n=e===r.cssClasses.value,i=n?l:u;return e+" "+(n?c:p)[r.ort]+" "+i[t]}function d(e,o,a){if((a=n?n(o,a):a)!==t.PipsType.None){var l=z(s,!1);l.className=f(a,r.cssClasses.marker),l.style[r.style]=e+"%",a>t.PipsType.NoValue&&((l=z(s,!1)).className=f(a,r.cssClasses.value),l.setAttribute("data-value",String(o)),l.style[r.style]=e+"%",l.innerHTML=String(i.to(o)))}}return h(s,r.cssClasses.pips),h(s,0===r.ort?r.cssClasses.pipsHorizontal:r.cssClasses.pipsVertical),Object.keys(e).forEach((function(t){d(t,e[t][0],e[t][1])})),s}function Z(){w&&(n(w),w=null)}function tt(t){Z();var e=K(t),r=t.filter,n=t.format||{to:function(t){return String(Math.round(t))}};return w=C.appendChild(Q(e,r,n))}function et(){var t=u.getBoundingClientRect(),e="offset"+["Width","Height"][r.ort];return 0===r.ort?t.width||u[e]:t.height||u[e]}function rt(t,e,n,i){var o=function(o){var a=nt(o,i.pageOffset,i.target||e);return!!a&&!(X()&&!i.doNotReject)&&!(v(C,r.cssClasses.tap)&&!i.doNotReject)&&!(t===E.start&&void 0!==a.buttons&&a.buttons>1)&&(!i.hover||!a.buttons)&&(N||a.preventDefault(),a.calcPoint=a.points[r.ort],void n(a,i))},a=[];return t.split(" ").forEach((function(t){e.addEventListener(t,o,!!N&&{passive:!0}),a.push([t,o])})),a}function nt(t,e,r){var n=0===t.type.indexOf("touch"),i=0===t.type.indexOf("mouse"),o=0===t.type.indexOf("pointer"),a=0,s=0;if(0===t.type.indexOf("MSPointer")&&(o=!0),"mousedown"===t.type&&!t.buttons&&!t.touches)return!1;if(n){var l=function(e){var n=e.target;return n===r||r.contains(n)||t.composed&&t.composedPath().shift()===r};if("touchstart"===t.type){var u=Array.prototype.filter.call(t.touches,l);if(u.length>1)return!1;a=u[0].pageX,s=u[0].pageY}else{var c=Array.prototype.find.call(t.changedTouches,l);if(!c)return!1;a=c.pageX,s=c.pageY}}return e=e||g(U),(i||o)&&(a=t.clientX+e.x,s=t.clientY+e.y),t.pageOffset=e,t.points=[a,s],t.cursor=i||o,t}function it(t){var e=100*(t-l(u,r.ort))/et();return e=p(e),r.dir?100-e:e}function ot(t){var e=100,r=!1;return d.forEach((function(n,i){if(!Y(i)){var o=V[i],a=Math.abs(o-t);(a<e||a<=e&&t>o||100===a&&100===e)&&(r=i,e=a)}})),r}function st(t,e){"mouseout"===t.type&&"HTML"===t.target.nodeName&&null===t.relatedTarget&&ut(t,e)}function lt(t,e){if(-1===navigator.appVersion.indexOf("MSIE 9")&&0===t.buttons&&0!==e.buttonsProperty)return ut(t,e);var n=(r.dir?-1:1)*(t.calcPoint-e.startCalcPoint);xt(n>0,100*n/e.baseSize,e.locations,e.handleNumbers,e.connect)}function ut(t,e){e.handle&&(m(e.handle,r.cssClasses.active),M-=1),e.listeners.forEach((function(t){D.removeEventListener(t[0],t[1])})),0===M&&(m(C,r.cssClasses.drag),Et(),t.cursor&&(T.style.cursor="",T.removeEventListener("selectstart",o))),e.handleNumbers.forEach((function(t){bt("change",t),bt("set",t),bt("end",t)}))}function ct(t,e){if(!e.handleNumbers.some(Y)){var n;1===e.handleNumbers.length&&(n=d[e.handleNumbers[0]].children[0],M+=1,h(n,r.cssClasses.active)),t.stopPropagation();var i=[],a=rt(E.move,D,lt,{target:t.target,handle:n,connect:e.connect,listeners:i,startCalcPoint:t.calcPoint,baseSize:et(),pageOffset:t.pageOffset,handleNumbers:e.handleNumbers,buttonsProperty:t.buttons,locations:V.slice()}),s=rt(E.end,D,ut,{target:t.target,handle:n,listeners:i,doNotReject:!0,handleNumbers:e.handleNumbers}),l=rt("mouseout",D,st,{target:t.target,handle:n,listeners:i,doNotReject:!0,handleNumbers:e.handleNumbers});i.push.apply(i,a.concat(s,l)),t.cursor&&(T.style.cursor=getComputedStyle(t.target).cursor,d.length>1&&h(C,r.cssClasses.drag),T.addEventListener("selectstart",o,!1)),e.handleNumbers.forEach((function(t){bt("start",t)}))}}function pt(t){t.stopPropagation();var e=it(t.calcPoint),n=ot(e);!1!==n&&(r.events.snap||c(C,r.cssClasses.tap,r.animationDuration),Nt(n,e,!0,!0),Et(),bt("slide",n,!0),bt("update",n,!0),r.events.snap?ct(t,{handleNumbers:[n]}):(bt("change",n,!0),bt("set",n,!0)))}function ft(t){var e=it(t.calcPoint),r=O.getStep(e),n=O.fromStepping(r);Object.keys(j).forEach((function(t){"hover"===t.split(".")[0]&&j[t].forEach((function(t){t.call(Ft,n)}))}))}function dt(t,e){if(X()||Y(e))return!1;var n=["Left","Right"],i=["Down","Up"],o=["PageDown","PageUp"],a=["Home","End"];r.dir&&!r.ort?n.reverse():r.ort&&!r.dir&&(i.reverse(),o.reverse());var s,l=t.key.replace("Arrow",""),u=l===o[0],c=l===o[1],p=l===i[0]||l===n[0]||u,f=l===i[1]||l===n[1]||c,d=l===a[0],h=l===a[1];if(!(p||f||d||h))return!0;if(t.preventDefault(),f||p){var m=p?0:1,v=Ut(e)[m];if(null===v)return!1;!1===v&&(v=O.getDefaultStep(V[e],p,r.keyboardDefaultStep)),v*=c||u?r.keyboardPageMultiplier:r.keyboardMultiplier,v=Math.max(v,1e-7),v*=p?-1:1,s=k[e]+v}else s=h?r.spectrum.xVal[r.spectrum.xVal.length-1]:r.spectrum.xVal[0];return Nt(e,O.toStepping(s),!0,!0),bt("slide",e),bt("update",e),bt("change",e),bt("set",e),!1}function ht(t){t.fixed||d.forEach((function(t,e){rt(E.start,t.children[0],ct,{handleNumbers:[e]})})),t.tap&&rt(E.start,u,pt,{}),t.hover&&rt(E.move,u,ft,{hover:!0}),t.drag&&S.forEach((function(e,n){if(!1!==e&&0!==n&&n!==S.length-1){var i=d[n-1],o=d[n],a=[e],s=[i,o],l=[n-1,n];h(e,r.cssClasses.draggable),t.fixed&&(a.push(i.children[0]),a.push(o.children[0])),t.dragAll&&(s=d,l=A),a.forEach((function(t){rt(E.start,t,ct,{handles:s,handleNumbers:l,connect:e})}))}}))}function mt(t,e){j[t]=j[t]||[],j[t].push(e),"update"===t.split(".")[0]&&d.forEach((function(t,e){bt("update",e)}))}function vt(t){return t===L.aria||t===L.tooltips}function gt(t){var e=t&&t.split(".")[0],r=e?t.substring(e.length):t;Object.keys(j).forEach((function(t){var n=t.split(".")[0],i=t.substring(n.length);e&&e!==n||r&&r!==i||vt(i)&&r!==i||delete j[t]}))}function bt(t,e,n){Object.keys(j).forEach((function(i){var o=i.split(".")[0];t===o&&j[i].forEach((function(t){t.call(Ft,k.map(r.format.to),e,k.slice(),n||!1,V.slice(),Ft)}))}))}function yt(t,e,n,i,o,a){var s;return d.length>1&&!r.events.unconstrained&&(i&&e>0&&(s=O.getAbsoluteDistance(t[e-1],r.margin,!1),n=Math.max(n,s)),o&&e<d.length-1&&(s=O.getAbsoluteDistance(t[e+1],r.margin,!0),n=Math.min(n,s))),d.length>1&&r.limit&&(i&&e>0&&(s=O.getAbsoluteDistance(t[e-1],r.limit,!1),n=Math.min(n,s)),o&&e<d.length-1&&(s=O.getAbsoluteDistance(t[e+1],r.limit,!0),n=Math.max(n,s))),r.padding&&(0===e&&(s=O.getAbsoluteDistance(0,r.padding[0],!1),n=Math.max(n,s)),e===d.length-1&&(s=O.getAbsoluteDistance(100,r.padding[1],!0),n=Math.min(n,s))),!((n=p(n=O.getStep(n)))===t[e]&&!a)&&n}function St(t,e){var n=r.ort;return(n?e:t)+", "+(n?t:e)}function xt(t,e,r,n,i){var o=r.slice(),a=n[0],s=[!t,t],l=[t,!t];n=n.slice(),t&&n.reverse(),n.length>1?n.forEach((function(t,r){var n=yt(o,t,o[t]+e,s[r],l[r],!1);!1===n?e=0:(e=n-o[t],o[t]=n)})):s=l=[!0];var u=!1;n.forEach((function(t,n){u=Nt(t,r[t]+e,s[n],l[n])||u})),u&&(n.forEach((function(t){bt("update",t),bt("slide",t)})),null!=i&&bt("drag",a))}function wt(t,e){return r.dir?100-t-e:t}function Pt(t,e){V[t]=e,k[t]=O.fromStepping(e);var n="translate("+St(10*(wt(e,0)-F)+"%","0")+")";d[t].style[r.transformRule]=n,Ct(t),Ct(t+1)}function Et(){A.forEach((function(t){var e=V[t]>50?-1:1,r=3+(d.length+e*t);d[t].style.zIndex=String(r)}))}function Nt(t,e,r,n,i){return i||(e=yt(V,t,e,r,n,!1)),!1!==e&&(Pt(t,e),!0)}function Ct(t){if(S[t]){var e=0,n=100;0!==t&&(e=V[t-1]),t!==S.length-1&&(n=V[t]);var i=n-e,o="translate("+St(wt(e,i)+"%","0")+")",a="scale("+St(i/100,"1")+")";S[t].style[r.transformRule]=o+" "+a}}function Ot(t,e){return null===t||!1===t||void 0===t?V[e]:("number"==typeof t&&(t=String(t)),!1!==(t=r.format.from(t))&&(t=O.toStepping(t)),!1===t||isNaN(t)?V[e]:t)}function kt(t,e,n){var i=f(t),o=void 0===V[0];e=void 0===e||e,r.animate&&!o&&c(C,r.cssClasses.tap,r.animationDuration),A.forEach((function(t){Nt(t,Ot(i[t],t),!0,!1,n)}));var a=1===A.length?0:1;if(o&&O.hasNoSize()&&(n=!0,V[0]=0,A.length>1)){var s=100/(A.length-1);A.forEach((function(t){V[t]=t*s}))}for(;a<A.length;++a)A.forEach((function(t){Nt(t,V[t],!0,!0,n)}));Et(),A.forEach((function(t){bt("update",t),null!==i[t]&&e&&bt("set",t)}))}function Vt(t){kt(r.start,t)}function At(t,e,r,n){if(!((t=Number(t))>=0&&t<A.length))throw new Error("noUiSlider: invalid handle number, got: "+t);Nt(t,Ot(e,t),!0,!0,n),bt("update",t),r&&bt("set",t)}function Mt(t){if(void 0===t&&(t=!1),t)return 1===k.length?k[0]:k.slice(0);var e=k.map(r.format.to);return 1===e.length?e[0]:e}function jt(){for(gt(L.aria),gt(L.tooltips),Object.keys(r.cssClasses).forEach((function(t){m(C,r.cssClasses[t])}));C.firstChild;)C.removeChild(C.firstChild);delete C.noUiSlider}function Ut(t){var e=V[t],n=O.getNearbySteps(e),i=k[t],o=n.thisStep.step,a=null;if(r.snap)return[i-n.stepBefore.startValue||null,n.stepAfter.startValue-i||null];!1!==o&&i+o>n.stepAfter.startValue&&(o=n.stepAfter.startValue-i),a=i>n.thisStep.startValue?n.thisStep.step:!1!==n.stepBefore.step&&i-n.stepBefore.highestStep,100===e?o=null:0===e&&(a=null);var s=O.countStepDecimals();return null!==o&&!1!==o&&(o=Number(o.toFixed(s))),null!==a&&!1!==a&&(a=Number(a.toFixed(s))),[a,o]}function Dt(){return A.map(Ut)}function Lt(t,e){var n=Mt(),o=["margin","limit","padding","range","animate","snap","step","format","pips","tooltips"];o.forEach((function(e){void 0!==t[e]&&(s[e]=t[e])}));var a=at(s);o.forEach((function(e){void 0!==t[e]&&(r[e]=a[e])})),O=a.spectrum,r.margin=a.margin,r.limit=a.limit,r.padding=a.padding,r.pips?tt(r.pips):Z(),r.tooltips?$():I(),V=[],kt(i(t.start)?t.start:n,e)}function Tt(){u=B(C),R(r.connect,u),ht(r.events),kt(r.start),r.pips&&tt(r.pips),r.tooltips&&$(),W()}Tt();var Ft={destroy:jt,steps:Dt,on:mt,off:gt,get:Mt,set:kt,setHandle:At,reset:Vt,__moveHandles:function(t,e,r){xt(t,e,V,r)},options:s,updateOptions:Lt,target:C,removePips:Z,removeTooltips:I,getPositions:function(){return V.slice()},getTooltips:function(){return P},getOrigins:function(){return d},pips:tt};return Ft}function lt(t,e){if(!t||!t.nodeName)throw new Error("noUiSlider: create requires a single element, got: "+t);if(t.noUiSlider)throw new Error("noUiSlider: Slider was already initialized.");var r=st(t,at(e),e);return t.noUiSlider=r,r}var ut={__spectrum:j,cssClasses:D,create:lt};t.create=lt,t.cssClasses=D,t.default=ut,Object.defineProperty(t,"__esModule",{value:!0})}(e)})));function w(t,e){var r=e.slice().sort();return t.length===e.length&&t.slice().sort().every((function(t,e){return t===r[e]}))}var P={name:"Slider",emits:["input","update:modelValue","update","change"],props:{...{value:{validator:function(t){return t=>"number"==typeof t||t instanceof Array||null==t||!1===t},required:!1},modelValue:{validator:function(t){return t=>"number"==typeof t||t instanceof Array||null==t||!1===t},required:!1}},id:{type:[String,Number],required:!1},disabled:{type:Boolean,required:!1,default:!1},min:{type:Number,required:!1,default:0},max:{type:Number,required:!1,default:100},step:{type:Number,required:!1,default:1},orientation:{type:String,required:!1,default:"horizontal"},direction:{type:String,required:!1,default:"ltr"},tooltips:{type:Boolean,required:!1,default:!0},options:{type:Object,required:!1,default:()=>({})},merge:{type:Number,required:!1,default:-1},format:{type:[Object,Function,Boolean],required:!1,default:null},classes:{type:Object,required:!1,default:()=>({})},showTooltip:{type:String,required:!1,default:"always"},tooltipPosition:{type:String,required:!1,default:null}},setup(a,s){const l=function(r,n,i){var o=(0,vue__WEBPACK_IMPORTED_MODULE_0__.toRefs)(r),a=o.value,s=o.modelValue,l=void 0!==n.expose?s:a,c=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(l.value);if(u(l.value))throw new Error("Slider v-model must be a Number or Array");if(Array.isArray(l.value)&&0==l.value.length)throw new Error("Slider v-model must not be an empty array");return{value:l,initialValue:c}}(a,s),c=function(e,n,i){var o=(0,vue__WEBPACK_IMPORTED_MODULE_0__.toRefs)(e),a=o.classes,s=o.showTooltip,l=o.tooltipPosition,u=o.orientation,c=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)((function(){return p({target:"slider-target",focused:"slider-focused",tooltipFocus:"slider-tooltip-focus",tooltipDrag:"slider-tooltip-drag",ltr:"slider-ltr",rtl:"slider-rtl",horizontal:"slider-horizontal",vertical:"slider-vertical",textDirectionRtl:"slider-txt-dir-rtl",textDirectionLtr:"slider-txt-dir-ltr",base:"slider-base",connects:"slider-connects",connect:"slider-connect",origin:"slider-origin",handle:"slider-handle",handleUpper:"slider-handle-upper",handleLower:"slider-handle-lower",touchArea:"slider-touch-area",tooltip:"slider-tooltip",tooltipTop:"slider-tooltip-top",tooltipBottom:"slider-tooltip-bottom",tooltipLeft:"slider-tooltip-left",tooltipRight:"slider-tooltip-right",tooltipHidden:"slider-tooltip-hidden",active:"slider-active",draggable:"slider-draggable",tap:"slider-state-tap",drag:"slider-state-drag",pips:"slider-pips",pipsHorizontal:"slider-pips-horizontal",pipsVertical:"slider-pips-vertical",marker:"slider-marker",markerHorizontal:"slider-marker-horizontal",markerVertical:"slider-marker-vertical",markerNormal:"slider-marker-normal",markerLarge:"slider-marker-large",markerSub:"slider-marker-sub",value:"slider-value",valueHorizontal:"slider-value-horizontal",valueVertical:"slider-value-vertical",valueNormal:"slider-value-normal",valueLarge:"slider-value-large",valueSub:"slider-value-sub"},a.value)}));return{classList:(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)((function(){var t=p({},c.value);return"always"!==s.value&&(t.target+=" ".concat("drag"===s.value?t.tooltipDrag:t.tooltipFocus)),"horizontal"===u.value&&(t.tooltip+="bottom"===l.value?" ".concat(t.tooltipBottom):" ".concat(t.tooltipTop)),"vertical"===u.value&&(t.tooltip+="right"===l.value?" ".concat(t.tooltipRight):" ".concat(t.tooltipLeft)),t}))}}(a),f=y(a,0,{value:l.value,classList:c.classList}),d=function(a,s,l){var c=(0,vue__WEBPACK_IMPORTED_MODULE_0__.toRefs)(a),p=c.orientation,f=c.direction,d=c.tooltips,h=c.step,m=c.min,v=c.max,g=c.merge,b=c.id,y=c.disabled,S=c.options,P=c.classes,E=c.format,N=l.value,C=l.initialValue,O=l.tooltipsFormat,k=l.tooltipsMerge,V=l.classList,A=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null),M=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null),j=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(!1),U=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)((function(){var t={cssPrefix:"",cssClasses:V.value,orientation:p.value,direction:f.value,tooltips:!!d.value&&O.value,connect:"lower",start:u(N.value)?m.value:N.value,range:{min:m.value,max:v.value}};return h.value>0&&(t.step=h.value),Array.isArray(N.value)&&(t.connect=!0),t})),D=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)((function(){var t={id:b&&b.value?b.value:void 0};return y.value&&(t.disabled=!0),t})),L=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)((function(){return Array.isArray(N.value)})),T=function(){var t=M.value.get();return Array.isArray(t)?t.map((function(t){return parseFloat(t)})):parseFloat(t)},F=function(t){var e=!(arguments.length>1&&void 0!==arguments[1])||arguments[1];M.value.set(t,e)},z=function(t){s.emit("input",t),s.emit("update:modelValue",t),s.emit("update",t)},H=function(){M.value=x.create(A.value,Object.assign({},U.value,S.value)),d.value&&L.value&&g.value>=0&&k(A.value,g.value," - "),M.value.on("set",(function(t){s.emit("change",T())})),M.value.on("update",(function(t){if(j.value){var e=T();L.value&&w(N.value,e)||!L.value&&N.value==e?s.emit("update",e):z(e)}})),A.value.querySelectorAll("[data-handle]").forEach((function(t){t.onblur=function(){V.value.focused.split(" ").forEach((function(t){A.value.classList.remove(t)}))},t.onfocus=function(){V.value.focused.split(" ").forEach((function(t){A.value.classList.add(t)}))}})),j.value=!0},q=function(){M.value.off(),M.value.destroy(),M.value=null},R=function(t,e){j.value=!1,q(),H()};return (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(H),(0,vue__WEBPACK_IMPORTED_MODULE_0__.onUnmounted)(q),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(L,R,{immediate:!1}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(m,R,{immediate:!1}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(v,R,{immediate:!1}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(h,R,{immediate:!1}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(p,R,{immediate:!1}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(f,R,{immediate:!1}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(d,R,{immediate:!1}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(E,R,{immediate:!1,deep:!0}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(g,R,{immediate:!1}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(S,R,{immediate:!1,deep:!0}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(P,R,{immediate:!1,deep:!0}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(N,(function(t){u(t)?F(m.value,!1):(L.value&&!w(t,T())||!L.value&&t!=T())&&F(t,!1)}),{deep:!0}),{slider:A,slider$:M,isRange:L,sliderProps:D,init:H,destroy:q,refresh:R,update:F,reset:function(){z(C.value)}}}(a,s,{value:l.value,initialValue:l.initialValue,tooltipsFormat:f.tooltipsFormat,tooltipsMerge:f.tooltipsMerge,classList:c.classList});return{...c,...f,...d}}};P.render=function(t,e,r,n,i,o){return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(),(0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("div",(0,vue__WEBPACK_IMPORTED_MODULE_0__.mergeProps)(t.sliderProps,{ref:"slider"}),null,16)},P.__file="src/Slider.vue";/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (P);


/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/SearchBar/MobileSearchBar.vue?vue&type=script&lang=js":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/SearchBar/MobileSearchBar.vue?vue&type=script&lang=js ***!
  \*******************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _search_bar_mixin_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./search_bar_mixin.js */ "./resources/js/components/SearchBar/search_bar_mixin.js");
/* harmony import */ var _heroicons_vue_solid__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @heroicons/vue/solid */ "./node_modules/@heroicons/vue/solid/esm/index.js");


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      showMobileSearchBar: false
    };
  },
  components: {
    XIcon: _heroicons_vue_solid__WEBPACK_IMPORTED_MODULE_1__.XIcon
  },
  mixins: [_search_bar_mixin_js__WEBPACK_IMPORTED_MODULE_0__["default"]],
  props: ['showWelcomeText']
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/SearchBar/MobileSearchBar.vue?vue&type=template&id=4e89d38a":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/SearchBar/MobileSearchBar.vue?vue&type=template&id=4e89d38a ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  ref: "searchBar",
  "class": "grid grid-rows-3 gap-4 mt-2 text-white text-base"
};

var _hoisted_2 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "w-3/4"
}, "Type", -1
/* HOISTED */
);

var _hoisted_3 = {
  "class": "overflow-hidden rounded-3xl shadow-lg ring-1 ring-black ring-opacity-5"
};
var _hoisted_4 = {
  "class": "relative grid gap-4 bg-white p-7 grid-cols-2"
};
var _hoisted_5 = {
  "class": "col-span-1 flex items-center"
};
var _hoisted_6 = {
  "class": "ml-2 font-semibold"
};

var _hoisted_7 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "col-span-1"
}, null, -1
/* HOISTED */
);

var _hoisted_8 = ["value"];
var _hoisted_9 = {
  "class": "ml-2"
};

var _hoisted_10 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "w-3/4"
}, "Price range", -1
/* HOISTED */
);

var _hoisted_11 = {
  "class": "overflow-hidden rounded-3xl shadow-lg ring-1 ring-black ring-opacity-5"
};
var _hoisted_12 = {
  "class": "bg-white pb-7 pt-14 px-12 w-80 relative"
};
var _hoisted_13 = {
  "class": "p-1 rounded-full focus:outline-none w-full h-full bg-main-orange hover:bg-opacity-75 flex items-center justify-center gap-3"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _this = this;

  var _component_XIcon = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("XIcon");

  var _component_ChevronDownIcon = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("ChevronDownIcon");

  var _component_PopoverButton = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("PopoverButton");

  var _component_PopoverPanel = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("PopoverPanel");

  var _component_Popover = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Popover");

  var _component_LocationMarkerIcon = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("LocationMarkerIcon");

  var _component_Slider = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Slider");

  var _component_search_icon = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("search-icon");

  var _component_vue_final_modal = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("vue-final-modal");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_vue_final_modal, {
    modelValue: $data.showMobileSearchBar,
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $data.showMobileSearchBar = $event;
    }),
    name: "MobileSearchBarModal",
    onClosed: _cache[10] || (_cache[10] = function ($event) {
      return _this.$emit('closedMobileSearchBar');
    }),
    transition: {
      'enter-active-class': 'transition duration-200 ease-in-out transform',
      'enter-from-class': 'translate-y-full',
      'enter-to-class': 'translate-y-0',
      'leave-active-class': 'transition duration-200 ease-in-out transform',
      'leave-to-class': 'translate-y-full',
      'leave-from-class': 'translate-y-0'
    },
    classes: "flex justify-center items-center",
    "content-class": "backdrop-blur-2xl backdrop-filter backdrop-opacity-90 bg-opacity-30 bg-white w-4/5 sm:max-w-md px-6 pb-6 pt-8 rounded-3xl relative flex flex-col max-h-full border"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
        "class": "absolute top-0 right-0 mt-2 mr-2",
        onClick: _cache[0] || (_cache[0] = function ($event) {
          return $data.showMobileSearchBar = false;
        })
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_XIcon, {
        "class": "h-5 w-5 text-white"
      })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Types Popover "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Popover, {
        "class": "h-full relative hover:bg-opacity-75"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function (_ref) {
          var open = _ref.open;
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_PopoverButton, {
            onClick: _cache[1] || (_cache[1] = function ($event) {
              return _ctx.isSearchBarFocused = true;
            }),
            "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)([open ? 'bg-opacity-75 shadow-2xl' : '', "w-full inline-flex items-center px-3 h-full rounded-full group bg-white text-main-blue"])
          }, {
            "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
              return [_hoisted_2, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_ChevronDownIcon, {
                "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)([open ? '' : 'text-opacity-70', "w-1/4 h-6"]),
                "aria-hidden": "true"
              }, null, 8
              /* PROPS */
              , ["class"])];
            }),
            _: 2
            /* DYNAMIC */

          }, 1032
          /* PROPS, DYNAMIC_SLOTS */
          , ["class"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(vue__WEBPACK_IMPORTED_MODULE_0__.Transition, {
            "enter-active-class": "transition duration-200 ease-out",
            "enter-from-class": "translate-y-1 opacity-0",
            "enter-to-class": "translate-y-0 opacity-100",
            "leave-active-class": "transition duration-150 ease-in",
            "leave-from-class": "translate-y-0 opacity-100",
            "leave-to-class": "translate-y-1 opacity-0"
          }, {
            "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
              return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_PopoverPanel, {
                onClick: _cache[4] || (_cache[4] = function ($event) {
                  return _ctx.isSearchBarFocused = true;
                }),
                "class": "absolute z-10 w-max px-4 mt-5 transform -translate-x-1/2 left-full"
              }, {
                "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
                  return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
                    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
                      return _ctx.selectAllPropertyTypes = $event;
                    }),
                    type: "checkbox",
                    "class": "rounded border-gray-600 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                  }, null, 512
                  /* NEED_PATCH */
                  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, _ctx.selectAllPropertyTypes]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", _hoisted_6, "-- Select " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.selectAllPropertyTypes ? 'none' : 'all') + " --", 1
                  /* TEXT */
                  )]), _hoisted_7, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(_ctx.propertyTypes, function (item, index) {
                    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
                      key: index,
                      "class": "col-span-1 flex items-center"
                    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
                      type: "checkbox",
                      "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
                        return _ctx.form.types = $event;
                      }),
                      value: item['type'],
                      "class": "rounded border-gray-600 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                    }, null, 8
                    /* PROPS */
                    , _hoisted_8), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, _ctx.form.types]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", _hoisted_9, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item['type']), 1
                    /* TEXT */
                    )]);
                  }), 128
                  /* KEYED_FRAGMENT */
                  ))])])];
                }),
                _: 1
                /* STABLE */

              })];
            }),
            _: 1
            /* STABLE */

          })];
        }),
        _: 1
        /* STABLE */

      }), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Location Input box "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)([[_ctx.isInputFocused ? ' focus:bg-opacity-75 shadow-2xl' : 'group'], "rounded-full flex items-center h-full focus-within:shadow-2xl bg-white text-main-blue"])
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <div style=\"height:32px; width:1px; background: #ddd; display:inline;\"></div> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        onFocus: _cache[5] || (_cache[5] = function ($event) {
          return _ctx.isInputFocused = true, _ctx.isSearchBarFocused = true;
        }),
        onBlur: _cache[6] || (_cache[6] = function ($event) {
          return _ctx.isInputFocused = false;
        }),
        "class": "text-base lg:text-lg xl:text-xl text-left border-0 h-full pl-3 pr-0 w-full rounded-full focus:ring-0 focus:outline-none bg-transparent placeholder-main-blue",
        type: "text",
        placeholder: "Enter a location"
      }, null, 32
      /* HYDRATE_EVENTS */
      ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_LocationMarkerIcon, {
        "class": "h-6 pl-1 pr-3"
      }), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <div style=\"height:32px; width:1px; background: #ddd; display:inline;\"></div> ")], 2
      /* CLASS */
      ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Price Range Popover "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Popover, {
        "class": "relative h-full"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function (_ref2) {
          var open = _ref2.open;
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_PopoverButton, {
            onClick: _cache[7] || (_cache[7] = function ($event) {
              return _ctx.isSearchBarFocused = true;
            }),
            "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)([open ? 'focus:bg-opacity-75 shadow-2xl' : '', "w-full flex items-center pl-1 h-full rounded-full group bg-white text-main-blue"])
          }, {
            "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
              return [_hoisted_10, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_ChevronDownIcon, {
                "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)([open ? '' : 'text-opacity-70', "w-1/4 h-6"]),
                "aria-hidden": "true"
              }, null, 8
              /* PROPS */
              , ["class"])];
            }),
            _: 2
            /* DYNAMIC */

          }, 1032
          /* PROPS, DYNAMIC_SLOTS */
          , ["class"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(vue__WEBPACK_IMPORTED_MODULE_0__.Transition, {
            "enter-active-class": "transition duration-200 ease-out",
            "enter-from-class": "translate-y-1 opacity-0",
            "enter-to-class": "translate-y-0 opacity-100",
            "leave-active-class": "transition duration-150 ease-in",
            "leave-from-class": "translate-y-0 opacity-100",
            "leave-to-class": "translate-y-1 opacity-0"
          }, {
            "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
              return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_PopoverPanel, {
                "class": "absolute z-10 w-max px-4 mt-5 transform -translate-x-1/2 left-1/2"
              }, {
                "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
                  return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Slider, {
                    min: 0,
                    max: 500,
                    format: _ctx.sliderFormat,
                    modelValue: _ctx.form.priceRange,
                    "onUpdate:modelValue": _cache[8] || (_cache[8] = function ($event) {
                      return _ctx.form.priceRange = $event;
                    })
                  }, null, 8
                  /* PROPS */
                  , ["format", "modelValue"])])])];
                }),
                _: 1
                /* STABLE */

              })];
            }),
            _: 1
            /* STABLE */

          })];
        }),
        _: 1
        /* STABLE */

      }), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Search Button "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)([[_ctx.isSearchBarFocused ? '' : ''], "px-5 h-full"])
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Search "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_search_icon, {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)([[_ctx.isSearchBarFocused ? '' : ''], "text-white w-6"])
      }, null, 8
      /* PROPS */
      , ["class"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)([[_ctx.isSearchBarFocused ? 'xl:inline' : ''], "font-semibold text-lg text-white tracking-wide"])
      }, "Search", 2
      /* CLASS */
      )])], 2
      /* CLASS */
      )], 512
      /* NEED_PATCH */
      )];
    }),
    _: 1
    /* STABLE */

  }, 8
  /* PROPS */
  , ["modelValue"]);
}

/***/ }),

/***/ "./resources/js/components/SearchBar/search_bar_mixin.js":
/*!***************************************************************!*\
  !*** ./resources/js/components/SearchBar/search_bar_mixin.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @headlessui/vue */ "./node_modules/@headlessui/vue/dist/components/popover/popover.esm.js");
/* harmony import */ var _vueform_slider__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @vueform/slider */ "./node_modules/@vueform/slider/dist/slider.js");
/* harmony import */ var _heroicons_vue_solid__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @heroicons/vue/solid */ "./node_modules/@heroicons/vue/solid/esm/index.js");




var searchBarMixin = {
  components: {
    Popover: _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__.Popover,
    PopoverButton: _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__.PopoverButton,
    PopoverPanel: _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__.PopoverPanel,
    ChevronDownIcon: _heroicons_vue_solid__WEBPACK_IMPORTED_MODULE_1__.ChevronDownIcon,
    LocationMarkerIcon: _heroicons_vue_solid__WEBPACK_IMPORTED_MODULE_1__.LocationMarkerIcon,
    Slider: _vueform_slider__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  props: ['propertyTypes', 'isSearchBarInNavbar'],
  // emits: ['onScrollYPastSearchBar', 'onScrollYNotPastSearchBar'],
  data: function data() {
    return {
      csrfToken: csrfToken,
      isSearchBarFocused: false,
      isInputFocused: false,
      isScrollYPastSearchBar: false,
      sliderFormat: {
        prefix: 'GH&#8373;',
        decimals: 0
      },
      form: {
        types: [],
        priceRange: [0, 500]
      }
    };
  },
  computed: {
    selectAllPropertyTypes: {
      get: function get() {
        return this.form.types ? this.propertyTypes.length == this.form.types.length : false;
      },
      set: function set(value) {
        var selectedTypes = [];

        if (!value) {
          this.form.types = [];
          return;
        }

        this.propertyTypes.forEach(function (item) {
          selectedTypes.push(item.type);
        });
        this.form.types = selectedTypes;
      }
    }
  },
  methods: {
    onSearchBarNotFocused: function onSearchBarNotFocused(event) {
      if (!this.$refs.searchBar.contains(event.target)) {
        //the click was outside the specifiedElement, do something
        this.isSearchBarFocused = false; // console.log(this.$refs.searchBar)
      }
    }
  },
  mounted: function mounted() {
    document.addEventListener('click', this.onSearchBarNotFocused); // if(!this.isSearchBarInNavbar) {
    //     let searchBarOffsetTop = this.$refs.searchBar.offsetTop;
    //     let searchBarOffsetHeight = this.$refs.searchBar.offsetHeight;
    //     let navBarHeight = document.getElementById('nav-bar').offsetHeight;
    //     let thisVar = this;
    //     window.addEventListener(
    //         'scroll', 
    //         _.throttle( function() {
    //             if (window.scrollY >= searchBarOffsetTop + navBarHeight - (window.scrollY) ) {
    //                 thisVar.isScrollYPastSearchBar = true
    //                 // thisVar.$emit('onScrollYPastSearchBar')
    //             } else {
    //                 thisVar.isScrollYPastSearchBar = false
    //                 // thisVar.$emit('onScrollYNotPastSearchBar')
    //             }
    //         }, 600)
    //     );
    // }    
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (searchBarMixin);

/***/ }),

/***/ "./resources/js/components/SearchBar/MobileSearchBar.vue":
/*!***************************************************************!*\
  !*** ./resources/js/components/SearchBar/MobileSearchBar.vue ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _MobileSearchBar_vue_vue_type_template_id_4e89d38a__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MobileSearchBar.vue?vue&type=template&id=4e89d38a */ "./resources/js/components/SearchBar/MobileSearchBar.vue?vue&type=template&id=4e89d38a");
/* harmony import */ var _MobileSearchBar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MobileSearchBar.vue?vue&type=script&lang=js */ "./resources/js/components/SearchBar/MobileSearchBar.vue?vue&type=script&lang=js");
/* harmony import */ var _var_www_html_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_var_www_html_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_MobileSearchBar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_MobileSearchBar_vue_vue_type_template_id_4e89d38a__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/components/SearchBar/MobileSearchBar.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/components/SearchBar/MobileSearchBar.vue?vue&type=script&lang=js":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/SearchBar/MobileSearchBar.vue?vue&type=script&lang=js ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MobileSearchBar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MobileSearchBar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MobileSearchBar.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/SearchBar/MobileSearchBar.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/SearchBar/MobileSearchBar.vue?vue&type=template&id=4e89d38a":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/SearchBar/MobileSearchBar.vue?vue&type=template&id=4e89d38a ***!
  \*********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MobileSearchBar_vue_vue_type_template_id_4e89d38a__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MobileSearchBar_vue_vue_type_template_id_4e89d38a__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MobileSearchBar.vue?vue&type=template&id=4e89d38a */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/SearchBar/MobileSearchBar.vue?vue&type=template&id=4e89d38a");


/***/ })

}]);