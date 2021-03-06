/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/webpack/buildin/module.js":
/*!***********************************!*\
  !*** (webpack)/buildin/module.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = function(module) {
	if (!module.webpackPolyfill) {
		module.deprecate = function() {};
		module.paths = [];
		// module.parent = undefined by default
		if (!module.children) module.children = [];
		Object.defineProperty(module, "loaded", {
			enumerable: true,
			get: function() {
				return module.l;
			}
		});
		Object.defineProperty(module, "id", {
			enumerable: true,
			get: function() {
				return module.i;
			}
		});
		module.webpackPolyfill = 1;
	}
	return module;
};


/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

window.$ = window.jQuery = __webpack_require__(/*! ./jquery.min */ "./resources/js/jquery.min.js");

__webpack_require__(/*! ./jquery.slimscroll */ "./resources/js/jquery.slimscroll.js"); // select2 = require('./select2.min');


__webpack_require__(/*! ./jquery.inputmask.bundle */ "./resources/js/jquery.inputmask.bundle.js");

Noty = __webpack_require__(/*! ./noty */ "./resources/js/noty.js");
svaigi = __webpack_require__(/*! ./svaigi */ "./resources/js/svaigi.js");

__webpack_require__(/*! ./main */ "./resources/js/main.js");

/***/ }),

/***/ "./resources/js/jquery.inputmask.bundle.js":
/*!*************************************************!*\
  !*** ./resources/js/jquery.inputmask.bundle.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

function _typeof2(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof2 = function _typeof2(obj) { return typeof obj; }; } else { _typeof2 = function _typeof2(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof2(obj); }

/*!
* jquery.inputmask.bundle.js
* https://github.com/RobinHerbots/Inputmask
* Copyright (c) 2010 - 2018 Robin Herbots
* Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
* Version: 4.0.3-beta.1
*/
(function (modules) {
  var installedModules = {};

  function __webpack_require__(moduleId) {
    if (installedModules[moduleId]) {
      return installedModules[moduleId].exports;
    }

    var module = installedModules[moduleId] = {
      i: moduleId,
      l: false,
      exports: {}
    };
    modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
    module.l = true;
    return module.exports;
  }

  __webpack_require__.m = modules;
  __webpack_require__.c = installedModules;

  __webpack_require__.d = function (exports, name, getter) {
    if (!__webpack_require__.o(exports, name)) {
      Object.defineProperty(exports, name, {
        enumerable: true,
        get: getter
      });
    }
  };

  __webpack_require__.r = function (exports) {
    if (typeof Symbol !== "undefined" && Symbol.toStringTag) {
      Object.defineProperty(exports, Symbol.toStringTag, {
        value: "Module"
      });
    }

    Object.defineProperty(exports, "__esModule", {
      value: true
    });
  };

  __webpack_require__.t = function (value, mode) {
    if (mode & 1) value = __webpack_require__(value);
    if (mode & 8) return value;
    if (mode & 4 && _typeof2(value) === "object" && value && value.__esModule) return value;
    var ns = Object.create(null);

    __webpack_require__.r(ns);

    Object.defineProperty(ns, "default", {
      enumerable: true,
      value: value
    });
    if (mode & 2 && typeof value != "string") for (var key in value) {
      __webpack_require__.d(ns, key, function (key) {
        return value[key];
      }.bind(null, key));
    }
    return ns;
  };

  __webpack_require__.n = function (module) {
    var getter = module && module.__esModule ? function getDefault() {
      return module["default"];
    } : function getModuleExports() {
      return module;
    };

    __webpack_require__.d(getter, "a", getter);

    return getter;
  };

  __webpack_require__.o = function (object, property) {
    return Object.prototype.hasOwnProperty.call(object, property);
  };

  __webpack_require__.p = "";
  return __webpack_require__(__webpack_require__.s = 0);
})([function (module, exports, __webpack_require__) {
  "use strict";

  __webpack_require__(1);

  __webpack_require__(6);

  __webpack_require__(7);

  var _inputmask = __webpack_require__(2);

  var _inputmask2 = _interopRequireDefault(_inputmask);

  var _inputmask3 = __webpack_require__(3);

  var _inputmask4 = _interopRequireDefault(_inputmask3);

  var _jquery = __webpack_require__(4);

  var _jquery2 = _interopRequireDefault(_jquery);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : {
      default: obj
    };
  }

  if (_inputmask4.default === _jquery2.default) {
    __webpack_require__(8);
  }

  window.Inputmask = _inputmask2.default;
}, function (module, exports, __webpack_require__) {
  "use strict";

  var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;

  var _typeof = typeof Symbol === "function" && _typeof2(Symbol.iterator) === "symbol" ? function (obj) {
    return _typeof2(obj);
  } : function (obj) {
    return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
  };

  (function (factory) {
    if (true) {
      !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(2)], __WEBPACK_AMD_DEFINE_FACTORY__ = factory, __WEBPACK_AMD_DEFINE_RESULT__ = typeof __WEBPACK_AMD_DEFINE_FACTORY__ === "function" ? __WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__) : __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
    } else {}
  })(function (Inputmask) {
    Inputmask.extendDefinitions({
      A: {
        validator: "[A-Za-z\u0410-\u044F\u0401\u0451\xC0-\xFF\xB5]",
        casing: "upper"
      },
      "&": {
        validator: "[0-9A-Za-z\u0410-\u044F\u0401\u0451\xC0-\xFF\xB5]",
        casing: "upper"
      },
      "#": {
        validator: "[0-9A-Fa-f]",
        casing: "upper"
      }
    });
    Inputmask.extendAliases({
      cssunit: {
        regex: "[+-]?[0-9]+\\.?([0-9]+)?(px|em|rem|ex|%|in|cm|mm|pt|pc)"
      },
      url: {
        regex: "(https?|ftp)//.*",
        autoUnmask: false
      },
      ip: {
        mask: "i[i[i]].i[i[i]].i[i[i]].i[i[i]]",
        definitions: {
          i: {
            validator: function validator(chrs, maskset, pos, strict, opts) {
              if (pos - 1 > -1 && maskset.buffer[pos - 1] !== ".") {
                chrs = maskset.buffer[pos - 1] + chrs;

                if (pos - 2 > -1 && maskset.buffer[pos - 2] !== ".") {
                  chrs = maskset.buffer[pos - 2] + chrs;
                } else chrs = "0" + chrs;
              } else chrs = "00" + chrs;

              return new RegExp("25[0-5]|2[0-4][0-9]|[01][0-9][0-9]").test(chrs);
            }
          }
        },
        onUnMask: function onUnMask(maskedValue, unmaskedValue, opts) {
          return maskedValue;
        },
        inputmode: "numeric"
      },
      email: {
        mask: "*{1,64}[.*{1,64}][.*{1,64}][.*{1,63}]@-{1,63}.-{1,63}[.-{1,63}][.-{1,63}]",
        greedy: false,
        casing: "lower",
        onBeforePaste: function onBeforePaste(pastedValue, opts) {
          pastedValue = pastedValue.toLowerCase();
          return pastedValue.replace("mailto:", "");
        },
        definitions: {
          "*": {
            validator: "[0-9\uFF11-\uFF19A-Za-z\u0410-\u044F\u0401\u0451\xC0-\xFF\xB5!#$%&'*+/=?^_`{|}~-]"
          },
          "-": {
            validator: "[0-9A-Za-z-]"
          }
        },
        onUnMask: function onUnMask(maskedValue, unmaskedValue, opts) {
          return maskedValue;
        },
        inputmode: "email"
      },
      mac: {
        mask: "##:##:##:##:##:##"
      },
      vin: {
        mask: "V{13}9{4}",
        definitions: {
          V: {
            validator: "[A-HJ-NPR-Za-hj-npr-z\\d]",
            casing: "upper"
          }
        },
        clearIncomplete: true,
        autoUnmask: true
      }
    });
    return Inputmask;
  });
}, function (module, exports, __webpack_require__) {
  "use strict";

  var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;

  var _typeof = typeof Symbol === "function" && _typeof2(Symbol.iterator) === "symbol" ? function (obj) {
    return _typeof2(obj);
  } : function (obj) {
    return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
  };

  (function (factory) {
    if (true) {
      !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(3), __webpack_require__(5)], __WEBPACK_AMD_DEFINE_FACTORY__ = factory, __WEBPACK_AMD_DEFINE_RESULT__ = typeof __WEBPACK_AMD_DEFINE_FACTORY__ === "function" ? __WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__) : __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
    } else {}
  })(function ($, window, undefined) {
    var document = window.document,
        ua = navigator.userAgent,
        ie = ua.indexOf("MSIE ") > 0 || ua.indexOf("Trident/") > 0,
        mobile = isInputEventSupported("touchstart"),
        iemobile = /iemobile/i.test(ua),
        iphone = /iphone/i.test(ua) && !iemobile;

    function Inputmask(alias, options, internal) {
      if (!(this instanceof Inputmask)) {
        return new Inputmask(alias, options, internal);
      }

      this.el = undefined;
      this.events = {};
      this.maskset = undefined;
      this.refreshValue = false;

      if (internal !== true) {
        if ($.isPlainObject(alias)) {
          options = alias;
        } else {
          options = options || {};
          if (alias) options.alias = alias;
        }

        this.opts = $.extend(true, {}, this.defaults, options);
        this.noMasksCache = options && options.definitions !== undefined;
        this.userOptions = options || {};
        this.isRTL = this.opts.numericInput;
        resolveAlias(this.opts.alias, options, this.opts);
      }
    }

    Inputmask.prototype = {
      dataAttribute: "data-inputmask",
      defaults: {
        placeholder: "_",
        optionalmarker: ["[", "]"],
        quantifiermarker: ["{", "}"],
        groupmarker: ["(", ")"],
        alternatormarker: "|",
        escapeChar: "\\",
        mask: null,
        regex: null,
        oncomplete: $.noop,
        onincomplete: $.noop,
        oncleared: $.noop,
        repeat: 0,
        greedy: false,
        autoUnmask: false,
        removeMaskOnSubmit: false,
        clearMaskOnLostFocus: true,
        insertMode: true,
        clearIncomplete: false,
        alias: null,
        onKeyDown: $.noop,
        onBeforeMask: null,
        onBeforePaste: function onBeforePaste(pastedValue, opts) {
          return $.isFunction(opts.onBeforeMask) ? opts.onBeforeMask.call(this, pastedValue, opts) : pastedValue;
        },
        onBeforeWrite: null,
        onUnMask: null,
        showMaskOnFocus: true,
        showMaskOnHover: true,
        onKeyValidation: $.noop,
        skipOptionalPartCharacter: " ",
        numericInput: false,
        rightAlign: false,
        undoOnEscape: true,
        radixPoint: "",
        _radixDance: false,
        groupSeparator: "",
        keepStatic: null,
        positionCaretOnTab: true,
        tabThrough: false,
        supportsInputType: ["text", "tel", "password", "search"],
        ignorables: [8, 9, 13, 19, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 93, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 0, 229],
        isComplete: null,
        preValidation: null,
        postValidation: null,
        staticDefinitionSymbol: undefined,
        jitMasking: false,
        nullable: true,
        inputEventOnly: false,
        noValuePatching: false,
        positionCaretOnClick: "lvp",
        casing: null,
        inputmode: "verbatim",
        colorMask: false,
        disablePredictiveText: false,
        importDataAttributes: true
      },
      definitions: {
        9: {
          validator: "[0-9\uFF11-\uFF19]",
          definitionSymbol: "*"
        },
        a: {
          validator: "[A-Za-z\u0410-\u044F\u0401\u0451\xC0-\xFF\xB5]",
          definitionSymbol: "*"
        },
        "*": {
          validator: "[0-9\uFF11-\uFF19A-Za-z\u0410-\u044F\u0401\u0451\xC0-\xFF\xB5]"
        }
      },
      aliases: {},
      masksCache: {},
      mask: function mask(elems) {
        var that = this;

        function importAttributeOptions(npt, opts, userOptions, dataAttribute) {
          if (opts.importDataAttributes === true) {
            var importOption = function importOption(option, optionData) {
              optionData = optionData !== undefined ? optionData : npt.getAttribute(dataAttribute + "-" + option);

              if (optionData !== null) {
                if (typeof optionData === "string") {
                  if (option.indexOf("on") === 0) optionData = window[optionData];else if (optionData === "false") optionData = false;else if (optionData === "true") optionData = true;
                }

                userOptions[option] = optionData;
              }
            };

            var attrOptions = npt.getAttribute(dataAttribute),
                option,
                dataoptions,
                optionData,
                p;

            if (attrOptions && attrOptions !== "") {
              attrOptions = attrOptions.replace(/'/g, '"');
              dataoptions = JSON.parse("{" + attrOptions + "}");
            }

            if (dataoptions) {
              optionData = undefined;

              for (p in dataoptions) {
                if (p.toLowerCase() === "alias") {
                  optionData = dataoptions[p];
                  break;
                }
              }
            }

            importOption("alias", optionData);

            if (userOptions.alias) {
              resolveAlias(userOptions.alias, userOptions, opts);
            }

            for (option in opts) {
              if (dataoptions) {
                optionData = undefined;

                for (p in dataoptions) {
                  if (p.toLowerCase() === option.toLowerCase()) {
                    optionData = dataoptions[p];
                    break;
                  }
                }
              }

              importOption(option, optionData);
            }
          }

          $.extend(true, opts, userOptions);

          if (npt.dir === "rtl" || opts.rightAlign) {
            npt.style.textAlign = "right";
          }

          if (npt.dir === "rtl" || opts.numericInput) {
            npt.dir = "ltr";
            npt.removeAttribute("dir");
            opts.isRTL = true;
          }

          return Object.keys(userOptions).length;
        }

        if (typeof elems === "string") {
          elems = document.getElementById(elems) || document.querySelectorAll(elems);
        }

        elems = elems.nodeName ? [elems] : elems;
        $.each(elems, function (ndx, el) {
          var scopedOpts = $.extend(true, {}, that.opts);

          if (importAttributeOptions(el, scopedOpts, $.extend(true, {}, that.userOptions), that.dataAttribute)) {
            var maskset = generateMaskSet(scopedOpts, that.noMasksCache);

            if (maskset !== undefined) {
              if (el.inputmask !== undefined) {
                el.inputmask.opts.autoUnmask = true;
                el.inputmask.remove();
              }

              el.inputmask = new Inputmask(undefined, undefined, true);
              el.inputmask.opts = scopedOpts;
              el.inputmask.noMasksCache = that.noMasksCache;
              el.inputmask.userOptions = $.extend(true, {}, that.userOptions);
              el.inputmask.isRTL = scopedOpts.isRTL || scopedOpts.numericInput;
              el.inputmask.el = el;
              el.inputmask.maskset = maskset;
              $.data(el, "_inputmask_opts", scopedOpts);
              maskScope.call(el.inputmask, {
                action: "mask"
              });
            }
          }
        });
        return elems && elems[0] ? elems[0].inputmask || this : this;
      },
      option: function option(options, noremask) {
        if (typeof options === "string") {
          return this.opts[options];
        } else if ((typeof options === "undefined" ? "undefined" : _typeof(options)) === "object") {
          $.extend(this.userOptions, options);

          if (this.el && noremask !== true) {
            this.mask(this.el);
          }

          return this;
        }
      },
      unmaskedvalue: function unmaskedvalue(value) {
        this.maskset = this.maskset || generateMaskSet(this.opts, this.noMasksCache);
        return maskScope.call(this, {
          action: "unmaskedvalue",
          value: value
        });
      },
      remove: function remove() {
        return maskScope.call(this, {
          action: "remove"
        });
      },
      getemptymask: function getemptymask() {
        this.maskset = this.maskset || generateMaskSet(this.opts, this.noMasksCache);
        return maskScope.call(this, {
          action: "getemptymask"
        });
      },
      hasMaskedValue: function hasMaskedValue() {
        return !this.opts.autoUnmask;
      },
      isComplete: function isComplete() {
        this.maskset = this.maskset || generateMaskSet(this.opts, this.noMasksCache);
        return maskScope.call(this, {
          action: "isComplete"
        });
      },
      getmetadata: function getmetadata() {
        this.maskset = this.maskset || generateMaskSet(this.opts, this.noMasksCache);
        return maskScope.call(this, {
          action: "getmetadata"
        });
      },
      isValid: function isValid(value) {
        this.maskset = this.maskset || generateMaskSet(this.opts, this.noMasksCache);
        return maskScope.call(this, {
          action: "isValid",
          value: value
        });
      },
      format: function format(value, metadata) {
        this.maskset = this.maskset || generateMaskSet(this.opts, this.noMasksCache);
        return maskScope.call(this, {
          action: "format",
          value: value,
          metadata: metadata
        });
      },
      setValue: function setValue(value) {
        if (this.el) {
          $(this.el).trigger("setvalue", [value]);
        }
      },
      analyseMask: function analyseMask(mask, regexMask, opts) {
        var tokenizer = /(?:[?*+]|\{[0-9\+\*]+(?:,[0-9\+\*]*)?(?:\|[0-9\+\*]*)?\})|[^.?*+^${[]()|\\]+|./g,
            regexTokenizer = /\[\^?]?(?:[^\\\]]+|\\[\S\s]?)*]?|\\(?:0(?:[0-3][0-7]{0,2}|[4-7][0-7]?)?|[1-9][0-9]*|x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4}|c[A-Za-z]|[\S\s]?)|\((?:\?[:=!]?)?|(?:[?*+]|\{[0-9]+(?:,[0-9]*)?\})\??|[^.?*+^${[()|\\]+|./g,
            escaped = false,
            currentToken = new MaskToken(),
            match,
            m,
            openenings = [],
            maskTokens = [],
            openingToken,
            currentOpeningToken,
            alternator,
            lastMatch,
            groupToken;

        function MaskToken(isGroup, isOptional, isQuantifier, isAlternator) {
          this.matches = [];
          this.openGroup = isGroup || false;
          this.alternatorGroup = false;
          this.isGroup = isGroup || false;
          this.isOptional = isOptional || false;
          this.isQuantifier = isQuantifier || false;
          this.isAlternator = isAlternator || false;
          this.quantifier = {
            min: 1,
            max: 1
          };
        }

        function insertTestDefinition(mtoken, element, position) {
          position = position !== undefined ? position : mtoken.matches.length;
          var prevMatch = mtoken.matches[position - 1];

          if (regexMask) {
            if (element.indexOf("[") === 0 || escaped && /\\d|\\s|\\w]/i.test(element) || element === ".") {
              mtoken.matches.splice(position++, 0, {
                fn: new RegExp(element, opts.casing ? "i" : ""),
                optionality: false,
                newBlockMarker: prevMatch === undefined ? "master" : prevMatch.def !== element,
                casing: null,
                def: element,
                placeholder: undefined,
                nativeDef: element
              });
            } else {
              if (escaped) element = element[element.length - 1];
              $.each(element.split(""), function (ndx, lmnt) {
                prevMatch = mtoken.matches[position - 1];
                mtoken.matches.splice(position++, 0, {
                  fn: null,
                  optionality: false,
                  newBlockMarker: prevMatch === undefined ? "master" : prevMatch.def !== lmnt && prevMatch.fn !== null,
                  casing: null,
                  def: opts.staticDefinitionSymbol || lmnt,
                  placeholder: opts.staticDefinitionSymbol !== undefined ? lmnt : undefined,
                  nativeDef: (escaped ? "'" : "") + lmnt
                });
              });
            }

            escaped = false;
          } else {
            var maskdef = (opts.definitions ? opts.definitions[element] : undefined) || Inputmask.prototype.definitions[element];

            if (maskdef && !escaped) {
              mtoken.matches.splice(position++, 0, {
                fn: maskdef.validator ? typeof maskdef.validator == "string" ? new RegExp(maskdef.validator, opts.casing ? "i" : "") : new function () {
                  this.test = maskdef.validator;
                }() : new RegExp("."),
                optionality: false,
                newBlockMarker: prevMatch === undefined ? "master" : prevMatch.def !== (maskdef.definitionSymbol || element),
                casing: maskdef.casing,
                def: maskdef.definitionSymbol || element,
                placeholder: maskdef.placeholder,
                nativeDef: element
              });
            } else {
              mtoken.matches.splice(position++, 0, {
                fn: null,
                optionality: false,
                newBlockMarker: prevMatch === undefined ? "master" : prevMatch.def !== element && prevMatch.fn !== null,
                casing: null,
                def: opts.staticDefinitionSymbol || element,
                placeholder: opts.staticDefinitionSymbol !== undefined ? element : undefined,
                nativeDef: (escaped ? "'" : "") + element
              });
              escaped = false;
            }
          }
        }

        function verifyGroupMarker(maskToken) {
          if (maskToken && maskToken.matches) {
            $.each(maskToken.matches, function (ndx, token) {
              var nextToken = maskToken.matches[ndx + 1];

              if ((nextToken === undefined || nextToken.matches === undefined || nextToken.isQuantifier === false) && token && token.isGroup) {
                token.isGroup = false;

                if (!regexMask) {
                  insertTestDefinition(token, opts.groupmarker[0], 0);

                  if (token.openGroup !== true) {
                    insertTestDefinition(token, opts.groupmarker[1]);
                  }
                }
              }

              verifyGroupMarker(token);
            });
          }
        }

        function defaultCase() {
          if (openenings.length > 0) {
            currentOpeningToken = openenings[openenings.length - 1];
            insertTestDefinition(currentOpeningToken, m);

            if (currentOpeningToken.isAlternator) {
              alternator = openenings.pop();

              for (var mndx = 0; mndx < alternator.matches.length; mndx++) {
                if (alternator.matches[mndx].isGroup) alternator.matches[mndx].isGroup = false;
              }

              if (openenings.length > 0) {
                currentOpeningToken = openenings[openenings.length - 1];
                currentOpeningToken.matches.push(alternator);
              } else {
                currentToken.matches.push(alternator);
              }
            }
          } else {
            insertTestDefinition(currentToken, m);
          }
        }

        function reverseTokens(maskToken) {
          function reverseStatic(st) {
            if (st === opts.optionalmarker[0]) st = opts.optionalmarker[1];else if (st === opts.optionalmarker[1]) st = opts.optionalmarker[0];else if (st === opts.groupmarker[0]) st = opts.groupmarker[1];else if (st === opts.groupmarker[1]) st = opts.groupmarker[0];
            return st;
          }

          maskToken.matches = maskToken.matches.reverse();

          for (var match in maskToken.matches) {
            if (maskToken.matches.hasOwnProperty(match)) {
              var intMatch = parseInt(match);

              if (maskToken.matches[match].isQuantifier && maskToken.matches[intMatch + 1] && maskToken.matches[intMatch + 1].isGroup) {
                var qt = maskToken.matches[match];
                maskToken.matches.splice(match, 1);
                maskToken.matches.splice(intMatch + 1, 0, qt);
              }

              if (maskToken.matches[match].matches !== undefined) {
                maskToken.matches[match] = reverseTokens(maskToken.matches[match]);
              } else {
                maskToken.matches[match] = reverseStatic(maskToken.matches[match]);
              }
            }
          }

          return maskToken;
        }

        function groupify(matches) {
          var groupToken = new MaskToken(true);
          groupToken.openGroup = false;
          groupToken.matches = matches;
          return groupToken;
        }

        if (regexMask) {
          opts.optionalmarker[0] = undefined;
          opts.optionalmarker[1] = undefined;
        }

        while (match = regexMask ? regexTokenizer.exec(mask) : tokenizer.exec(mask)) {
          m = match[0];

          if (regexMask) {
            switch (m.charAt(0)) {
              case "?":
                m = "{0,1}";
                break;

              case "+":
              case "*":
                m = "{" + m + "}";
                break;
            }
          }

          if (escaped) {
            defaultCase();
            continue;
          }

          switch (m.charAt(0)) {
            case "(?=":
              break;

            case "(?!":
              break;

            case "(?<=":
              break;

            case "(?<!":
              break;

            case opts.escapeChar:
              escaped = true;

              if (regexMask) {
                defaultCase();
              }

              break;

            case opts.optionalmarker[1]:
            case opts.groupmarker[1]:
              openingToken = openenings.pop();
              openingToken.openGroup = false;

              if (openingToken !== undefined) {
                if (openenings.length > 0) {
                  currentOpeningToken = openenings[openenings.length - 1];
                  currentOpeningToken.matches.push(openingToken);

                  if (currentOpeningToken.isAlternator) {
                    alternator = openenings.pop();

                    for (var mndx = 0; mndx < alternator.matches.length; mndx++) {
                      alternator.matches[mndx].isGroup = false;
                      alternator.matches[mndx].alternatorGroup = false;
                    }

                    if (openenings.length > 0) {
                      currentOpeningToken = openenings[openenings.length - 1];
                      currentOpeningToken.matches.push(alternator);
                    } else {
                      currentToken.matches.push(alternator);
                    }
                  }
                } else {
                  currentToken.matches.push(openingToken);
                }
              } else defaultCase();

              break;

            case opts.optionalmarker[0]:
              openenings.push(new MaskToken(false, true));
              break;

            case opts.groupmarker[0]:
              openenings.push(new MaskToken(true));
              break;

            case opts.quantifiermarker[0]:
              var quantifier = new MaskToken(false, false, true);
              m = m.replace(/[{}]/g, "");
              var mqj = m.split("|"),
                  mq = mqj[0].split(","),
                  mq0 = isNaN(mq[0]) ? mq[0] : parseInt(mq[0]),
                  mq1 = mq.length === 1 ? mq0 : isNaN(mq[1]) ? mq[1] : parseInt(mq[1]);

              if (mq0 === "*" || mq0 === "+") {
                mq0 = mq1 === "*" ? 0 : 1;
              }

              quantifier.quantifier = {
                min: mq0,
                max: mq1,
                jit: mqj[1]
              };
              var matches = openenings.length > 0 ? openenings[openenings.length - 1].matches : currentToken.matches;
              match = matches.pop();

              if (match.isAlternator) {
                matches.push(match);
                matches = match.matches;
                var groupToken = new MaskToken(true);
                var tmpMatch = matches.pop();
                matches.push(groupToken);
                matches = groupToken.matches;
                match = tmpMatch;
              }

              if (!match.isGroup) {
                match = groupify([match]);
              }

              matches.push(match);
              matches.push(quantifier);
              break;

            case opts.alternatormarker:
              var groupQuantifier = function groupQuantifier(matches) {
                var lastMatch = matches.pop();

                if (lastMatch.isQuantifier) {
                  lastMatch = groupify([matches.pop(), lastMatch]);
                }

                return lastMatch;
              };

              if (openenings.length > 0) {
                currentOpeningToken = openenings[openenings.length - 1];
                var subToken = currentOpeningToken.matches[currentOpeningToken.matches.length - 1];

                if (currentOpeningToken.openGroup && (subToken.matches === undefined || subToken.isGroup === false && subToken.isAlternator === false)) {
                  lastMatch = openenings.pop();
                } else {
                  lastMatch = groupQuantifier(currentOpeningToken.matches);
                }
              } else {
                lastMatch = groupQuantifier(currentToken.matches);
              }

              if (lastMatch.isAlternator) {
                openenings.push(lastMatch);
              } else {
                if (lastMatch.alternatorGroup) {
                  alternator = openenings.pop();
                  lastMatch.alternatorGroup = false;
                } else {
                  alternator = new MaskToken(false, false, false, true);
                }

                alternator.matches.push(lastMatch);
                openenings.push(alternator);

                if (lastMatch.openGroup) {
                  lastMatch.openGroup = false;
                  var alternatorGroup = new MaskToken(true);
                  alternatorGroup.alternatorGroup = true;
                  openenings.push(alternatorGroup);
                }
              }

              break;

            default:
              defaultCase();
          }
        }

        while (openenings.length > 0) {
          openingToken = openenings.pop();
          currentToken.matches.push(openingToken);
        }

        if (currentToken.matches.length > 0) {
          verifyGroupMarker(currentToken);
          maskTokens.push(currentToken);
        }

        if (opts.numericInput || opts.isRTL) {
          reverseTokens(maskTokens[0]);
        }

        return maskTokens;
      }
    };

    Inputmask.extendDefaults = function (options) {
      $.extend(true, Inputmask.prototype.defaults, options);
    };

    Inputmask.extendDefinitions = function (definition) {
      $.extend(true, Inputmask.prototype.definitions, definition);
    };

    Inputmask.extendAliases = function (alias) {
      $.extend(true, Inputmask.prototype.aliases, alias);
    };

    Inputmask.format = function (value, options, metadata) {
      return Inputmask(options).format(value, metadata);
    };

    Inputmask.unmask = function (value, options) {
      return Inputmask(options).unmaskedvalue(value);
    };

    Inputmask.isValid = function (value, options) {
      return Inputmask(options).isValid(value);
    };

    Inputmask.remove = function (elems) {
      if (typeof elems === "string") {
        elems = document.getElementById(elems) || document.querySelectorAll(elems);
      }

      elems = elems.nodeName ? [elems] : elems;
      $.each(elems, function (ndx, el) {
        if (el.inputmask) el.inputmask.remove();
      });
    };

    Inputmask.setValue = function (elems, value) {
      if (typeof elems === "string") {
        elems = document.getElementById(elems) || document.querySelectorAll(elems);
      }

      elems = elems.nodeName ? [elems] : elems;
      $.each(elems, function (ndx, el) {
        if (el.inputmask) el.inputmask.setValue(value);else $(el).trigger("setvalue", [value]);
      });
    };

    Inputmask.escapeRegex = function (str) {
      var specials = ["/", ".", "*", "+", "?", "|", "(", ")", "[", "]", "{", "}", "\\", "$", "^"];
      return str.replace(new RegExp("(\\" + specials.join("|\\") + ")", "gim"), "\\$1");
    };

    Inputmask.keyCode = {
      BACKSPACE: 8,
      BACKSPACE_SAFARI: 127,
      DELETE: 46,
      DOWN: 40,
      END: 35,
      ENTER: 13,
      ESCAPE: 27,
      HOME: 36,
      INSERT: 45,
      LEFT: 37,
      PAGE_DOWN: 34,
      PAGE_UP: 33,
      RIGHT: 39,
      SPACE: 32,
      TAB: 9,
      UP: 38,
      X: 88,
      CONTROL: 17
    };
    Inputmask.dependencyLib = $;

    function resolveAlias(aliasStr, options, opts) {
      var aliasDefinition = Inputmask.prototype.aliases[aliasStr];

      if (aliasDefinition) {
        if (aliasDefinition.alias) resolveAlias(aliasDefinition.alias, undefined, opts);
        $.extend(true, opts, aliasDefinition);
        $.extend(true, opts, options);
        return true;
      } else if (opts.mask === null) {
        opts.mask = aliasStr;
      }

      return false;
    }

    function generateMaskSet(opts, nocache) {
      function generateMask(mask, metadata, opts) {
        var regexMask = false;

        if (mask === null || mask === "") {
          regexMask = opts.regex !== null;

          if (regexMask) {
            mask = opts.regex;
            mask = mask.replace(/^(\^)(.*)(\$)$/, "$2");
          } else {
            regexMask = true;
            mask = ".*";
          }
        }

        if (mask.length === 1 && opts.greedy === false && opts.repeat !== 0) {
          opts.placeholder = "";
        }

        if (opts.repeat > 0 || opts.repeat === "*" || opts.repeat === "+") {
          var repeatStart = opts.repeat === "*" ? 0 : opts.repeat === "+" ? 1 : opts.repeat;
          mask = opts.groupmarker[0] + mask + opts.groupmarker[1] + opts.quantifiermarker[0] + repeatStart + "," + opts.repeat + opts.quantifiermarker[1];
        }

        var masksetDefinition,
            maskdefKey = regexMask ? "regex_" + opts.regex : opts.numericInput ? mask.split("").reverse().join("") : mask;

        if (Inputmask.prototype.masksCache[maskdefKey] === undefined || nocache === true) {
          masksetDefinition = {
            mask: mask,
            maskToken: Inputmask.prototype.analyseMask(mask, regexMask, opts),
            validPositions: {},
            _buffer: undefined,
            buffer: undefined,
            tests: {},
            excludes: {},
            metadata: metadata,
            maskLength: undefined
          };

          if (nocache !== true) {
            Inputmask.prototype.masksCache[maskdefKey] = masksetDefinition;
            masksetDefinition = $.extend(true, {}, Inputmask.prototype.masksCache[maskdefKey]);
          }
        } else masksetDefinition = $.extend(true, {}, Inputmask.prototype.masksCache[maskdefKey]);

        return masksetDefinition;
      }

      var ms;

      if ($.isFunction(opts.mask)) {
        opts.mask = opts.mask(opts);
      }

      if ($.isArray(opts.mask)) {
        if (opts.mask.length > 1) {
          if (opts.keepStatic === null) {
            opts.keepStatic = "auto";

            for (var i = 0; i < opts.mask.length; i++) {
              if (opts.mask[i].charAt(0) !== opts.mask[0].charAt(0)) {
                opts.keepStatic = true;
                break;
              }
            }
          }

          var altMask = opts.groupmarker[0];
          $.each(opts.isRTL ? opts.mask.reverse() : opts.mask, function (ndx, msk) {
            if (altMask.length > 1) {
              altMask += opts.groupmarker[1] + opts.alternatormarker + opts.groupmarker[0];
            }

            if (msk.mask !== undefined && !$.isFunction(msk.mask)) {
              altMask += msk.mask;
            } else {
              altMask += msk;
            }
          });
          altMask += opts.groupmarker[1];
          return generateMask(altMask, opts.mask, opts);
        } else opts.mask = opts.mask.pop();
      }

      if (opts.mask && opts.mask.mask !== undefined && !$.isFunction(opts.mask.mask)) {
        ms = generateMask(opts.mask.mask, opts.mask, opts);
      } else {
        ms = generateMask(opts.mask, opts.mask, opts);
      }

      return ms;
    }

    function isInputEventSupported(eventName) {
      var el = document.createElement("input"),
          evName = "on" + eventName,
          isSupported = evName in el;

      if (!isSupported) {
        el.setAttribute(evName, "return;");
        isSupported = typeof el[evName] === "function";
      }

      el = null;
      return isSupported;
    }

    function maskScope(actionObj, maskset, opts) {
      maskset = maskset || this.maskset;
      opts = opts || this.opts;
      var inputmask = this,
          el = this.el,
          isRTL = this.isRTL,
          undoValue,
          $el,
          skipKeyPressEvent = false,
          skipInputEvent = false,
          ignorable = false,
          maxLength,
          mouseEnter = false,
          colorMask,
          originalPlaceholder;

      function getMaskTemplate(baseOnInput, minimalPos, includeMode, noJit, clearOptionalTail) {
        var greedy = opts.greedy;
        if (clearOptionalTail) opts.greedy = false;
        minimalPos = minimalPos || 0;
        var maskTemplate = [],
            ndxIntlzr,
            pos = 0,
            test,
            testPos,
            lvp = getLastValidPosition();

        do {
          if (baseOnInput === true && getMaskSet().validPositions[pos]) {
            testPos = clearOptionalTail && getMaskSet().validPositions[pos].match.optionality === true && getMaskSet().validPositions[pos + 1] === undefined && (getMaskSet().validPositions[pos].generatedInput === true || getMaskSet().validPositions[pos].input == opts.skipOptionalPartCharacter && pos > 0) ? determineTestTemplate(pos, getTests(pos, ndxIntlzr, pos - 1)) : getMaskSet().validPositions[pos];
            test = testPos.match;
            ndxIntlzr = testPos.locator.slice();
            maskTemplate.push(includeMode === true ? testPos.input : includeMode === false ? test.nativeDef : getPlaceholder(pos, test));
          } else {
            testPos = getTestTemplate(pos, ndxIntlzr, pos - 1);
            test = testPos.match;
            ndxIntlzr = testPos.locator.slice();
            var jitMasking = noJit === true ? false : opts.jitMasking !== false ? opts.jitMasking : test.jit;

            if (jitMasking === false || jitMasking === undefined || typeof jitMasking === "number" && isFinite(jitMasking) && jitMasking > pos) {
              maskTemplate.push(includeMode === false ? test.nativeDef : getPlaceholder(pos, test));
            }
          }

          if (opts.keepStatic === "auto") {
            if (test.newBlockMarker && test.fn !== null) {
              opts.keepStatic = pos - 1;
            }
          }

          pos++;
        } while ((maxLength === undefined || pos < maxLength) && (test.fn !== null || test.def !== "") || minimalPos > pos);

        if (maskTemplate[maskTemplate.length - 1] === "") {
          maskTemplate.pop();
        }

        if (includeMode !== false || getMaskSet().maskLength === undefined) getMaskSet().maskLength = pos - 1;
        opts.greedy = greedy;
        return maskTemplate;
      }

      function getMaskSet() {
        return maskset;
      }

      function resetMaskSet(soft) {
        var maskset = getMaskSet();
        maskset.buffer = undefined;

        if (soft !== true) {
          maskset.validPositions = {};
          maskset.p = 0;
        }
      }

      function getLastValidPosition(closestTo, strict, validPositions) {
        var before = -1,
            after = -1,
            valids = validPositions || getMaskSet().validPositions;
        if (closestTo === undefined) closestTo = -1;

        for (var posNdx in valids) {
          var psNdx = parseInt(posNdx);

          if (valids[psNdx] && (strict || valids[psNdx].generatedInput !== true)) {
            if (psNdx <= closestTo) before = psNdx;
            if (psNdx >= closestTo) after = psNdx;
          }
        }

        return before === -1 || before == closestTo ? after : after == -1 ? before : closestTo - before < after - closestTo ? before : after;
      }

      function getDecisionTaker(tst) {
        var decisionTaker = tst.locator[tst.alternation];

        if (typeof decisionTaker == "string" && decisionTaker.length > 0) {
          decisionTaker = decisionTaker.split(",")[0];
        }

        return decisionTaker !== undefined ? decisionTaker.toString() : "";
      }

      function getLocator(tst, align) {
        var locator = (tst.alternation != undefined ? tst.mloc[getDecisionTaker(tst)] : tst.locator).join("");
        if (locator !== "") while (locator.length < align) {
          locator += "0";
        }
        return locator;
      }

      function determineTestTemplate(pos, tests) {
        pos = pos > 0 ? pos - 1 : 0;
        var altTest = getTest(pos),
            targetLocator = getLocator(altTest),
            tstLocator,
            closest,
            bestMatch;

        for (var ndx = 0; ndx < tests.length; ndx++) {
          var tst = tests[ndx];
          tstLocator = getLocator(tst, targetLocator.length);
          var distance = Math.abs(tstLocator - targetLocator);

          if (closest === undefined || tstLocator !== "" && distance < closest || bestMatch && bestMatch.match.optionality && bestMatch.match.newBlockMarker === "master" && (!tst.match.optionality || !tst.match.newBlockMarker) || bestMatch && bestMatch.match.optionalQuantifier && !tst.match.optionalQuantifier) {
            closest = distance;
            bestMatch = tst;
          }
        }

        return bestMatch;
      }

      function getTestTemplate(pos, ndxIntlzr, tstPs) {
        return getMaskSet().validPositions[pos] || determineTestTemplate(pos, getTests(pos, ndxIntlzr ? ndxIntlzr.slice() : ndxIntlzr, tstPs));
      }

      function getTest(pos, tests) {
        if (getMaskSet().validPositions[pos]) {
          return getMaskSet().validPositions[pos];
        }

        return (tests || getTests(pos))[0];
      }

      function positionCanMatchDefinition(pos, def) {
        var valid = false,
            tests = getTests(pos);

        for (var tndx = 0; tndx < tests.length; tndx++) {
          if (tests[tndx].match && tests[tndx].match.def === def) {
            valid = true;
            break;
          }
        }

        return valid;
      }

      function getTests(pos, ndxIntlzr, tstPs) {
        var maskTokens = getMaskSet().maskToken,
            testPos = ndxIntlzr ? tstPs : 0,
            ndxInitializer = ndxIntlzr ? ndxIntlzr.slice() : [0],
            matches = [],
            insertStop = false,
            latestMatch,
            cacheDependency = ndxIntlzr ? ndxIntlzr.join("") : "",
            offset = 0;

        function resolveTestFromToken(maskToken, ndxInitializer, loopNdx, quantifierRecurse) {
          function handleMatch(match, loopNdx, quantifierRecurse) {
            function isFirstMatch(latestMatch, tokenGroup) {
              var firstMatch = $.inArray(latestMatch, tokenGroup.matches) === 0;

              if (!firstMatch) {
                $.each(tokenGroup.matches, function (ndx, match) {
                  if (match.isQuantifier === true) firstMatch = isFirstMatch(latestMatch, tokenGroup.matches[ndx - 1]);else if (match.hasOwnProperty("matches")) firstMatch = isFirstMatch(latestMatch, match);
                  if (firstMatch) return false;
                });
              }

              return firstMatch;
            }

            function resolveNdxInitializer(pos, alternateNdx, targetAlternation) {
              var bestMatch, indexPos;

              if (getMaskSet().tests[pos] || getMaskSet().validPositions[pos]) {
                $.each(getMaskSet().tests[pos] || [getMaskSet().validPositions[pos]], function (ndx, lmnt) {
                  if (lmnt.mloc[alternateNdx]) {
                    bestMatch = lmnt;
                    return false;
                  }

                  var alternation = targetAlternation !== undefined ? targetAlternation : lmnt.alternation,
                      ndxPos = lmnt.locator[alternation] !== undefined ? lmnt.locator[alternation].toString().indexOf(alternateNdx) : -1;

                  if ((indexPos === undefined || ndxPos < indexPos) && ndxPos !== -1) {
                    bestMatch = lmnt;
                    indexPos = ndxPos;
                  }
                });
              }

              if (bestMatch) {
                var bestMatchAltIndex = bestMatch.locator[bestMatch.alternation];
                var locator = bestMatch.mloc[alternateNdx] || bestMatch.mloc[bestMatchAltIndex] || bestMatch.locator;
                return locator.slice((targetAlternation !== undefined ? targetAlternation : bestMatch.alternation) + 1);
              } else {
                return targetAlternation !== undefined ? resolveNdxInitializer(pos, alternateNdx) : undefined;
              }
            }

            function isSubsetOf(source, target) {
              function expand(pattern) {
                var expanded = [],
                    start,
                    end;

                for (var i = 0, l = pattern.length; i < l; i++) {
                  if (pattern.charAt(i) === "-") {
                    end = pattern.charCodeAt(i + 1);

                    while (++start < end) {
                      expanded.push(String.fromCharCode(start));
                    }
                  } else {
                    start = pattern.charCodeAt(i);
                    expanded.push(pattern.charAt(i));
                  }
                }

                return expanded.join("");
              }

              if (opts.regex && source.match.fn !== null && target.match.fn !== null) {
                return expand(target.match.def.replace(/[\[\]]/g, "")).indexOf(expand(source.match.def.replace(/[\[\]]/g, ""))) !== -1;
              }

              return source.match.def === target.match.nativeDef;
            }

            function staticCanMatchDefinition(source, target) {
              var sloc = source.locator.slice(source.alternation).join(""),
                  tloc = target.locator.slice(target.alternation).join(""),
                  canMatch = sloc == tloc,
                  canMatch = canMatch && source.match.fn === null && target.match.fn !== null ? target.match.fn.test(source.match.def, getMaskSet(), pos, false, opts, false) : false;
              return canMatch;
            }

            function setMergeLocators(targetMatch, altMatch) {
              if (altMatch === undefined || targetMatch.alternation === altMatch.alternation && targetMatch.locator[targetMatch.alternation].toString().indexOf(altMatch.locator[altMatch.alternation]) === -1) {
                targetMatch.mloc = targetMatch.mloc || {};
                var locNdx = targetMatch.locator[targetMatch.alternation];
                if (locNdx === undefined) targetMatch.alternation = undefined;else {
                  if (typeof locNdx === "string") locNdx = locNdx.split(",")[0];
                  if (targetMatch.mloc[locNdx] === undefined) targetMatch.mloc[locNdx] = targetMatch.locator.slice();

                  if (altMatch !== undefined) {
                    for (var ndx in altMatch.mloc) {
                      if (typeof ndx === "string") ndx = ndx.split(",")[0];
                      if (targetMatch.mloc[ndx] === undefined) targetMatch.mloc[ndx] = altMatch.mloc[ndx];
                    }

                    targetMatch.locator[targetMatch.alternation] = Object.keys(targetMatch.mloc).join(",");
                  }

                  return true;
                }
              }

              return false;
            }

            if (testPos > 500 && quantifierRecurse !== undefined) {
              throw "Inputmask: There is probably an error in your mask definition or in the code. Create an issue on github with an example of the mask you are using. " + getMaskSet().mask;
            }

            if (testPos === pos && match.matches === undefined) {
              matches.push({
                match: match,
                locator: loopNdx.reverse(),
                cd: cacheDependency,
                mloc: {}
              });
              return true;
            } else if (match.matches !== undefined) {
              if (match.isGroup && quantifierRecurse !== match) {
                match = handleMatch(maskToken.matches[$.inArray(match, maskToken.matches) + 1], loopNdx, quantifierRecurse);
                if (match) return true;
              } else if (match.isOptional) {
                var optionalToken = match;
                match = resolveTestFromToken(match, ndxInitializer, loopNdx, quantifierRecurse);

                if (match) {
                  $.each(matches, function (ndx, mtch) {
                    mtch.match.optionality = true;
                  });
                  latestMatch = matches[matches.length - 1].match;

                  if (quantifierRecurse === undefined && isFirstMatch(latestMatch, optionalToken)) {
                    insertStop = true;
                    testPos = pos;
                  } else return true;
                }
              } else if (match.isAlternator) {
                var alternateToken = match,
                    malternateMatches = [],
                    maltMatches,
                    currentMatches = matches.slice(),
                    loopNdxCnt = loopNdx.length;
                var altIndex = ndxInitializer.length > 0 ? ndxInitializer.shift() : -1;

                if (altIndex === -1 || typeof altIndex === "string") {
                  var currentPos = testPos,
                      ndxInitializerClone = ndxInitializer.slice(),
                      altIndexArr = [],
                      amndx;

                  if (typeof altIndex == "string") {
                    altIndexArr = altIndex.split(",");
                  } else {
                    for (amndx = 0; amndx < alternateToken.matches.length; amndx++) {
                      altIndexArr.push(amndx.toString());
                    }
                  }

                  if (getMaskSet().excludes[pos]) {
                    var altIndexArrClone = altIndexArr.slice();

                    for (var i = 0, el = getMaskSet().excludes[pos].length; i < el; i++) {
                      altIndexArr.splice(altIndexArr.indexOf(getMaskSet().excludes[pos][i].toString()), 1);
                    }

                    if (altIndexArr.length === 0) {
                      getMaskSet().excludes[pos] = undefined;
                      altIndexArr = altIndexArrClone;
                    }
                  }

                  if (opts.keepStatic === true || isFinite(parseInt(opts.keepStatic)) && currentPos >= opts.keepStatic) altIndexArr = altIndexArr.slice(0, 1);
                  var unMatchedAlternation = false;

                  for (var ndx = 0; ndx < altIndexArr.length; ndx++) {
                    amndx = parseInt(altIndexArr[ndx]);
                    matches = [];
                    ndxInitializer = typeof altIndex === "string" ? resolveNdxInitializer(testPos, amndx, loopNdxCnt) || ndxInitializerClone.slice() : ndxInitializerClone.slice();
                    if (alternateToken.matches[amndx] && handleMatch(alternateToken.matches[amndx], [amndx].concat(loopNdx), quantifierRecurse)) match = true;else if (ndx === 0) {
                      unMatchedAlternation = true;
                    }
                    maltMatches = matches.slice();
                    testPos = currentPos;
                    matches = [];

                    for (var ndx1 = 0; ndx1 < maltMatches.length; ndx1++) {
                      var altMatch = maltMatches[ndx1],
                          dropMatch = false;
                      altMatch.match.jit = altMatch.match.jit || unMatchedAlternation;
                      altMatch.alternation = altMatch.alternation || loopNdxCnt;
                      setMergeLocators(altMatch);

                      for (var ndx2 = 0; ndx2 < malternateMatches.length; ndx2++) {
                        var altMatch2 = malternateMatches[ndx2];

                        if (typeof altIndex !== "string" || altMatch.alternation !== undefined && $.inArray(altMatch.locator[altMatch.alternation].toString(), altIndexArr) !== -1) {
                          if (altMatch.match.nativeDef === altMatch2.match.nativeDef) {
                            dropMatch = true;
                            setMergeLocators(altMatch2, altMatch);
                            break;
                          } else if (isSubsetOf(altMatch, altMatch2)) {
                            if (setMergeLocators(altMatch, altMatch2)) {
                              dropMatch = true;
                              malternateMatches.splice(malternateMatches.indexOf(altMatch2), 0, altMatch);
                            }

                            break;
                          } else if (isSubsetOf(altMatch2, altMatch)) {
                            setMergeLocators(altMatch2, altMatch);
                            break;
                          } else if (staticCanMatchDefinition(altMatch, altMatch2)) {
                            if (setMergeLocators(altMatch, altMatch2)) {
                              dropMatch = true;
                              malternateMatches.splice(malternateMatches.indexOf(altMatch2), 0, altMatch);
                            }

                            break;
                          }
                        }
                      }

                      if (!dropMatch) {
                        malternateMatches.push(altMatch);
                      }
                    }
                  }

                  matches = currentMatches.concat(malternateMatches);
                  testPos = pos;
                  insertStop = matches.length > 0;
                  match = malternateMatches.length > 0;
                  ndxInitializer = ndxInitializerClone.slice();
                } else match = handleMatch(alternateToken.matches[altIndex] || maskToken.matches[altIndex], [altIndex].concat(loopNdx), quantifierRecurse);

                if (match) return true;
              } else if (match.isQuantifier && quantifierRecurse !== maskToken.matches[$.inArray(match, maskToken.matches) - 1]) {
                var qt = match;

                for (var qndx = ndxInitializer.length > 0 ? ndxInitializer.shift() : 0; qndx < (isNaN(qt.quantifier.max) ? qndx + 1 : qt.quantifier.max) && testPos <= pos; qndx++) {
                  var tokenGroup = maskToken.matches[$.inArray(qt, maskToken.matches) - 1];
                  match = handleMatch(tokenGroup, [qndx].concat(loopNdx), tokenGroup);

                  if (match) {
                    latestMatch = matches[matches.length - 1].match;
                    latestMatch.optionalQuantifier = qndx > qt.quantifier.min - 1;
                    latestMatch.jit = (qndx || 1) * tokenGroup.matches.indexOf(latestMatch) >= qt.quantifier.jit;

                    if (latestMatch.optionalQuantifier && isFirstMatch(latestMatch, tokenGroup)) {
                      insertStop = true;
                      testPos = pos;
                      break;
                    }

                    if (latestMatch.jit && !latestMatch.optionalQuantifier) {
                      offset = tokenGroup.matches.indexOf(latestMatch);
                      testPos = pos;
                      insertStop = true;
                      break;
                    }

                    return true;
                  }
                }
              } else {
                match = resolveTestFromToken(match, ndxInitializer, loopNdx, quantifierRecurse);
                if (match) return true;
              }
            } else {
              testPos++;
            }
          }

          for (var tndx = ndxInitializer.length > 0 ? ndxInitializer.shift() : 0; tndx < maskToken.matches.length; tndx = tndx + 1 + offset) {
            offset = 0;

            if (maskToken.matches[tndx].isQuantifier !== true) {
              var match = handleMatch(maskToken.matches[tndx], [tndx].concat(loopNdx), quantifierRecurse);

              if (match && testPos === pos) {
                return match;
              } else if (testPos > pos) {
                break;
              }
            }
          }
        }

        function mergeLocators(pos, tests) {
          var locator = [];
          if (!$.isArray(tests)) tests = [tests];

          if (tests.length > 0) {
            if (tests[0].alternation === undefined) {
              locator = determineTestTemplate(pos, tests.slice()).locator.slice();
              if (locator.length === 0) locator = tests[0].locator.slice();
            } else {
              $.each(tests, function (ndx, tst) {
                if (tst.def !== "") {
                  if (locator.length === 0) locator = tst.locator.slice();else {
                    for (var i = 0; i < locator.length; i++) {
                      if (tst.locator[i] && locator[i].toString().indexOf(tst.locator[i]) === -1) {
                        locator[i] += "," + tst.locator[i];
                      }
                    }
                  }
                }
              });
            }
          }

          return locator;
        }

        if (pos > -1) {
          if (ndxIntlzr === undefined) {
            var previousPos = pos - 1,
                test;

            while ((test = getMaskSet().validPositions[previousPos] || getMaskSet().tests[previousPos]) === undefined && previousPos > -1) {
              previousPos--;
            }

            if (test !== undefined && previousPos > -1) {
              ndxInitializer = mergeLocators(previousPos, test);
              cacheDependency = ndxInitializer.join("");
              testPos = previousPos;
            }
          }

          if (getMaskSet().tests[pos] && getMaskSet().tests[pos][0].cd === cacheDependency) {
            return getMaskSet().tests[pos];
          }

          for (var mtndx = ndxInitializer.shift(); mtndx < maskTokens.length; mtndx++) {
            var match = resolveTestFromToken(maskTokens[mtndx], ndxInitializer, [mtndx]);

            if (match && testPos === pos || testPos > pos) {
              break;
            }
          }
        }

        if (matches.length === 0 || insertStop) {
          matches.push({
            match: {
              fn: null,
              optionality: false,
              casing: null,
              def: "",
              placeholder: ""
            },
            locator: [],
            mloc: {},
            cd: cacheDependency
          });
        }

        if (ndxIntlzr !== undefined && getMaskSet().tests[pos]) {
          return $.extend(true, [], matches);
        }

        getMaskSet().tests[pos] = $.extend(true, [], matches);
        return getMaskSet().tests[pos];
      }

      function getBufferTemplate() {
        if (getMaskSet()._buffer === undefined) {
          getMaskSet()._buffer = getMaskTemplate(false, 1);
          if (getMaskSet().buffer === undefined) getMaskSet().buffer = getMaskSet()._buffer.slice();
        }

        return getMaskSet()._buffer;
      }

      function getBuffer(noCache) {
        if (getMaskSet().buffer === undefined || noCache === true) {
          getMaskSet().buffer = getMaskTemplate(true, getLastValidPosition(), true);
        }

        return getMaskSet().buffer;
      }

      function refreshFromBuffer(start, end, buffer) {
        var i, p;

        if (start === true) {
          resetMaskSet();
          start = 0;
          end = buffer.length;
        } else {
          for (i = start; i < end; i++) {
            delete getMaskSet().validPositions[i];
          }
        }

        p = start;

        for (i = start; i < end; i++) {
          resetMaskSet(true);

          if (buffer[i] !== opts.skipOptionalPartCharacter) {
            var valResult = isValid(p, buffer[i], true, true);

            if (valResult !== false) {
              resetMaskSet(true);
              p = valResult.caret !== undefined ? valResult.caret : valResult.pos + 1;
            }
          }
        }
      }

      function casing(elem, test, pos) {
        switch (opts.casing || test.casing) {
          case "upper":
            elem = elem.toUpperCase();
            break;

          case "lower":
            elem = elem.toLowerCase();
            break;

          case "title":
            var posBefore = getMaskSet().validPositions[pos - 1];

            if (pos === 0 || posBefore && posBefore.input === String.fromCharCode(Inputmask.keyCode.SPACE)) {
              elem = elem.toUpperCase();
            } else {
              elem = elem.toLowerCase();
            }

            break;

          default:
            if ($.isFunction(opts.casing)) {
              var args = Array.prototype.slice.call(arguments);
              args.push(getMaskSet().validPositions);
              elem = opts.casing.apply(this, args);
            }

        }

        return elem;
      }

      function checkAlternationMatch(altArr1, altArr2, na) {
        var altArrC = opts.greedy ? altArr2 : altArr2.slice(0, 1),
            isMatch = false,
            naArr = na !== undefined ? na.split(",") : [],
            naNdx;

        for (var i = 0; i < naArr.length; i++) {
          if ((naNdx = altArr1.indexOf(naArr[i])) !== -1) {
            altArr1.splice(naNdx, 1);
          }
        }

        for (var alndx = 0; alndx < altArr1.length; alndx++) {
          if ($.inArray(altArr1[alndx], altArrC) !== -1) {
            isMatch = true;
            break;
          }
        }

        return isMatch;
      }

      function alternate(pos, c, strict, fromSetValid, rAltPos) {
        var validPsClone = $.extend(true, {}, getMaskSet().validPositions),
            lastAlt,
            alternation,
            isValidRslt = false,
            altPos,
            prevAltPos,
            i,
            validPos,
            decisionPos,
            lAltPos = rAltPos !== undefined ? rAltPos : getLastValidPosition();

        if (lAltPos === -1 && rAltPos === undefined) {
          lastAlt = 0;
          prevAltPos = getTest(lastAlt);
          alternation = prevAltPos.alternation;
        } else {
          for (; lAltPos >= 0; lAltPos--) {
            altPos = getMaskSet().validPositions[lAltPos];

            if (altPos && altPos.alternation !== undefined) {
              if (prevAltPos && prevAltPos.locator[altPos.alternation] !== altPos.locator[altPos.alternation]) {
                break;
              }

              lastAlt = lAltPos;
              alternation = getMaskSet().validPositions[lastAlt].alternation;
              prevAltPos = altPos;
            }
          }
        }

        if (alternation !== undefined) {
          decisionPos = parseInt(lastAlt);
          getMaskSet().excludes[decisionPos] = getMaskSet().excludes[decisionPos] || [];

          if (pos !== true) {
            getMaskSet().excludes[decisionPos].push(getDecisionTaker(prevAltPos));
          }

          var validInputsClone = [],
              staticInputsBeforePos = 0;

          for (i = decisionPos; i < getLastValidPosition(undefined, true) + 1; i++) {
            validPos = getMaskSet().validPositions[i];

            if (validPos && validPos.generatedInput !== true) {
              validInputsClone.push(validPos.input);
            } else if (i < pos) staticInputsBeforePos++;

            delete getMaskSet().validPositions[i];
          }

          while (getMaskSet().excludes[decisionPos] && getMaskSet().excludes[decisionPos].length < 10) {
            var posOffset = staticInputsBeforePos * -1,
                validInputs = validInputsClone.slice();
            getMaskSet().tests[decisionPos] = undefined;
            resetMaskSet(true);
            isValidRslt = true;

            while (validInputs.length > 0) {
              var input = validInputs.shift();

              if (!(isValidRslt = isValid(getLastValidPosition(undefined, true) + 1, input, false, fromSetValid, true))) {
                break;
              }
            }

            if (isValidRslt && c !== undefined) {
              var targetLvp = getLastValidPosition(pos) + 1;

              for (i = decisionPos; i < getLastValidPosition() + 1; i++) {
                validPos = getMaskSet().validPositions[i];

                if ((validPos === undefined || validPos.match.fn == null) && i < pos + posOffset) {
                  posOffset++;
                }
              }

              pos = pos + posOffset;
              isValidRslt = isValid(pos > targetLvp ? targetLvp : pos, c, strict, fromSetValid, true);
            }

            if (!isValidRslt) {
              resetMaskSet();
              prevAltPos = getTest(decisionPos);
              getMaskSet().validPositions = $.extend(true, {}, validPsClone);

              if (getMaskSet().excludes[decisionPos]) {
                var decisionTaker = getDecisionTaker(prevAltPos);

                if (getMaskSet().excludes[decisionPos].indexOf(decisionTaker) !== -1) {
                  isValidRslt = alternate(pos, c, strict, fromSetValid, decisionPos - 1);
                  break;
                }

                getMaskSet().excludes[decisionPos].push(decisionTaker);

                for (i = decisionPos; i < getLastValidPosition(undefined, true) + 1; i++) {
                  delete getMaskSet().validPositions[i];
                }
              } else {
                isValidRslt = alternate(pos, c, strict, fromSetValid, decisionPos - 1);
                break;
              }
            } else break;
          }
        }

        getMaskSet().excludes[decisionPos] = undefined;
        return isValidRslt;
      }

      function isValid(pos, c, strict, fromSetValid, fromAlternate, validateOnly) {
        function isSelection(posObj) {
          return isRTL ? posObj.begin - posObj.end > 1 || posObj.begin - posObj.end === 1 : posObj.end - posObj.begin > 1 || posObj.end - posObj.begin === 1;
        }

        strict = strict === true;
        var maskPos = pos;

        if (pos.begin !== undefined) {
          maskPos = isRTL ? pos.end : pos.begin;
        }

        function _isValid(position, c, strict) {
          var rslt = false;
          $.each(getTests(position), function (ndx, tst) {
            var test = tst.match;
            getBuffer(true);
            rslt = test.fn != null ? test.fn.test(c, getMaskSet(), position, strict, opts, isSelection(pos)) : (c === test.def || c === opts.skipOptionalPartCharacter) && test.def !== "" ? {
              c: getPlaceholder(position, test, true) || test.def,
              pos: position
            } : false;

            if (rslt !== false) {
              var elem = rslt.c !== undefined ? rslt.c : c,
                  validatedPos = position;
              elem = elem === opts.skipOptionalPartCharacter && test.fn === null ? getPlaceholder(position, test, true) || test.def : elem;

              if (rslt.remove !== undefined) {
                if (!$.isArray(rslt.remove)) rslt.remove = [rslt.remove];
                $.each(rslt.remove.sort(function (a, b) {
                  return b - a;
                }), function (ndx, lmnt) {
                  revalidateMask({
                    begin: lmnt,
                    end: lmnt + 1
                  });
                });
              }

              if (rslt.insert !== undefined) {
                if (!$.isArray(rslt.insert)) rslt.insert = [rslt.insert];
                $.each(rslt.insert.sort(function (a, b) {
                  return a - b;
                }), function (ndx, lmnt) {
                  isValid(lmnt.pos, lmnt.c, true, fromSetValid);
                });
              }

              if (rslt !== true && rslt.pos !== undefined && rslt.pos !== position) {
                validatedPos = rslt.pos;
              }

              if (rslt !== true && rslt.pos === undefined && rslt.c === undefined) {
                return false;
              }

              if (!revalidateMask(pos, $.extend({}, tst, {
                input: casing(elem, test, validatedPos)
              }), fromSetValid, validatedPos)) {
                rslt = false;
              }

              return false;
            }
          });
          return rslt;
        }

        var result = true,
            positionsClone = $.extend(true, {}, getMaskSet().validPositions);

        if ($.isFunction(opts.preValidation) && !strict && fromSetValid !== true && validateOnly !== true) {
          result = opts.preValidation(getBuffer(), maskPos, c, isSelection(pos), opts, getMaskSet());
        }

        if (result === true) {
          trackbackPositions(undefined, maskPos, true);

          if (maxLength === undefined || maskPos < maxLength) {
            result = _isValid(maskPos, c, strict);

            if ((!strict || fromSetValid === true) && result === false && validateOnly !== true) {
              var currentPosValid = getMaskSet().validPositions[maskPos];

              if (currentPosValid && currentPosValid.match.fn === null && (currentPosValid.match.def === c || c === opts.skipOptionalPartCharacter)) {
                result = {
                  caret: seekNext(maskPos)
                };
              } else if ((opts.insertMode || getMaskSet().validPositions[seekNext(maskPos)] === undefined) && !isMask(maskPos, true)) {
                for (var nPos = maskPos + 1, snPos = seekNext(maskPos); nPos <= snPos; nPos++) {
                  result = _isValid(nPos, c, strict);

                  if (result !== false) {
                    result = trackbackPositions(maskPos, result.pos !== undefined ? result.pos : nPos) || result;
                    maskPos = nPos;
                    break;
                  }
                }
              }
            }
          }

          if (result === false && opts.keepStatic !== false && (opts.regex == null || isComplete(getBuffer())) && !strict && fromAlternate !== true) {
            result = alternate(maskPos, c, strict, fromSetValid);
          }

          if (result === true) {
            result = {
              pos: maskPos
            };
          }
        }

        if ($.isFunction(opts.postValidation) && result !== false && !strict && fromSetValid !== true && validateOnly !== true) {
          var postResult = opts.postValidation(getBuffer(true), pos.begin !== undefined ? isRTL ? pos.end : pos.begin : pos, result, opts);

          if (postResult !== undefined) {
            if (postResult.refreshFromBuffer && postResult.buffer) {
              var refresh = postResult.refreshFromBuffer;
              refreshFromBuffer(refresh === true ? refresh : refresh.start, refresh.end, postResult.buffer);
            }

            result = postResult === true ? result : postResult;
          }
        }

        if (result && result.pos === undefined) {
          result.pos = maskPos;
        }

        if (result === false || validateOnly === true) {
          resetMaskSet(true);
          getMaskSet().validPositions = $.extend(true, {}, positionsClone);
        }

        return result;
      }

      function trackbackPositions(originalPos, newPos, fillOnly) {
        var result;

        if (originalPos === undefined) {
          for (originalPos = newPos - 1; originalPos > 0; originalPos--) {
            if (getMaskSet().validPositions[originalPos]) break;
          }
        }

        for (var ps = originalPos; ps < newPos; ps++) {
          if (getMaskSet().validPositions[ps] === undefined && !isMask(ps, true)) {
            var vp = ps == 0 ? getTest(ps) : getMaskSet().validPositions[ps - 1];

            if (vp) {
              var tests = getTests(ps).slice();
              if (tests[tests.length - 1].match.def === "") tests.pop();
              var bestMatch = determineTestTemplate(ps, tests);
              bestMatch = $.extend({}, bestMatch, {
                input: getPlaceholder(ps, bestMatch.match, true) || bestMatch.match.def
              });
              bestMatch.generatedInput = true;
              revalidateMask(ps, bestMatch, true);

              if (fillOnly !== true) {
                var cvpInput = getMaskSet().validPositions[newPos].input;
                getMaskSet().validPositions[newPos] = undefined;
                result = isValid(newPos, cvpInput, true, true);
              }
            }
          }
        }

        return result;
      }

      function revalidateMask(pos, validTest, fromSetValid, validatedPos) {
        function IsEnclosedStatic(pos, valids, selection) {
          var posMatch = valids[pos];

          if (posMatch !== undefined && (posMatch.match.fn === null && posMatch.match.optionality !== true || posMatch.input === opts.radixPoint)) {
            var prevMatch = selection.begin <= pos - 1 ? valids[pos - 1] && valids[pos - 1].match.fn === null && valids[pos - 1] : valids[pos - 1],
                nextMatch = selection.end > pos + 1 ? valids[pos + 1] && valids[pos + 1].match.fn === null && valids[pos + 1] : valids[pos + 1];
            return prevMatch && nextMatch;
          }

          return false;
        }

        var begin = pos.begin !== undefined ? pos.begin : pos,
            end = pos.end !== undefined ? pos.end : pos;

        if (pos.begin > pos.end) {
          begin = pos.end;
          end = pos.begin;
        }

        validatedPos = validatedPos !== undefined ? validatedPos : begin;

        if (begin !== end || opts.insertMode && getMaskSet().validPositions[validatedPos] !== undefined && fromSetValid === undefined) {
          var positionsClone = $.extend(true, {}, getMaskSet().validPositions),
              lvp = getLastValidPosition(undefined, true),
              i;
          getMaskSet().p = begin;

          for (i = lvp; i >= begin; i--) {
            if (getMaskSet().validPositions[i] && getMaskSet().validPositions[i].match.nativeDef === "+") {
              opts.isNegative = false;
            }

            delete getMaskSet().validPositions[i];
          }

          var valid = true,
              j = validatedPos,
              vps = getMaskSet().validPositions,
              needsValidation = false,
              posMatch = j,
              i = j;

          if (validTest) {
            getMaskSet().validPositions[validatedPos] = $.extend(true, {}, validTest);
            posMatch++;
            j++;
            if (begin < end) i++;
          }

          for (; i <= lvp; i++) {
            var t = positionsClone[i];

            if (t !== undefined && (i >= end || i >= begin && t.generatedInput !== true && IsEnclosedStatic(i, positionsClone, {
              begin: begin,
              end: end
            }))) {
              while (getTest(posMatch).match.def !== "") {
                if (needsValidation === false && positionsClone[posMatch] && positionsClone[posMatch].match.nativeDef === t.match.nativeDef) {
                  getMaskSet().validPositions[posMatch] = $.extend(true, {}, positionsClone[posMatch]);
                  getMaskSet().validPositions[posMatch].input = t.input;
                  trackbackPositions(undefined, posMatch, true);
                  j = posMatch + 1;
                  valid = true;
                } else if (positionCanMatchDefinition(posMatch, t.match.def)) {
                  var result = isValid(posMatch, t.input, true, true);
                  valid = result !== false;
                  j = result.caret || result.insert ? getLastValidPosition() : posMatch + 1;
                  needsValidation = true;
                } else {
                  valid = t.generatedInput === true || t.input === opts.radixPoint && opts.numericInput === true;
                }

                if (valid) break;

                if (!valid && posMatch > end && isMask(posMatch, true) && (t.match.fn !== null || posMatch > getMaskSet().maskLength)) {
                  break;
                }

                posMatch++;
              }

              if (getTest(posMatch).match.def == "") valid = false;
              posMatch = j;
            }

            if (!valid) break;
          }

          if (!valid) {
            getMaskSet().validPositions = $.extend(true, {}, positionsClone);
            resetMaskSet(true);
            return false;
          }
        } else if (validTest) {
          getMaskSet().validPositions[validatedPos] = $.extend(true, {}, validTest);
        }

        resetMaskSet(true);
        return true;
      }

      function isMask(pos, strict) {
        var test = getTestTemplate(pos).match;
        if (test.def === "") test = getTest(pos).match;

        if (test.fn != null) {
          return test.fn;
        }

        if (strict !== true && pos > -1) {
          var tests = getTests(pos);
          return tests.length > 1 + (tests[tests.length - 1].match.def === "" ? 1 : 0);
        }

        return false;
      }

      function seekNext(pos, newBlock) {
        var position = pos + 1;

        while (getTest(position).match.def !== "" && (newBlock === true && (getTest(position).match.newBlockMarker !== true || !isMask(position)) || newBlock !== true && !isMask(position))) {
          position++;
        }

        return position;
      }

      function seekPrevious(pos, newBlock) {
        var position = pos,
            tests;
        if (position <= 0) return 0;

        while (--position > 0 && (newBlock === true && getTest(position).match.newBlockMarker !== true || newBlock !== true && !isMask(position) && (tests = getTests(position), tests.length < 2 || tests.length === 2 && tests[1].match.def === ""))) {}

        return position;
      }

      function getBufferElement(position) {
        return getMaskSet().validPositions[position] === undefined ? getPlaceholder(position) : getMaskSet().validPositions[position].input;
      }

      function writeBuffer(input, buffer, caretPos, event, triggerEvents) {
        if (event && $.isFunction(opts.onBeforeWrite)) {
          var result = opts.onBeforeWrite.call(inputmask, event, buffer, caretPos, opts);

          if (result) {
            if (result.refreshFromBuffer) {
              var refresh = result.refreshFromBuffer;
              refreshFromBuffer(refresh === true ? refresh : refresh.start, refresh.end, result.buffer || buffer);
              buffer = getBuffer(true);
            }

            if (caretPos !== undefined) caretPos = result.caret !== undefined ? result.caret : caretPos;
          }
        }

        if (input !== undefined) {
          input.inputmask._valueSet(buffer.join(""));

          if (caretPos !== undefined && (event === undefined || event.type !== "blur")) {
            caret(input, caretPos);
          } else renderColorMask(input, caretPos, buffer.length === 0);

          if (triggerEvents === true) {
            var $input = $(input),
                nptVal = input.inputmask._valueGet();

            skipInputEvent = true;
            $input.trigger("input");
            setTimeout(function () {
              if (nptVal === getBufferTemplate().join("")) {
                $input.trigger("cleared");
              } else if (isComplete(buffer) === true) {
                $input.trigger("complete");
              }
            }, 0);
          }
        }
      }

      function getPlaceholder(pos, test, returnPL) {
        test = test || getTest(pos).match;

        if (test.placeholder !== undefined || returnPL === true) {
          return $.isFunction(test.placeholder) ? test.placeholder(opts) : test.placeholder;
        } else if (test.fn === null) {
          if (pos > -1 && getMaskSet().validPositions[pos] === undefined) {
            var tests = getTests(pos),
                staticAlternations = [],
                prevTest;

            if (tests.length > 1 + (tests[tests.length - 1].match.def === "" ? 1 : 0)) {
              for (var i = 0; i < tests.length; i++) {
                if (tests[i].match.optionality !== true && tests[i].match.optionalQuantifier !== true && (tests[i].match.fn === null || prevTest === undefined || tests[i].match.fn.test(prevTest.match.def, getMaskSet(), pos, true, opts) !== false)) {
                  staticAlternations.push(tests[i]);
                  if (tests[i].match.fn === null) prevTest = tests[i];

                  if (staticAlternations.length > 1) {
                    if (/[0-9a-bA-Z]/.test(staticAlternations[0].match.def)) {
                      return opts.placeholder.charAt(pos % opts.placeholder.length);
                    }
                  }
                }
              }
            }
          }

          return test.def;
        }

        return opts.placeholder.charAt(pos % opts.placeholder.length);
      }

      function HandleNativePlaceholder(npt, value) {
        if (ie && npt.inputmask._valueGet() !== value) {
          var buffer = getBuffer().slice(),
              nptValue = npt.inputmask._valueGet();

          if (nptValue !== value) {
            if (getLastValidPosition() === -1 && nptValue === getBufferTemplate().join("")) {
              buffer = [];
            } else {
              clearOptionalTail(buffer);
            }

            writeBuffer(npt, buffer);
          }
        } else if (npt.placeholder !== value) {
          npt.placeholder = value;
          if (npt.placeholder === "") npt.removeAttribute("placeholder");
        }
      }

      var EventRuler = {
        on: function on(input, eventName, eventHandler) {
          var ev = function ev(e) {
            var that = this;

            if (that.inputmask === undefined && this.nodeName !== "FORM") {
              var imOpts = $.data(that, "_inputmask_opts");
              if (imOpts) new Inputmask(imOpts).mask(that);else EventRuler.off(that);
            } else if (e.type !== "setvalue" && this.nodeName !== "FORM" && (that.disabled || that.readOnly && !(e.type === "keydown" && e.ctrlKey && e.keyCode === 67 || opts.tabThrough === false && e.keyCode === Inputmask.keyCode.TAB))) {
              e.preventDefault();
            } else {
              switch (e.type) {
                case "input":
                  if (skipInputEvent === true) {
                    skipInputEvent = false;
                    return e.preventDefault();
                  }

                  if (mobile) {
                    var args = arguments;
                    setTimeout(function () {
                      eventHandler.apply(that, args);
                      caret(that, that.inputmask.caretPos, undefined, true);
                    }, 0);
                    return false;
                  }

                  break;

                case "keydown":
                  skipKeyPressEvent = false;
                  skipInputEvent = false;
                  break;

                case "keypress":
                  if (skipKeyPressEvent === true) {
                    return e.preventDefault();
                  }

                  skipKeyPressEvent = true;
                  break;

                case "click":
                  if (iemobile || iphone) {
                    var args = arguments;
                    setTimeout(function () {
                      eventHandler.apply(that, args);
                    }, 0);
                    return false;
                  }

                  break;
              }

              var returnVal = eventHandler.apply(that, arguments);

              if (returnVal === false) {
                e.preventDefault();
                e.stopPropagation();
              }

              return returnVal;
            }
          };

          input.inputmask.events[eventName] = input.inputmask.events[eventName] || [];
          input.inputmask.events[eventName].push(ev);

          if ($.inArray(eventName, ["submit", "reset"]) !== -1) {
            if (input.form !== null) $(input.form).on(eventName, ev);
          } else {
            $(input).on(eventName, ev);
          }
        },
        off: function off(input, event) {
          if (input.inputmask && input.inputmask.events) {
            var events;

            if (event) {
              events = [];
              events[event] = input.inputmask.events[event];
            } else {
              events = input.inputmask.events;
            }

            $.each(events, function (eventName, evArr) {
              while (evArr.length > 0) {
                var ev = evArr.pop();

                if ($.inArray(eventName, ["submit", "reset"]) !== -1) {
                  if (input.form !== null) $(input.form).off(eventName, ev);
                } else {
                  $(input).off(eventName, ev);
                }
              }

              delete input.inputmask.events[eventName];
            });
          }
        }
      };
      var EventHandlers = {
        keydownEvent: function keydownEvent(e) {
          var input = this,
              $input = $(input),
              k = e.keyCode,
              pos = caret(input);

          if (k === Inputmask.keyCode.BACKSPACE || k === Inputmask.keyCode.DELETE || iphone && k === Inputmask.keyCode.BACKSPACE_SAFARI || e.ctrlKey && k === Inputmask.keyCode.X && !isInputEventSupported("cut")) {
            e.preventDefault();
            handleRemove(input, k, pos);
            writeBuffer(input, getBuffer(true), getMaskSet().p, e, input.inputmask._valueGet() !== getBuffer().join(""));
          } else if (k === Inputmask.keyCode.END || k === Inputmask.keyCode.PAGE_DOWN) {
            e.preventDefault();
            var caretPos = seekNext(getLastValidPosition());
            caret(input, e.shiftKey ? pos.begin : caretPos, caretPos, true);
          } else if (k === Inputmask.keyCode.HOME && !e.shiftKey || k === Inputmask.keyCode.PAGE_UP) {
            e.preventDefault();
            caret(input, 0, e.shiftKey ? pos.begin : 0, true);
          } else if ((opts.undoOnEscape && k === Inputmask.keyCode.ESCAPE || k === 90 && e.ctrlKey) && e.altKey !== true) {
            checkVal(input, true, false, undoValue.split(""));
            $input.trigger("click");
          } else if (k === Inputmask.keyCode.INSERT && !(e.shiftKey || e.ctrlKey)) {
            opts.insertMode = !opts.insertMode;
            input.setAttribute("im-insert", opts.insertMode);
          } else if (opts.tabThrough === true && k === Inputmask.keyCode.TAB) {
            if (e.shiftKey === true) {
              if (getTest(pos.begin).match.fn === null) {
                pos.begin = seekNext(pos.begin);
              }

              pos.end = seekPrevious(pos.begin, true);
              pos.begin = seekPrevious(pos.end, true);
            } else {
              pos.begin = seekNext(pos.begin, true);
              pos.end = seekNext(pos.begin, true);
              if (pos.end < getMaskSet().maskLength) pos.end--;
            }

            if (pos.begin < getMaskSet().maskLength) {
              e.preventDefault();
              caret(input, pos.begin, pos.end);
            }
          }

          opts.onKeyDown.call(this, e, getBuffer(), caret(input).begin, opts);
          ignorable = $.inArray(k, opts.ignorables) !== -1;
        },
        keypressEvent: function keypressEvent(e, checkval, writeOut, strict, ndx) {
          var input = this,
              $input = $(input),
              k = e.which || e.charCode || e.keyCode;

          if (checkval !== true && !(e.ctrlKey && e.altKey) && (e.ctrlKey || e.metaKey || ignorable)) {
            if (k === Inputmask.keyCode.ENTER && undoValue !== getBuffer().join("")) {
              undoValue = getBuffer().join("");
              setTimeout(function () {
                $input.trigger("change");
              }, 0);
            }

            return true;
          } else {
            if (k) {
              if (k === 46 && e.shiftKey === false && opts.radixPoint !== "") k = opts.radixPoint.charCodeAt(0);
              var pos = checkval ? {
                begin: ndx,
                end: ndx
              } : caret(input),
                  forwardPosition,
                  c = String.fromCharCode(k),
                  offset = 0;

              if (opts._radixDance && opts.numericInput) {
                var caretPos = getBuffer().indexOf(opts.radixPoint.charAt(0)) + 1;

                if (pos.begin <= caretPos) {
                  if (k === opts.radixPoint.charCodeAt(0)) offset = 1;
                  pos.begin -= 1;
                  pos.end -= 1;
                }
              }

              getMaskSet().writeOutBuffer = true;
              var valResult = isValid(pos, c, strict);

              if (valResult !== false) {
                resetMaskSet(true);
                forwardPosition = valResult.caret !== undefined ? valResult.caret : seekNext(valResult.pos.begin ? valResult.pos.begin : valResult.pos);
                getMaskSet().p = forwardPosition;
              }

              forwardPosition = (opts.numericInput && valResult.caret === undefined ? seekPrevious(forwardPosition) : forwardPosition) + offset;

              if (writeOut !== false) {
                setTimeout(function () {
                  opts.onKeyValidation.call(input, k, valResult, opts);
                }, 0);

                if (getMaskSet().writeOutBuffer && valResult !== false) {
                  var buffer = getBuffer();
                  writeBuffer(input, buffer, forwardPosition, e, checkval !== true);
                }
              }

              e.preventDefault();

              if (checkval) {
                if (valResult !== false) valResult.forwardPosition = forwardPosition;
                return valResult;
              }
            }
          }
        },
        pasteEvent: function pasteEvent(e) {
          var input = this,
              ev = e.originalEvent || e,
              $input = $(input),
              inputValue = input.inputmask._valueGet(true),
              caretPos = caret(input),
              tempValue;

          if (isRTL) {
            tempValue = caretPos.end;
            caretPos.end = caretPos.begin;
            caretPos.begin = tempValue;
          }

          var valueBeforeCaret = inputValue.substr(0, caretPos.begin),
              valueAfterCaret = inputValue.substr(caretPos.end, inputValue.length);
          if (valueBeforeCaret === (isRTL ? getBufferTemplate().reverse() : getBufferTemplate()).slice(0, caretPos.begin).join("")) valueBeforeCaret = "";
          if (valueAfterCaret === (isRTL ? getBufferTemplate().reverse() : getBufferTemplate()).slice(caretPos.end).join("")) valueAfterCaret = "";

          if (window.clipboardData && window.clipboardData.getData) {
            inputValue = valueBeforeCaret + window.clipboardData.getData("Text") + valueAfterCaret;
          } else if (ev.clipboardData && ev.clipboardData.getData) {
            inputValue = valueBeforeCaret + ev.clipboardData.getData("text/plain") + valueAfterCaret;
          } else return true;

          var pasteValue = inputValue;

          if ($.isFunction(opts.onBeforePaste)) {
            pasteValue = opts.onBeforePaste.call(inputmask, inputValue, opts);

            if (pasteValue === false) {
              return e.preventDefault();
            }

            if (!pasteValue) {
              pasteValue = inputValue;
            }
          }

          checkVal(input, false, false, pasteValue.toString().split(""));
          writeBuffer(input, getBuffer(), seekNext(getLastValidPosition()), e, undoValue !== getBuffer().join(""));
          return e.preventDefault();
        },
        inputFallBackEvent: function inputFallBackEvent(e) {
          function radixPointHandler(input, inputValue, caretPos) {
            if (inputValue.charAt(caretPos.begin - 1) === "." && opts.radixPoint !== "") {
              inputValue = inputValue.split("");
              inputValue[caretPos.begin - 1] = opts.radixPoint.charAt(0);
              inputValue = inputValue.join("");
            }

            return inputValue;
          }

          function ieMobileHandler(input, inputValue, caretPos) {
            if (iemobile) {
              var inputChar = inputValue.replace(getBuffer().join(""), "");

              if (inputChar.length === 1) {
                var iv = inputValue.split("");
                iv.splice(caretPos.begin, 0, inputChar);
                inputValue = iv.join("");
              }
            }

            return inputValue;
          }

          var input = this,
              inputValue = input.inputmask._valueGet();

          if (getBuffer().join("") !== inputValue) {
            var caretPos = caret(input);
            inputValue = radixPointHandler(input, inputValue, caretPos);
            inputValue = ieMobileHandler(input, inputValue, caretPos);

            if (getBuffer().join("") !== inputValue) {
              var buffer = getBuffer().join(""),
                  offset = !opts.numericInput && inputValue.length > buffer.length ? -1 : 0,
                  frontPart = inputValue.substr(0, caretPos.begin),
                  backPart = inputValue.substr(caretPos.begin),
                  frontBufferPart = buffer.substr(0, caretPos.begin + offset),
                  backBufferPart = buffer.substr(caretPos.begin + offset);
              var selection = caretPos,
                  entries = "",
                  isEntry = false;

              if (frontPart !== frontBufferPart) {
                var fpl = (isEntry = frontPart.length >= frontBufferPart.length) ? frontPart.length : frontBufferPart.length,
                    i;

                for (i = 0; frontPart.charAt(i) === frontBufferPart.charAt(i) && i < fpl; i++) {}

                if (isEntry) {
                  selection.begin = i - offset;
                  entries += frontPart.slice(i, selection.end);
                }
              }

              if (backPart !== backBufferPart) {
                if (backPart.length > backBufferPart.length) {
                  entries += backPart.slice(0, 1);
                } else {
                  if (backPart.length < backBufferPart.length) {
                    selection.end += backBufferPart.length - backPart.length;

                    if (!isEntry && opts.radixPoint !== "" && backPart === "" && frontPart.charAt(selection.begin + offset - 1) === opts.radixPoint) {
                      selection.begin--;
                      entries = opts.radixPoint;
                    }
                  }
                }
              }

              writeBuffer(input, getBuffer(), {
                begin: selection.begin + offset,
                end: selection.end + offset
              });

              if (entries.length > 0) {
                $.each(entries.split(""), function (ndx, entry) {
                  var keypress = new $.Event("keypress");
                  keypress.which = entry.charCodeAt(0);
                  ignorable = false;
                  EventHandlers.keypressEvent.call(input, keypress);
                });
              } else {
                if (selection.begin === selection.end - 1) {
                  selection.begin = seekPrevious(selection.begin + 1);

                  if (selection.begin === selection.end - 1) {
                    caret(input, selection.begin);
                  } else {
                    caret(input, selection.begin, selection.end);
                  }
                }

                var keydown = new $.Event("keydown");
                keydown.keyCode = opts.numericInput ? Inputmask.keyCode.BACKSPACE : Inputmask.keyCode.DELETE;
                EventHandlers.keydownEvent.call(input, keydown);
              }

              e.preventDefault();
            }
          }
        },
        beforeInputEvent: function beforeInputEvent(e) {
          if (e.cancelable) {
            var input = this;

            switch (e.inputType) {
              case "insertText":
                $.each(e.data.split(""), function (ndx, entry) {
                  var keypress = new $.Event("keypress");
                  keypress.which = entry.charCodeAt(0);
                  ignorable = false;
                  EventHandlers.keypressEvent.call(input, keypress);
                });
                return e.preventDefault();

              case "deleteContentBackward":
                var keydown = new $.Event("keydown");
                keydown.keyCode = Inputmask.keyCode.BACKSPACE;
                EventHandlers.keydownEvent.call(input, keydown);
                return e.preventDefault();

              case "deleteContentForward":
                var keydown = new $.Event("keydown");
                keydown.keyCode = Inputmask.keyCode.DELETE;
                EventHandlers.keydownEvent.call(input, keydown);
                return e.preventDefault();
            }
          }
        },
        setValueEvent: function setValueEvent(e) {
          this.inputmask.refreshValue = false;

          var input = this,
              value = e && e.detail ? e.detail[0] : arguments[1],
              value = value || input.inputmask._valueGet(true);

          if ($.isFunction(opts.onBeforeMask)) value = opts.onBeforeMask.call(inputmask, value, opts) || value;
          value = value.split("");
          checkVal(input, true, false, value);
          undoValue = getBuffer().join("");

          if ((opts.clearMaskOnLostFocus || opts.clearIncomplete) && input.inputmask._valueGet() === getBufferTemplate().join("")) {
            input.inputmask._valueSet("");
          }
        },
        focusEvent: function focusEvent(e) {
          var input = this,
              nptValue = input.inputmask._valueGet();

          if (opts.showMaskOnFocus && (!opts.showMaskOnHover || opts.showMaskOnHover && nptValue === "")) {
            if (input.inputmask._valueGet() !== getBuffer().join("")) {
              writeBuffer(input, getBuffer(), seekNext(getLastValidPosition()));
            } else if (mouseEnter === false) {
              caret(input, seekNext(getLastValidPosition()));
            }
          }

          if (opts.positionCaretOnTab === true && mouseEnter === false) {
            EventHandlers.clickEvent.apply(input, [e, true]);
          }

          undoValue = getBuffer().join("");
        },
        mouseleaveEvent: function mouseleaveEvent(e) {
          var input = this;
          mouseEnter = false;

          if (opts.clearMaskOnLostFocus && document.activeElement !== input) {
            HandleNativePlaceholder(input, originalPlaceholder);
          }
        },
        clickEvent: function clickEvent(e, tabbed) {
          function doRadixFocus(clickPos) {
            if (opts.radixPoint !== "") {
              var vps = getMaskSet().validPositions;

              if (vps[clickPos] === undefined || vps[clickPos].input === getPlaceholder(clickPos)) {
                if (clickPos < seekNext(-1)) return true;
                var radixPos = $.inArray(opts.radixPoint, getBuffer());

                if (radixPos !== -1) {
                  for (var vp in vps) {
                    if (radixPos < vp && vps[vp].input !== getPlaceholder(vp)) {
                      return false;
                    }
                  }

                  return true;
                }
              }
            }

            return false;
          }

          var input = this;
          setTimeout(function () {
            if (document.activeElement === input) {
              var selectedCaret = caret(input);

              if (tabbed) {
                if (isRTL) {
                  selectedCaret.end = selectedCaret.begin;
                } else {
                  selectedCaret.begin = selectedCaret.end;
                }
              }

              if (selectedCaret.begin === selectedCaret.end) {
                switch (opts.positionCaretOnClick) {
                  case "none":
                    break;

                  case "select":
                    caret(input, 0, getBuffer().length);
                    break;

                  case "ignore":
                    caret(input, seekNext(getLastValidPosition()));
                    break;

                  case "radixFocus":
                    if (doRadixFocus(selectedCaret.begin)) {
                      var radixPos = getBuffer().join("").indexOf(opts.radixPoint);
                      caret(input, opts.numericInput ? seekNext(radixPos) : radixPos);
                      break;
                    }

                  default:
                    var clickPosition = selectedCaret.begin,
                        lvclickPosition = getLastValidPosition(clickPosition, true),
                        lastPosition = seekNext(lvclickPosition);

                    if (clickPosition < lastPosition) {
                      caret(input, !isMask(clickPosition, true) && !isMask(clickPosition - 1, true) ? seekNext(clickPosition) : clickPosition);
                    } else {
                      var lvp = getMaskSet().validPositions[lvclickPosition],
                          tt = getTestTemplate(lastPosition, lvp ? lvp.match.locator : undefined, lvp),
                          placeholder = getPlaceholder(lastPosition, tt.match);

                      if (placeholder !== "" && getBuffer()[lastPosition] !== placeholder && tt.match.optionalQuantifier !== true && tt.match.newBlockMarker !== true || !isMask(lastPosition, opts.keepStatic) && tt.match.def === placeholder) {
                        var newPos = seekNext(lastPosition);

                        if (clickPosition >= newPos || clickPosition === lastPosition) {
                          lastPosition = newPos;
                        }
                      }

                      caret(input, lastPosition);
                    }

                    break;
                }
              }
            }
          }, 0);
        },
        cutEvent: function cutEvent(e) {
          var input = this,
              $input = $(input),
              pos = caret(input),
              ev = e.originalEvent || e;
          var clipboardData = window.clipboardData || ev.clipboardData,
              clipData = isRTL ? getBuffer().slice(pos.end, pos.begin) : getBuffer().slice(pos.begin, pos.end);
          clipboardData.setData("text", isRTL ? clipData.reverse().join("") : clipData.join(""));
          if (document.execCommand) document.execCommand("copy");
          handleRemove(input, Inputmask.keyCode.DELETE, pos);
          writeBuffer(input, getBuffer(), getMaskSet().p, e, undoValue !== getBuffer().join(""));
        },
        blurEvent: function blurEvent(e) {
          var $input = $(this),
              input = this;

          if (input.inputmask) {
            HandleNativePlaceholder(input, originalPlaceholder);

            var nptValue = input.inputmask._valueGet(),
                buffer = getBuffer().slice();

            if (nptValue !== "" || colorMask !== undefined) {
              if (opts.clearMaskOnLostFocus) {
                if (getLastValidPosition() === -1 && nptValue === getBufferTemplate().join("")) {
                  buffer = [];
                } else {
                  clearOptionalTail(buffer);
                }
              }

              if (isComplete(buffer) === false) {
                setTimeout(function () {
                  $input.trigger("incomplete");
                }, 0);

                if (opts.clearIncomplete) {
                  resetMaskSet();

                  if (opts.clearMaskOnLostFocus) {
                    buffer = [];
                  } else {
                    buffer = getBufferTemplate().slice();
                  }
                }
              }

              writeBuffer(input, buffer, undefined, e);
            }

            if (undoValue !== getBuffer().join("")) {
              undoValue = buffer.join("");
              $input.trigger("change");
            }
          }
        },
        mouseenterEvent: function mouseenterEvent(e) {
          var input = this;
          mouseEnter = true;

          if (document.activeElement !== input && opts.showMaskOnHover) {
            HandleNativePlaceholder(input, (isRTL ? getBuffer().slice().reverse() : getBuffer()).join(""));
          }
        },
        submitEvent: function submitEvent(e) {
          if (undoValue !== getBuffer().join("")) {
            $el.trigger("change");
          }

          if (opts.clearMaskOnLostFocus && getLastValidPosition() === -1 && el.inputmask._valueGet && el.inputmask._valueGet() === getBufferTemplate().join("")) {
            el.inputmask._valueSet("");
          }

          if (opts.clearIncomplete && isComplete(getBuffer()) === false) {
            el.inputmask._valueSet("");
          }

          if (opts.removeMaskOnSubmit) {
            el.inputmask._valueSet(el.inputmask.unmaskedvalue(), true);

            setTimeout(function () {
              writeBuffer(el, getBuffer());
            }, 0);
          }
        },
        resetEvent: function resetEvent(e) {
          el.inputmask.refreshValue = true;
          setTimeout(function () {
            $el.trigger("setvalue");
          }, 0);
        }
      };

      function checkVal(input, writeOut, strict, nptvl, initiatingEvent) {
        var inputmask = this || input.inputmask,
            inputValue = nptvl.slice(),
            charCodes = "",
            initialNdx = -1,
            result = undefined;

        function isTemplateMatch(ndx, charCodes) {
          var charCodeNdx = getMaskTemplate(true, 0, false).slice(ndx, seekNext(ndx)).join("").replace(/'/g, "").indexOf(charCodes);
          return charCodeNdx !== -1 && !isMask(ndx) && (getTest(ndx).match.nativeDef === charCodes.charAt(0) || getTest(ndx).match.fn === null && getTest(ndx).match.nativeDef === "'" + charCodes.charAt(0) || getTest(ndx).match.nativeDef === " " && (getTest(ndx + 1).match.nativeDef === charCodes.charAt(0) || getTest(ndx + 1).match.fn === null && getTest(ndx + 1).match.nativeDef === "'" + charCodes.charAt(0)));
        }

        resetMaskSet();

        if (!strict && opts.autoUnmask !== true) {
          var staticInput = getBufferTemplate().slice(0, seekNext(-1)).join(""),
              matches = inputValue.join("").match(new RegExp("^" + Inputmask.escapeRegex(staticInput), "g"));

          if (matches && matches.length > 0) {
            inputValue.splice(0, matches.length * staticInput.length);
            initialNdx = seekNext(initialNdx);
          }
        } else {
          initialNdx = seekNext(initialNdx);
        }

        if (initialNdx === -1) {
          getMaskSet().p = seekNext(initialNdx);
          initialNdx = 0;
        } else getMaskSet().p = initialNdx;

        inputmask.caretPos = {
          begin: initialNdx
        };
        $.each(inputValue, function (ndx, charCode) {
          if (charCode !== undefined) {
            if (getMaskSet().validPositions[ndx] === undefined && inputValue[ndx] === getPlaceholder(ndx) && isMask(ndx, true) && isValid(ndx, inputValue[ndx], true, undefined, undefined, true) === false) {
              getMaskSet().p++;
            } else {
              var keypress = new $.Event("_checkval");
              keypress.which = charCode.charCodeAt(0);
              charCodes += charCode;
              var lvp = getLastValidPosition(undefined, true);

              if (!isTemplateMatch(initialNdx, charCodes)) {
                result = EventHandlers.keypressEvent.call(input, keypress, true, false, strict, inputmask.caretPos.begin);

                if (result) {
                  initialNdx = inputmask.caretPos.begin + 1;
                  charCodes = "";
                }
              } else {
                result = EventHandlers.keypressEvent.call(input, keypress, true, false, strict, lvp + 1);
              }

              if (result) {
                writeBuffer(undefined, getBuffer(), result.forwardPosition, keypress, false);
                inputmask.caretPos = {
                  begin: result.forwardPosition,
                  end: result.forwardPosition
                };
              }
            }
          }
        });
        if (writeOut) writeBuffer(input, getBuffer(), result ? result.forwardPosition : undefined, initiatingEvent || new $.Event("checkval"), initiatingEvent && initiatingEvent.type === "input");
      }

      function unmaskedvalue(input) {
        if (input) {
          if (input.inputmask === undefined) {
            return input.value;
          }

          if (input.inputmask && input.inputmask.refreshValue) {
            EventHandlers.setValueEvent.call(input);
          }
        }

        var umValue = [],
            vps = getMaskSet().validPositions;

        for (var pndx in vps) {
          if (vps[pndx].match && vps[pndx].match.fn != null) {
            umValue.push(vps[pndx].input);
          }
        }

        var unmaskedValue = umValue.length === 0 ? "" : (isRTL ? umValue.reverse() : umValue).join("");

        if ($.isFunction(opts.onUnMask)) {
          var bufferValue = (isRTL ? getBuffer().slice().reverse() : getBuffer()).join("");
          unmaskedValue = opts.onUnMask.call(inputmask, bufferValue, unmaskedValue, opts);
        }

        return unmaskedValue;
      }

      function caret(input, begin, end, notranslate) {
        function translatePosition(pos) {
          if (isRTL && typeof pos === "number" && (!opts.greedy || opts.placeholder !== "") && el) {
            pos = el.inputmask._valueGet().length - pos;
          }

          return pos;
        }

        var range;

        if (begin !== undefined) {
          if ($.isArray(begin)) {
            end = isRTL ? begin[0] : begin[1];
            begin = isRTL ? begin[1] : begin[0];
          }

          if (begin.begin !== undefined) {
            end = isRTL ? begin.begin : begin.end;
            begin = isRTL ? begin.end : begin.begin;
          }

          if (typeof begin === "number") {
            begin = notranslate ? begin : translatePosition(begin);
            end = notranslate ? end : translatePosition(end);
            end = typeof end == "number" ? end : begin;
            var scrollCalc = parseInt(((input.ownerDocument.defaultView || window).getComputedStyle ? (input.ownerDocument.defaultView || window).getComputedStyle(input, null) : input.currentStyle).fontSize) * end;
            input.scrollLeft = scrollCalc > input.scrollWidth ? scrollCalc : 0;
            input.inputmask.caretPos = {
              begin: begin,
              end: end
            };

            if (input === document.activeElement) {
              if ("selectionStart" in input) {
                input.selectionStart = begin;
                input.selectionEnd = end;
              } else if (window.getSelection) {
                range = document.createRange();

                if (input.firstChild === undefined || input.firstChild === null) {
                  var textNode = document.createTextNode("");
                  input.appendChild(textNode);
                }

                range.setStart(input.firstChild, begin < input.inputmask._valueGet().length ? begin : input.inputmask._valueGet().length);
                range.setEnd(input.firstChild, end < input.inputmask._valueGet().length ? end : input.inputmask._valueGet().length);
                range.collapse(true);
                var sel = window.getSelection();
                sel.removeAllRanges();
                sel.addRange(range);
              } else if (input.createTextRange) {
                range = input.createTextRange();
                range.collapse(true);
                range.moveEnd("character", end);
                range.moveStart("character", begin);
                range.select();
              }

              renderColorMask(input, {
                begin: begin,
                end: end
              });
            }
          }
        } else {
          if ("selectionStart" in input) {
            begin = input.selectionStart;
            end = input.selectionEnd;
          } else if (window.getSelection) {
            range = window.getSelection().getRangeAt(0);

            if (range.commonAncestorContainer.parentNode === input || range.commonAncestorContainer === input) {
              begin = range.startOffset;
              end = range.endOffset;
            }
          } else if (document.selection && document.selection.createRange) {
            range = document.selection.createRange();
            begin = 0 - range.duplicate().moveStart("character", -input.inputmask._valueGet().length);
            end = begin + range.text.length;
          }

          return {
            begin: notranslate ? begin : translatePosition(begin),
            end: notranslate ? end : translatePosition(end)
          };
        }
      }

      function determineLastRequiredPosition(returnDefinition) {
        var buffer = getMaskTemplate(true, getLastValidPosition(), true, true),
            bl = buffer.length,
            pos,
            lvp = getLastValidPosition(),
            positions = {},
            lvTest = getMaskSet().validPositions[lvp],
            ndxIntlzr = lvTest !== undefined ? lvTest.locator.slice() : undefined,
            testPos;

        for (pos = lvp + 1; pos < buffer.length; pos++) {
          testPos = getTestTemplate(pos, ndxIntlzr, pos - 1);
          ndxIntlzr = testPos.locator.slice();
          positions[pos] = $.extend(true, {}, testPos);
        }

        var lvTestAlt = lvTest && lvTest.alternation !== undefined ? lvTest.locator[lvTest.alternation] : undefined;

        for (pos = bl - 1; pos > lvp; pos--) {
          testPos = positions[pos];

          if ((testPos.match.optionality || testPos.match.optionalQuantifier && testPos.match.newBlockMarker || lvTestAlt && (lvTestAlt !== positions[pos].locator[lvTest.alternation] && testPos.match.fn != null || testPos.match.fn === null && testPos.locator[lvTest.alternation] && checkAlternationMatch(testPos.locator[lvTest.alternation].toString().split(","), lvTestAlt.toString().split(",")) && getTests(pos)[0].def !== "")) && buffer[pos] === getPlaceholder(pos, testPos.match)) {
            bl--;
          } else break;
        }

        return returnDefinition ? {
          l: bl,
          def: positions[bl] ? positions[bl].match : undefined
        } : bl;
      }

      function clearOptionalTail(buffer) {
        buffer.length = 0;
        var template = getMaskTemplate(true, 0, true, undefined, true),
            lmnt,
            validPos;

        while (lmnt = template.shift(), lmnt !== undefined) {
          buffer.push(lmnt);
        }

        return buffer;
      }

      function isComplete(buffer) {
        if ($.isFunction(opts.isComplete)) return opts.isComplete(buffer, opts);
        if (opts.repeat === "*") return undefined;
        var complete = false,
            lrp = determineLastRequiredPosition(true),
            aml = seekPrevious(lrp.l);

        if (lrp.def === undefined || lrp.def.newBlockMarker || lrp.def.optionality || lrp.def.optionalQuantifier) {
          complete = true;

          for (var i = 0; i <= aml; i++) {
            var test = getTestTemplate(i).match;

            if (test.fn !== null && getMaskSet().validPositions[i] === undefined && test.optionality !== true && test.optionalQuantifier !== true || test.fn === null && buffer[i] !== getPlaceholder(i, test)) {
              complete = false;
              break;
            }
          }
        }

        return complete;
      }

      function handleRemove(input, k, pos, strict, fromIsValid) {
        if (opts.numericInput || isRTL) {
          if (k === Inputmask.keyCode.BACKSPACE) {
            k = Inputmask.keyCode.DELETE;
          } else if (k === Inputmask.keyCode.DELETE) {
            k = Inputmask.keyCode.BACKSPACE;
          }

          if (isRTL) {
            var pend = pos.end;
            pos.end = pos.begin;
            pos.begin = pend;
          }
        }

        if (k === Inputmask.keyCode.BACKSPACE && pos.end - pos.begin < 1) {
          pos.begin = seekPrevious(pos.begin);

          if (getMaskSet().validPositions[pos.begin] !== undefined && getMaskSet().validPositions[pos.begin].input === opts.groupSeparator) {
            pos.begin--;
          }
        } else if (k === Inputmask.keyCode.DELETE && pos.begin === pos.end) {
          pos.end = isMask(pos.end, true) && getMaskSet().validPositions[pos.end] && getMaskSet().validPositions[pos.end].input !== opts.radixPoint ? pos.end + 1 : seekNext(pos.end) + 1;

          if (getMaskSet().validPositions[pos.begin] !== undefined && getMaskSet().validPositions[pos.begin].input === opts.groupSeparator) {
            pos.end++;
          }
        }

        revalidateMask(pos);

        if (strict !== true && opts.keepStatic !== false || opts.regex !== null) {
          var result = alternate(true);

          if (result) {
            var newPos = result.caret !== undefined ? result.caret : result.pos ? seekNext(result.pos.begin ? result.pos.begin : result.pos) : getLastValidPosition(-1, true);

            if (k !== Inputmask.keyCode.DELETE || pos.begin > newPos) {
              pos.begin == newPos;
            }
          }
        }

        var lvp = getLastValidPosition(pos.begin, true);

        if (lvp < pos.begin || pos.begin === -1) {
          getMaskSet().p = seekNext(lvp);
        } else if (strict !== true) {
          getMaskSet().p = pos.begin;

          if (fromIsValid !== true) {
            while (getMaskSet().p < lvp && getMaskSet().validPositions[getMaskSet().p] === undefined) {
              getMaskSet().p++;
            }
          }
        }
      }

      function initializeColorMask(input) {
        var computedStyle = (input.ownerDocument.defaultView || window).getComputedStyle(input, null);

        function findCaretPos(clientx) {
          var e = document.createElement("span"),
              caretPos;

          for (var style in computedStyle) {
            if (isNaN(style) && style.indexOf("font") !== -1) {
              e.style[style] = computedStyle[style];
            }
          }

          e.style.textTransform = computedStyle.textTransform;
          e.style.letterSpacing = computedStyle.letterSpacing;
          e.style.position = "absolute";
          e.style.height = "auto";
          e.style.width = "auto";
          e.style.visibility = "hidden";
          e.style.whiteSpace = "nowrap";
          document.body.appendChild(e);

          var inputText = input.inputmask._valueGet(),
              previousWidth = 0,
              itl;

          for (caretPos = 0, itl = inputText.length; caretPos <= itl; caretPos++) {
            e.innerHTML += inputText.charAt(caretPos) || "_";

            if (e.offsetWidth >= clientx) {
              var offset1 = clientx - previousWidth;
              var offset2 = e.offsetWidth - clientx;
              e.innerHTML = inputText.charAt(caretPos);
              offset1 -= e.offsetWidth / 3;
              caretPos = offset1 < offset2 ? caretPos - 1 : caretPos;
              break;
            }

            previousWidth = e.offsetWidth;
          }

          document.body.removeChild(e);
          return caretPos;
        }

        var template = document.createElement("div");
        template.style.width = computedStyle.width;
        template.style.textAlign = computedStyle.textAlign;
        colorMask = document.createElement("div");
        input.inputmask.colorMask = colorMask;
        colorMask.className = "im-colormask";
        input.parentNode.insertBefore(colorMask, input);
        input.parentNode.removeChild(input);
        colorMask.appendChild(input);
        colorMask.appendChild(template);
        input.style.left = template.offsetLeft + "px";
        $(colorMask).on("mouseleave", function (e) {
          return EventHandlers.mouseleaveEvent.call(input, [e]);
        });
        $(colorMask).on("mouseenter", function (e) {
          return EventHandlers.mouseenterEvent.call(input, [e]);
        });
        $(colorMask).on("click", function (e) {
          caret(input, findCaretPos(e.clientX));
          return EventHandlers.clickEvent.call(input, [e]);
        });
      }

      Inputmask.prototype.positionColorMask = function (input, template) {
        input.style.left = template.offsetLeft + "px";
      };

      function renderColorMask(input, caretPos, clear) {
        var maskTemplate = [],
            isStatic = false,
            test,
            testPos,
            ndxIntlzr,
            pos = 0;

        function setEntry(entry) {
          if (entry === undefined) entry = "";

          if (!isStatic && (test.fn === null || testPos.input === undefined)) {
            isStatic = true;
            maskTemplate.push("<span class='im-static'>" + entry);
          } else if (isStatic && (test.fn !== null && testPos.input !== undefined || test.def === "")) {
            isStatic = false;
            var mtl = maskTemplate.length;
            maskTemplate[mtl - 1] = maskTemplate[mtl - 1] + "</span>";
            maskTemplate.push(entry);
          } else maskTemplate.push(entry);
        }

        function setCaret() {
          if (document.activeElement === input) {
            maskTemplate.splice(caretPos.begin, 0, caretPos.begin === caretPos.end || caretPos.end > getMaskSet().maskLength ? '<mark class="im-caret" style="border-right-width: 1px;border-right-style: solid;">' : '<mark class="im-caret-select">');
            maskTemplate.splice(caretPos.end + 1, 0, "</mark>");
          }
        }

        if (colorMask !== undefined) {
          var buffer = getBuffer();

          if (caretPos === undefined) {
            caretPos = caret(input);
          } else if (caretPos.begin === undefined) {
            caretPos = {
              begin: caretPos,
              end: caretPos
            };
          }

          if (clear !== true) {
            var lvp = getLastValidPosition();

            do {
              if (getMaskSet().validPositions[pos]) {
                testPos = getMaskSet().validPositions[pos];
                test = testPos.match;
                ndxIntlzr = testPos.locator.slice();
                setEntry(buffer[pos]);
              } else {
                testPos = getTestTemplate(pos, ndxIntlzr, pos - 1);
                test = testPos.match;
                ndxIntlzr = testPos.locator.slice();

                if (opts.jitMasking === false || pos < lvp || typeof opts.jitMasking === "number" && isFinite(opts.jitMasking) && opts.jitMasking > pos) {
                  setEntry(getPlaceholder(pos, test));
                } else isStatic = false;
              }

              pos++;
            } while ((maxLength === undefined || pos < maxLength) && (test.fn !== null || test.def !== "") || lvp > pos || isStatic);

            if (isStatic) setEntry();
            setCaret();
          }

          var template = colorMask.getElementsByTagName("div")[0];
          template.innerHTML = maskTemplate.join("");
          input.inputmask.positionColorMask(input, template);
        }
      }

      function mask(elem) {
        function isElementTypeSupported(input, opts) {
          function patchValueProperty(npt) {
            var valueGet;
            var valueSet;

            function patchValhook(type) {
              if ($.valHooks && ($.valHooks[type] === undefined || $.valHooks[type].inputmaskpatch !== true)) {
                var valhookGet = $.valHooks[type] && $.valHooks[type].get ? $.valHooks[type].get : function (elem) {
                  return elem.value;
                };
                var valhookSet = $.valHooks[type] && $.valHooks[type].set ? $.valHooks[type].set : function (elem, value) {
                  elem.value = value;
                  return elem;
                };
                $.valHooks[type] = {
                  get: function get(elem) {
                    if (elem.inputmask) {
                      if (elem.inputmask.opts.autoUnmask) {
                        return elem.inputmask.unmaskedvalue();
                      } else {
                        var result = valhookGet(elem);
                        return getLastValidPosition(undefined, undefined, elem.inputmask.maskset.validPositions) !== -1 || opts.nullable !== true ? result : "";
                      }
                    } else return valhookGet(elem);
                  },
                  set: function set(elem, value) {
                    var $elem = $(elem),
                        result;
                    result = valhookSet(elem, value);

                    if (elem.inputmask) {
                      $elem.trigger("setvalue", [value]);
                    }

                    return result;
                  },
                  inputmaskpatch: true
                };
              }
            }

            function getter() {
              if (this.inputmask) {
                return this.inputmask.opts.autoUnmask ? this.inputmask.unmaskedvalue() : getLastValidPosition() !== -1 || opts.nullable !== true ? document.activeElement === this && opts.clearMaskOnLostFocus ? (isRTL ? clearOptionalTail(getBuffer().slice()).reverse() : clearOptionalTail(getBuffer().slice())).join("") : valueGet.call(this) : "";
              } else return valueGet.call(this);
            }

            function setter(value) {
              valueSet.call(this, value);

              if (this.inputmask) {
                $(this).trigger("setvalue", [value]);
              }
            }

            function installNativeValueSetFallback(npt) {
              EventRuler.on(npt, "mouseenter", function (event) {
                var $input = $(this),
                    input = this,
                    value = input.inputmask._valueGet();

                if (value !== getBuffer().join("")) {
                  $input.trigger("setvalue");
                }
              });
            }

            if (!npt.inputmask.__valueGet) {
              if (opts.noValuePatching !== true) {
                if (Object.getOwnPropertyDescriptor) {
                  if (typeof Object.getPrototypeOf !== "function") {
                    Object.getPrototypeOf = _typeof("test".__proto__) === "object" ? function (object) {
                      return object.__proto__;
                    } : function (object) {
                      return object.constructor.prototype;
                    };
                  }

                  var valueProperty = Object.getPrototypeOf ? Object.getOwnPropertyDescriptor(Object.getPrototypeOf(npt), "value") : undefined;

                  if (valueProperty && valueProperty.get && valueProperty.set) {
                    valueGet = valueProperty.get;
                    valueSet = valueProperty.set;
                    Object.defineProperty(npt, "value", {
                      get: getter,
                      set: setter,
                      configurable: true
                    });
                  } else if (npt.tagName !== "INPUT") {
                    valueGet = function valueGet() {
                      return this.textContent;
                    };

                    valueSet = function valueSet(value) {
                      this.textContent = value;
                    };

                    Object.defineProperty(npt, "value", {
                      get: getter,
                      set: setter,
                      configurable: true
                    });
                  }
                } else if (document.__lookupGetter__ && npt.__lookupGetter__("value")) {
                  valueGet = npt.__lookupGetter__("value");
                  valueSet = npt.__lookupSetter__("value");

                  npt.__defineGetter__("value", getter);

                  npt.__defineSetter__("value", setter);
                }

                npt.inputmask.__valueGet = valueGet;
                npt.inputmask.__valueSet = valueSet;
              }

              npt.inputmask._valueGet = function (overruleRTL) {
                return isRTL && overruleRTL !== true ? valueGet.call(this.el).split("").reverse().join("") : valueGet.call(this.el);
              };

              npt.inputmask._valueSet = function (value, overruleRTL) {
                valueSet.call(this.el, value === null || value === undefined ? "" : overruleRTL !== true && isRTL ? value.split("").reverse().join("") : value);
              };

              if (valueGet === undefined) {
                valueGet = function valueGet() {
                  return this.value;
                };

                valueSet = function valueSet(value) {
                  this.value = value;
                };

                patchValhook(npt.type);
                installNativeValueSetFallback(npt);
              }
            }
          }

          var elementType = input.getAttribute("type");
          var isSupported = input.tagName === "INPUT" && $.inArray(elementType, opts.supportsInputType) !== -1 || input.isContentEditable || input.tagName === "TEXTAREA";

          if (!isSupported) {
            if (input.tagName === "INPUT") {
              var el = document.createElement("input");
              el.setAttribute("type", elementType);
              isSupported = el.type === "text";
              el = null;
            } else isSupported = "partial";
          }

          if (isSupported !== false) {
            patchValueProperty(input);
          } else input.inputmask = undefined;

          return isSupported;
        }

        EventRuler.off(elem);
        var isSupported = isElementTypeSupported(elem, opts);

        if (isSupported !== false) {
          el = elem;
          $el = $(el);
          originalPlaceholder = el.placeholder;
          maxLength = el !== undefined ? el.maxLength : undefined;
          if (maxLength === -1) maxLength = undefined;

          if (opts.colorMask === true) {
            initializeColorMask(el);
          }

          if (mobile) {
            if ("inputmode" in el) {
              el.inputmode = opts.inputmode;
              el.setAttribute("inputmode", opts.inputmode);
            }

            if (opts.disablePredictiveText === true) {
              if ("autocorrect" in el) {
                el.autocorrect = false;
              } else {
                if (opts.colorMask !== true) {
                  initializeColorMask(el);
                }

                el.type = "password";
              }
            }
          }

          if (isSupported === true) {
            el.setAttribute("im-insert", opts.insertMode);
            EventRuler.on(el, "submit", EventHandlers.submitEvent);
            EventRuler.on(el, "reset", EventHandlers.resetEvent);
            EventRuler.on(el, "blur", EventHandlers.blurEvent);
            EventRuler.on(el, "focus", EventHandlers.focusEvent);

            if (opts.colorMask !== true) {
              EventRuler.on(el, "click", EventHandlers.clickEvent);
              EventRuler.on(el, "mouseleave", EventHandlers.mouseleaveEvent);
              EventRuler.on(el, "mouseenter", EventHandlers.mouseenterEvent);
            }

            EventRuler.on(el, "paste", EventHandlers.pasteEvent);
            EventRuler.on(el, "cut", EventHandlers.cutEvent);
            EventRuler.on(el, "complete", opts.oncomplete);
            EventRuler.on(el, "incomplete", opts.onincomplete);
            EventRuler.on(el, "cleared", opts.oncleared);

            if (!mobile && opts.inputEventOnly !== true) {
              EventRuler.on(el, "keydown", EventHandlers.keydownEvent);
              EventRuler.on(el, "keypress", EventHandlers.keypressEvent);
            } else {
              el.removeAttribute("maxLength");
            }

            EventRuler.on(el, "input", EventHandlers.inputFallBackEvent);
            EventRuler.on(el, "beforeinput", EventHandlers.beforeInputEvent);
          }

          EventRuler.on(el, "setvalue", EventHandlers.setValueEvent);
          undoValue = getBufferTemplate().join("");

          if (el.inputmask._valueGet(true) !== "" || opts.clearMaskOnLostFocus === false || document.activeElement === el) {
            var initialValue = $.isFunction(opts.onBeforeMask) ? opts.onBeforeMask.call(inputmask, el.inputmask._valueGet(true), opts) || el.inputmask._valueGet(true) : el.inputmask._valueGet(true);
            if (initialValue !== "") checkVal(el, true, false, initialValue.split(""));
            var buffer = getBuffer().slice();
            undoValue = buffer.join("");

            if (isComplete(buffer) === false) {
              if (opts.clearIncomplete) {
                resetMaskSet();
              }
            }

            if (opts.clearMaskOnLostFocus && document.activeElement !== el) {
              if (getLastValidPosition() === -1) {
                buffer = [];
              } else {
                clearOptionalTail(buffer);
              }
            }

            if (opts.clearMaskOnLostFocus === false || opts.showMaskOnFocus && document.activeElement === el || el.inputmask._valueGet(true) !== "") writeBuffer(el, buffer);

            if (document.activeElement === el) {
              caret(el, seekNext(getLastValidPosition()));
            }
          }
        }
      }

      var valueBuffer;

      if (actionObj !== undefined) {
        switch (actionObj.action) {
          case "isComplete":
            el = actionObj.el;
            return isComplete(getBuffer());

          case "unmaskedvalue":
            if (el === undefined || actionObj.value !== undefined) {
              valueBuffer = actionObj.value;
              valueBuffer = ($.isFunction(opts.onBeforeMask) ? opts.onBeforeMask.call(inputmask, valueBuffer, opts) || valueBuffer : valueBuffer).split("");
              checkVal.call(this, undefined, false, false, valueBuffer);
              if ($.isFunction(opts.onBeforeWrite)) opts.onBeforeWrite.call(inputmask, undefined, getBuffer(), 0, opts);
            }

            return unmaskedvalue(el);

          case "mask":
            mask(el);
            break;

          case "format":
            valueBuffer = ($.isFunction(opts.onBeforeMask) ? opts.onBeforeMask.call(inputmask, actionObj.value, opts) || actionObj.value : actionObj.value).split("");
            checkVal.call(this, undefined, true, false, valueBuffer);

            if (actionObj.metadata) {
              return {
                value: isRTL ? getBuffer().slice().reverse().join("") : getBuffer().join(""),
                metadata: maskScope.call(this, {
                  action: "getmetadata"
                }, maskset, opts)
              };
            }

            return isRTL ? getBuffer().slice().reverse().join("") : getBuffer().join("");

          case "isValid":
            if (actionObj.value) {
              valueBuffer = actionObj.value.split("");
              checkVal.call(this, undefined, true, true, valueBuffer);
            } else {
              actionObj.value = getBuffer().join("");
            }

            var buffer = getBuffer();
            var rl = determineLastRequiredPosition(),
                lmib = buffer.length - 1;

            for (; lmib > rl; lmib--) {
              if (isMask(lmib)) break;
            }

            buffer.splice(rl, lmib + 1 - rl);
            return isComplete(buffer) && actionObj.value === getBuffer().join("");

          case "getemptymask":
            return getBufferTemplate().join("");

          case "remove":
            if (el && el.inputmask) {
              $.data(el, "_inputmask_opts", null);
              $el = $(el);

              el.inputmask._valueSet(opts.autoUnmask ? unmaskedvalue(el) : el.inputmask._valueGet(true));

              EventRuler.off(el);

              if (el.inputmask.colorMask) {
                colorMask = el.inputmask.colorMask;
                colorMask.removeChild(el);
                colorMask.parentNode.insertBefore(el, colorMask);
                colorMask.parentNode.removeChild(colorMask);
              }

              var valueProperty;

              if (Object.getOwnPropertyDescriptor && Object.getPrototypeOf) {
                valueProperty = Object.getOwnPropertyDescriptor(Object.getPrototypeOf(el), "value");

                if (valueProperty) {
                  if (el.inputmask.__valueGet) {
                    Object.defineProperty(el, "value", {
                      get: el.inputmask.__valueGet,
                      set: el.inputmask.__valueSet,
                      configurable: true
                    });
                  }
                }
              } else if (document.__lookupGetter__ && el.__lookupGetter__("value")) {
                if (el.inputmask.__valueGet) {
                  el.__defineGetter__("value", el.inputmask.__valueGet);

                  el.__defineSetter__("value", el.inputmask.__valueSet);
                }
              }

              el.inputmask = undefined;
            }

            return el;
            break;

          case "getmetadata":
            if ($.isArray(maskset.metadata)) {
              var maskTarget = getMaskTemplate(true, 0, false).join("");
              $.each(maskset.metadata, function (ndx, mtdt) {
                if (mtdt.mask === maskTarget) {
                  maskTarget = mtdt;
                  return false;
                }
              });
              return maskTarget;
            }

            return maskset.metadata;
        }
      }
    }

    return Inputmask;
  });
}, function (module, exports, __webpack_require__) {
  "use strict";

  var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;

  var _typeof = typeof Symbol === "function" && _typeof2(Symbol.iterator) === "symbol" ? function (obj) {
    return _typeof2(obj);
  } : function (obj) {
    return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
  };

  (function (factory) {
    if (true) {
      !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(4)], __WEBPACK_AMD_DEFINE_FACTORY__ = factory, __WEBPACK_AMD_DEFINE_RESULT__ = typeof __WEBPACK_AMD_DEFINE_FACTORY__ === "function" ? __WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__) : __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
    } else {}
  })(function ($) {
    return $;
  });
}, function (module, exports) {
  module.exports = jQuery;
}, function (module, exports, __webpack_require__) {
  "use strict";

  var __WEBPACK_AMD_DEFINE_RESULT__;

  var _typeof = typeof Symbol === "function" && _typeof2(Symbol.iterator) === "symbol" ? function (obj) {
    return _typeof2(obj);
  } : function (obj) {
    return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
  };

  if (true) !(__WEBPACK_AMD_DEFINE_RESULT__ = function () {
    return window || new (eval("require('jsdom')")("").window)();
  }.call(exports, __webpack_require__, exports, module), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));else {}
}, function (module, exports, __webpack_require__) {
  "use strict";

  var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;

  var _typeof = typeof Symbol === "function" && _typeof2(Symbol.iterator) === "symbol" ? function (obj) {
    return _typeof2(obj);
  } : function (obj) {
    return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
  };

  (function (factory) {
    if (true) {
      !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(2)], __WEBPACK_AMD_DEFINE_FACTORY__ = factory, __WEBPACK_AMD_DEFINE_RESULT__ = typeof __WEBPACK_AMD_DEFINE_FACTORY__ === "function" ? __WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__) : __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
    } else {}
  })(function (Inputmask) {
    var $ = Inputmask.dependencyLib;
    var formatCode = {
      d: ["[1-9]|[12][0-9]|3[01]", Date.prototype.setDate, "day", Date.prototype.getDate],
      dd: ["0[1-9]|[12][0-9]|3[01]", Date.prototype.setDate, "day", function () {
        return pad(Date.prototype.getDate.call(this), 2);
      }],
      ddd: [""],
      dddd: [""],
      m: ["[1-9]|1[012]", Date.prototype.setMonth, "month", function () {
        return Date.prototype.getMonth.call(this) + 1;
      }],
      mm: ["0[1-9]|1[012]", Date.prototype.setMonth, "month", function () {
        return pad(Date.prototype.getMonth.call(this) + 1, 2);
      }],
      mmm: [""],
      mmmm: [""],
      yy: ["[0-9]{2}", Date.prototype.setFullYear, "year", function () {
        return pad(Date.prototype.getFullYear.call(this), 2);
      }],
      yyyy: ["[0-9]{4}", Date.prototype.setFullYear, "year", function () {
        return pad(Date.prototype.getFullYear.call(this), 4);
      }],
      h: ["[1-9]|1[0-2]", Date.prototype.setHours, "hours", Date.prototype.getHours],
      hh: ["0[1-9]|1[0-2]", Date.prototype.setHours, "hours", function () {
        return pad(Date.prototype.getHours.call(this), 2);
      }],
      hhh: ["[0-9]+", Date.prototype.setHours, "hours", Date.prototype.getHours],
      H: ["1?[0-9]|2[0-3]", Date.prototype.setHours, "hours", Date.prototype.getHours],
      HH: ["[01][0-9]|2[0-3]", Date.prototype.setHours, "hours", function () {
        return pad(Date.prototype.getHours.call(this), 2);
      }],
      HHH: ["[0-9]+", Date.prototype.setHours, "hours", Date.prototype.getHours],
      M: ["[1-5]?[0-9]", Date.prototype.setMinutes, "minutes", Date.prototype.getMinutes],
      MM: ["[0-5][0-9]", Date.prototype.setMinutes, "minutes", function () {
        return pad(Date.prototype.getMinutes.call(this), 2);
      }],
      s: ["[1-5]?[0-9]", Date.prototype.setSeconds, "seconds", Date.prototype.getSeconds],
      ss: ["[0-5][0-9]", Date.prototype.setSeconds, "seconds", function () {
        return pad(Date.prototype.getSeconds.call(this), 2);
      }],
      l: ["[0-9]{3}", Date.prototype.setMilliseconds, "milliseconds", function () {
        return pad(Date.prototype.getMilliseconds.call(this), 3);
      }],
      L: ["[0-9]{2}", Date.prototype.setMilliseconds, "milliseconds", function () {
        return pad(Date.prototype.getMilliseconds.call(this), 2);
      }],
      t: ["[ap]"],
      tt: ["[ap]m"],
      T: ["[AP]"],
      TT: ["[AP]M"],
      Z: [""],
      o: [""],
      S: [""]
    },
        formatAlias = {
      isoDate: "yyyy-mm-dd",
      isoTime: "HH:MM:ss",
      isoDateTime: "yyyy-mm-dd'T'HH:MM:ss",
      isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
    };

    function getTokenizer(opts) {
      if (!opts.tokenizer) {
        var tokens = [];

        for (var ndx in formatCode) {
          if (tokens.indexOf(ndx[0]) === -1) tokens.push(ndx[0]);
        }

        opts.tokenizer = "(" + tokens.join("+|") + ")+?|.";
        opts.tokenizer = new RegExp(opts.tokenizer, "g");
      }

      return opts.tokenizer;
    }

    function isValidDate(dateParts, currentResult) {
      return !isFinite(dateParts.rawday) || dateParts.day == "29" && !isFinite(dateParts.rawyear) || new Date(dateParts.date.getFullYear(), isFinite(dateParts.rawmonth) ? dateParts.month : dateParts.date.getMonth() + 1, 0).getDate() >= dateParts.day ? currentResult : false;
    }

    function isDateInRange(dateParts, opts) {
      var result = true;

      if (opts.min) {
        if (dateParts["rawyear"]) {
          var rawYear = dateParts["rawyear"].replace(/[^0-9]/g, ""),
              minYear = opts.min.year.substr(0, rawYear.length);
          result = minYear <= rawYear;
        }

        if (dateParts["year"] === dateParts["rawyear"]) {
          if (opts.min.date.getTime() === opts.min.date.getTime()) {
            result = opts.min.date.getTime() <= dateParts.date.getTime();
          }
        }
      }

      if (result && opts.max && opts.max.date.getTime() === opts.max.date.getTime()) {
        result = opts.max.date.getTime() >= dateParts.date.getTime();
      }

      return result;
    }

    function parse(format, dateObjValue, opts, raw) {
      var mask = "",
          match;

      while (match = getTokenizer(opts).exec(format)) {
        if (dateObjValue === undefined) {
          if (formatCode[match[0]]) {
            mask += "(" + formatCode[match[0]][0] + ")";
          } else {
            switch (match[0]) {
              case "[":
                mask += "(";
                break;

              case "]":
                mask += ")?";
                break;

              default:
                mask += Inputmask.escapeRegex(match[0]);
            }
          }
        } else {
          if (formatCode[match[0]]) {
            if (raw !== true && formatCode[match[0]][3]) {
              var getFn = formatCode[match[0]][3];
              mask += getFn.call(dateObjValue.date);
            } else if (formatCode[match[0]][2]) mask += dateObjValue["raw" + formatCode[match[0]][2]];else mask += match[0];
          } else mask += match[0];
        }
      }

      return mask;
    }

    function pad(val, len) {
      val = String(val);
      len = len || 2;

      while (val.length < len) {
        val = "0" + val;
      }

      return val;
    }

    function analyseMask(maskString, format, opts) {
      var dateObj = {
        date: new Date(1, 0, 1)
      },
          targetProp,
          mask = maskString,
          match,
          dateOperation,
          targetValidator;

      function extendProperty(value) {
        var correctedValue = value.replace(/[^0-9]/g, "0");

        if (correctedValue != value) {
          var enteredPart = value.replace(/[^0-9]/g, ""),
              min = (opts.min && opts.min[targetProp] || value).toString(),
              max = (opts.max && opts.max[targetProp] || value).toString();
          correctedValue = enteredPart + (enteredPart < min.slice(0, enteredPart.length) ? min.slice(enteredPart.length) : enteredPart > max.slice(0, enteredPart.length) ? max.slice(enteredPart.length) : correctedValue.toString().slice(enteredPart.length));
        }

        return correctedValue;
      }

      function setValue(dateObj, value, opts) {
        dateObj[targetProp] = extendProperty(value);
        dateObj["raw" + targetProp] = value;
        if (dateOperation !== undefined) dateOperation.call(dateObj.date, targetProp == "month" ? parseInt(dateObj[targetProp]) - 1 : dateObj[targetProp]);
      }

      if (typeof mask === "string") {
        while (match = getTokenizer(opts).exec(format)) {
          var value = mask.slice(0, match[0].length);

          if (formatCode.hasOwnProperty(match[0])) {
            targetValidator = formatCode[match[0]][0];
            targetProp = formatCode[match[0]][2];
            dateOperation = formatCode[match[0]][1];
            setValue(dateObj, value, opts);
          }

          mask = mask.slice(value.length);
        }

        return dateObj;
      } else if (mask && (typeof mask === "undefined" ? "undefined" : _typeof(mask)) === "object" && mask.hasOwnProperty("date")) {
        return mask;
      }

      return undefined;
    }

    Inputmask.extendAliases({
      datetime: {
        mask: function mask(opts) {
          formatCode.S = opts.i18n.ordinalSuffix.join("|");
          opts.inputFormat = formatAlias[opts.inputFormat] || opts.inputFormat;
          opts.displayFormat = formatAlias[opts.displayFormat] || opts.displayFormat || opts.inputFormat;
          opts.outputFormat = formatAlias[opts.outputFormat] || opts.outputFormat || opts.inputFormat;
          opts.placeholder = opts.placeholder !== "" ? opts.placeholder : opts.inputFormat.replace(/[\[\]]/, "");
          opts.regex = parse(opts.inputFormat, undefined, opts);
          return null;
        },
        placeholder: "",
        inputFormat: "isoDateTime",
        displayFormat: undefined,
        outputFormat: undefined,
        min: null,
        max: null,
        i18n: {
          dayNames: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
          monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
          ordinalSuffix: ["st", "nd", "rd", "th"]
        },
        postValidation: function postValidation(buffer, pos, currentResult, opts) {
          opts.min = analyseMask(opts.min, opts.inputFormat, opts);
          opts.max = analyseMask(opts.max, opts.inputFormat, opts);
          var result = currentResult,
              dateParts = analyseMask(buffer.join(""), opts.inputFormat, opts);

          if (result && dateParts.date.getTime() === dateParts.date.getTime()) {
            result = isValidDate(dateParts, result);
            result = result && isDateInRange(dateParts, opts);
          }

          if (pos && result && currentResult.pos !== pos) {
            return {
              buffer: parse(opts.inputFormat, dateParts, opts),
              refreshFromBuffer: {
                start: pos,
                end: currentResult.pos
              }
            };
          }

          return result;
        },
        onKeyDown: function onKeyDown(e, buffer, caretPos, opts) {
          var input = this;

          if (e.ctrlKey && e.keyCode === Inputmask.keyCode.RIGHT) {
            var today = new Date(),
                match,
                date = "";

            while (match = getTokenizer(opts).exec(opts.inputFormat)) {
              if (match[0].charAt(0) === "d") {
                date += pad(today.getDate(), match[0].length);
              } else if (match[0].charAt(0) === "m") {
                date += pad(today.getMonth() + 1, match[0].length);
              } else if (match[0] === "yyyy") {
                date += today.getFullYear().toString();
              } else if (match[0].charAt(0) === "y") {
                date += pad(today.getYear(), match[0].length);
              }
            }

            input.inputmask._valueSet(date);

            $(input).trigger("setvalue");
          }
        },
        onUnMask: function onUnMask(maskedValue, unmaskedValue, opts) {
          return parse(opts.outputFormat, analyseMask(maskedValue, opts.inputFormat, opts), opts, true);
        },
        casing: function casing(elem, test, pos, validPositions) {
          if (test.nativeDef.indexOf("[ap]") == 0) return elem.toLowerCase();
          if (test.nativeDef.indexOf("[AP]") == 0) return elem.toUpperCase();
          return elem;
        },
        insertMode: false
      }
    });
    return Inputmask;
  });
}, function (module, exports, __webpack_require__) {
  "use strict";

  var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;

  var _typeof = typeof Symbol === "function" && _typeof2(Symbol.iterator) === "symbol" ? function (obj) {
    return _typeof2(obj);
  } : function (obj) {
    return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
  };

  (function (factory) {
    if (true) {
      !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(2)], __WEBPACK_AMD_DEFINE_FACTORY__ = factory, __WEBPACK_AMD_DEFINE_RESULT__ = typeof __WEBPACK_AMD_DEFINE_FACTORY__ === "function" ? __WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__) : __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
    } else {}
  })(function (Inputmask) {
    var $ = Inputmask.dependencyLib;

    function autoEscape(txt, opts) {
      var escapedTxt = "";

      for (var i = 0; i < txt.length; i++) {
        if (Inputmask.prototype.definitions[txt.charAt(i)] || opts.definitions[txt.charAt(i)] || opts.optionalmarker.start === txt.charAt(i) || opts.optionalmarker.end === txt.charAt(i) || opts.quantifiermarker.start === txt.charAt(i) || opts.quantifiermarker.end === txt.charAt(i) || opts.groupmarker.start === txt.charAt(i) || opts.groupmarker.end === txt.charAt(i) || opts.alternatormarker === txt.charAt(i)) {
          escapedTxt += "\\" + txt.charAt(i);
        } else escapedTxt += txt.charAt(i);
      }

      return escapedTxt;
    }

    function alignDigits(buffer, opts) {
      if (opts.numericInput) {
        var radixPosition = $.inArray(opts.radixPoint, buffer);

        if (radixPosition === -1) {
          buffer.push(opts.radixPoint);
          radixPosition = buffer.length - 1;
        }

        for (var i = 1; i <= opts.digits; i++) {
          buffer[radixPosition + i] = buffer[radixPosition + i] || "0";
        }
      }

      return buffer;
    }

    Inputmask.extendAliases({
      numeric: {
        mask: function mask(opts) {
          if (opts.repeat !== 0 && isNaN(opts.integerDigits)) {
            opts.integerDigits = opts.repeat;
          }

          opts.repeat = 0;

          if (opts.groupSeparator === opts.radixPoint && opts.digits && opts.digits !== "0") {
            if (opts.radixPoint === ".") {
              opts.groupSeparator = ",";
            } else if (opts.radixPoint === ",") {
              opts.groupSeparator = ".";
            } else opts.groupSeparator = "";
          }

          if (opts.groupSeparator === " ") {
            opts.skipOptionalPartCharacter = undefined;
          }

          opts.autoGroup = opts.autoGroup && opts.groupSeparator !== "";

          if (opts.autoGroup) {
            if (typeof opts.groupSize == "string" && isFinite(opts.groupSize)) opts.groupSize = parseInt(opts.groupSize);

            if (isFinite(opts.integerDigits)) {
              var seps = Math.floor(opts.integerDigits / opts.groupSize);
              var mod = opts.integerDigits % opts.groupSize;
              opts.integerDigits = parseInt(opts.integerDigits) + (mod === 0 ? seps - 1 : seps);

              if (opts.integerDigits < 1) {
                opts.integerDigits = "*";
              }
            }
          }

          if (opts.placeholder.length > 1) {
            opts.placeholder = opts.placeholder.charAt(0);
          }

          if (opts.positionCaretOnClick === "radixFocus" && opts.placeholder === "" && opts.integerOptional === false) {
            opts.positionCaretOnClick = "lvp";
          }

          opts.definitions[";"] = opts.definitions["~"];
          opts.definitions[";"].definitionSymbol = "~";

          if (opts.numericInput === true) {
            opts.positionCaretOnClick = opts.positionCaretOnClick === "radixFocus" ? "lvp" : opts.positionCaretOnClick;
            opts.digitsOptional = false;
            if (isNaN(opts.digits)) opts.digits = 2;
            opts.decimalProtect = false;
          }

          var mask = "[+]";
          mask += autoEscape(opts.prefix, opts);

          if (opts.integerOptional === true) {
            mask += "~{1," + opts.integerDigits + "}";
          } else mask += "~{" + opts.integerDigits + "}";

          if (opts.digits !== undefined) {
            var radixDef = opts.decimalProtect ? ":" : opts.radixPoint;
            var dq = opts.digits.toString().split(",");

            if (isFinite(dq[0]) && dq[1] && isFinite(dq[1])) {
              mask += radixDef + ";{" + opts.digits + "}";
            } else if (isNaN(opts.digits) || parseInt(opts.digits) > 0) {
              if (opts.digitsOptional) {
                mask += "[" + radixDef + ";{1," + opts.digits + "}]";
              } else mask += radixDef + ";{" + opts.digits + "}";
            }
          }

          mask += autoEscape(opts.suffix, opts);
          mask += "[-]";
          opts.greedy = false;
          return mask;
        },
        placeholder: "",
        greedy: false,
        digits: "*",
        digitsOptional: true,
        enforceDigitsOnBlur: false,
        radixPoint: ".",
        positionCaretOnClick: "radixFocus",
        groupSize: 3,
        groupSeparator: "",
        autoGroup: false,
        allowMinus: true,
        negationSymbol: {
          front: "-",
          back: ""
        },
        integerDigits: "+",
        integerOptional: true,
        prefix: "",
        suffix: "",
        rightAlign: true,
        decimalProtect: true,
        min: null,
        max: null,
        step: 1,
        insertMode: true,
        autoUnmask: false,
        unmaskAsNumber: false,
        inputmode: "numeric",
        preValidation: function preValidation(buffer, pos, c, isSelection, opts, maskset) {
          if (c === "-" || c === opts.negationSymbol.front) {
            if (opts.allowMinus !== true) return false;
            opts.isNegative = opts.isNegative === undefined ? true : !opts.isNegative;
            if (buffer.join("") === "") return true;
            return {
              caret: maskset.validPositions[pos] ? pos : undefined,
              dopost: true
            };
          }

          if (isSelection === false && c === opts.radixPoint && opts.digits !== undefined && (isNaN(opts.digits) || parseInt(opts.digits) > 0)) {
            var radixPos = $.inArray(opts.radixPoint, buffer);

            if (radixPos !== -1 && maskset.validPositions[radixPos] !== undefined) {
              if (opts.numericInput === true) {
                return pos === radixPos;
              }

              return {
                caret: radixPos + 1
              };
            }
          }

          return true;
        },
        postValidation: function postValidation(buffer, pos, currentResult, opts) {
          function buildPostMask(buffer, opts) {
            var postMask = "";
            postMask += "(" + opts.groupSeparator + "*{" + opts.groupSize + "}){*}";

            if (opts.radixPoint !== "") {
              var radixSplit = buffer.join("").split(opts.radixPoint);

              if (radixSplit[1]) {
                postMask += opts.radixPoint + "*{" + radixSplit[1].match(/^\d*\??\d*/)[0].length + "}";
              }
            }

            return postMask;
          }

          var suffix = opts.suffix.split(""),
              prefix = opts.prefix.split("");
          if (currentResult.pos === undefined && currentResult.caret !== undefined && currentResult.dopost !== true) return currentResult;
          var caretPos = currentResult.caret !== undefined ? currentResult.caret : currentResult.pos;
          var maskedValue = buffer.slice();

          if (opts.numericInput) {
            caretPos = maskedValue.length - caretPos - 1;
            maskedValue = maskedValue.reverse();
          }

          var charAtPos = maskedValue[caretPos];

          if (charAtPos === opts.groupSeparator) {
            caretPos += 1;
            charAtPos = maskedValue[caretPos];
          }

          if (caretPos === maskedValue.length - opts.suffix.length - 1 && charAtPos === opts.radixPoint) return currentResult;

          if (charAtPos !== undefined) {
            if (charAtPos !== opts.radixPoint && charAtPos !== opts.negationSymbol.front && charAtPos !== opts.negationSymbol.back) {
              maskedValue[caretPos] = "?";

              if (opts.prefix.length > 0 && caretPos >= (opts.isNegative === false ? 1 : 0) && caretPos < opts.prefix.length - 1 + (opts.isNegative === false ? 1 : 0)) {
                prefix[caretPos - (opts.isNegative === false ? 1 : 0)] = "?";
              } else if (opts.suffix.length > 0 && caretPos >= maskedValue.length - opts.suffix.length - (opts.isNegative === false ? 1 : 0)) {
                suffix[caretPos - (maskedValue.length - opts.suffix.length - (opts.isNegative === false ? 1 : 0))] = "?";
              }
            }
          }

          prefix = prefix.join("");
          suffix = suffix.join("");
          var processValue = maskedValue.join("").replace(prefix, "");
          processValue = processValue.replace(suffix, "");
          processValue = processValue.replace(new RegExp(Inputmask.escapeRegex(opts.groupSeparator), "g"), "");
          processValue = processValue.replace(new RegExp("[-" + Inputmask.escapeRegex(opts.negationSymbol.front) + "]", "g"), "");
          processValue = processValue.replace(new RegExp(Inputmask.escapeRegex(opts.negationSymbol.back) + "$"), "");

          if (isNaN(opts.placeholder)) {
            processValue = processValue.replace(new RegExp(Inputmask.escapeRegex(opts.placeholder), "g"), "");
          }

          if (processValue.length > 1 && processValue.indexOf(opts.radixPoint) !== 1) {
            if (charAtPos === "0") {
              processValue = processValue.replace(/^\?/g, "");
            }

            processValue = processValue.replace(/^0/g, "");
          }

          if (processValue.charAt(0) === opts.radixPoint && opts.radixPoint !== "" && opts.numericInput !== true) {
            processValue = "0" + processValue;
          }

          if (processValue !== "") {
            processValue = processValue.split("");

            if ((!opts.digitsOptional || opts.enforceDigitsOnBlur && currentResult.event === "blur") && isFinite(opts.digits)) {
              var radixPosition = $.inArray(opts.radixPoint, processValue);
              var rpb = $.inArray(opts.radixPoint, maskedValue);

              if (radixPosition === -1) {
                processValue.push(opts.radixPoint);
                radixPosition = processValue.length - 1;
              }

              for (var i = 1; i <= opts.digits; i++) {
                if ((!opts.digitsOptional || opts.enforceDigitsOnBlur && currentResult.event === "blur") && (processValue[radixPosition + i] === undefined || processValue[radixPosition + i] === opts.placeholder.charAt(0))) {
                  processValue[radixPosition + i] = currentResult.placeholder || opts.placeholder.charAt(0);
                } else if (rpb !== -1 && maskedValue[rpb + i] !== undefined) {
                  processValue[radixPosition + i] = processValue[radixPosition + i] || maskedValue[rpb + i];
                }
              }
            }

            if (opts.autoGroup === true && opts.groupSeparator !== "" && (charAtPos !== opts.radixPoint || currentResult.pos !== undefined || currentResult.dopost)) {
              var addRadix = processValue[processValue.length - 1] === opts.radixPoint && currentResult.c === opts.radixPoint;
              processValue = Inputmask(buildPostMask(processValue, opts), {
                numericInput: true,
                jitMasking: true,
                definitions: {
                  "*": {
                    validator: "[0-9?]",
                    cardinality: 1
                  }
                }
              }).format(processValue.join(""));
              if (addRadix) processValue += opts.radixPoint;

              if (processValue.charAt(0) === opts.groupSeparator) {
                processValue.substr(1);
              }
            } else processValue = processValue.join("");
          }

          if (opts.isNegative && currentResult.event === "blur") {
            opts.isNegative = processValue !== "0";
          }

          processValue = prefix + processValue;
          processValue += suffix;

          if (opts.isNegative) {
            processValue = opts.negationSymbol.front + processValue;
            processValue += opts.negationSymbol.back;
          }

          processValue = processValue.split("");

          if (charAtPos !== undefined) {
            if (charAtPos !== opts.radixPoint && charAtPos !== opts.negationSymbol.front && charAtPos !== opts.negationSymbol.back) {
              caretPos = $.inArray("?", processValue);

              if (caretPos > -1) {
                processValue[caretPos] = charAtPos;
              } else caretPos = currentResult.caret || 0;
            } else if (charAtPos === opts.radixPoint || charAtPos === opts.negationSymbol.front || charAtPos === opts.negationSymbol.back) {
              var newCaretPos = $.inArray(charAtPos, processValue);
              if (newCaretPos !== -1) caretPos = newCaretPos;
            }
          }

          if (opts.numericInput) {
            caretPos = processValue.length - caretPos - 1;
            processValue = processValue.reverse();
          }

          var rslt = {
            caret: (charAtPos === undefined || currentResult.pos !== undefined) && caretPos !== undefined ? caretPos + (opts.numericInput ? -1 : 1) : caretPos,
            buffer: processValue,
            refreshFromBuffer: currentResult.dopost || buffer.join("") !== processValue.join("")
          };
          return rslt.refreshFromBuffer ? rslt : currentResult;
        },
        onBeforeWrite: function onBeforeWrite(e, buffer, caretPos, opts) {
          function parseMinMaxOptions(opts) {
            if (opts.parseMinMaxOptions === undefined) {
              if (opts.min !== null) {
                opts.min = opts.min.toString().replace(new RegExp(Inputmask.escapeRegex(opts.groupSeparator), "g"), "");
                if (opts.radixPoint === ",") opts.min = opts.min.replace(opts.radixPoint, ".");
                opts.min = isFinite(opts.min) ? parseFloat(opts.min) : NaN;
                if (isNaN(opts.min)) opts.min = Number.MIN_VALUE;
              }

              if (opts.max !== null) {
                opts.max = opts.max.toString().replace(new RegExp(Inputmask.escapeRegex(opts.groupSeparator), "g"), "");
                if (opts.radixPoint === ",") opts.max = opts.max.replace(opts.radixPoint, ".");
                opts.max = isFinite(opts.max) ? parseFloat(opts.max) : NaN;
                if (isNaN(opts.max)) opts.max = Number.MAX_VALUE;
              }

              opts.parseMinMaxOptions = "done";
            }
          }

          if (e) {
            switch (e.type) {
              case "keydown":
                return opts.postValidation(buffer, caretPos, {
                  caret: caretPos,
                  dopost: true
                }, opts);

              case "blur":
              case "checkval":
                var unmasked;
                parseMinMaxOptions(opts);

                if (opts.min !== null || opts.max !== null) {
                  unmasked = opts.onUnMask(buffer.join(""), undefined, $.extend({}, opts, {
                    unmaskAsNumber: true
                  }));

                  if (opts.min !== null && unmasked < opts.min) {
                    opts.isNegative = opts.min < 0;
                    return opts.postValidation(opts.min.toString().replace(".", opts.radixPoint).split(""), caretPos, {
                      caret: caretPos,
                      dopost: true,
                      placeholder: "0"
                    }, opts);
                  } else if (opts.max !== null && unmasked > opts.max) {
                    opts.isNegative = opts.max < 0;
                    return opts.postValidation(opts.max.toString().replace(".", opts.radixPoint).split(""), caretPos, {
                      caret: caretPos,
                      dopost: true,
                      placeholder: "0"
                    }, opts);
                  }
                }

                return opts.postValidation(buffer, caretPos, {
                  caret: caretPos,
                  placeholder: "0",
                  event: "blur"
                }, opts);

              case "_checkval":
                return {
                  caret: caretPos
                };

              default:
                break;
            }
          }
        },
        regex: {
          integerPart: function integerPart(opts, emptyCheck) {
            return emptyCheck ? new RegExp("[" + Inputmask.escapeRegex(opts.negationSymbol.front) + "+]?") : new RegExp("[" + Inputmask.escapeRegex(opts.negationSymbol.front) + "+]?\\d+");
          },
          integerNPart: function integerNPart(opts) {
            return new RegExp("[\\d" + Inputmask.escapeRegex(opts.groupSeparator) + Inputmask.escapeRegex(opts.placeholder.charAt(0)) + "]+");
          }
        },
        definitions: {
          "~": {
            validator: function validator(chrs, maskset, pos, strict, opts, isSelection) {
              var isValid, l;

              if (chrs === "k" || chrs === "m") {
                isValid = {
                  insert: [],
                  c: 0
                };

                for (var i = 0, l = chrs === "k" ? 2 : 5; i < l; i++) {
                  isValid.insert.push({
                    pos: pos + i,
                    c: 0
                  });
                }

                isValid.pos = pos + l;
                return isValid;
              }

              isValid = strict ? new RegExp("[0-9" + Inputmask.escapeRegex(opts.groupSeparator) + "]").test(chrs) : new RegExp("[0-9]").test(chrs);

              if (isValid === true) {
                if (opts.numericInput !== true && maskset.validPositions[pos] !== undefined && maskset.validPositions[pos].match.def === "~" && !isSelection) {
                  var processValue = maskset.buffer.join("");
                  processValue = processValue.replace(new RegExp("[-" + Inputmask.escapeRegex(opts.negationSymbol.front) + "]", "g"), "");
                  processValue = processValue.replace(new RegExp(Inputmask.escapeRegex(opts.negationSymbol.back) + "$"), "");
                  var pvRadixSplit = processValue.split(opts.radixPoint);

                  if (pvRadixSplit.length > 1) {
                    pvRadixSplit[1] = pvRadixSplit[1].replace(/0/g, opts.placeholder.charAt(0));
                  }

                  if (pvRadixSplit[0] === "0") {
                    pvRadixSplit[0] = pvRadixSplit[0].replace(/0/g, opts.placeholder.charAt(0));
                  }

                  processValue = pvRadixSplit[0] + opts.radixPoint + pvRadixSplit[1] || "";

                  var bufferTemplate = maskset._buffer.join("");

                  if (processValue === opts.radixPoint) {
                    processValue = bufferTemplate;
                  }

                  while (processValue.match(Inputmask.escapeRegex(bufferTemplate) + "$") === null) {
                    bufferTemplate = bufferTemplate.slice(1);
                  }

                  processValue = processValue.replace(bufferTemplate, "");
                  processValue = processValue.split("");

                  if (processValue[pos] === undefined) {
                    isValid = {
                      pos: pos,
                      remove: pos
                    };
                  } else {
                    isValid = {
                      pos: pos
                    };
                  }
                }
              } else if (!strict && chrs === opts.radixPoint && maskset.validPositions[pos - 1] === undefined) {
                isValid = {
                  insert: {
                    pos: pos,
                    c: 0
                  },
                  pos: pos + 1
                };
              }

              return isValid;
            },
            cardinality: 1
          },
          "+": {
            validator: function validator(chrs, maskset, pos, strict, opts) {
              return opts.allowMinus && (chrs === "-" || chrs === opts.negationSymbol.front);
            },
            cardinality: 1,
            placeholder: ""
          },
          "-": {
            validator: function validator(chrs, maskset, pos, strict, opts) {
              return opts.allowMinus && chrs === opts.negationSymbol.back;
            },
            cardinality: 1,
            placeholder: ""
          },
          ":": {
            validator: function validator(chrs, maskset, pos, strict, opts) {
              var radix = "[" + Inputmask.escapeRegex(opts.radixPoint) + "]";
              var isValid = new RegExp(radix).test(chrs);

              if (isValid && maskset.validPositions[pos] && maskset.validPositions[pos].match.placeholder === opts.radixPoint) {
                isValid = {
                  caret: pos + 1
                };
              }

              return isValid;
            },
            cardinality: 1,
            placeholder: function placeholder(opts) {
              return opts.radixPoint;
            }
          }
        },
        onUnMask: function onUnMask(maskedValue, unmaskedValue, opts) {
          if (unmaskedValue === "" && opts.nullable === true) {
            return unmaskedValue;
          }

          var processValue = maskedValue.replace(opts.prefix, "");
          processValue = processValue.replace(opts.suffix, "");
          processValue = processValue.replace(new RegExp(Inputmask.escapeRegex(opts.groupSeparator), "g"), "");

          if (opts.placeholder.charAt(0) !== "") {
            processValue = processValue.replace(new RegExp(opts.placeholder.charAt(0), "g"), "0");
          }

          if (opts.unmaskAsNumber) {
            if (opts.radixPoint !== "" && processValue.indexOf(opts.radixPoint) !== -1) processValue = processValue.replace(Inputmask.escapeRegex.call(this, opts.radixPoint), ".");
            processValue = processValue.replace(new RegExp("^" + Inputmask.escapeRegex(opts.negationSymbol.front)), "-");
            processValue = processValue.replace(new RegExp(Inputmask.escapeRegex(opts.negationSymbol.back) + "$"), "");
            return Number(processValue);
          }

          return processValue;
        },
        isComplete: function isComplete(buffer, opts) {
          var maskedValue = (opts.numericInput ? buffer.slice().reverse() : buffer).join("");
          maskedValue = maskedValue.replace(new RegExp("^" + Inputmask.escapeRegex(opts.negationSymbol.front)), "-");
          maskedValue = maskedValue.replace(new RegExp(Inputmask.escapeRegex(opts.negationSymbol.back) + "$"), "");
          maskedValue = maskedValue.replace(opts.prefix, "");
          maskedValue = maskedValue.replace(opts.suffix, "");
          maskedValue = maskedValue.replace(new RegExp(Inputmask.escapeRegex(opts.groupSeparator) + "([0-9]{3})", "g"), "$1");
          if (opts.radixPoint === ",") maskedValue = maskedValue.replace(Inputmask.escapeRegex(opts.radixPoint), ".");
          return isFinite(maskedValue);
        },
        onBeforeMask: function onBeforeMask(initialValue, opts) {
          opts.isNegative = undefined;

          if (typeof initialValue == "number" && opts.radixPoint !== "") {
            initialValue = initialValue.toString().replace(".", opts.radixPoint);
          }

          initialValue = initialValue.toString().charAt(initialValue.length - 1) === opts.radixPoint ? initialValue.toString().substr(0, initialValue.length - 1) : initialValue.toString();

          if (opts.radixPoint !== "" && isFinite(initialValue)) {
            var vs = initialValue.split("."),
                groupSize = opts.groupSeparator !== "" ? parseInt(opts.groupSize) : 0;

            if (vs.length === 2 && (vs[0].length > groupSize || vs[1].length > groupSize || vs[0].length <= groupSize && vs[1].length < groupSize)) {
              initialValue = initialValue.replace(".", opts.radixPoint);
            }
          }

          var kommaMatches = initialValue.match(/,/g);
          var dotMatches = initialValue.match(/\./g);

          if (dotMatches && kommaMatches) {
            if (dotMatches.length > kommaMatches.length) {
              initialValue = initialValue.replace(/\./g, "");
              initialValue = initialValue.replace(",", opts.radixPoint);
            } else if (kommaMatches.length > dotMatches.length) {
              initialValue = initialValue.replace(/,/g, "");
              initialValue = initialValue.replace(".", opts.radixPoint);
            } else {
              initialValue = initialValue.indexOf(".") < initialValue.indexOf(",") ? initialValue.replace(/\./g, "") : initialValue.replace(/,/g, "");
            }
          } else {
            initialValue = initialValue.replace(new RegExp(Inputmask.escapeRegex(opts.groupSeparator), "g"), "");
          }

          if (opts.digits === 0) {
            if (initialValue.indexOf(".") !== -1) {
              initialValue = initialValue.substring(0, initialValue.indexOf("."));
            } else if (initialValue.indexOf(",") !== -1) {
              initialValue = initialValue.substring(0, initialValue.indexOf(","));
            }
          }

          if (opts.radixPoint !== "" && isFinite(opts.digits)) {
            if (initialValue.indexOf(opts.radixPoint) !== -1) {
              var valueParts = initialValue.split(opts.radixPoint),
                  decPart = valueParts[1].match(new RegExp("\\d*"))[0];

              if (parseInt(opts.digits) < decPart.toString().length) {
                var digitsFactor = Math.pow(10, parseInt(opts.digits));
                initialValue = initialValue.replace(Inputmask.escapeRegex(opts.radixPoint), ".");
                initialValue = Math.round(parseFloat(initialValue) * digitsFactor) / digitsFactor;
                initialValue = initialValue.toString().replace(".", opts.radixPoint);
              }
            }
          }

          return alignDigits(initialValue.toString().split(""), opts).join("");
        },
        onKeyDown: function onKeyDown(e, buffer, caretPos, opts) {
          var $input = $(this);

          if (e.ctrlKey) {
            switch (e.keyCode) {
              case Inputmask.keyCode.UP:
                $input.val(parseFloat(this.inputmask.unmaskedvalue()) + parseInt(opts.step));
                $input.trigger("setvalue");
                break;

              case Inputmask.keyCode.DOWN:
                $input.val(parseFloat(this.inputmask.unmaskedvalue()) - parseInt(opts.step));
                $input.trigger("setvalue");
                break;
            }
          }
        }
      },
      currency: {
        prefix: "$ ",
        groupSeparator: ",",
        alias: "numeric",
        placeholder: "0",
        autoGroup: true,
        digits: 2,
        digitsOptional: false,
        clearMaskOnLostFocus: false
      },
      decimal: {
        alias: "numeric"
      },
      integer: {
        alias: "numeric",
        digits: 0,
        radixPoint: ""
      },
      percentage: {
        alias: "numeric",
        digits: 2,
        digitsOptional: true,
        radixPoint: ".",
        placeholder: "0",
        autoGroup: false,
        min: 0,
        max: 100,
        suffix: " %",
        allowMinus: false
      }
    });
    return Inputmask;
  });
}, function (module, exports, __webpack_require__) {
  "use strict";

  var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;

  var _typeof = typeof Symbol === "function" && _typeof2(Symbol.iterator) === "symbol" ? function (obj) {
    return _typeof2(obj);
  } : function (obj) {
    return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
  };

  (function (factory) {
    if (true) {
      !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(4), __webpack_require__(2)], __WEBPACK_AMD_DEFINE_FACTORY__ = factory, __WEBPACK_AMD_DEFINE_RESULT__ = typeof __WEBPACK_AMD_DEFINE_FACTORY__ === "function" ? __WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__) : __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
    } else {}
  })(function ($, Inputmask) {
    if ($.fn.inputmask === undefined) {
      $.fn.inputmask = function (fn, options) {
        var nptmask,
            input = this[0];
        if (options === undefined) options = {};

        if (typeof fn === "string") {
          switch (fn) {
            case "unmaskedvalue":
              return input && input.inputmask ? input.inputmask.unmaskedvalue() : $(input).val();

            case "remove":
              return this.each(function () {
                if (this.inputmask) this.inputmask.remove();
              });

            case "getemptymask":
              return input && input.inputmask ? input.inputmask.getemptymask() : "";

            case "hasMaskedValue":
              return input && input.inputmask ? input.inputmask.hasMaskedValue() : false;

            case "isComplete":
              return input && input.inputmask ? input.inputmask.isComplete() : true;

            case "getmetadata":
              return input && input.inputmask ? input.inputmask.getmetadata() : undefined;

            case "setvalue":
              Inputmask.setValue(input, options);
              break;

            case "option":
              if (typeof options === "string") {
                if (input && input.inputmask !== undefined) {
                  return input.inputmask.option(options);
                }
              } else {
                return this.each(function () {
                  if (this.inputmask !== undefined) {
                    return this.inputmask.option(options);
                  }
                });
              }

              break;

            default:
              options.alias = fn;
              nptmask = new Inputmask(options);
              return this.each(function () {
                nptmask.mask(this);
              });
          }
        } else if (Array.isArray(fn)) {
          options.alias = fn;
          nptmask = new Inputmask(options);
          return this.each(function () {
            nptmask.mask(this);
          });
        } else if ((typeof fn === "undefined" ? "undefined" : _typeof(fn)) == "object") {
          nptmask = new Inputmask(fn);

          if (fn.mask === undefined && fn.alias === undefined) {
            return this.each(function () {
              if (this.inputmask !== undefined) {
                return this.inputmask.option(fn);
              } else nptmask.mask(this);
            });
          } else {
            return this.each(function () {
              nptmask.mask(this);
            });
          }
        } else if (fn === undefined) {
          return this.each(function () {
            nptmask = new Inputmask(options);
            nptmask.mask(this);
          });
        }
      };
    }

    return $.fn.inputmask;
  });
}]);

/***/ }),

/***/ "./resources/js/jquery.min.js":
/*!************************************!*\
  !*** ./resources/js/jquery.min.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(module) {var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*! jQuery v3.3.1 | (c) JS Foundation and other contributors | jquery.org/license */
!function (e, t) {
  "use strict";

  "object" == ( false ? undefined : _typeof(module)) && "object" == _typeof(module.exports) ? module.exports = e.document ? t(e, !0) : function (e) {
    if (!e.document) throw new Error("jQuery requires a window with a document");
    return t(e);
  } : t(e);
}("undefined" != typeof window ? window : this, function (e, t) {
  "use strict";

  var n = [],
      r = e.document,
      i = Object.getPrototypeOf,
      o = n.slice,
      a = n.concat,
      s = n.push,
      u = n.indexOf,
      l = {},
      c = l.toString,
      f = l.hasOwnProperty,
      p = f.toString,
      d = p.call(Object),
      h = {},
      g = function e(t) {
    return "function" == typeof t && "number" != typeof t.nodeType;
  },
      y = function e(t) {
    return null != t && t === t.window;
  },
      v = {
    type: !0,
    src: !0,
    noModule: !0
  };

  function m(e, t, n) {
    var i,
        o = (t = t || r).createElement("script");
    if (o.text = e, n) for (i in v) {
      n[i] && (o[i] = n[i]);
    }
    t.head.appendChild(o).parentNode.removeChild(o);
  }

  function x(e) {
    return null == e ? e + "" : "object" == _typeof(e) || "function" == typeof e ? l[c.call(e)] || "object" : _typeof(e);
  }

  var b = "3.3.1",
      w = function w(e, t) {
    return new w.fn.init(e, t);
  },
      T = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;

  w.fn = w.prototype = {
    jquery: "3.3.1",
    constructor: w,
    length: 0,
    toArray: function toArray() {
      return o.call(this);
    },
    get: function get(e) {
      return null == e ? o.call(this) : e < 0 ? this[e + this.length] : this[e];
    },
    pushStack: function pushStack(e) {
      var t = w.merge(this.constructor(), e);
      return t.prevObject = this, t;
    },
    each: function each(e) {
      return w.each(this, e);
    },
    map: function map(e) {
      return this.pushStack(w.map(this, function (t, n) {
        return e.call(t, n, t);
      }));
    },
    slice: function slice() {
      return this.pushStack(o.apply(this, arguments));
    },
    first: function first() {
      return this.eq(0);
    },
    last: function last() {
      return this.eq(-1);
    },
    eq: function eq(e) {
      var t = this.length,
          n = +e + (e < 0 ? t : 0);
      return this.pushStack(n >= 0 && n < t ? [this[n]] : []);
    },
    end: function end() {
      return this.prevObject || this.constructor();
    },
    push: s,
    sort: n.sort,
    splice: n.splice
  }, w.extend = w.fn.extend = function () {
    var e,
        t,
        n,
        r,
        i,
        o,
        a = arguments[0] || {},
        s = 1,
        u = arguments.length,
        l = !1;

    for ("boolean" == typeof a && (l = a, a = arguments[s] || {}, s++), "object" == _typeof(a) || g(a) || (a = {}), s === u && (a = this, s--); s < u; s++) {
      if (null != (e = arguments[s])) for (t in e) {
        n = a[t], a !== (r = e[t]) && (l && r && (w.isPlainObject(r) || (i = Array.isArray(r))) ? (i ? (i = !1, o = n && Array.isArray(n) ? n : []) : o = n && w.isPlainObject(n) ? n : {}, a[t] = w.extend(l, o, r)) : void 0 !== r && (a[t] = r));
      }
    }

    return a;
  }, w.extend({
    expando: "jQuery" + ("3.3.1" + Math.random()).replace(/\D/g, ""),
    isReady: !0,
    error: function error(e) {
      throw new Error(e);
    },
    noop: function noop() {},
    isPlainObject: function isPlainObject(e) {
      var t, n;
      return !(!e || "[object Object]" !== c.call(e)) && (!(t = i(e)) || "function" == typeof (n = f.call(t, "constructor") && t.constructor) && p.call(n) === d);
    },
    isEmptyObject: function isEmptyObject(e) {
      var t;

      for (t in e) {
        return !1;
      }

      return !0;
    },
    globalEval: function globalEval(e) {
      m(e);
    },
    each: function each(e, t) {
      var n,
          r = 0;

      if (C(e)) {
        for (n = e.length; r < n; r++) {
          if (!1 === t.call(e[r], r, e[r])) break;
        }
      } else for (r in e) {
        if (!1 === t.call(e[r], r, e[r])) break;
      }

      return e;
    },
    trim: function trim(e) {
      return null == e ? "" : (e + "").replace(T, "");
    },
    makeArray: function makeArray(e, t) {
      var n = t || [];
      return null != e && (C(Object(e)) ? w.merge(n, "string" == typeof e ? [e] : e) : s.call(n, e)), n;
    },
    inArray: function inArray(e, t, n) {
      return null == t ? -1 : u.call(t, e, n);
    },
    merge: function merge(e, t) {
      for (var n = +t.length, r = 0, i = e.length; r < n; r++) {
        e[i++] = t[r];
      }

      return e.length = i, e;
    },
    grep: function grep(e, t, n) {
      for (var r, i = [], o = 0, a = e.length, s = !n; o < a; o++) {
        (r = !t(e[o], o)) !== s && i.push(e[o]);
      }

      return i;
    },
    map: function map(e, t, n) {
      var r,
          i,
          o = 0,
          s = [];
      if (C(e)) for (r = e.length; o < r; o++) {
        null != (i = t(e[o], o, n)) && s.push(i);
      } else for (o in e) {
        null != (i = t(e[o], o, n)) && s.push(i);
      }
      return a.apply([], s);
    },
    guid: 1,
    support: h
  }), "function" == typeof Symbol && (w.fn[Symbol.iterator] = n[Symbol.iterator]), w.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function (e, t) {
    l["[object " + t + "]"] = t.toLowerCase();
  });

  function C(e) {
    var t = !!e && "length" in e && e.length,
        n = x(e);
    return !g(e) && !y(e) && ("array" === n || 0 === t || "number" == typeof t && t > 0 && t - 1 in e);
  }

  var E = function (e) {
    var t,
        n,
        r,
        i,
        o,
        a,
        s,
        u,
        l,
        c,
        f,
        p,
        d,
        h,
        g,
        y,
        v,
        m,
        x,
        b = "sizzle" + 1 * new Date(),
        w = e.document,
        T = 0,
        C = 0,
        E = ae(),
        k = ae(),
        S = ae(),
        D = function D(e, t) {
      return e === t && (f = !0), 0;
    },
        N = {}.hasOwnProperty,
        A = [],
        j = A.pop,
        q = A.push,
        L = A.push,
        H = A.slice,
        O = function O(e, t) {
      for (var n = 0, r = e.length; n < r; n++) {
        if (e[n] === t) return n;
      }

      return -1;
    },
        P = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
        M = "[\\x20\\t\\r\\n\\f]",
        R = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+",
        I = "\\[" + M + "*(" + R + ")(?:" + M + "*([*^$|!~]?=)" + M + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + R + "))|)" + M + "*\\]",
        W = ":(" + R + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + I + ")*)|.*)\\)|)",
        $ = new RegExp(M + "+", "g"),
        B = new RegExp("^" + M + "+|((?:^|[^\\\\])(?:\\\\.)*)" + M + "+$", "g"),
        F = new RegExp("^" + M + "*," + M + "*"),
        _ = new RegExp("^" + M + "*([>+~]|" + M + ")" + M + "*"),
        z = new RegExp("=" + M + "*([^\\]'\"]*?)" + M + "*\\]", "g"),
        X = new RegExp(W),
        U = new RegExp("^" + R + "$"),
        V = {
      ID: new RegExp("^#(" + R + ")"),
      CLASS: new RegExp("^\\.(" + R + ")"),
      TAG: new RegExp("^(" + R + "|[*])"),
      ATTR: new RegExp("^" + I),
      PSEUDO: new RegExp("^" + W),
      CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + M + "*(even|odd|(([+-]|)(\\d*)n|)" + M + "*(?:([+-]|)" + M + "*(\\d+)|))" + M + "*\\)|)", "i"),
      bool: new RegExp("^(?:" + P + ")$", "i"),
      needsContext: new RegExp("^" + M + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + M + "*((?:-\\d)?\\d*)" + M + "*\\)|)(?=[^-]|$)", "i")
    },
        G = /^(?:input|select|textarea|button)$/i,
        Y = /^h\d$/i,
        Q = /^[^{]+\{\s*\[native \w/,
        J = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
        K = /[+~]/,
        Z = new RegExp("\\\\([\\da-f]{1,6}" + M + "?|(" + M + ")|.)", "ig"),
        ee = function ee(e, t, n) {
      var r = "0x" + t - 65536;
      return r !== r || n ? t : r < 0 ? String.fromCharCode(r + 65536) : String.fromCharCode(r >> 10 | 55296, 1023 & r | 56320);
    },
        te = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
        ne = function ne(e, t) {
      return t ? "\0" === e ? "\uFFFD" : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " " : "\\" + e;
    },
        re = function re() {
      p();
    },
        ie = me(function (e) {
      return !0 === e.disabled && ("form" in e || "label" in e);
    }, {
      dir: "parentNode",
      next: "legend"
    });

    try {
      L.apply(A = H.call(w.childNodes), w.childNodes), A[w.childNodes.length].nodeType;
    } catch (e) {
      L = {
        apply: A.length ? function (e, t) {
          q.apply(e, H.call(t));
        } : function (e, t) {
          var n = e.length,
              r = 0;

          while (e[n++] = t[r++]) {
            ;
          }

          e.length = n - 1;
        }
      };
    }

    function oe(e, t, r, i) {
      var o,
          s,
          l,
          c,
          f,
          h,
          v,
          m = t && t.ownerDocument,
          T = t ? t.nodeType : 9;
      if (r = r || [], "string" != typeof e || !e || 1 !== T && 9 !== T && 11 !== T) return r;

      if (!i && ((t ? t.ownerDocument || t : w) !== d && p(t), t = t || d, g)) {
        if (11 !== T && (f = J.exec(e))) if (o = f[1]) {
          if (9 === T) {
            if (!(l = t.getElementById(o))) return r;
            if (l.id === o) return r.push(l), r;
          } else if (m && (l = m.getElementById(o)) && x(t, l) && l.id === o) return r.push(l), r;
        } else {
          if (f[2]) return L.apply(r, t.getElementsByTagName(e)), r;
          if ((o = f[3]) && n.getElementsByClassName && t.getElementsByClassName) return L.apply(r, t.getElementsByClassName(o)), r;
        }

        if (n.qsa && !S[e + " "] && (!y || !y.test(e))) {
          if (1 !== T) m = t, v = e;else if ("object" !== t.nodeName.toLowerCase()) {
            (c = t.getAttribute("id")) ? c = c.replace(te, ne) : t.setAttribute("id", c = b), s = (h = a(e)).length;

            while (s--) {
              h[s] = "#" + c + " " + ve(h[s]);
            }

            v = h.join(","), m = K.test(e) && ge(t.parentNode) || t;
          }
          if (v) try {
            return L.apply(r, m.querySelectorAll(v)), r;
          } catch (e) {} finally {
            c === b && t.removeAttribute("id");
          }
        }
      }

      return u(e.replace(B, "$1"), t, r, i);
    }

    function ae() {
      var e = [];

      function t(n, i) {
        return e.push(n + " ") > r.cacheLength && delete t[e.shift()], t[n + " "] = i;
      }

      return t;
    }

    function se(e) {
      return e[b] = !0, e;
    }

    function ue(e) {
      var t = d.createElement("fieldset");

      try {
        return !!e(t);
      } catch (e) {
        return !1;
      } finally {
        t.parentNode && t.parentNode.removeChild(t), t = null;
      }
    }

    function le(e, t) {
      var n = e.split("|"),
          i = n.length;

      while (i--) {
        r.attrHandle[n[i]] = t;
      }
    }

    function ce(e, t) {
      var n = t && e,
          r = n && 1 === e.nodeType && 1 === t.nodeType && e.sourceIndex - t.sourceIndex;
      if (r) return r;
      if (n) while (n = n.nextSibling) {
        if (n === t) return -1;
      }
      return e ? 1 : -1;
    }

    function fe(e) {
      return function (t) {
        return "input" === t.nodeName.toLowerCase() && t.type === e;
      };
    }

    function pe(e) {
      return function (t) {
        var n = t.nodeName.toLowerCase();
        return ("input" === n || "button" === n) && t.type === e;
      };
    }

    function de(e) {
      return function (t) {
        return "form" in t ? t.parentNode && !1 === t.disabled ? "label" in t ? "label" in t.parentNode ? t.parentNode.disabled === e : t.disabled === e : t.isDisabled === e || t.isDisabled !== !e && ie(t) === e : t.disabled === e : "label" in t && t.disabled === e;
      };
    }

    function he(e) {
      return se(function (t) {
        return t = +t, se(function (n, r) {
          var i,
              o = e([], n.length, t),
              a = o.length;

          while (a--) {
            n[i = o[a]] && (n[i] = !(r[i] = n[i]));
          }
        });
      });
    }

    function ge(e) {
      return e && "undefined" != typeof e.getElementsByTagName && e;
    }

    n = oe.support = {}, o = oe.isXML = function (e) {
      var t = e && (e.ownerDocument || e).documentElement;
      return !!t && "HTML" !== t.nodeName;
    }, p = oe.setDocument = function (e) {
      var t,
          i,
          a = e ? e.ownerDocument || e : w;
      return a !== d && 9 === a.nodeType && a.documentElement ? (d = a, h = d.documentElement, g = !o(d), w !== d && (i = d.defaultView) && i.top !== i && (i.addEventListener ? i.addEventListener("unload", re, !1) : i.attachEvent && i.attachEvent("onunload", re)), n.attributes = ue(function (e) {
        return e.className = "i", !e.getAttribute("className");
      }), n.getElementsByTagName = ue(function (e) {
        return e.appendChild(d.createComment("")), !e.getElementsByTagName("*").length;
      }), n.getElementsByClassName = Q.test(d.getElementsByClassName), n.getById = ue(function (e) {
        return h.appendChild(e).id = b, !d.getElementsByName || !d.getElementsByName(b).length;
      }), n.getById ? (r.filter.ID = function (e) {
        var t = e.replace(Z, ee);
        return function (e) {
          return e.getAttribute("id") === t;
        };
      }, r.find.ID = function (e, t) {
        if ("undefined" != typeof t.getElementById && g) {
          var n = t.getElementById(e);
          return n ? [n] : [];
        }
      }) : (r.filter.ID = function (e) {
        var t = e.replace(Z, ee);
        return function (e) {
          var n = "undefined" != typeof e.getAttributeNode && e.getAttributeNode("id");
          return n && n.value === t;
        };
      }, r.find.ID = function (e, t) {
        if ("undefined" != typeof t.getElementById && g) {
          var n,
              r,
              i,
              o = t.getElementById(e);

          if (o) {
            if ((n = o.getAttributeNode("id")) && n.value === e) return [o];
            i = t.getElementsByName(e), r = 0;

            while (o = i[r++]) {
              if ((n = o.getAttributeNode("id")) && n.value === e) return [o];
            }
          }

          return [];
        }
      }), r.find.TAG = n.getElementsByTagName ? function (e, t) {
        return "undefined" != typeof t.getElementsByTagName ? t.getElementsByTagName(e) : n.qsa ? t.querySelectorAll(e) : void 0;
      } : function (e, t) {
        var n,
            r = [],
            i = 0,
            o = t.getElementsByTagName(e);

        if ("*" === e) {
          while (n = o[i++]) {
            1 === n.nodeType && r.push(n);
          }

          return r;
        }

        return o;
      }, r.find.CLASS = n.getElementsByClassName && function (e, t) {
        if ("undefined" != typeof t.getElementsByClassName && g) return t.getElementsByClassName(e);
      }, v = [], y = [], (n.qsa = Q.test(d.querySelectorAll)) && (ue(function (e) {
        h.appendChild(e).innerHTML = "<a id='" + b + "'></a><select id='" + b + "-\r\\' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && y.push("[*^$]=" + M + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || y.push("\\[" + M + "*(?:value|" + P + ")"), e.querySelectorAll("[id~=" + b + "-]").length || y.push("~="), e.querySelectorAll(":checked").length || y.push(":checked"), e.querySelectorAll("a#" + b + "+*").length || y.push(".#.+[+~]");
      }), ue(function (e) {
        e.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
        var t = d.createElement("input");
        t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && y.push("name" + M + "*[*^$|!~]?="), 2 !== e.querySelectorAll(":enabled").length && y.push(":enabled", ":disabled"), h.appendChild(e).disabled = !0, 2 !== e.querySelectorAll(":disabled").length && y.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), y.push(",.*:");
      })), (n.matchesSelector = Q.test(m = h.matches || h.webkitMatchesSelector || h.mozMatchesSelector || h.oMatchesSelector || h.msMatchesSelector)) && ue(function (e) {
        n.disconnectedMatch = m.call(e, "*"), m.call(e, "[s!='']:x"), v.push("!=", W);
      }), y = y.length && new RegExp(y.join("|")), v = v.length && new RegExp(v.join("|")), t = Q.test(h.compareDocumentPosition), x = t || Q.test(h.contains) ? function (e, t) {
        var n = 9 === e.nodeType ? e.documentElement : e,
            r = t && t.parentNode;
        return e === r || !(!r || 1 !== r.nodeType || !(n.contains ? n.contains(r) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(r)));
      } : function (e, t) {
        if (t) while (t = t.parentNode) {
          if (t === e) return !0;
        }
        return !1;
      }, D = t ? function (e, t) {
        if (e === t) return f = !0, 0;
        var r = !e.compareDocumentPosition - !t.compareDocumentPosition;
        return r || (1 & (r = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1) || !n.sortDetached && t.compareDocumentPosition(e) === r ? e === d || e.ownerDocument === w && x(w, e) ? -1 : t === d || t.ownerDocument === w && x(w, t) ? 1 : c ? O(c, e) - O(c, t) : 0 : 4 & r ? -1 : 1);
      } : function (e, t) {
        if (e === t) return f = !0, 0;
        var n,
            r = 0,
            i = e.parentNode,
            o = t.parentNode,
            a = [e],
            s = [t];
        if (!i || !o) return e === d ? -1 : t === d ? 1 : i ? -1 : o ? 1 : c ? O(c, e) - O(c, t) : 0;
        if (i === o) return ce(e, t);
        n = e;

        while (n = n.parentNode) {
          a.unshift(n);
        }

        n = t;

        while (n = n.parentNode) {
          s.unshift(n);
        }

        while (a[r] === s[r]) {
          r++;
        }

        return r ? ce(a[r], s[r]) : a[r] === w ? -1 : s[r] === w ? 1 : 0;
      }, d) : d;
    }, oe.matches = function (e, t) {
      return oe(e, null, null, t);
    }, oe.matchesSelector = function (e, t) {
      if ((e.ownerDocument || e) !== d && p(e), t = t.replace(z, "='$1']"), n.matchesSelector && g && !S[t + " "] && (!v || !v.test(t)) && (!y || !y.test(t))) try {
        var r = m.call(e, t);
        if (r || n.disconnectedMatch || e.document && 11 !== e.document.nodeType) return r;
      } catch (e) {}
      return oe(t, d, null, [e]).length > 0;
    }, oe.contains = function (e, t) {
      return (e.ownerDocument || e) !== d && p(e), x(e, t);
    }, oe.attr = function (e, t) {
      (e.ownerDocument || e) !== d && p(e);
      var i = r.attrHandle[t.toLowerCase()],
          o = i && N.call(r.attrHandle, t.toLowerCase()) ? i(e, t, !g) : void 0;
      return void 0 !== o ? o : n.attributes || !g ? e.getAttribute(t) : (o = e.getAttributeNode(t)) && o.specified ? o.value : null;
    }, oe.escape = function (e) {
      return (e + "").replace(te, ne);
    }, oe.error = function (e) {
      throw new Error("Syntax error, unrecognized expression: " + e);
    }, oe.uniqueSort = function (e) {
      var t,
          r = [],
          i = 0,
          o = 0;

      if (f = !n.detectDuplicates, c = !n.sortStable && e.slice(0), e.sort(D), f) {
        while (t = e[o++]) {
          t === e[o] && (i = r.push(o));
        }

        while (i--) {
          e.splice(r[i], 1);
        }
      }

      return c = null, e;
    }, i = oe.getText = function (e) {
      var t,
          n = "",
          r = 0,
          o = e.nodeType;

      if (o) {
        if (1 === o || 9 === o || 11 === o) {
          if ("string" == typeof e.textContent) return e.textContent;

          for (e = e.firstChild; e; e = e.nextSibling) {
            n += i(e);
          }
        } else if (3 === o || 4 === o) return e.nodeValue;
      } else while (t = e[r++]) {
        n += i(t);
      }

      return n;
    }, (r = oe.selectors = {
      cacheLength: 50,
      createPseudo: se,
      match: V,
      attrHandle: {},
      find: {},
      relative: {
        ">": {
          dir: "parentNode",
          first: !0
        },
        " ": {
          dir: "parentNode"
        },
        "+": {
          dir: "previousSibling",
          first: !0
        },
        "~": {
          dir: "previousSibling"
        }
      },
      preFilter: {
        ATTR: function ATTR(e) {
          return e[1] = e[1].replace(Z, ee), e[3] = (e[3] || e[4] || e[5] || "").replace(Z, ee), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4);
        },
        CHILD: function CHILD(e) {
          return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || oe.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && oe.error(e[0]), e;
        },
        PSEUDO: function PSEUDO(e) {
          var t,
              n = !e[6] && e[2];
          return V.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && X.test(n) && (t = a(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3));
        }
      },
      filter: {
        TAG: function TAG(e) {
          var t = e.replace(Z, ee).toLowerCase();
          return "*" === e ? function () {
            return !0;
          } : function (e) {
            return e.nodeName && e.nodeName.toLowerCase() === t;
          };
        },
        CLASS: function CLASS(e) {
          var t = E[e + " "];
          return t || (t = new RegExp("(^|" + M + ")" + e + "(" + M + "|$)")) && E(e, function (e) {
            return t.test("string" == typeof e.className && e.className || "undefined" != typeof e.getAttribute && e.getAttribute("class") || "");
          });
        },
        ATTR: function ATTR(e, t, n) {
          return function (r) {
            var i = oe.attr(r, e);
            return null == i ? "!=" === t : !t || (i += "", "=" === t ? i === n : "!=" === t ? i !== n : "^=" === t ? n && 0 === i.indexOf(n) : "*=" === t ? n && i.indexOf(n) > -1 : "$=" === t ? n && i.slice(-n.length) === n : "~=" === t ? (" " + i.replace($, " ") + " ").indexOf(n) > -1 : "|=" === t && (i === n || i.slice(0, n.length + 1) === n + "-"));
          };
        },
        CHILD: function CHILD(e, t, n, r, i) {
          var o = "nth" !== e.slice(0, 3),
              a = "last" !== e.slice(-4),
              s = "of-type" === t;
          return 1 === r && 0 === i ? function (e) {
            return !!e.parentNode;
          } : function (t, n, u) {
            var l,
                c,
                f,
                p,
                d,
                h,
                g = o !== a ? "nextSibling" : "previousSibling",
                y = t.parentNode,
                v = s && t.nodeName.toLowerCase(),
                m = !u && !s,
                x = !1;

            if (y) {
              if (o) {
                while (g) {
                  p = t;

                  while (p = p[g]) {
                    if (s ? p.nodeName.toLowerCase() === v : 1 === p.nodeType) return !1;
                  }

                  h = g = "only" === e && !h && "nextSibling";
                }

                return !0;
              }

              if (h = [a ? y.firstChild : y.lastChild], a && m) {
                x = (d = (l = (c = (f = (p = y)[b] || (p[b] = {}))[p.uniqueID] || (f[p.uniqueID] = {}))[e] || [])[0] === T && l[1]) && l[2], p = d && y.childNodes[d];

                while (p = ++d && p && p[g] || (x = d = 0) || h.pop()) {
                  if (1 === p.nodeType && ++x && p === t) {
                    c[e] = [T, d, x];
                    break;
                  }
                }
              } else if (m && (x = d = (l = (c = (f = (p = t)[b] || (p[b] = {}))[p.uniqueID] || (f[p.uniqueID] = {}))[e] || [])[0] === T && l[1]), !1 === x) while (p = ++d && p && p[g] || (x = d = 0) || h.pop()) {
                if ((s ? p.nodeName.toLowerCase() === v : 1 === p.nodeType) && ++x && (m && ((c = (f = p[b] || (p[b] = {}))[p.uniqueID] || (f[p.uniqueID] = {}))[e] = [T, x]), p === t)) break;
              }

              return (x -= i) === r || x % r == 0 && x / r >= 0;
            }
          };
        },
        PSEUDO: function PSEUDO(e, t) {
          var n,
              i = r.pseudos[e] || r.setFilters[e.toLowerCase()] || oe.error("unsupported pseudo: " + e);
          return i[b] ? i(t) : i.length > 1 ? (n = [e, e, "", t], r.setFilters.hasOwnProperty(e.toLowerCase()) ? se(function (e, n) {
            var r,
                o = i(e, t),
                a = o.length;

            while (a--) {
              e[r = O(e, o[a])] = !(n[r] = o[a]);
            }
          }) : function (e) {
            return i(e, 0, n);
          }) : i;
        }
      },
      pseudos: {
        not: se(function (e) {
          var t = [],
              n = [],
              r = s(e.replace(B, "$1"));
          return r[b] ? se(function (e, t, n, i) {
            var o,
                a = r(e, null, i, []),
                s = e.length;

            while (s--) {
              (o = a[s]) && (e[s] = !(t[s] = o));
            }
          }) : function (e, i, o) {
            return t[0] = e, r(t, null, o, n), t[0] = null, !n.pop();
          };
        }),
        has: se(function (e) {
          return function (t) {
            return oe(e, t).length > 0;
          };
        }),
        contains: se(function (e) {
          return e = e.replace(Z, ee), function (t) {
            return (t.textContent || t.innerText || i(t)).indexOf(e) > -1;
          };
        }),
        lang: se(function (e) {
          return U.test(e || "") || oe.error("unsupported lang: " + e), e = e.replace(Z, ee).toLowerCase(), function (t) {
            var n;

            do {
              if (n = g ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang")) return (n = n.toLowerCase()) === e || 0 === n.indexOf(e + "-");
            } while ((t = t.parentNode) && 1 === t.nodeType);

            return !1;
          };
        }),
        target: function target(t) {
          var n = e.location && e.location.hash;
          return n && n.slice(1) === t.id;
        },
        root: function root(e) {
          return e === h;
        },
        focus: function focus(e) {
          return e === d.activeElement && (!d.hasFocus || d.hasFocus()) && !!(e.type || e.href || ~e.tabIndex);
        },
        enabled: de(!1),
        disabled: de(!0),
        checked: function checked(e) {
          var t = e.nodeName.toLowerCase();
          return "input" === t && !!e.checked || "option" === t && !!e.selected;
        },
        selected: function selected(e) {
          return e.parentNode && e.parentNode.selectedIndex, !0 === e.selected;
        },
        empty: function empty(e) {
          for (e = e.firstChild; e; e = e.nextSibling) {
            if (e.nodeType < 6) return !1;
          }

          return !0;
        },
        parent: function parent(e) {
          return !r.pseudos.empty(e);
        },
        header: function header(e) {
          return Y.test(e.nodeName);
        },
        input: function input(e) {
          return G.test(e.nodeName);
        },
        button: function button(e) {
          var t = e.nodeName.toLowerCase();
          return "input" === t && "button" === e.type || "button" === t;
        },
        text: function text(e) {
          var t;
          return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase());
        },
        first: he(function () {
          return [0];
        }),
        last: he(function (e, t) {
          return [t - 1];
        }),
        eq: he(function (e, t, n) {
          return [n < 0 ? n + t : n];
        }),
        even: he(function (e, t) {
          for (var n = 0; n < t; n += 2) {
            e.push(n);
          }

          return e;
        }),
        odd: he(function (e, t) {
          for (var n = 1; n < t; n += 2) {
            e.push(n);
          }

          return e;
        }),
        lt: he(function (e, t, n) {
          for (var r = n < 0 ? n + t : n; --r >= 0;) {
            e.push(r);
          }

          return e;
        }),
        gt: he(function (e, t, n) {
          for (var r = n < 0 ? n + t : n; ++r < t;) {
            e.push(r);
          }

          return e;
        })
      }
    }).pseudos.nth = r.pseudos.eq;

    for (t in {
      radio: !0,
      checkbox: !0,
      file: !0,
      password: !0,
      image: !0
    }) {
      r.pseudos[t] = fe(t);
    }

    for (t in {
      submit: !0,
      reset: !0
    }) {
      r.pseudos[t] = pe(t);
    }

    function ye() {}

    ye.prototype = r.filters = r.pseudos, r.setFilters = new ye(), a = oe.tokenize = function (e, t) {
      var n,
          i,
          o,
          a,
          s,
          u,
          l,
          c = k[e + " "];
      if (c) return t ? 0 : c.slice(0);
      s = e, u = [], l = r.preFilter;

      while (s) {
        n && !(i = F.exec(s)) || (i && (s = s.slice(i[0].length) || s), u.push(o = [])), n = !1, (i = _.exec(s)) && (n = i.shift(), o.push({
          value: n,
          type: i[0].replace(B, " ")
        }), s = s.slice(n.length));

        for (a in r.filter) {
          !(i = V[a].exec(s)) || l[a] && !(i = l[a](i)) || (n = i.shift(), o.push({
            value: n,
            type: a,
            matches: i
          }), s = s.slice(n.length));
        }

        if (!n) break;
      }

      return t ? s.length : s ? oe.error(e) : k(e, u).slice(0);
    };

    function ve(e) {
      for (var t = 0, n = e.length, r = ""; t < n; t++) {
        r += e[t].value;
      }

      return r;
    }

    function me(e, t, n) {
      var r = t.dir,
          i = t.next,
          o = i || r,
          a = n && "parentNode" === o,
          s = C++;
      return t.first ? function (t, n, i) {
        while (t = t[r]) {
          if (1 === t.nodeType || a) return e(t, n, i);
        }

        return !1;
      } : function (t, n, u) {
        var l,
            c,
            f,
            p = [T, s];

        if (u) {
          while (t = t[r]) {
            if ((1 === t.nodeType || a) && e(t, n, u)) return !0;
          }
        } else while (t = t[r]) {
          if (1 === t.nodeType || a) if (f = t[b] || (t[b] = {}), c = f[t.uniqueID] || (f[t.uniqueID] = {}), i && i === t.nodeName.toLowerCase()) t = t[r] || t;else {
            if ((l = c[o]) && l[0] === T && l[1] === s) return p[2] = l[2];
            if (c[o] = p, p[2] = e(t, n, u)) return !0;
          }
        }

        return !1;
      };
    }

    function xe(e) {
      return e.length > 1 ? function (t, n, r) {
        var i = e.length;

        while (i--) {
          if (!e[i](t, n, r)) return !1;
        }

        return !0;
      } : e[0];
    }

    function be(e, t, n) {
      for (var r = 0, i = t.length; r < i; r++) {
        oe(e, t[r], n);
      }

      return n;
    }

    function we(e, t, n, r, i) {
      for (var o, a = [], s = 0, u = e.length, l = null != t; s < u; s++) {
        (o = e[s]) && (n && !n(o, r, i) || (a.push(o), l && t.push(s)));
      }

      return a;
    }

    function Te(e, t, n, r, i, o) {
      return r && !r[b] && (r = Te(r)), i && !i[b] && (i = Te(i, o)), se(function (o, a, s, u) {
        var l,
            c,
            f,
            p = [],
            d = [],
            h = a.length,
            g = o || be(t || "*", s.nodeType ? [s] : s, []),
            y = !e || !o && t ? g : we(g, p, e, s, u),
            v = n ? i || (o ? e : h || r) ? [] : a : y;

        if (n && n(y, v, s, u), r) {
          l = we(v, d), r(l, [], s, u), c = l.length;

          while (c--) {
            (f = l[c]) && (v[d[c]] = !(y[d[c]] = f));
          }
        }

        if (o) {
          if (i || e) {
            if (i) {
              l = [], c = v.length;

              while (c--) {
                (f = v[c]) && l.push(y[c] = f);
              }

              i(null, v = [], l, u);
            }

            c = v.length;

            while (c--) {
              (f = v[c]) && (l = i ? O(o, f) : p[c]) > -1 && (o[l] = !(a[l] = f));
            }
          }
        } else v = we(v === a ? v.splice(h, v.length) : v), i ? i(null, a, v, u) : L.apply(a, v);
      });
    }

    function Ce(e) {
      for (var t, n, i, o = e.length, a = r.relative[e[0].type], s = a || r.relative[" "], u = a ? 1 : 0, c = me(function (e) {
        return e === t;
      }, s, !0), f = me(function (e) {
        return O(t, e) > -1;
      }, s, !0), p = [function (e, n, r) {
        var i = !a && (r || n !== l) || ((t = n).nodeType ? c(e, n, r) : f(e, n, r));
        return t = null, i;
      }]; u < o; u++) {
        if (n = r.relative[e[u].type]) p = [me(xe(p), n)];else {
          if ((n = r.filter[e[u].type].apply(null, e[u].matches))[b]) {
            for (i = ++u; i < o; i++) {
              if (r.relative[e[i].type]) break;
            }

            return Te(u > 1 && xe(p), u > 1 && ve(e.slice(0, u - 1).concat({
              value: " " === e[u - 2].type ? "*" : ""
            })).replace(B, "$1"), n, u < i && Ce(e.slice(u, i)), i < o && Ce(e = e.slice(i)), i < o && ve(e));
          }

          p.push(n);
        }
      }

      return xe(p);
    }

    function Ee(e, t) {
      var n = t.length > 0,
          i = e.length > 0,
          o = function o(_o, a, s, u, c) {
        var f,
            h,
            y,
            v = 0,
            m = "0",
            x = _o && [],
            b = [],
            w = l,
            C = _o || i && r.find.TAG("*", c),
            E = T += null == w ? 1 : Math.random() || .1,
            k = C.length;

        for (c && (l = a === d || a || c); m !== k && null != (f = C[m]); m++) {
          if (i && f) {
            h = 0, a || f.ownerDocument === d || (p(f), s = !g);

            while (y = e[h++]) {
              if (y(f, a || d, s)) {
                u.push(f);
                break;
              }
            }

            c && (T = E);
          }

          n && ((f = !y && f) && v--, _o && x.push(f));
        }

        if (v += m, n && m !== v) {
          h = 0;

          while (y = t[h++]) {
            y(x, b, a, s);
          }

          if (_o) {
            if (v > 0) while (m--) {
              x[m] || b[m] || (b[m] = j.call(u));
            }
            b = we(b);
          }

          L.apply(u, b), c && !_o && b.length > 0 && v + t.length > 1 && oe.uniqueSort(u);
        }

        return c && (T = E, l = w), x;
      };

      return n ? se(o) : o;
    }

    return s = oe.compile = function (e, t) {
      var n,
          r = [],
          i = [],
          o = S[e + " "];

      if (!o) {
        t || (t = a(e)), n = t.length;

        while (n--) {
          (o = Ce(t[n]))[b] ? r.push(o) : i.push(o);
        }

        (o = S(e, Ee(i, r))).selector = e;
      }

      return o;
    }, u = oe.select = function (e, t, n, i) {
      var o,
          u,
          l,
          c,
          f,
          p = "function" == typeof e && e,
          d = !i && a(e = p.selector || e);

      if (n = n || [], 1 === d.length) {
        if ((u = d[0] = d[0].slice(0)).length > 2 && "ID" === (l = u[0]).type && 9 === t.nodeType && g && r.relative[u[1].type]) {
          if (!(t = (r.find.ID(l.matches[0].replace(Z, ee), t) || [])[0])) return n;
          p && (t = t.parentNode), e = e.slice(u.shift().value.length);
        }

        o = V.needsContext.test(e) ? 0 : u.length;

        while (o--) {
          if (l = u[o], r.relative[c = l.type]) break;

          if ((f = r.find[c]) && (i = f(l.matches[0].replace(Z, ee), K.test(u[0].type) && ge(t.parentNode) || t))) {
            if (u.splice(o, 1), !(e = i.length && ve(u))) return L.apply(n, i), n;
            break;
          }
        }
      }

      return (p || s(e, d))(i, t, !g, n, !t || K.test(e) && ge(t.parentNode) || t), n;
    }, n.sortStable = b.split("").sort(D).join("") === b, n.detectDuplicates = !!f, p(), n.sortDetached = ue(function (e) {
      return 1 & e.compareDocumentPosition(d.createElement("fieldset"));
    }), ue(function (e) {
      return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href");
    }) || le("type|href|height|width", function (e, t, n) {
      if (!n) return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2);
    }), n.attributes && ue(function (e) {
      return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value");
    }) || le("value", function (e, t, n) {
      if (!n && "input" === e.nodeName.toLowerCase()) return e.defaultValue;
    }), ue(function (e) {
      return null == e.getAttribute("disabled");
    }) || le(P, function (e, t, n) {
      var r;
      if (!n) return !0 === e[t] ? t.toLowerCase() : (r = e.getAttributeNode(t)) && r.specified ? r.value : null;
    }), oe;
  }(e);

  w.find = E, w.expr = E.selectors, w.expr[":"] = w.expr.pseudos, w.uniqueSort = w.unique = E.uniqueSort, w.text = E.getText, w.isXMLDoc = E.isXML, w.contains = E.contains, w.escapeSelector = E.escape;

  var k = function k(e, t, n) {
    var r = [],
        i = void 0 !== n;

    while ((e = e[t]) && 9 !== e.nodeType) {
      if (1 === e.nodeType) {
        if (i && w(e).is(n)) break;
        r.push(e);
      }
    }

    return r;
  },
      S = function S(e, t) {
    for (var n = []; e; e = e.nextSibling) {
      1 === e.nodeType && e !== t && n.push(e);
    }

    return n;
  },
      D = w.expr.match.needsContext;

  function N(e, t) {
    return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase();
  }

  var A = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;

  function j(e, t, n) {
    return g(t) ? w.grep(e, function (e, r) {
      return !!t.call(e, r, e) !== n;
    }) : t.nodeType ? w.grep(e, function (e) {
      return e === t !== n;
    }) : "string" != typeof t ? w.grep(e, function (e) {
      return u.call(t, e) > -1 !== n;
    }) : w.filter(t, e, n);
  }

  w.filter = function (e, t, n) {
    var r = t[0];
    return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === r.nodeType ? w.find.matchesSelector(r, e) ? [r] : [] : w.find.matches(e, w.grep(t, function (e) {
      return 1 === e.nodeType;
    }));
  }, w.fn.extend({
    find: function find(e) {
      var t,
          n,
          r = this.length,
          i = this;
      if ("string" != typeof e) return this.pushStack(w(e).filter(function () {
        for (t = 0; t < r; t++) {
          if (w.contains(i[t], this)) return !0;
        }
      }));

      for (n = this.pushStack([]), t = 0; t < r; t++) {
        w.find(e, i[t], n);
      }

      return r > 1 ? w.uniqueSort(n) : n;
    },
    filter: function filter(e) {
      return this.pushStack(j(this, e || [], !1));
    },
    not: function not(e) {
      return this.pushStack(j(this, e || [], !0));
    },
    is: function is(e) {
      return !!j(this, "string" == typeof e && D.test(e) ? w(e) : e || [], !1).length;
    }
  });
  var q,
      L = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
  (w.fn.init = function (e, t, n) {
    var i, o;
    if (!e) return this;

    if (n = n || q, "string" == typeof e) {
      if (!(i = "<" === e[0] && ">" === e[e.length - 1] && e.length >= 3 ? [null, e, null] : L.exec(e)) || !i[1] && t) return !t || t.jquery ? (t || n).find(e) : this.constructor(t).find(e);

      if (i[1]) {
        if (t = t instanceof w ? t[0] : t, w.merge(this, w.parseHTML(i[1], t && t.nodeType ? t.ownerDocument || t : r, !0)), A.test(i[1]) && w.isPlainObject(t)) for (i in t) {
          g(this[i]) ? this[i](t[i]) : this.attr(i, t[i]);
        }
        return this;
      }

      return (o = r.getElementById(i[2])) && (this[0] = o, this.length = 1), this;
    }

    return e.nodeType ? (this[0] = e, this.length = 1, this) : g(e) ? void 0 !== n.ready ? n.ready(e) : e(w) : w.makeArray(e, this);
  }).prototype = w.fn, q = w(r);
  var H = /^(?:parents|prev(?:Until|All))/,
      O = {
    children: !0,
    contents: !0,
    next: !0,
    prev: !0
  };
  w.fn.extend({
    has: function has(e) {
      var t = w(e, this),
          n = t.length;
      return this.filter(function () {
        for (var e = 0; e < n; e++) {
          if (w.contains(this, t[e])) return !0;
        }
      });
    },
    closest: function closest(e, t) {
      var n,
          r = 0,
          i = this.length,
          o = [],
          a = "string" != typeof e && w(e);
      if (!D.test(e)) for (; r < i; r++) {
        for (n = this[r]; n && n !== t; n = n.parentNode) {
          if (n.nodeType < 11 && (a ? a.index(n) > -1 : 1 === n.nodeType && w.find.matchesSelector(n, e))) {
            o.push(n);
            break;
          }
        }
      }
      return this.pushStack(o.length > 1 ? w.uniqueSort(o) : o);
    },
    index: function index(e) {
      return e ? "string" == typeof e ? u.call(w(e), this[0]) : u.call(this, e.jquery ? e[0] : e) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1;
    },
    add: function add(e, t) {
      return this.pushStack(w.uniqueSort(w.merge(this.get(), w(e, t))));
    },
    addBack: function addBack(e) {
      return this.add(null == e ? this.prevObject : this.prevObject.filter(e));
    }
  });

  function P(e, t) {
    while ((e = e[t]) && 1 !== e.nodeType) {
      ;
    }

    return e;
  }

  w.each({
    parent: function parent(e) {
      var t = e.parentNode;
      return t && 11 !== t.nodeType ? t : null;
    },
    parents: function parents(e) {
      return k(e, "parentNode");
    },
    parentsUntil: function parentsUntil(e, t, n) {
      return k(e, "parentNode", n);
    },
    next: function next(e) {
      return P(e, "nextSibling");
    },
    prev: function prev(e) {
      return P(e, "previousSibling");
    },
    nextAll: function nextAll(e) {
      return k(e, "nextSibling");
    },
    prevAll: function prevAll(e) {
      return k(e, "previousSibling");
    },
    nextUntil: function nextUntil(e, t, n) {
      return k(e, "nextSibling", n);
    },
    prevUntil: function prevUntil(e, t, n) {
      return k(e, "previousSibling", n);
    },
    siblings: function siblings(e) {
      return S((e.parentNode || {}).firstChild, e);
    },
    children: function children(e) {
      return S(e.firstChild);
    },
    contents: function contents(e) {
      return N(e, "iframe") ? e.contentDocument : (N(e, "template") && (e = e.content || e), w.merge([], e.childNodes));
    }
  }, function (e, t) {
    w.fn[e] = function (n, r) {
      var i = w.map(this, t, n);
      return "Until" !== e.slice(-5) && (r = n), r && "string" == typeof r && (i = w.filter(r, i)), this.length > 1 && (O[e] || w.uniqueSort(i), H.test(e) && i.reverse()), this.pushStack(i);
    };
  });
  var M = /[^\x20\t\r\n\f]+/g;

  function R(e) {
    var t = {};
    return w.each(e.match(M) || [], function (e, n) {
      t[n] = !0;
    }), t;
  }

  w.Callbacks = function (e) {
    e = "string" == typeof e ? R(e) : w.extend({}, e);

    var t,
        n,
        r,
        i,
        o = [],
        a = [],
        s = -1,
        u = function u() {
      for (i = i || e.once, r = t = !0; a.length; s = -1) {
        n = a.shift();

        while (++s < o.length) {
          !1 === o[s].apply(n[0], n[1]) && e.stopOnFalse && (s = o.length, n = !1);
        }
      }

      e.memory || (n = !1), t = !1, i && (o = n ? [] : "");
    },
        l = {
      add: function add() {
        return o && (n && !t && (s = o.length - 1, a.push(n)), function t(n) {
          w.each(n, function (n, r) {
            g(r) ? e.unique && l.has(r) || o.push(r) : r && r.length && "string" !== x(r) && t(r);
          });
        }(arguments), n && !t && u()), this;
      },
      remove: function remove() {
        return w.each(arguments, function (e, t) {
          var n;

          while ((n = w.inArray(t, o, n)) > -1) {
            o.splice(n, 1), n <= s && s--;
          }
        }), this;
      },
      has: function has(e) {
        return e ? w.inArray(e, o) > -1 : o.length > 0;
      },
      empty: function empty() {
        return o && (o = []), this;
      },
      disable: function disable() {
        return i = a = [], o = n = "", this;
      },
      disabled: function disabled() {
        return !o;
      },
      lock: function lock() {
        return i = a = [], n || t || (o = n = ""), this;
      },
      locked: function locked() {
        return !!i;
      },
      fireWith: function fireWith(e, n) {
        return i || (n = [e, (n = n || []).slice ? n.slice() : n], a.push(n), t || u()), this;
      },
      fire: function fire() {
        return l.fireWith(this, arguments), this;
      },
      fired: function fired() {
        return !!r;
      }
    };

    return l;
  };

  function I(e) {
    return e;
  }

  function W(e) {
    throw e;
  }

  function $(e, t, n, r) {
    var i;

    try {
      e && g(i = e.promise) ? i.call(e).done(t).fail(n) : e && g(i = e.then) ? i.call(e, t, n) : t.apply(void 0, [e].slice(r));
    } catch (e) {
      n.apply(void 0, [e]);
    }
  }

  w.extend({
    Deferred: function Deferred(t) {
      var n = [["notify", "progress", w.Callbacks("memory"), w.Callbacks("memory"), 2], ["resolve", "done", w.Callbacks("once memory"), w.Callbacks("once memory"), 0, "resolved"], ["reject", "fail", w.Callbacks("once memory"), w.Callbacks("once memory"), 1, "rejected"]],
          r = "pending",
          i = {
        state: function state() {
          return r;
        },
        always: function always() {
          return o.done(arguments).fail(arguments), this;
        },
        "catch": function _catch(e) {
          return i.then(null, e);
        },
        pipe: function pipe() {
          var e = arguments;
          return w.Deferred(function (t) {
            w.each(n, function (n, r) {
              var i = g(e[r[4]]) && e[r[4]];
              o[r[1]](function () {
                var e = i && i.apply(this, arguments);
                e && g(e.promise) ? e.promise().progress(t.notify).done(t.resolve).fail(t.reject) : t[r[0] + "With"](this, i ? [e] : arguments);
              });
            }), e = null;
          }).promise();
        },
        then: function then(t, r, i) {
          var o = 0;

          function a(t, n, r, i) {
            return function () {
              var s = this,
                  u = arguments,
                  l = function l() {
                var e, l;

                if (!(t < o)) {
                  if ((e = r.apply(s, u)) === n.promise()) throw new TypeError("Thenable self-resolution");
                  l = e && ("object" == _typeof(e) || "function" == typeof e) && e.then, g(l) ? i ? l.call(e, a(o, n, I, i), a(o, n, W, i)) : (o++, l.call(e, a(o, n, I, i), a(o, n, W, i), a(o, n, I, n.notifyWith))) : (r !== I && (s = void 0, u = [e]), (i || n.resolveWith)(s, u));
                }
              },
                  c = i ? l : function () {
                try {
                  l();
                } catch (e) {
                  w.Deferred.exceptionHook && w.Deferred.exceptionHook(e, c.stackTrace), t + 1 >= o && (r !== W && (s = void 0, u = [e]), n.rejectWith(s, u));
                }
              };

              t ? c() : (w.Deferred.getStackHook && (c.stackTrace = w.Deferred.getStackHook()), e.setTimeout(c));
            };
          }

          return w.Deferred(function (e) {
            n[0][3].add(a(0, e, g(i) ? i : I, e.notifyWith)), n[1][3].add(a(0, e, g(t) ? t : I)), n[2][3].add(a(0, e, g(r) ? r : W));
          }).promise();
        },
        promise: function promise(e) {
          return null != e ? w.extend(e, i) : i;
        }
      },
          o = {};
      return w.each(n, function (e, t) {
        var a = t[2],
            s = t[5];
        i[t[1]] = a.add, s && a.add(function () {
          r = s;
        }, n[3 - e][2].disable, n[3 - e][3].disable, n[0][2].lock, n[0][3].lock), a.add(t[3].fire), o[t[0]] = function () {
          return o[t[0] + "With"](this === o ? void 0 : this, arguments), this;
        }, o[t[0] + "With"] = a.fireWith;
      }), i.promise(o), t && t.call(o, o), o;
    },
    when: function when(e) {
      var t = arguments.length,
          n = t,
          r = Array(n),
          i = o.call(arguments),
          a = w.Deferred(),
          s = function s(e) {
        return function (n) {
          r[e] = this, i[e] = arguments.length > 1 ? o.call(arguments) : n, --t || a.resolveWith(r, i);
        };
      };

      if (t <= 1 && ($(e, a.done(s(n)).resolve, a.reject, !t), "pending" === a.state() || g(i[n] && i[n].then))) return a.then();

      while (n--) {
        $(i[n], s(n), a.reject);
      }

      return a.promise();
    }
  });
  var B = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
  w.Deferred.exceptionHook = function (t, n) {
    e.console && e.console.warn && t && B.test(t.name) && e.console.warn("jQuery.Deferred exception: " + t.message, t.stack, n);
  }, w.readyException = function (t) {
    e.setTimeout(function () {
      throw t;
    });
  };
  var F = w.Deferred();
  w.fn.ready = function (e) {
    return F.then(e)["catch"](function (e) {
      w.readyException(e);
    }), this;
  }, w.extend({
    isReady: !1,
    readyWait: 1,
    ready: function ready(e) {
      (!0 === e ? --w.readyWait : w.isReady) || (w.isReady = !0, !0 !== e && --w.readyWait > 0 || F.resolveWith(r, [w]));
    }
  }), w.ready.then = F.then;

  function _() {
    r.removeEventListener("DOMContentLoaded", _), e.removeEventListener("load", _), w.ready();
  }

  "complete" === r.readyState || "loading" !== r.readyState && !r.documentElement.doScroll ? e.setTimeout(w.ready) : (r.addEventListener("DOMContentLoaded", _), e.addEventListener("load", _));

  var z = function z(e, t, n, r, i, o, a) {
    var s = 0,
        u = e.length,
        l = null == n;

    if ("object" === x(n)) {
      i = !0;

      for (s in n) {
        z(e, t, s, n[s], !0, o, a);
      }
    } else if (void 0 !== r && (i = !0, g(r) || (a = !0), l && (a ? (t.call(e, r), t = null) : (l = t, t = function t(e, _t2, n) {
      return l.call(w(e), n);
    })), t)) for (; s < u; s++) {
      t(e[s], n, a ? r : r.call(e[s], s, t(e[s], n)));
    }

    return i ? e : l ? t.call(e) : u ? t(e[0], n) : o;
  },
      X = /^-ms-/,
      U = /-([a-z])/g;

  function V(e, t) {
    return t.toUpperCase();
  }

  function G(e) {
    return e.replace(X, "ms-").replace(U, V);
  }

  var Y = function Y(e) {
    return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType;
  };

  function Q() {
    this.expando = w.expando + Q.uid++;
  }

  Q.uid = 1, Q.prototype = {
    cache: function cache(e) {
      var t = e[this.expando];
      return t || (t = {}, Y(e) && (e.nodeType ? e[this.expando] = t : Object.defineProperty(e, this.expando, {
        value: t,
        configurable: !0
      }))), t;
    },
    set: function set(e, t, n) {
      var r,
          i = this.cache(e);
      if ("string" == typeof t) i[G(t)] = n;else for (r in t) {
        i[G(r)] = t[r];
      }
      return i;
    },
    get: function get(e, t) {
      return void 0 === t ? this.cache(e) : e[this.expando] && e[this.expando][G(t)];
    },
    access: function access(e, t, n) {
      return void 0 === t || t && "string" == typeof t && void 0 === n ? this.get(e, t) : (this.set(e, t, n), void 0 !== n ? n : t);
    },
    remove: function remove(e, t) {
      var n,
          r = e[this.expando];

      if (void 0 !== r) {
        if (void 0 !== t) {
          n = (t = Array.isArray(t) ? t.map(G) : (t = G(t)) in r ? [t] : t.match(M) || []).length;

          while (n--) {
            delete r[t[n]];
          }
        }

        (void 0 === t || w.isEmptyObject(r)) && (e.nodeType ? e[this.expando] = void 0 : delete e[this.expando]);
      }
    },
    hasData: function hasData(e) {
      var t = e[this.expando];
      return void 0 !== t && !w.isEmptyObject(t);
    }
  };
  var J = new Q(),
      K = new Q(),
      Z = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
      ee = /[A-Z]/g;

  function te(e) {
    return "true" === e || "false" !== e && ("null" === e ? null : e === +e + "" ? +e : Z.test(e) ? JSON.parse(e) : e);
  }

  function ne(e, t, n) {
    var r;
    if (void 0 === n && 1 === e.nodeType) if (r = "data-" + t.replace(ee, "-$&").toLowerCase(), "string" == typeof (n = e.getAttribute(r))) {
      try {
        n = te(n);
      } catch (e) {}

      K.set(e, t, n);
    } else n = void 0;
    return n;
  }

  w.extend({
    hasData: function hasData(e) {
      return K.hasData(e) || J.hasData(e);
    },
    data: function data(e, t, n) {
      return K.access(e, t, n);
    },
    removeData: function removeData(e, t) {
      K.remove(e, t);
    },
    _data: function _data(e, t, n) {
      return J.access(e, t, n);
    },
    _removeData: function _removeData(e, t) {
      J.remove(e, t);
    }
  }), w.fn.extend({
    data: function data(e, t) {
      var n,
          r,
          i,
          o = this[0],
          a = o && o.attributes;

      if (void 0 === e) {
        if (this.length && (i = K.get(o), 1 === o.nodeType && !J.get(o, "hasDataAttrs"))) {
          n = a.length;

          while (n--) {
            a[n] && 0 === (r = a[n].name).indexOf("data-") && (r = G(r.slice(5)), ne(o, r, i[r]));
          }

          J.set(o, "hasDataAttrs", !0);
        }

        return i;
      }

      return "object" == _typeof(e) ? this.each(function () {
        K.set(this, e);
      }) : z(this, function (t) {
        var n;

        if (o && void 0 === t) {
          if (void 0 !== (n = K.get(o, e))) return n;
          if (void 0 !== (n = ne(o, e))) return n;
        } else this.each(function () {
          K.set(this, e, t);
        });
      }, null, t, arguments.length > 1, null, !0);
    },
    removeData: function removeData(e) {
      return this.each(function () {
        K.remove(this, e);
      });
    }
  }), w.extend({
    queue: function queue(e, t, n) {
      var r;
      if (e) return t = (t || "fx") + "queue", r = J.get(e, t), n && (!r || Array.isArray(n) ? r = J.access(e, t, w.makeArray(n)) : r.push(n)), r || [];
    },
    dequeue: function dequeue(e, t) {
      t = t || "fx";

      var n = w.queue(e, t),
          r = n.length,
          i = n.shift(),
          o = w._queueHooks(e, t),
          a = function a() {
        w.dequeue(e, t);
      };

      "inprogress" === i && (i = n.shift(), r--), i && ("fx" === t && n.unshift("inprogress"), delete o.stop, i.call(e, a, o)), !r && o && o.empty.fire();
    },
    _queueHooks: function _queueHooks(e, t) {
      var n = t + "queueHooks";
      return J.get(e, n) || J.access(e, n, {
        empty: w.Callbacks("once memory").add(function () {
          J.remove(e, [t + "queue", n]);
        })
      });
    }
  }), w.fn.extend({
    queue: function queue(e, t) {
      var n = 2;
      return "string" != typeof e && (t = e, e = "fx", n--), arguments.length < n ? w.queue(this[0], e) : void 0 === t ? this : this.each(function () {
        var n = w.queue(this, e, t);
        w._queueHooks(this, e), "fx" === e && "inprogress" !== n[0] && w.dequeue(this, e);
      });
    },
    dequeue: function dequeue(e) {
      return this.each(function () {
        w.dequeue(this, e);
      });
    },
    clearQueue: function clearQueue(e) {
      return this.queue(e || "fx", []);
    },
    promise: function promise(e, t) {
      var n,
          r = 1,
          i = w.Deferred(),
          o = this,
          a = this.length,
          s = function s() {
        --r || i.resolveWith(o, [o]);
      };

      "string" != typeof e && (t = e, e = void 0), e = e || "fx";

      while (a--) {
        (n = J.get(o[a], e + "queueHooks")) && n.empty && (r++, n.empty.add(s));
      }

      return s(), i.promise(t);
    }
  });

  var re = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
      ie = new RegExp("^(?:([+-])=|)(" + re + ")([a-z%]*)$", "i"),
      oe = ["Top", "Right", "Bottom", "Left"],
      ae = function ae(e, t) {
    return "none" === (e = t || e).style.display || "" === e.style.display && w.contains(e.ownerDocument, e) && "none" === w.css(e, "display");
  },
      se = function se(e, t, n, r) {
    var i,
        o,
        a = {};

    for (o in t) {
      a[o] = e.style[o], e.style[o] = t[o];
    }

    i = n.apply(e, r || []);

    for (o in t) {
      e.style[o] = a[o];
    }

    return i;
  };

  function ue(e, t, n, r) {
    var i,
        o,
        a = 20,
        s = r ? function () {
      return r.cur();
    } : function () {
      return w.css(e, t, "");
    },
        u = s(),
        l = n && n[3] || (w.cssNumber[t] ? "" : "px"),
        c = (w.cssNumber[t] || "px" !== l && +u) && ie.exec(w.css(e, t));

    if (c && c[3] !== l) {
      u /= 2, l = l || c[3], c = +u || 1;

      while (a--) {
        w.style(e, t, c + l), (1 - o) * (1 - (o = s() / u || .5)) <= 0 && (a = 0), c /= o;
      }

      c *= 2, w.style(e, t, c + l), n = n || [];
    }

    return n && (c = +c || +u || 0, i = n[1] ? c + (n[1] + 1) * n[2] : +n[2], r && (r.unit = l, r.start = c, r.end = i)), i;
  }

  var le = {};

  function ce(e) {
    var t,
        n = e.ownerDocument,
        r = e.nodeName,
        i = le[r];
    return i || (t = n.body.appendChild(n.createElement(r)), i = w.css(t, "display"), t.parentNode.removeChild(t), "none" === i && (i = "block"), le[r] = i, i);
  }

  function fe(e, t) {
    for (var n, r, i = [], o = 0, a = e.length; o < a; o++) {
      (r = e[o]).style && (n = r.style.display, t ? ("none" === n && (i[o] = J.get(r, "display") || null, i[o] || (r.style.display = "")), "" === r.style.display && ae(r) && (i[o] = ce(r))) : "none" !== n && (i[o] = "none", J.set(r, "display", n)));
    }

    for (o = 0; o < a; o++) {
      null != i[o] && (e[o].style.display = i[o]);
    }

    return e;
  }

  w.fn.extend({
    show: function show() {
      return fe(this, !0);
    },
    hide: function hide() {
      return fe(this);
    },
    toggle: function toggle(e) {
      return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function () {
        ae(this) ? w(this).show() : w(this).hide();
      });
    }
  });
  var pe = /^(?:checkbox|radio)$/i,
      de = /<([a-z][^\/\0>\x20\t\r\n\f]+)/i,
      he = /^$|^module$|\/(?:java|ecma)script/i,
      ge = {
    option: [1, "<select multiple='multiple'>", "</select>"],
    thead: [1, "<table>", "</table>"],
    col: [2, "<table><colgroup>", "</colgroup></table>"],
    tr: [2, "<table><tbody>", "</tbody></table>"],
    td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
    _default: [0, "", ""]
  };
  ge.optgroup = ge.option, ge.tbody = ge.tfoot = ge.colgroup = ge.caption = ge.thead, ge.th = ge.td;

  function ye(e, t) {
    var n;
    return n = "undefined" != typeof e.getElementsByTagName ? e.getElementsByTagName(t || "*") : "undefined" != typeof e.querySelectorAll ? e.querySelectorAll(t || "*") : [], void 0 === t || t && N(e, t) ? w.merge([e], n) : n;
  }

  function ve(e, t) {
    for (var n = 0, r = e.length; n < r; n++) {
      J.set(e[n], "globalEval", !t || J.get(t[n], "globalEval"));
    }
  }

  var me = /<|&#?\w+;/;

  function xe(e, t, n, r, i) {
    for (var o, a, s, u, l, c, f = t.createDocumentFragment(), p = [], d = 0, h = e.length; d < h; d++) {
      if ((o = e[d]) || 0 === o) if ("object" === x(o)) w.merge(p, o.nodeType ? [o] : o);else if (me.test(o)) {
        a = a || f.appendChild(t.createElement("div")), s = (de.exec(o) || ["", ""])[1].toLowerCase(), u = ge[s] || ge._default, a.innerHTML = u[1] + w.htmlPrefilter(o) + u[2], c = u[0];

        while (c--) {
          a = a.lastChild;
        }

        w.merge(p, a.childNodes), (a = f.firstChild).textContent = "";
      } else p.push(t.createTextNode(o));
    }

    f.textContent = "", d = 0;

    while (o = p[d++]) {
      if (r && w.inArray(o, r) > -1) i && i.push(o);else if (l = w.contains(o.ownerDocument, o), a = ye(f.appendChild(o), "script"), l && ve(a), n) {
        c = 0;

        while (o = a[c++]) {
          he.test(o.type || "") && n.push(o);
        }
      }
    }

    return f;
  }

  !function () {
    var e = r.createDocumentFragment().appendChild(r.createElement("div")),
        t = r.createElement("input");
    t.setAttribute("type", "radio"), t.setAttribute("checked", "checked"), t.setAttribute("name", "t"), e.appendChild(t), h.checkClone = e.cloneNode(!0).cloneNode(!0).lastChild.checked, e.innerHTML = "<textarea>x</textarea>", h.noCloneChecked = !!e.cloneNode(!0).lastChild.defaultValue;
  }();
  var be = r.documentElement,
      we = /^key/,
      Te = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
      Ce = /^([^.]*)(?:\.(.+)|)/;

  function Ee() {
    return !0;
  }

  function ke() {
    return !1;
  }

  function Se() {
    try {
      return r.activeElement;
    } catch (e) {}
  }

  function De(e, t, n, r, i, o) {
    var a, s;

    if ("object" == _typeof(t)) {
      "string" != typeof n && (r = r || n, n = void 0);

      for (s in t) {
        De(e, s, n, r, t[s], o);
      }

      return e;
    }

    if (null == r && null == i ? (i = n, r = n = void 0) : null == i && ("string" == typeof n ? (i = r, r = void 0) : (i = r, r = n, n = void 0)), !1 === i) i = ke;else if (!i) return e;
    return 1 === o && (a = i, (i = function i(e) {
      return w().off(e), a.apply(this, arguments);
    }).guid = a.guid || (a.guid = w.guid++)), e.each(function () {
      w.event.add(this, t, i, r, n);
    });
  }

  w.event = {
    global: {},
    add: function add(e, t, n, r, i) {
      var o,
          a,
          s,
          u,
          l,
          c,
          f,
          p,
          d,
          h,
          g,
          y = J.get(e);

      if (y) {
        n.handler && (n = (o = n).handler, i = o.selector), i && w.find.matchesSelector(be, i), n.guid || (n.guid = w.guid++), (u = y.events) || (u = y.events = {}), (a = y.handle) || (a = y.handle = function (t) {
          return "undefined" != typeof w && w.event.triggered !== t.type ? w.event.dispatch.apply(e, arguments) : void 0;
        }), l = (t = (t || "").match(M) || [""]).length;

        while (l--) {
          d = g = (s = Ce.exec(t[l]) || [])[1], h = (s[2] || "").split(".").sort(), d && (f = w.event.special[d] || {}, d = (i ? f.delegateType : f.bindType) || d, f = w.event.special[d] || {}, c = w.extend({
            type: d,
            origType: g,
            data: r,
            handler: n,
            guid: n.guid,
            selector: i,
            needsContext: i && w.expr.match.needsContext.test(i),
            namespace: h.join(".")
          }, o), (p = u[d]) || ((p = u[d] = []).delegateCount = 0, f.setup && !1 !== f.setup.call(e, r, h, a) || e.addEventListener && e.addEventListener(d, a)), f.add && (f.add.call(e, c), c.handler.guid || (c.handler.guid = n.guid)), i ? p.splice(p.delegateCount++, 0, c) : p.push(c), w.event.global[d] = !0);
        }
      }
    },
    remove: function remove(e, t, n, r, i) {
      var o,
          a,
          s,
          u,
          l,
          c,
          f,
          p,
          d,
          h,
          g,
          y = J.hasData(e) && J.get(e);

      if (y && (u = y.events)) {
        l = (t = (t || "").match(M) || [""]).length;

        while (l--) {
          if (s = Ce.exec(t[l]) || [], d = g = s[1], h = (s[2] || "").split(".").sort(), d) {
            f = w.event.special[d] || {}, p = u[d = (r ? f.delegateType : f.bindType) || d] || [], s = s[2] && new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), a = o = p.length;

            while (o--) {
              c = p[o], !i && g !== c.origType || n && n.guid !== c.guid || s && !s.test(c.namespace) || r && r !== c.selector && ("**" !== r || !c.selector) || (p.splice(o, 1), c.selector && p.delegateCount--, f.remove && f.remove.call(e, c));
            }

            a && !p.length && (f.teardown && !1 !== f.teardown.call(e, h, y.handle) || w.removeEvent(e, d, y.handle), delete u[d]);
          } else for (d in u) {
            w.event.remove(e, d + t[l], n, r, !0);
          }
        }

        w.isEmptyObject(u) && J.remove(e, "handle events");
      }
    },
    dispatch: function dispatch(e) {
      var t = w.event.fix(e),
          n,
          r,
          i,
          o,
          a,
          s,
          u = new Array(arguments.length),
          l = (J.get(this, "events") || {})[t.type] || [],
          c = w.event.special[t.type] || {};

      for (u[0] = t, n = 1; n < arguments.length; n++) {
        u[n] = arguments[n];
      }

      if (t.delegateTarget = this, !c.preDispatch || !1 !== c.preDispatch.call(this, t)) {
        s = w.event.handlers.call(this, t, l), n = 0;

        while ((o = s[n++]) && !t.isPropagationStopped()) {
          t.currentTarget = o.elem, r = 0;

          while ((a = o.handlers[r++]) && !t.isImmediatePropagationStopped()) {
            t.rnamespace && !t.rnamespace.test(a.namespace) || (t.handleObj = a, t.data = a.data, void 0 !== (i = ((w.event.special[a.origType] || {}).handle || a.handler).apply(o.elem, u)) && !1 === (t.result = i) && (t.preventDefault(), t.stopPropagation()));
          }
        }

        return c.postDispatch && c.postDispatch.call(this, t), t.result;
      }
    },
    handlers: function handlers(e, t) {
      var n,
          r,
          i,
          o,
          a,
          s = [],
          u = t.delegateCount,
          l = e.target;
      if (u && l.nodeType && !("click" === e.type && e.button >= 1)) for (; l !== this; l = l.parentNode || this) {
        if (1 === l.nodeType && ("click" !== e.type || !0 !== l.disabled)) {
          for (o = [], a = {}, n = 0; n < u; n++) {
            void 0 === a[i = (r = t[n]).selector + " "] && (a[i] = r.needsContext ? w(i, this).index(l) > -1 : w.find(i, this, null, [l]).length), a[i] && o.push(r);
          }

          o.length && s.push({
            elem: l,
            handlers: o
          });
        }
      }
      return l = this, u < t.length && s.push({
        elem: l,
        handlers: t.slice(u)
      }), s;
    },
    addProp: function addProp(e, t) {
      Object.defineProperty(w.Event.prototype, e, {
        enumerable: !0,
        configurable: !0,
        get: g(t) ? function () {
          if (this.originalEvent) return t(this.originalEvent);
        } : function () {
          if (this.originalEvent) return this.originalEvent[e];
        },
        set: function set(t) {
          Object.defineProperty(this, e, {
            enumerable: !0,
            configurable: !0,
            writable: !0,
            value: t
          });
        }
      });
    },
    fix: function fix(e) {
      return e[w.expando] ? e : new w.Event(e);
    },
    special: {
      load: {
        noBubble: !0
      },
      focus: {
        trigger: function trigger() {
          if (this !== Se() && this.focus) return this.focus(), !1;
        },
        delegateType: "focusin"
      },
      blur: {
        trigger: function trigger() {
          if (this === Se() && this.blur) return this.blur(), !1;
        },
        delegateType: "focusout"
      },
      click: {
        trigger: function trigger() {
          if ("checkbox" === this.type && this.click && N(this, "input")) return this.click(), !1;
        },
        _default: function _default(e) {
          return N(e.target, "a");
        }
      },
      beforeunload: {
        postDispatch: function postDispatch(e) {
          void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result);
        }
      }
    }
  }, w.removeEvent = function (e, t, n) {
    e.removeEventListener && e.removeEventListener(t, n);
  }, w.Event = function (e, t) {
    if (!(this instanceof w.Event)) return new w.Event(e, t);
    e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && !1 === e.returnValue ? Ee : ke, this.target = e.target && 3 === e.target.nodeType ? e.target.parentNode : e.target, this.currentTarget = e.currentTarget, this.relatedTarget = e.relatedTarget) : this.type = e, t && w.extend(this, t), this.timeStamp = e && e.timeStamp || Date.now(), this[w.expando] = !0;
  }, w.Event.prototype = {
    constructor: w.Event,
    isDefaultPrevented: ke,
    isPropagationStopped: ke,
    isImmediatePropagationStopped: ke,
    isSimulated: !1,
    preventDefault: function preventDefault() {
      var e = this.originalEvent;
      this.isDefaultPrevented = Ee, e && !this.isSimulated && e.preventDefault();
    },
    stopPropagation: function stopPropagation() {
      var e = this.originalEvent;
      this.isPropagationStopped = Ee, e && !this.isSimulated && e.stopPropagation();
    },
    stopImmediatePropagation: function stopImmediatePropagation() {
      var e = this.originalEvent;
      this.isImmediatePropagationStopped = Ee, e && !this.isSimulated && e.stopImmediatePropagation(), this.stopPropagation();
    }
  }, w.each({
    altKey: !0,
    bubbles: !0,
    cancelable: !0,
    changedTouches: !0,
    ctrlKey: !0,
    detail: !0,
    eventPhase: !0,
    metaKey: !0,
    pageX: !0,
    pageY: !0,
    shiftKey: !0,
    view: !0,
    "char": !0,
    charCode: !0,
    key: !0,
    keyCode: !0,
    button: !0,
    buttons: !0,
    clientX: !0,
    clientY: !0,
    offsetX: !0,
    offsetY: !0,
    pointerId: !0,
    pointerType: !0,
    screenX: !0,
    screenY: !0,
    targetTouches: !0,
    toElement: !0,
    touches: !0,
    which: function which(e) {
      var t = e.button;
      return null == e.which && we.test(e.type) ? null != e.charCode ? e.charCode : e.keyCode : !e.which && void 0 !== t && Te.test(e.type) ? 1 & t ? 1 : 2 & t ? 3 : 4 & t ? 2 : 0 : e.which;
    }
  }, w.event.addProp), w.each({
    mouseenter: "mouseover",
    mouseleave: "mouseout",
    pointerenter: "pointerover",
    pointerleave: "pointerout"
  }, function (e, t) {
    w.event.special[e] = {
      delegateType: t,
      bindType: t,
      handle: function handle(e) {
        var n,
            r = this,
            i = e.relatedTarget,
            o = e.handleObj;
        return i && (i === r || w.contains(r, i)) || (e.type = o.origType, n = o.handler.apply(this, arguments), e.type = t), n;
      }
    };
  }), w.fn.extend({
    on: function on(e, t, n, r) {
      return De(this, e, t, n, r);
    },
    one: function one(e, t, n, r) {
      return De(this, e, t, n, r, 1);
    },
    off: function off(e, t, n) {
      var r, i;
      if (e && e.preventDefault && e.handleObj) return r = e.handleObj, w(e.delegateTarget).off(r.namespace ? r.origType + "." + r.namespace : r.origType, r.selector, r.handler), this;

      if ("object" == _typeof(e)) {
        for (i in e) {
          this.off(i, t, e[i]);
        }

        return this;
      }

      return !1 !== t && "function" != typeof t || (n = t, t = void 0), !1 === n && (n = ke), this.each(function () {
        w.event.remove(this, e, n, t);
      });
    }
  });
  var Ne = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,
      Ae = /<script|<style|<link/i,
      je = /checked\s*(?:[^=]|=\s*.checked.)/i,
      qe = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;

  function Le(e, t) {
    return N(e, "table") && N(11 !== t.nodeType ? t : t.firstChild, "tr") ? w(e).children("tbody")[0] || e : e;
  }

  function He(e) {
    return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e;
  }

  function Oe(e) {
    return "true/" === (e.type || "").slice(0, 5) ? e.type = e.type.slice(5) : e.removeAttribute("type"), e;
  }

  function Pe(e, t) {
    var n, r, i, o, a, s, u, l;

    if (1 === t.nodeType) {
      if (J.hasData(e) && (o = J.access(e), a = J.set(t, o), l = o.events)) {
        delete a.handle, a.events = {};

        for (i in l) {
          for (n = 0, r = l[i].length; n < r; n++) {
            w.event.add(t, i, l[i][n]);
          }
        }
      }

      K.hasData(e) && (s = K.access(e), u = w.extend({}, s), K.set(t, u));
    }
  }

  function Me(e, t) {
    var n = t.nodeName.toLowerCase();
    "input" === n && pe.test(e.type) ? t.checked = e.checked : "input" !== n && "textarea" !== n || (t.defaultValue = e.defaultValue);
  }

  function Re(e, t, n, r) {
    t = a.apply([], t);
    var i,
        o,
        s,
        u,
        l,
        c,
        f = 0,
        p = e.length,
        d = p - 1,
        y = t[0],
        v = g(y);
    if (v || p > 1 && "string" == typeof y && !h.checkClone && je.test(y)) return e.each(function (i) {
      var o = e.eq(i);
      v && (t[0] = y.call(this, i, o.html())), Re(o, t, n, r);
    });

    if (p && (i = xe(t, e[0].ownerDocument, !1, e, r), o = i.firstChild, 1 === i.childNodes.length && (i = o), o || r)) {
      for (u = (s = w.map(ye(i, "script"), He)).length; f < p; f++) {
        l = i, f !== d && (l = w.clone(l, !0, !0), u && w.merge(s, ye(l, "script"))), n.call(e[f], l, f);
      }

      if (u) for (c = s[s.length - 1].ownerDocument, w.map(s, Oe), f = 0; f < u; f++) {
        l = s[f], he.test(l.type || "") && !J.access(l, "globalEval") && w.contains(c, l) && (l.src && "module" !== (l.type || "").toLowerCase() ? w._evalUrl && w._evalUrl(l.src) : m(l.textContent.replace(qe, ""), c, l));
      }
    }

    return e;
  }

  function Ie(e, t, n) {
    for (var r, i = t ? w.filter(t, e) : e, o = 0; null != (r = i[o]); o++) {
      n || 1 !== r.nodeType || w.cleanData(ye(r)), r.parentNode && (n && w.contains(r.ownerDocument, r) && ve(ye(r, "script")), r.parentNode.removeChild(r));
    }

    return e;
  }

  w.extend({
    htmlPrefilter: function htmlPrefilter(e) {
      return e.replace(Ne, "<$1></$2>");
    },
    clone: function clone(e, t, n) {
      var r,
          i,
          o,
          a,
          s = e.cloneNode(!0),
          u = w.contains(e.ownerDocument, e);
      if (!(h.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || w.isXMLDoc(e))) for (a = ye(s), r = 0, i = (o = ye(e)).length; r < i; r++) {
        Me(o[r], a[r]);
      }
      if (t) if (n) for (o = o || ye(e), a = a || ye(s), r = 0, i = o.length; r < i; r++) {
        Pe(o[r], a[r]);
      } else Pe(e, s);
      return (a = ye(s, "script")).length > 0 && ve(a, !u && ye(e, "script")), s;
    },
    cleanData: function cleanData(e) {
      for (var t, n, r, i = w.event.special, o = 0; void 0 !== (n = e[o]); o++) {
        if (Y(n)) {
          if (t = n[J.expando]) {
            if (t.events) for (r in t.events) {
              i[r] ? w.event.remove(n, r) : w.removeEvent(n, r, t.handle);
            }
            n[J.expando] = void 0;
          }

          n[K.expando] && (n[K.expando] = void 0);
        }
      }
    }
  }), w.fn.extend({
    detach: function detach(e) {
      return Ie(this, e, !0);
    },
    remove: function remove(e) {
      return Ie(this, e);
    },
    text: function text(e) {
      return z(this, function (e) {
        return void 0 === e ? w.text(this) : this.empty().each(function () {
          1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = e);
        });
      }, null, e, arguments.length);
    },
    append: function append() {
      return Re(this, arguments, function (e) {
        1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || Le(this, e).appendChild(e);
      });
    },
    prepend: function prepend() {
      return Re(this, arguments, function (e) {
        if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
          var t = Le(this, e);
          t.insertBefore(e, t.firstChild);
        }
      });
    },
    before: function before() {
      return Re(this, arguments, function (e) {
        this.parentNode && this.parentNode.insertBefore(e, this);
      });
    },
    after: function after() {
      return Re(this, arguments, function (e) {
        this.parentNode && this.parentNode.insertBefore(e, this.nextSibling);
      });
    },
    empty: function empty() {
      for (var e, t = 0; null != (e = this[t]); t++) {
        1 === e.nodeType && (w.cleanData(ye(e, !1)), e.textContent = "");
      }

      return this;
    },
    clone: function clone(e, t) {
      return e = null != e && e, t = null == t ? e : t, this.map(function () {
        return w.clone(this, e, t);
      });
    },
    html: function html(e) {
      return z(this, function (e) {
        var t = this[0] || {},
            n = 0,
            r = this.length;
        if (void 0 === e && 1 === t.nodeType) return t.innerHTML;

        if ("string" == typeof e && !Ae.test(e) && !ge[(de.exec(e) || ["", ""])[1].toLowerCase()]) {
          e = w.htmlPrefilter(e);

          try {
            for (; n < r; n++) {
              1 === (t = this[n] || {}).nodeType && (w.cleanData(ye(t, !1)), t.innerHTML = e);
            }

            t = 0;
          } catch (e) {}
        }

        t && this.empty().append(e);
      }, null, e, arguments.length);
    },
    replaceWith: function replaceWith() {
      var e = [];
      return Re(this, arguments, function (t) {
        var n = this.parentNode;
        w.inArray(this, e) < 0 && (w.cleanData(ye(this)), n && n.replaceChild(t, this));
      }, e);
    }
  }), w.each({
    appendTo: "append",
    prependTo: "prepend",
    insertBefore: "before",
    insertAfter: "after",
    replaceAll: "replaceWith"
  }, function (e, t) {
    w.fn[e] = function (e) {
      for (var n, r = [], i = w(e), o = i.length - 1, a = 0; a <= o; a++) {
        n = a === o ? this : this.clone(!0), w(i[a])[t](n), s.apply(r, n.get());
      }

      return this.pushStack(r);
    };
  });

  var We = new RegExp("^(" + re + ")(?!px)[a-z%]+$", "i"),
      $e = function $e(t) {
    var n = t.ownerDocument.defaultView;
    return n && n.opener || (n = e), n.getComputedStyle(t);
  },
      Be = new RegExp(oe.join("|"), "i");

  !function () {
    function t() {
      if (c) {
        l.style.cssText = "position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0", c.style.cssText = "position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%", be.appendChild(l).appendChild(c);
        var t = e.getComputedStyle(c);
        i = "1%" !== t.top, u = 12 === n(t.marginLeft), c.style.right = "60%", s = 36 === n(t.right), o = 36 === n(t.width), c.style.position = "absolute", a = 36 === c.offsetWidth || "absolute", be.removeChild(l), c = null;
      }
    }

    function n(e) {
      return Math.round(parseFloat(e));
    }

    var i,
        o,
        a,
        s,
        u,
        l = r.createElement("div"),
        c = r.createElement("div");
    c.style && (c.style.backgroundClip = "content-box", c.cloneNode(!0).style.backgroundClip = "", h.clearCloneStyle = "content-box" === c.style.backgroundClip, w.extend(h, {
      boxSizingReliable: function boxSizingReliable() {
        return t(), o;
      },
      pixelBoxStyles: function pixelBoxStyles() {
        return t(), s;
      },
      pixelPosition: function pixelPosition() {
        return t(), i;
      },
      reliableMarginLeft: function reliableMarginLeft() {
        return t(), u;
      },
      scrollboxSize: function scrollboxSize() {
        return t(), a;
      }
    }));
  }();

  function Fe(e, t, n) {
    var r,
        i,
        o,
        a,
        s = e.style;
    return (n = n || $e(e)) && ("" !== (a = n.getPropertyValue(t) || n[t]) || w.contains(e.ownerDocument, e) || (a = w.style(e, t)), !h.pixelBoxStyles() && We.test(a) && Be.test(t) && (r = s.width, i = s.minWidth, o = s.maxWidth, s.minWidth = s.maxWidth = s.width = a, a = n.width, s.width = r, s.minWidth = i, s.maxWidth = o)), void 0 !== a ? a + "" : a;
  }

  function _e(e, t) {
    return {
      get: function get() {
        if (!e()) return (this.get = t).apply(this, arguments);
        delete this.get;
      }
    };
  }

  var ze = /^(none|table(?!-c[ea]).+)/,
      Xe = /^--/,
      Ue = {
    position: "absolute",
    visibility: "hidden",
    display: "block"
  },
      Ve = {
    letterSpacing: "0",
    fontWeight: "400"
  },
      Ge = ["Webkit", "Moz", "ms"],
      Ye = r.createElement("div").style;

  function Qe(e) {
    if (e in Ye) return e;
    var t = e[0].toUpperCase() + e.slice(1),
        n = Ge.length;

    while (n--) {
      if ((e = Ge[n] + t) in Ye) return e;
    }
  }

  function Je(e) {
    var t = w.cssProps[e];
    return t || (t = w.cssProps[e] = Qe(e) || e), t;
  }

  function Ke(e, t, n) {
    var r = ie.exec(t);
    return r ? Math.max(0, r[2] - (n || 0)) + (r[3] || "px") : t;
  }

  function Ze(e, t, n, r, i, o) {
    var a = "width" === t ? 1 : 0,
        s = 0,
        u = 0;
    if (n === (r ? "border" : "content")) return 0;

    for (; a < 4; a += 2) {
      "margin" === n && (u += w.css(e, n + oe[a], !0, i)), r ? ("content" === n && (u -= w.css(e, "padding" + oe[a], !0, i)), "margin" !== n && (u -= w.css(e, "border" + oe[a] + "Width", !0, i))) : (u += w.css(e, "padding" + oe[a], !0, i), "padding" !== n ? u += w.css(e, "border" + oe[a] + "Width", !0, i) : s += w.css(e, "border" + oe[a] + "Width", !0, i));
    }

    return !r && o >= 0 && (u += Math.max(0, Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - o - u - s - .5))), u;
  }

  function et(e, t, n) {
    var r = $e(e),
        i = Fe(e, t, r),
        o = "border-box" === w.css(e, "boxSizing", !1, r),
        a = o;

    if (We.test(i)) {
      if (!n) return i;
      i = "auto";
    }

    return a = a && (h.boxSizingReliable() || i === e.style[t]), ("auto" === i || !parseFloat(i) && "inline" === w.css(e, "display", !1, r)) && (i = e["offset" + t[0].toUpperCase() + t.slice(1)], a = !0), (i = parseFloat(i) || 0) + Ze(e, t, n || (o ? "border" : "content"), a, r, i) + "px";
  }

  w.extend({
    cssHooks: {
      opacity: {
        get: function get(e, t) {
          if (t) {
            var n = Fe(e, "opacity");
            return "" === n ? "1" : n;
          }
        }
      }
    },
    cssNumber: {
      animationIterationCount: !0,
      columnCount: !0,
      fillOpacity: !0,
      flexGrow: !0,
      flexShrink: !0,
      fontWeight: !0,
      lineHeight: !0,
      opacity: !0,
      order: !0,
      orphans: !0,
      widows: !0,
      zIndex: !0,
      zoom: !0
    },
    cssProps: {},
    style: function style(e, t, n, r) {
      if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
        var i,
            o,
            a,
            s = G(t),
            u = Xe.test(t),
            l = e.style;
        if (u || (t = Je(s)), a = w.cssHooks[t] || w.cssHooks[s], void 0 === n) return a && "get" in a && void 0 !== (i = a.get(e, !1, r)) ? i : l[t];
        "string" == (o = _typeof(n)) && (i = ie.exec(n)) && i[1] && (n = ue(e, t, i), o = "number"), null != n && n === n && ("number" === o && (n += i && i[3] || (w.cssNumber[s] ? "" : "px")), h.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (l[t] = "inherit"), a && "set" in a && void 0 === (n = a.set(e, n, r)) || (u ? l.setProperty(t, n) : l[t] = n));
      }
    },
    css: function css(e, t, n, r) {
      var i,
          o,
          a,
          s = G(t);
      return Xe.test(t) || (t = Je(s)), (a = w.cssHooks[t] || w.cssHooks[s]) && "get" in a && (i = a.get(e, !0, n)), void 0 === i && (i = Fe(e, t, r)), "normal" === i && t in Ve && (i = Ve[t]), "" === n || n ? (o = parseFloat(i), !0 === n || isFinite(o) ? o || 0 : i) : i;
    }
  }), w.each(["height", "width"], function (e, t) {
    w.cssHooks[t] = {
      get: function get(e, n, r) {
        if (n) return !ze.test(w.css(e, "display")) || e.getClientRects().length && e.getBoundingClientRect().width ? et(e, t, r) : se(e, Ue, function () {
          return et(e, t, r);
        });
      },
      set: function set(e, n, r) {
        var i,
            o = $e(e),
            a = "border-box" === w.css(e, "boxSizing", !1, o),
            s = r && Ze(e, t, r, a, o);
        return a && h.scrollboxSize() === o.position && (s -= Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - parseFloat(o[t]) - Ze(e, t, "border", !1, o) - .5)), s && (i = ie.exec(n)) && "px" !== (i[3] || "px") && (e.style[t] = n, n = w.css(e, t)), Ke(e, n, s);
      }
    };
  }), w.cssHooks.marginLeft = _e(h.reliableMarginLeft, function (e, t) {
    if (t) return (parseFloat(Fe(e, "marginLeft")) || e.getBoundingClientRect().left - se(e, {
      marginLeft: 0
    }, function () {
      return e.getBoundingClientRect().left;
    })) + "px";
  }), w.each({
    margin: "",
    padding: "",
    border: "Width"
  }, function (e, t) {
    w.cssHooks[e + t] = {
      expand: function expand(n) {
        for (var r = 0, i = {}, o = "string" == typeof n ? n.split(" ") : [n]; r < 4; r++) {
          i[e + oe[r] + t] = o[r] || o[r - 2] || o[0];
        }

        return i;
      }
    }, "margin" !== e && (w.cssHooks[e + t].set = Ke);
  }), w.fn.extend({
    css: function css(e, t) {
      return z(this, function (e, t, n) {
        var r,
            i,
            o = {},
            a = 0;

        if (Array.isArray(t)) {
          for (r = $e(e), i = t.length; a < i; a++) {
            o[t[a]] = w.css(e, t[a], !1, r);
          }

          return o;
        }

        return void 0 !== n ? w.style(e, t, n) : w.css(e, t);
      }, e, t, arguments.length > 1);
    }
  });

  function tt(e, t, n, r, i) {
    return new tt.prototype.init(e, t, n, r, i);
  }

  w.Tween = tt, tt.prototype = {
    constructor: tt,
    init: function init(e, t, n, r, i, o) {
      this.elem = e, this.prop = n, this.easing = i || w.easing._default, this.options = t, this.start = this.now = this.cur(), this.end = r, this.unit = o || (w.cssNumber[n] ? "" : "px");
    },
    cur: function cur() {
      var e = tt.propHooks[this.prop];
      return e && e.get ? e.get(this) : tt.propHooks._default.get(this);
    },
    run: function run(e) {
      var t,
          n = tt.propHooks[this.prop];
      return this.options.duration ? this.pos = t = w.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : tt.propHooks._default.set(this), this;
    }
  }, tt.prototype.init.prototype = tt.prototype, tt.propHooks = {
    _default: {
      get: function get(e) {
        var t;
        return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = w.css(e.elem, e.prop, "")) && "auto" !== t ? t : 0;
      },
      set: function set(e) {
        w.fx.step[e.prop] ? w.fx.step[e.prop](e) : 1 !== e.elem.nodeType || null == e.elem.style[w.cssProps[e.prop]] && !w.cssHooks[e.prop] ? e.elem[e.prop] = e.now : w.style(e.elem, e.prop, e.now + e.unit);
      }
    }
  }, tt.propHooks.scrollTop = tt.propHooks.scrollLeft = {
    set: function set(e) {
      e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now);
    }
  }, w.easing = {
    linear: function linear(e) {
      return e;
    },
    swing: function swing(e) {
      return .5 - Math.cos(e * Math.PI) / 2;
    },
    _default: "swing"
  }, w.fx = tt.prototype.init, w.fx.step = {};
  var nt,
      rt,
      it = /^(?:toggle|show|hide)$/,
      ot = /queueHooks$/;

  function at() {
    rt && (!1 === r.hidden && e.requestAnimationFrame ? e.requestAnimationFrame(at) : e.setTimeout(at, w.fx.interval), w.fx.tick());
  }

  function st() {
    return e.setTimeout(function () {
      nt = void 0;
    }), nt = Date.now();
  }

  function ut(e, t) {
    var n,
        r = 0,
        i = {
      height: e
    };

    for (t = t ? 1 : 0; r < 4; r += 2 - t) {
      i["margin" + (n = oe[r])] = i["padding" + n] = e;
    }

    return t && (i.opacity = i.width = e), i;
  }

  function lt(e, t, n) {
    for (var r, i = (pt.tweeners[t] || []).concat(pt.tweeners["*"]), o = 0, a = i.length; o < a; o++) {
      if (r = i[o].call(n, t, e)) return r;
    }
  }

  function ct(e, t, n) {
    var r,
        i,
        o,
        a,
        s,
        u,
        l,
        c,
        f = "width" in t || "height" in t,
        p = this,
        d = {},
        h = e.style,
        g = e.nodeType && ae(e),
        y = J.get(e, "fxshow");
    n.queue || (null == (a = w._queueHooks(e, "fx")).unqueued && (a.unqueued = 0, s = a.empty.fire, a.empty.fire = function () {
      a.unqueued || s();
    }), a.unqueued++, p.always(function () {
      p.always(function () {
        a.unqueued--, w.queue(e, "fx").length || a.empty.fire();
      });
    }));

    for (r in t) {
      if (i = t[r], it.test(i)) {
        if (delete t[r], o = o || "toggle" === i, i === (g ? "hide" : "show")) {
          if ("show" !== i || !y || void 0 === y[r]) continue;
          g = !0;
        }

        d[r] = y && y[r] || w.style(e, r);
      }
    }

    if ((u = !w.isEmptyObject(t)) || !w.isEmptyObject(d)) {
      f && 1 === e.nodeType && (n.overflow = [h.overflow, h.overflowX, h.overflowY], null == (l = y && y.display) && (l = J.get(e, "display")), "none" === (c = w.css(e, "display")) && (l ? c = l : (fe([e], !0), l = e.style.display || l, c = w.css(e, "display"), fe([e]))), ("inline" === c || "inline-block" === c && null != l) && "none" === w.css(e, "float") && (u || (p.done(function () {
        h.display = l;
      }), null == l && (c = h.display, l = "none" === c ? "" : c)), h.display = "inline-block")), n.overflow && (h.overflow = "hidden", p.always(function () {
        h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2];
      })), u = !1;

      for (r in d) {
        u || (y ? "hidden" in y && (g = y.hidden) : y = J.access(e, "fxshow", {
          display: l
        }), o && (y.hidden = !g), g && fe([e], !0), p.done(function () {
          g || fe([e]), J.remove(e, "fxshow");

          for (r in d) {
            w.style(e, r, d[r]);
          }
        })), u = lt(g ? y[r] : 0, r, p), r in y || (y[r] = u.start, g && (u.end = u.start, u.start = 0));
      }
    }
  }

  function ft(e, t) {
    var n, r, i, o, a;

    for (n in e) {
      if (r = G(n), i = t[r], o = e[n], Array.isArray(o) && (i = o[1], o = e[n] = o[0]), n !== r && (e[r] = o, delete e[n]), (a = w.cssHooks[r]) && "expand" in a) {
        o = a.expand(o), delete e[r];

        for (n in o) {
          n in e || (e[n] = o[n], t[n] = i);
        }
      } else t[r] = i;
    }
  }

  function pt(e, t, n) {
    var r,
        i,
        o = 0,
        a = pt.prefilters.length,
        s = w.Deferred().always(function () {
      delete u.elem;
    }),
        u = function u() {
      if (i) return !1;

      for (var t = nt || st(), n = Math.max(0, l.startTime + l.duration - t), r = 1 - (n / l.duration || 0), o = 0, a = l.tweens.length; o < a; o++) {
        l.tweens[o].run(r);
      }

      return s.notifyWith(e, [l, r, n]), r < 1 && a ? n : (a || s.notifyWith(e, [l, 1, 0]), s.resolveWith(e, [l]), !1);
    },
        l = s.promise({
      elem: e,
      props: w.extend({}, t),
      opts: w.extend(!0, {
        specialEasing: {},
        easing: w.easing._default
      }, n),
      originalProperties: t,
      originalOptions: n,
      startTime: nt || st(),
      duration: n.duration,
      tweens: [],
      createTween: function createTween(t, n) {
        var r = w.Tween(e, l.opts, t, n, l.opts.specialEasing[t] || l.opts.easing);
        return l.tweens.push(r), r;
      },
      stop: function stop(t) {
        var n = 0,
            r = t ? l.tweens.length : 0;
        if (i) return this;

        for (i = !0; n < r; n++) {
          l.tweens[n].run(1);
        }

        return t ? (s.notifyWith(e, [l, 1, 0]), s.resolveWith(e, [l, t])) : s.rejectWith(e, [l, t]), this;
      }
    }),
        c = l.props;

    for (ft(c, l.opts.specialEasing); o < a; o++) {
      if (r = pt.prefilters[o].call(l, e, c, l.opts)) return g(r.stop) && (w._queueHooks(l.elem, l.opts.queue).stop = r.stop.bind(r)), r;
    }

    return w.map(c, lt, l), g(l.opts.start) && l.opts.start.call(e, l), l.progress(l.opts.progress).done(l.opts.done, l.opts.complete).fail(l.opts.fail).always(l.opts.always), w.fx.timer(w.extend(u, {
      elem: e,
      anim: l,
      queue: l.opts.queue
    })), l;
  }

  w.Animation = w.extend(pt, {
    tweeners: {
      "*": [function (e, t) {
        var n = this.createTween(e, t);
        return ue(n.elem, e, ie.exec(t), n), n;
      }]
    },
    tweener: function tweener(e, t) {
      g(e) ? (t = e, e = ["*"]) : e = e.match(M);

      for (var n, r = 0, i = e.length; r < i; r++) {
        n = e[r], pt.tweeners[n] = pt.tweeners[n] || [], pt.tweeners[n].unshift(t);
      }
    },
    prefilters: [ct],
    prefilter: function prefilter(e, t) {
      t ? pt.prefilters.unshift(e) : pt.prefilters.push(e);
    }
  }), w.speed = function (e, t, n) {
    var r = e && "object" == _typeof(e) ? w.extend({}, e) : {
      complete: n || !n && t || g(e) && e,
      duration: e,
      easing: n && t || t && !g(t) && t
    };
    return w.fx.off ? r.duration = 0 : "number" != typeof r.duration && (r.duration in w.fx.speeds ? r.duration = w.fx.speeds[r.duration] : r.duration = w.fx.speeds._default), null != r.queue && !0 !== r.queue || (r.queue = "fx"), r.old = r.complete, r.complete = function () {
      g(r.old) && r.old.call(this), r.queue && w.dequeue(this, r.queue);
    }, r;
  }, w.fn.extend({
    fadeTo: function fadeTo(e, t, n, r) {
      return this.filter(ae).css("opacity", 0).show().end().animate({
        opacity: t
      }, e, n, r);
    },
    animate: function animate(e, t, n, r) {
      var i = w.isEmptyObject(e),
          o = w.speed(t, n, r),
          a = function a() {
        var t = pt(this, w.extend({}, e), o);
        (i || J.get(this, "finish")) && t.stop(!0);
      };

      return a.finish = a, i || !1 === o.queue ? this.each(a) : this.queue(o.queue, a);
    },
    stop: function stop(e, t, n) {
      var r = function r(e) {
        var t = e.stop;
        delete e.stop, t(n);
      };

      return "string" != typeof e && (n = t, t = e, e = void 0), t && !1 !== e && this.queue(e || "fx", []), this.each(function () {
        var t = !0,
            i = null != e && e + "queueHooks",
            o = w.timers,
            a = J.get(this);
        if (i) a[i] && a[i].stop && r(a[i]);else for (i in a) {
          a[i] && a[i].stop && ot.test(i) && r(a[i]);
        }

        for (i = o.length; i--;) {
          o[i].elem !== this || null != e && o[i].queue !== e || (o[i].anim.stop(n), t = !1, o.splice(i, 1));
        }

        !t && n || w.dequeue(this, e);
      });
    },
    finish: function finish(e) {
      return !1 !== e && (e = e || "fx"), this.each(function () {
        var t,
            n = J.get(this),
            r = n[e + "queue"],
            i = n[e + "queueHooks"],
            o = w.timers,
            a = r ? r.length : 0;

        for (n.finish = !0, w.queue(this, e, []), i && i.stop && i.stop.call(this, !0), t = o.length; t--;) {
          o[t].elem === this && o[t].queue === e && (o[t].anim.stop(!0), o.splice(t, 1));
        }

        for (t = 0; t < a; t++) {
          r[t] && r[t].finish && r[t].finish.call(this);
        }

        delete n.finish;
      });
    }
  }), w.each(["toggle", "show", "hide"], function (e, t) {
    var n = w.fn[t];

    w.fn[t] = function (e, r, i) {
      return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(ut(t, !0), e, r, i);
    };
  }), w.each({
    slideDown: ut("show"),
    slideUp: ut("hide"),
    slideToggle: ut("toggle"),
    fadeIn: {
      opacity: "show"
    },
    fadeOut: {
      opacity: "hide"
    },
    fadeToggle: {
      opacity: "toggle"
    }
  }, function (e, t) {
    w.fn[e] = function (e, n, r) {
      return this.animate(t, e, n, r);
    };
  }), w.timers = [], w.fx.tick = function () {
    var e,
        t = 0,
        n = w.timers;

    for (nt = Date.now(); t < n.length; t++) {
      (e = n[t])() || n[t] !== e || n.splice(t--, 1);
    }

    n.length || w.fx.stop(), nt = void 0;
  }, w.fx.timer = function (e) {
    w.timers.push(e), w.fx.start();
  }, w.fx.interval = 13, w.fx.start = function () {
    rt || (rt = !0, at());
  }, w.fx.stop = function () {
    rt = null;
  }, w.fx.speeds = {
    slow: 600,
    fast: 200,
    _default: 400
  }, w.fn.delay = function (t, n) {
    return t = w.fx ? w.fx.speeds[t] || t : t, n = n || "fx", this.queue(n, function (n, r) {
      var i = e.setTimeout(n, t);

      r.stop = function () {
        e.clearTimeout(i);
      };
    });
  }, function () {
    var e = r.createElement("input"),
        t = r.createElement("select").appendChild(r.createElement("option"));
    e.type = "checkbox", h.checkOn = "" !== e.value, h.optSelected = t.selected, (e = r.createElement("input")).value = "t", e.type = "radio", h.radioValue = "t" === e.value;
  }();
  var dt,
      ht = w.expr.attrHandle;
  w.fn.extend({
    attr: function attr(e, t) {
      return z(this, w.attr, e, t, arguments.length > 1);
    },
    removeAttr: function removeAttr(e) {
      return this.each(function () {
        w.removeAttr(this, e);
      });
    }
  }), w.extend({
    attr: function attr(e, t, n) {
      var r,
          i,
          o = e.nodeType;
      if (3 !== o && 8 !== o && 2 !== o) return "undefined" == typeof e.getAttribute ? w.prop(e, t, n) : (1 === o && w.isXMLDoc(e) || (i = w.attrHooks[t.toLowerCase()] || (w.expr.match.bool.test(t) ? dt : void 0)), void 0 !== n ? null === n ? void w.removeAttr(e, t) : i && "set" in i && void 0 !== (r = i.set(e, n, t)) ? r : (e.setAttribute(t, n + ""), n) : i && "get" in i && null !== (r = i.get(e, t)) ? r : null == (r = w.find.attr(e, t)) ? void 0 : r);
    },
    attrHooks: {
      type: {
        set: function set(e, t) {
          if (!h.radioValue && "radio" === t && N(e, "input")) {
            var n = e.value;
            return e.setAttribute("type", t), n && (e.value = n), t;
          }
        }
      }
    },
    removeAttr: function removeAttr(e, t) {
      var n,
          r = 0,
          i = t && t.match(M);
      if (i && 1 === e.nodeType) while (n = i[r++]) {
        e.removeAttribute(n);
      }
    }
  }), dt = {
    set: function set(e, t, n) {
      return !1 === t ? w.removeAttr(e, n) : e.setAttribute(n, n), n;
    }
  }, w.each(w.expr.match.bool.source.match(/\w+/g), function (e, t) {
    var n = ht[t] || w.find.attr;

    ht[t] = function (e, t, r) {
      var i,
          o,
          a = t.toLowerCase();
      return r || (o = ht[a], ht[a] = i, i = null != n(e, t, r) ? a : null, ht[a] = o), i;
    };
  });
  var gt = /^(?:input|select|textarea|button)$/i,
      yt = /^(?:a|area)$/i;
  w.fn.extend({
    prop: function prop(e, t) {
      return z(this, w.prop, e, t, arguments.length > 1);
    },
    removeProp: function removeProp(e) {
      return this.each(function () {
        delete this[w.propFix[e] || e];
      });
    }
  }), w.extend({
    prop: function prop(e, t, n) {
      var r,
          i,
          o = e.nodeType;
      if (3 !== o && 8 !== o && 2 !== o) return 1 === o && w.isXMLDoc(e) || (t = w.propFix[t] || t, i = w.propHooks[t]), void 0 !== n ? i && "set" in i && void 0 !== (r = i.set(e, n, t)) ? r : e[t] = n : i && "get" in i && null !== (r = i.get(e, t)) ? r : e[t];
    },
    propHooks: {
      tabIndex: {
        get: function get(e) {
          var t = w.find.attr(e, "tabindex");
          return t ? parseInt(t, 10) : gt.test(e.nodeName) || yt.test(e.nodeName) && e.href ? 0 : -1;
        }
      }
    },
    propFix: {
      "for": "htmlFor",
      "class": "className"
    }
  }), h.optSelected || (w.propHooks.selected = {
    get: function get(e) {
      var t = e.parentNode;
      return t && t.parentNode && t.parentNode.selectedIndex, null;
    },
    set: function set(e) {
      var t = e.parentNode;
      t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex);
    }
  }), w.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
    w.propFix[this.toLowerCase()] = this;
  });

  function vt(e) {
    return (e.match(M) || []).join(" ");
  }

  function mt(e) {
    return e.getAttribute && e.getAttribute("class") || "";
  }

  function xt(e) {
    return Array.isArray(e) ? e : "string" == typeof e ? e.match(M) || [] : [];
  }

  w.fn.extend({
    addClass: function addClass(e) {
      var t,
          n,
          r,
          i,
          o,
          a,
          s,
          u = 0;
      if (g(e)) return this.each(function (t) {
        w(this).addClass(e.call(this, t, mt(this)));
      });
      if ((t = xt(e)).length) while (n = this[u++]) {
        if (i = mt(n), r = 1 === n.nodeType && " " + vt(i) + " ") {
          a = 0;

          while (o = t[a++]) {
            r.indexOf(" " + o + " ") < 0 && (r += o + " ");
          }

          i !== (s = vt(r)) && n.setAttribute("class", s);
        }
      }
      return this;
    },
    removeClass: function removeClass(e) {
      var t,
          n,
          r,
          i,
          o,
          a,
          s,
          u = 0;
      if (g(e)) return this.each(function (t) {
        w(this).removeClass(e.call(this, t, mt(this)));
      });
      if (!arguments.length) return this.attr("class", "");
      if ((t = xt(e)).length) while (n = this[u++]) {
        if (i = mt(n), r = 1 === n.nodeType && " " + vt(i) + " ") {
          a = 0;

          while (o = t[a++]) {
            while (r.indexOf(" " + o + " ") > -1) {
              r = r.replace(" " + o + " ", " ");
            }
          }

          i !== (s = vt(r)) && n.setAttribute("class", s);
        }
      }
      return this;
    },
    toggleClass: function toggleClass(e, t) {
      var n = _typeof(e),
          r = "string" === n || Array.isArray(e);

      return "boolean" == typeof t && r ? t ? this.addClass(e) : this.removeClass(e) : g(e) ? this.each(function (n) {
        w(this).toggleClass(e.call(this, n, mt(this), t), t);
      }) : this.each(function () {
        var t, i, o, a;

        if (r) {
          i = 0, o = w(this), a = xt(e);

          while (t = a[i++]) {
            o.hasClass(t) ? o.removeClass(t) : o.addClass(t);
          }
        } else void 0 !== e && "boolean" !== n || ((t = mt(this)) && J.set(this, "__className__", t), this.setAttribute && this.setAttribute("class", t || !1 === e ? "" : J.get(this, "__className__") || ""));
      });
    },
    hasClass: function hasClass(e) {
      var t,
          n,
          r = 0;
      t = " " + e + " ";

      while (n = this[r++]) {
        if (1 === n.nodeType && (" " + vt(mt(n)) + " ").indexOf(t) > -1) return !0;
      }

      return !1;
    }
  });
  var bt = /\r/g;
  w.fn.extend({
    val: function val(e) {
      var t,
          n,
          r,
          i = this[0];
      {
        if (arguments.length) return r = g(e), this.each(function (n) {
          var i;
          1 === this.nodeType && (null == (i = r ? e.call(this, n, w(this).val()) : e) ? i = "" : "number" == typeof i ? i += "" : Array.isArray(i) && (i = w.map(i, function (e) {
            return null == e ? "" : e + "";
          })), (t = w.valHooks[this.type] || w.valHooks[this.nodeName.toLowerCase()]) && "set" in t && void 0 !== t.set(this, i, "value") || (this.value = i));
        });
        if (i) return (t = w.valHooks[i.type] || w.valHooks[i.nodeName.toLowerCase()]) && "get" in t && void 0 !== (n = t.get(i, "value")) ? n : "string" == typeof (n = i.value) ? n.replace(bt, "") : null == n ? "" : n;
      }
    }
  }), w.extend({
    valHooks: {
      option: {
        get: function get(e) {
          var t = w.find.attr(e, "value");
          return null != t ? t : vt(w.text(e));
        }
      },
      select: {
        get: function get(e) {
          var t,
              n,
              r,
              i = e.options,
              o = e.selectedIndex,
              a = "select-one" === e.type,
              s = a ? null : [],
              u = a ? o + 1 : i.length;

          for (r = o < 0 ? u : a ? o : 0; r < u; r++) {
            if (((n = i[r]).selected || r === o) && !n.disabled && (!n.parentNode.disabled || !N(n.parentNode, "optgroup"))) {
              if (t = w(n).val(), a) return t;
              s.push(t);
            }
          }

          return s;
        },
        set: function set(e, t) {
          var n,
              r,
              i = e.options,
              o = w.makeArray(t),
              a = i.length;

          while (a--) {
            ((r = i[a]).selected = w.inArray(w.valHooks.option.get(r), o) > -1) && (n = !0);
          }

          return n || (e.selectedIndex = -1), o;
        }
      }
    }
  }), w.each(["radio", "checkbox"], function () {
    w.valHooks[this] = {
      set: function set(e, t) {
        if (Array.isArray(t)) return e.checked = w.inArray(w(e).val(), t) > -1;
      }
    }, h.checkOn || (w.valHooks[this].get = function (e) {
      return null === e.getAttribute("value") ? "on" : e.value;
    });
  }), h.focusin = "onfocusin" in e;

  var wt = /^(?:focusinfocus|focusoutblur)$/,
      Tt = function Tt(e) {
    e.stopPropagation();
  };

  w.extend(w.event, {
    trigger: function trigger(t, n, i, o) {
      var a,
          s,
          u,
          l,
          c,
          p,
          d,
          h,
          v = [i || r],
          m = f.call(t, "type") ? t.type : t,
          x = f.call(t, "namespace") ? t.namespace.split(".") : [];

      if (s = h = u = i = i || r, 3 !== i.nodeType && 8 !== i.nodeType && !wt.test(m + w.event.triggered) && (m.indexOf(".") > -1 && (m = (x = m.split(".")).shift(), x.sort()), c = m.indexOf(":") < 0 && "on" + m, t = t[w.expando] ? t : new w.Event(m, "object" == _typeof(t) && t), t.isTrigger = o ? 2 : 3, t.namespace = x.join("."), t.rnamespace = t.namespace ? new RegExp("(^|\\.)" + x.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, t.result = void 0, t.target || (t.target = i), n = null == n ? [t] : w.makeArray(n, [t]), d = w.event.special[m] || {}, o || !d.trigger || !1 !== d.trigger.apply(i, n))) {
        if (!o && !d.noBubble && !y(i)) {
          for (l = d.delegateType || m, wt.test(l + m) || (s = s.parentNode); s; s = s.parentNode) {
            v.push(s), u = s;
          }

          u === (i.ownerDocument || r) && v.push(u.defaultView || u.parentWindow || e);
        }

        a = 0;

        while ((s = v[a++]) && !t.isPropagationStopped()) {
          h = s, t.type = a > 1 ? l : d.bindType || m, (p = (J.get(s, "events") || {})[t.type] && J.get(s, "handle")) && p.apply(s, n), (p = c && s[c]) && p.apply && Y(s) && (t.result = p.apply(s, n), !1 === t.result && t.preventDefault());
        }

        return t.type = m, o || t.isDefaultPrevented() || d._default && !1 !== d._default.apply(v.pop(), n) || !Y(i) || c && g(i[m]) && !y(i) && ((u = i[c]) && (i[c] = null), w.event.triggered = m, t.isPropagationStopped() && h.addEventListener(m, Tt), i[m](), t.isPropagationStopped() && h.removeEventListener(m, Tt), w.event.triggered = void 0, u && (i[c] = u)), t.result;
      }
    },
    simulate: function simulate(e, t, n) {
      var r = w.extend(new w.Event(), n, {
        type: e,
        isSimulated: !0
      });
      w.event.trigger(r, null, t);
    }
  }), w.fn.extend({
    trigger: function trigger(e, t) {
      return this.each(function () {
        w.event.trigger(e, t, this);
      });
    },
    triggerHandler: function triggerHandler(e, t) {
      var n = this[0];
      if (n) return w.event.trigger(e, t, n, !0);
    }
  }), h.focusin || w.each({
    focus: "focusin",
    blur: "focusout"
  }, function (e, t) {
    var n = function n(e) {
      w.event.simulate(t, e.target, w.event.fix(e));
    };

    w.event.special[t] = {
      setup: function setup() {
        var r = this.ownerDocument || this,
            i = J.access(r, t);
        i || r.addEventListener(e, n, !0), J.access(r, t, (i || 0) + 1);
      },
      teardown: function teardown() {
        var r = this.ownerDocument || this,
            i = J.access(r, t) - 1;
        i ? J.access(r, t, i) : (r.removeEventListener(e, n, !0), J.remove(r, t));
      }
    };
  });
  var Ct = e.location,
      Et = Date.now(),
      kt = /\?/;

  w.parseXML = function (t) {
    var n;
    if (!t || "string" != typeof t) return null;

    try {
      n = new e.DOMParser().parseFromString(t, "text/xml");
    } catch (e) {
      n = void 0;
    }

    return n && !n.getElementsByTagName("parsererror").length || w.error("Invalid XML: " + t), n;
  };

  var St = /\[\]$/,
      Dt = /\r?\n/g,
      Nt = /^(?:submit|button|image|reset|file)$/i,
      At = /^(?:input|select|textarea|keygen)/i;

  function jt(e, t, n, r) {
    var i;
    if (Array.isArray(t)) w.each(t, function (t, i) {
      n || St.test(e) ? r(e, i) : jt(e + "[" + ("object" == _typeof(i) && null != i ? t : "") + "]", i, n, r);
    });else if (n || "object" !== x(t)) r(e, t);else for (i in t) {
      jt(e + "[" + i + "]", t[i], n, r);
    }
  }

  w.param = function (e, t) {
    var n,
        r = [],
        i = function i(e, t) {
      var n = g(t) ? t() : t;
      r[r.length] = encodeURIComponent(e) + "=" + encodeURIComponent(null == n ? "" : n);
    };

    if (Array.isArray(e) || e.jquery && !w.isPlainObject(e)) w.each(e, function () {
      i(this.name, this.value);
    });else for (n in e) {
      jt(n, e[n], t, i);
    }
    return r.join("&");
  }, w.fn.extend({
    serialize: function serialize() {
      return w.param(this.serializeArray());
    },
    serializeArray: function serializeArray() {
      return this.map(function () {
        var e = w.prop(this, "elements");
        return e ? w.makeArray(e) : this;
      }).filter(function () {
        var e = this.type;
        return this.name && !w(this).is(":disabled") && At.test(this.nodeName) && !Nt.test(e) && (this.checked || !pe.test(e));
      }).map(function (e, t) {
        var n = w(this).val();
        return null == n ? null : Array.isArray(n) ? w.map(n, function (e) {
          return {
            name: t.name,
            value: e.replace(Dt, "\r\n")
          };
        }) : {
          name: t.name,
          value: n.replace(Dt, "\r\n")
        };
      }).get();
    }
  });
  var qt = /%20/g,
      Lt = /#.*$/,
      Ht = /([?&])_=[^&]*/,
      Ot = /^(.*?):[ \t]*([^\r\n]*)$/gm,
      Pt = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
      Mt = /^(?:GET|HEAD)$/,
      Rt = /^\/\//,
      It = {},
      Wt = {},
      $t = "*/".concat("*"),
      Bt = r.createElement("a");
  Bt.href = Ct.href;

  function Ft(e) {
    return function (t, n) {
      "string" != typeof t && (n = t, t = "*");
      var r,
          i = 0,
          o = t.toLowerCase().match(M) || [];
      if (g(n)) while (r = o[i++]) {
        "+" === r[0] ? (r = r.slice(1) || "*", (e[r] = e[r] || []).unshift(n)) : (e[r] = e[r] || []).push(n);
      }
    };
  }

  function _t(e, t, n, r) {
    var i = {},
        o = e === Wt;

    function a(s) {
      var u;
      return i[s] = !0, w.each(e[s] || [], function (e, s) {
        var l = s(t, n, r);
        return "string" != typeof l || o || i[l] ? o ? !(u = l) : void 0 : (t.dataTypes.unshift(l), a(l), !1);
      }), u;
    }

    return a(t.dataTypes[0]) || !i["*"] && a("*");
  }

  function zt(e, t) {
    var n,
        r,
        i = w.ajaxSettings.flatOptions || {};

    for (n in t) {
      void 0 !== t[n] && ((i[n] ? e : r || (r = {}))[n] = t[n]);
    }

    return r && w.extend(!0, e, r), e;
  }

  function Xt(e, t, n) {
    var r,
        i,
        o,
        a,
        s = e.contents,
        u = e.dataTypes;

    while ("*" === u[0]) {
      u.shift(), void 0 === r && (r = e.mimeType || t.getResponseHeader("Content-Type"));
    }

    if (r) for (i in s) {
      if (s[i] && s[i].test(r)) {
        u.unshift(i);
        break;
      }
    }
    if (u[0] in n) o = u[0];else {
      for (i in n) {
        if (!u[0] || e.converters[i + " " + u[0]]) {
          o = i;
          break;
        }

        a || (a = i);
      }

      o = o || a;
    }
    if (o) return o !== u[0] && u.unshift(o), n[o];
  }

  function Ut(e, t, n, r) {
    var i,
        o,
        a,
        s,
        u,
        l = {},
        c = e.dataTypes.slice();
    if (c[1]) for (a in e.converters) {
      l[a.toLowerCase()] = e.converters[a];
    }
    o = c.shift();

    while (o) {
      if (e.responseFields[o] && (n[e.responseFields[o]] = t), !u && r && e.dataFilter && (t = e.dataFilter(t, e.dataType)), u = o, o = c.shift()) if ("*" === o) o = u;else if ("*" !== u && u !== o) {
        if (!(a = l[u + " " + o] || l["* " + o])) for (i in l) {
          if ((s = i.split(" "))[1] === o && (a = l[u + " " + s[0]] || l["* " + s[0]])) {
            !0 === a ? a = l[i] : !0 !== l[i] && (o = s[0], c.unshift(s[1]));
            break;
          }
        }
        if (!0 !== a) if (a && e["throws"]) t = a(t);else try {
          t = a(t);
        } catch (e) {
          return {
            state: "parsererror",
            error: a ? e : "No conversion from " + u + " to " + o
          };
        }
      }
    }

    return {
      state: "success",
      data: t
    };
  }

  w.extend({
    active: 0,
    lastModified: {},
    etag: {},
    ajaxSettings: {
      url: Ct.href,
      type: "GET",
      isLocal: Pt.test(Ct.protocol),
      global: !0,
      processData: !0,
      async: !0,
      contentType: "application/x-www-form-urlencoded; charset=UTF-8",
      accepts: {
        "*": $t,
        text: "text/plain",
        html: "text/html",
        xml: "application/xml, text/xml",
        json: "application/json, text/javascript"
      },
      contents: {
        xml: /\bxml\b/,
        html: /\bhtml/,
        json: /\bjson\b/
      },
      responseFields: {
        xml: "responseXML",
        text: "responseText",
        json: "responseJSON"
      },
      converters: {
        "* text": String,
        "text html": !0,
        "text json": JSON.parse,
        "text xml": w.parseXML
      },
      flatOptions: {
        url: !0,
        context: !0
      }
    },
    ajaxSetup: function ajaxSetup(e, t) {
      return t ? zt(zt(e, w.ajaxSettings), t) : zt(w.ajaxSettings, e);
    },
    ajaxPrefilter: Ft(It),
    ajaxTransport: Ft(Wt),
    ajax: function ajax(t, n) {
      "object" == _typeof(t) && (n = t, t = void 0), n = n || {};
      var i,
          o,
          a,
          s,
          u,
          l,
          c,
          f,
          p,
          d,
          h = w.ajaxSetup({}, n),
          g = h.context || h,
          y = h.context && (g.nodeType || g.jquery) ? w(g) : w.event,
          v = w.Deferred(),
          m = w.Callbacks("once memory"),
          x = h.statusCode || {},
          b = {},
          T = {},
          C = "canceled",
          E = {
        readyState: 0,
        getResponseHeader: function getResponseHeader(e) {
          var t;

          if (c) {
            if (!s) {
              s = {};

              while (t = Ot.exec(a)) {
                s[t[1].toLowerCase()] = t[2];
              }
            }

            t = s[e.toLowerCase()];
          }

          return null == t ? null : t;
        },
        getAllResponseHeaders: function getAllResponseHeaders() {
          return c ? a : null;
        },
        setRequestHeader: function setRequestHeader(e, t) {
          return null == c && (e = T[e.toLowerCase()] = T[e.toLowerCase()] || e, b[e] = t), this;
        },
        overrideMimeType: function overrideMimeType(e) {
          return null == c && (h.mimeType = e), this;
        },
        statusCode: function statusCode(e) {
          var t;
          if (e) if (c) E.always(e[E.status]);else for (t in e) {
            x[t] = [x[t], e[t]];
          }
          return this;
        },
        abort: function abort(e) {
          var t = e || C;
          return i && i.abort(t), k(0, t), this;
        }
      };

      if (v.promise(E), h.url = ((t || h.url || Ct.href) + "").replace(Rt, Ct.protocol + "//"), h.type = n.method || n.type || h.method || h.type, h.dataTypes = (h.dataType || "*").toLowerCase().match(M) || [""], null == h.crossDomain) {
        l = r.createElement("a");

        try {
          l.href = h.url, l.href = l.href, h.crossDomain = Bt.protocol + "//" + Bt.host != l.protocol + "//" + l.host;
        } catch (e) {
          h.crossDomain = !0;
        }
      }

      if (h.data && h.processData && "string" != typeof h.data && (h.data = w.param(h.data, h.traditional)), _t(It, h, n, E), c) return E;
      (f = w.event && h.global) && 0 == w.active++ && w.event.trigger("ajaxStart"), h.type = h.type.toUpperCase(), h.hasContent = !Mt.test(h.type), o = h.url.replace(Lt, ""), h.hasContent ? h.data && h.processData && 0 === (h.contentType || "").indexOf("application/x-www-form-urlencoded") && (h.data = h.data.replace(qt, "+")) : (d = h.url.slice(o.length), h.data && (h.processData || "string" == typeof h.data) && (o += (kt.test(o) ? "&" : "?") + h.data, delete h.data), !1 === h.cache && (o = o.replace(Ht, "$1"), d = (kt.test(o) ? "&" : "?") + "_=" + Et++ + d), h.url = o + d), h.ifModified && (w.lastModified[o] && E.setRequestHeader("If-Modified-Since", w.lastModified[o]), w.etag[o] && E.setRequestHeader("If-None-Match", w.etag[o])), (h.data && h.hasContent && !1 !== h.contentType || n.contentType) && E.setRequestHeader("Content-Type", h.contentType), E.setRequestHeader("Accept", h.dataTypes[0] && h.accepts[h.dataTypes[0]] ? h.accepts[h.dataTypes[0]] + ("*" !== h.dataTypes[0] ? ", " + $t + "; q=0.01" : "") : h.accepts["*"]);

      for (p in h.headers) {
        E.setRequestHeader(p, h.headers[p]);
      }

      if (h.beforeSend && (!1 === h.beforeSend.call(g, E, h) || c)) return E.abort();

      if (C = "abort", m.add(h.complete), E.done(h.success), E.fail(h.error), i = _t(Wt, h, n, E)) {
        if (E.readyState = 1, f && y.trigger("ajaxSend", [E, h]), c) return E;
        h.async && h.timeout > 0 && (u = e.setTimeout(function () {
          E.abort("timeout");
        }, h.timeout));

        try {
          c = !1, i.send(b, k);
        } catch (e) {
          if (c) throw e;
          k(-1, e);
        }
      } else k(-1, "No Transport");

      function k(t, n, r, s) {
        var l,
            p,
            d,
            b,
            T,
            C = n;
        c || (c = !0, u && e.clearTimeout(u), i = void 0, a = s || "", E.readyState = t > 0 ? 4 : 0, l = t >= 200 && t < 300 || 304 === t, r && (b = Xt(h, E, r)), b = Ut(h, b, E, l), l ? (h.ifModified && ((T = E.getResponseHeader("Last-Modified")) && (w.lastModified[o] = T), (T = E.getResponseHeader("etag")) && (w.etag[o] = T)), 204 === t || "HEAD" === h.type ? C = "nocontent" : 304 === t ? C = "notmodified" : (C = b.state, p = b.data, l = !(d = b.error))) : (d = C, !t && C || (C = "error", t < 0 && (t = 0))), E.status = t, E.statusText = (n || C) + "", l ? v.resolveWith(g, [p, C, E]) : v.rejectWith(g, [E, C, d]), E.statusCode(x), x = void 0, f && y.trigger(l ? "ajaxSuccess" : "ajaxError", [E, h, l ? p : d]), m.fireWith(g, [E, C]), f && (y.trigger("ajaxComplete", [E, h]), --w.active || w.event.trigger("ajaxStop")));
      }

      return E;
    },
    getJSON: function getJSON(e, t, n) {
      return w.get(e, t, n, "json");
    },
    getScript: function getScript(e, t) {
      return w.get(e, void 0, t, "script");
    }
  }), w.each(["get", "post"], function (e, t) {
    w[t] = function (e, n, r, i) {
      return g(n) && (i = i || r, r = n, n = void 0), w.ajax(w.extend({
        url: e,
        type: t,
        dataType: i,
        data: n,
        success: r
      }, w.isPlainObject(e) && e));
    };
  }), w._evalUrl = function (e) {
    return w.ajax({
      url: e,
      type: "GET",
      dataType: "script",
      cache: !0,
      async: !1,
      global: !1,
      "throws": !0
    });
  }, w.fn.extend({
    wrapAll: function wrapAll(e) {
      var t;
      return this[0] && (g(e) && (e = e.call(this[0])), t = w(e, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
        var e = this;

        while (e.firstElementChild) {
          e = e.firstElementChild;
        }

        return e;
      }).append(this)), this;
    },
    wrapInner: function wrapInner(e) {
      return g(e) ? this.each(function (t) {
        w(this).wrapInner(e.call(this, t));
      }) : this.each(function () {
        var t = w(this),
            n = t.contents();
        n.length ? n.wrapAll(e) : t.append(e);
      });
    },
    wrap: function wrap(e) {
      var t = g(e);
      return this.each(function (n) {
        w(this).wrapAll(t ? e.call(this, n) : e);
      });
    },
    unwrap: function unwrap(e) {
      return this.parent(e).not("body").each(function () {
        w(this).replaceWith(this.childNodes);
      }), this;
    }
  }), w.expr.pseudos.hidden = function (e) {
    return !w.expr.pseudos.visible(e);
  }, w.expr.pseudos.visible = function (e) {
    return !!(e.offsetWidth || e.offsetHeight || e.getClientRects().length);
  }, w.ajaxSettings.xhr = function () {
    try {
      return new e.XMLHttpRequest();
    } catch (e) {}
  };
  var Vt = {
    0: 200,
    1223: 204
  },
      Gt = w.ajaxSettings.xhr();
  h.cors = !!Gt && "withCredentials" in Gt, h.ajax = Gt = !!Gt, w.ajaxTransport(function (t) {
    var _n, r;

    if (h.cors || Gt && !t.crossDomain) return {
      send: function send(i, o) {
        var a,
            s = t.xhr();
        if (s.open(t.type, t.url, t.async, t.username, t.password), t.xhrFields) for (a in t.xhrFields) {
          s[a] = t.xhrFields[a];
        }
        t.mimeType && s.overrideMimeType && s.overrideMimeType(t.mimeType), t.crossDomain || i["X-Requested-With"] || (i["X-Requested-With"] = "XMLHttpRequest");

        for (a in i) {
          s.setRequestHeader(a, i[a]);
        }

        _n = function n(e) {
          return function () {
            _n && (_n = r = s.onload = s.onerror = s.onabort = s.ontimeout = s.onreadystatechange = null, "abort" === e ? s.abort() : "error" === e ? "number" != typeof s.status ? o(0, "error") : o(s.status, s.statusText) : o(Vt[s.status] || s.status, s.statusText, "text" !== (s.responseType || "text") || "string" != typeof s.responseText ? {
              binary: s.response
            } : {
              text: s.responseText
            }, s.getAllResponseHeaders()));
          };
        }, s.onload = _n(), r = s.onerror = s.ontimeout = _n("error"), void 0 !== s.onabort ? s.onabort = r : s.onreadystatechange = function () {
          4 === s.readyState && e.setTimeout(function () {
            _n && r();
          });
        }, _n = _n("abort");

        try {
          s.send(t.hasContent && t.data || null);
        } catch (e) {
          if (_n) throw e;
        }
      },
      abort: function abort() {
        _n && _n();
      }
    };
  }), w.ajaxPrefilter(function (e) {
    e.crossDomain && (e.contents.script = !1);
  }), w.ajaxSetup({
    accepts: {
      script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
    },
    contents: {
      script: /\b(?:java|ecma)script\b/
    },
    converters: {
      "text script": function textScript(e) {
        return w.globalEval(e), e;
      }
    }
  }), w.ajaxPrefilter("script", function (e) {
    void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET");
  }), w.ajaxTransport("script", function (e) {
    if (e.crossDomain) {
      var t, _n2;

      return {
        send: function send(i, o) {
          t = w("<script>").prop({
            charset: e.scriptCharset,
            src: e.url
          }).on("load error", _n2 = function n(e) {
            t.remove(), _n2 = null, e && o("error" === e.type ? 404 : 200, e.type);
          }), r.head.appendChild(t[0]);
        },
        abort: function abort() {
          _n2 && _n2();
        }
      };
    }
  });
  var Yt = [],
      Qt = /(=)\?(?=&|$)|\?\?/;
  w.ajaxSetup({
    jsonp: "callback",
    jsonpCallback: function jsonpCallback() {
      var e = Yt.pop() || w.expando + "_" + Et++;
      return this[e] = !0, e;
    }
  }), w.ajaxPrefilter("json jsonp", function (t, n, r) {
    var i,
        o,
        a,
        s = !1 !== t.jsonp && (Qt.test(t.url) ? "url" : "string" == typeof t.data && 0 === (t.contentType || "").indexOf("application/x-www-form-urlencoded") && Qt.test(t.data) && "data");
    if (s || "jsonp" === t.dataTypes[0]) return i = t.jsonpCallback = g(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback, s ? t[s] = t[s].replace(Qt, "$1" + i) : !1 !== t.jsonp && (t.url += (kt.test(t.url) ? "&" : "?") + t.jsonp + "=" + i), t.converters["script json"] = function () {
      return a || w.error(i + " was not called"), a[0];
    }, t.dataTypes[0] = "json", o = e[i], e[i] = function () {
      a = arguments;
    }, r.always(function () {
      void 0 === o ? w(e).removeProp(i) : e[i] = o, t[i] && (t.jsonpCallback = n.jsonpCallback, Yt.push(i)), a && g(o) && o(a[0]), a = o = void 0;
    }), "script";
  }), h.createHTMLDocument = function () {
    var e = r.implementation.createHTMLDocument("").body;
    return e.innerHTML = "<form></form><form></form>", 2 === e.childNodes.length;
  }(), w.parseHTML = function (e, t, n) {
    if ("string" != typeof e) return [];
    "boolean" == typeof t && (n = t, t = !1);
    var i, o, a;
    return t || (h.createHTMLDocument ? ((i = (t = r.implementation.createHTMLDocument("")).createElement("base")).href = r.location.href, t.head.appendChild(i)) : t = r), o = A.exec(e), a = !n && [], o ? [t.createElement(o[1])] : (o = xe([e], t, a), a && a.length && w(a).remove(), w.merge([], o.childNodes));
  }, w.fn.load = function (e, t, n) {
    var r,
        i,
        o,
        a = this,
        s = e.indexOf(" ");
    return s > -1 && (r = vt(e.slice(s)), e = e.slice(0, s)), g(t) ? (n = t, t = void 0) : t && "object" == _typeof(t) && (i = "POST"), a.length > 0 && w.ajax({
      url: e,
      type: i || "GET",
      dataType: "html",
      data: t
    }).done(function (e) {
      o = arguments, a.html(r ? w("<div>").append(w.parseHTML(e)).find(r) : e);
    }).always(n && function (e, t) {
      a.each(function () {
        n.apply(this, o || [e.responseText, t, e]);
      });
    }), this;
  }, w.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (e, t) {
    w.fn[t] = function (e) {
      return this.on(t, e);
    };
  }), w.expr.pseudos.animated = function (e) {
    return w.grep(w.timers, function (t) {
      return e === t.elem;
    }).length;
  }, w.offset = {
    setOffset: function setOffset(e, t, n) {
      var r,
          i,
          o,
          a,
          s,
          u,
          l,
          c = w.css(e, "position"),
          f = w(e),
          p = {};
      "static" === c && (e.style.position = "relative"), s = f.offset(), o = w.css(e, "top"), u = w.css(e, "left"), (l = ("absolute" === c || "fixed" === c) && (o + u).indexOf("auto") > -1) ? (a = (r = f.position()).top, i = r.left) : (a = parseFloat(o) || 0, i = parseFloat(u) || 0), g(t) && (t = t.call(e, n, w.extend({}, s))), null != t.top && (p.top = t.top - s.top + a), null != t.left && (p.left = t.left - s.left + i), "using" in t ? t.using.call(e, p) : f.css(p);
    }
  }, w.fn.extend({
    offset: function offset(e) {
      if (arguments.length) return void 0 === e ? this : this.each(function (t) {
        w.offset.setOffset(this, e, t);
      });
      var t,
          n,
          r = this[0];
      if (r) return r.getClientRects().length ? (t = r.getBoundingClientRect(), n = r.ownerDocument.defaultView, {
        top: t.top + n.pageYOffset,
        left: t.left + n.pageXOffset
      }) : {
        top: 0,
        left: 0
      };
    },
    position: function position() {
      if (this[0]) {
        var e,
            t,
            n,
            r = this[0],
            i = {
          top: 0,
          left: 0
        };
        if ("fixed" === w.css(r, "position")) t = r.getBoundingClientRect();else {
          t = this.offset(), n = r.ownerDocument, e = r.offsetParent || n.documentElement;

          while (e && (e === n.body || e === n.documentElement) && "static" === w.css(e, "position")) {
            e = e.parentNode;
          }

          e && e !== r && 1 === e.nodeType && ((i = w(e).offset()).top += w.css(e, "borderTopWidth", !0), i.left += w.css(e, "borderLeftWidth", !0));
        }
        return {
          top: t.top - i.top - w.css(r, "marginTop", !0),
          left: t.left - i.left - w.css(r, "marginLeft", !0)
        };
      }
    },
    offsetParent: function offsetParent() {
      return this.map(function () {
        var e = this.offsetParent;

        while (e && "static" === w.css(e, "position")) {
          e = e.offsetParent;
        }

        return e || be;
      });
    }
  }), w.each({
    scrollLeft: "pageXOffset",
    scrollTop: "pageYOffset"
  }, function (e, t) {
    var n = "pageYOffset" === t;

    w.fn[e] = function (r) {
      return z(this, function (e, r, i) {
        var o;
        if (y(e) ? o = e : 9 === e.nodeType && (o = e.defaultView), void 0 === i) return o ? o[t] : e[r];
        o ? o.scrollTo(n ? o.pageXOffset : i, n ? i : o.pageYOffset) : e[r] = i;
      }, e, r, arguments.length);
    };
  }), w.each(["top", "left"], function (e, t) {
    w.cssHooks[t] = _e(h.pixelPosition, function (e, n) {
      if (n) return n = Fe(e, t), We.test(n) ? w(e).position()[t] + "px" : n;
    });
  }), w.each({
    Height: "height",
    Width: "width"
  }, function (e, t) {
    w.each({
      padding: "inner" + e,
      content: t,
      "": "outer" + e
    }, function (n, r) {
      w.fn[r] = function (i, o) {
        var a = arguments.length && (n || "boolean" != typeof i),
            s = n || (!0 === i || !0 === o ? "margin" : "border");
        return z(this, function (t, n, i) {
          var o;
          return y(t) ? 0 === r.indexOf("outer") ? t["inner" + e] : t.document.documentElement["client" + e] : 9 === t.nodeType ? (o = t.documentElement, Math.max(t.body["scroll" + e], o["scroll" + e], t.body["offset" + e], o["offset" + e], o["client" + e])) : void 0 === i ? w.css(t, n, s) : w.style(t, n, i, s);
        }, t, a ? i : void 0, a);
      };
    });
  }), w.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function (e, t) {
    w.fn[t] = function (e, n) {
      return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t);
    };
  }), w.fn.extend({
    hover: function hover(e, t) {
      return this.mouseenter(e).mouseleave(t || e);
    }
  }), w.fn.extend({
    bind: function bind(e, t, n) {
      return this.on(e, null, t, n);
    },
    unbind: function unbind(e, t) {
      return this.off(e, null, t);
    },
    delegate: function delegate(e, t, n, r) {
      return this.on(t, e, n, r);
    },
    undelegate: function undelegate(e, t, n) {
      return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n);
    }
  }), w.proxy = function (e, t) {
    var n, r, i;
    if ("string" == typeof t && (n = e[t], t = e, e = n), g(e)) return r = o.call(arguments, 2), i = function i() {
      return e.apply(t || this, r.concat(o.call(arguments)));
    }, i.guid = e.guid = e.guid || w.guid++, i;
  }, w.holdReady = function (e) {
    e ? w.readyWait++ : w.ready(!0);
  }, w.isArray = Array.isArray, w.parseJSON = JSON.parse, w.nodeName = N, w.isFunction = g, w.isWindow = y, w.camelCase = G, w.type = x, w.now = Date.now, w.isNumeric = function (e) {
    var t = w.type(e);
    return ("number" === t || "string" === t) && !isNaN(e - parseFloat(e));
  },  true && !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function () {
    return w;
  }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  var Jt = e.jQuery,
      Kt = e.$;
  return w.noConflict = function (t) {
    return e.$ === w && (e.$ = Kt), t && e.jQuery === w && (e.jQuery = Jt), w;
  }, t || (e.jQuery = e.$ = w), w;
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../node_modules/webpack/buildin/module.js */ "./node_modules/webpack/buildin/module.js")(module)))

/***/ }),

/***/ "./resources/js/jquery.slimscroll.js":
/*!*******************************************!*\
  !*** ./resources/js/jquery.slimscroll.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*! Copyright (c) 2011 Piotr Rochala (http://rocha.la)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.8
 *
 */
(function ($) {
  $.fn.extend({
    slimScroll: function slimScroll(options) {
      var defaults = {
        // width in pixels of the visible scroll area
        width: 'auto',
        // height in pixels of the visible scroll area
        height: '100%',
        // width in pixels of the scrollbar and rail
        size: '7px',
        // scrollbar color, accepts any hex/color value
        color: '#000',
        // scrollbar position - left/right
        position: 'right',
        // distance in pixels between the side edge and the scrollbar
        distance: '1px',
        // default scroll position on load - top / bottom / $('selector')
        start: 'top',
        // sets scrollbar opacity
        opacity: .4,
        // enables always-on mode for the scrollbar
        alwaysVisible: false,
        // check if we should hide the scrollbar when user is hovering over
        disableFadeOut: false,
        // sets visibility of the rail
        railVisible: false,
        // sets rail color
        railColor: '#333',
        // sets rail opacity
        railOpacity: .2,
        // whether  we should use jQuery UI Draggable to enable bar dragging
        railDraggable: true,
        // defautlt CSS class of the slimscroll rail
        railClass: 'slimScrollRail',
        // defautlt CSS class of the slimscroll bar
        barClass: 'slimScrollBar',
        // defautlt CSS class of the slimscroll wrapper
        wrapperClass: 'slimScrollDiv',
        // check if mousewheel should scroll the window if we reach top/bottom
        allowPageScroll: false,
        // scroll amount applied to each mouse wheel step
        wheelStep: 20,
        // scroll amount applied when user is using gestures
        touchScrollStep: 200,
        // sets border radius
        borderRadius: '7px',
        // sets border radius of the rail
        railBorderRadius: '7px'
      };
      var o = $.extend(defaults, options); // do it for every element that matches selector

      this.each(function () {
        var isOverPanel,
            isOverBar,
            isDragg,
            queueHide,
            touchDif,
            barHeight,
            percentScroll,
            lastScroll,
            divS = '<div></div>',
            minBarHeight = 30,
            releaseScroll = false; // used in event handlers and for better minification

        var me = $(this); // ensure we are not binding it again

        if (me.parent().hasClass(o.wrapperClass)) {
          // start from last bar position
          var offset = me.scrollTop(); // find bar and rail

          bar = me.siblings('.' + o.barClass);
          rail = me.siblings('.' + o.railClass);
          getBarHeight(); // check if we should scroll existing instance

          if ($.isPlainObject(options)) {
            // Pass height: auto to an existing slimscroll object to force a resize after contents have changed
            if ('height' in options && options.height == 'auto') {
              me.parent().css('height', 'auto');
              me.css('height', 'auto');
              var height = me.parent().parent().height();
              me.parent().css('height', height);
              me.css('height', height);
            } else if ('height' in options) {
              var h = options.height;
              me.parent().css('height', h);
              me.css('height', h);
            }

            if ('scrollTo' in options) {
              // jump to a static point
              offset = parseInt(o.scrollTo);
            } else if ('scrollBy' in options) {
              // jump by value pixels
              offset += parseInt(o.scrollBy);
            } else if ('destroy' in options) {
              // remove slimscroll elements
              bar.remove();
              rail.remove();
              me.unwrap();
              return;
            } // scroll content by the given offset


            scrollContent(offset, false, true);
          }

          return;
        } else if ($.isPlainObject(options)) {
          if ('destroy' in options) {
            return;
          }
        } // optionally set height to the parent's height


        o.height = o.height == 'auto' ? me.parent().height() : o.height; // wrap content

        var wrapper = $(divS).addClass(o.wrapperClass).css({
          position: 'relative',
          overflow: 'hidden',
          width: o.width,
          height: o.height
        }); // update style for the div

        me.css({
          overflow: 'hidden',
          width: o.width,
          height: o.height
        }); // create scrollbar rail

        var rail = $(divS).addClass(o.railClass).css({
          width: o.size,
          height: '100%',
          position: 'absolute',
          top: 0,
          display: o.alwaysVisible && o.railVisible ? 'block' : 'none',
          'border-radius': o.railBorderRadius,
          background: o.railColor,
          opacity: o.railOpacity,
          zIndex: 90
        }); // create scrollbar

        var bar = $(divS).addClass(o.barClass).css({
          background: o.color,
          width: o.size,
          position: 'absolute',
          top: 0,
          opacity: o.opacity,
          display: o.alwaysVisible ? 'block' : 'none',
          'border-radius': o.borderRadius,
          BorderRadius: o.borderRadius,
          MozBorderRadius: o.borderRadius,
          WebkitBorderRadius: o.borderRadius,
          zIndex: 99
        }); // set position

        var posCss = o.position == 'right' ? {
          right: o.distance
        } : {
          left: o.distance
        };
        rail.css(posCss);
        bar.css(posCss); // wrap it

        me.wrap(wrapper); // append to parent div

        me.parent().append(bar);
        me.parent().append(rail); // make it draggable and no longer dependent on the jqueryUI

        if (o.railDraggable) {
          bar.bind("mousedown", function (e) {
            var $doc = $(document);
            isDragg = true;
            t = parseFloat(bar.css('top'));
            pageY = e.pageY;
            $doc.bind("mousemove.slimscroll", function (e) {
              currTop = t + e.pageY - pageY;
              bar.css('top', currTop);
              scrollContent(0, bar.position().top, false); // scroll content
            });
            $doc.bind("mouseup.slimscroll", function (e) {
              isDragg = false;
              hideBar();
              $doc.unbind('.slimscroll');
            });
            return false;
          }).bind("selectstart.slimscroll", function (e) {
            e.stopPropagation();
            e.preventDefault();
            return false;
          });
        } // on rail over


        rail.hover(function () {
          showBar();
        }, function () {
          hideBar();
        }); // on bar over

        bar.hover(function () {
          isOverBar = true;
        }, function () {
          isOverBar = false;
        }); // show on parent mouseover

        me.hover(function () {
          isOverPanel = true;
          showBar();
          hideBar();
        }, function () {
          isOverPanel = false;
          hideBar();
        }); // support for mobile

        me.bind('touchstart', function (e, b) {
          if (e.originalEvent.touches.length) {
            // record where touch started
            touchDif = e.originalEvent.touches[0].pageY;
          }
        });
        me.bind('touchmove', function (e) {
          // prevent scrolling the page if necessary
          if (!releaseScroll) {
            e.originalEvent.preventDefault();
          }

          if (e.originalEvent.touches.length) {
            // see how far user swiped
            var diff = (touchDif - e.originalEvent.touches[0].pageY) / o.touchScrollStep; // scroll content

            scrollContent(diff, true);
            touchDif = e.originalEvent.touches[0].pageY;
          }
        }); // set up initial height

        getBarHeight(); // check start position

        if (o.start === 'bottom') {
          // scroll content to bottom
          bar.css({
            top: me.outerHeight() - bar.outerHeight()
          });
          scrollContent(0, true);
        } else if (o.start !== 'top') {
          // assume jQuery selector
          scrollContent($(o.start).position().top, null, true); // make sure bar stays hidden

          if (!o.alwaysVisible) {
            bar.hide();
          }
        } // attach scroll events


        attachWheel(this);

        function _onWheel(e) {
          // use mouse wheel only when mouse is over
          if (!isOverPanel) {
            return;
          }

          var e = e || window.event;
          var delta = 0;

          if (e.wheelDelta) {
            delta = -e.wheelDelta / 120;
          }

          if (e.detail) {
            delta = e.detail / 3;
          }

          var target = e.target || e.srcTarget || e.srcElement;

          if ($(target).closest('.' + o.wrapperClass).is(me.parent())) {
            // scroll content
            scrollContent(delta, true);
          } // stop window scroll


          if (e.preventDefault && !releaseScroll) {
            e.preventDefault();
          }

          if (!releaseScroll) {
            e.returnValue = false;
          }
        }

        function scrollContent(y, isWheel, isJump) {
          releaseScroll = false;
          var delta = y;
          var maxTop = me.outerHeight() - bar.outerHeight();

          if (isWheel) {
            // move bar with mouse wheel
            delta = parseInt(bar.css('top')) + y * parseInt(o.wheelStep) / 100 * bar.outerHeight(); // move bar, make sure it doesn't go out

            delta = Math.min(Math.max(delta, 0), maxTop); // if scrolling down, make sure a fractional change to the
            // scroll position isn't rounded away when the scrollbar's CSS is set
            // this flooring of delta would happened automatically when
            // bar.css is set below, but we floor here for clarity

            delta = y > 0 ? Math.ceil(delta) : Math.floor(delta); // scroll the scrollbar

            bar.css({
              top: delta + 'px'
            });
          } // calculate actual scroll amount


          percentScroll = parseInt(bar.css('top')) / (me.outerHeight() - bar.outerHeight());
          delta = percentScroll * (me[0].scrollHeight - me.outerHeight());

          if (isJump) {
            delta = y;
            var offsetTop = delta / me[0].scrollHeight * me.outerHeight();
            offsetTop = Math.min(Math.max(offsetTop, 0), maxTop);
            bar.css({
              top: offsetTop + 'px'
            });
          } // scroll content


          me.scrollTop(delta); // fire scrolling event

          me.trigger('slimscrolling', ~~delta); // ensure bar is visible

          showBar(); // trigger hide when scroll is stopped

          hideBar();
        }

        function attachWheel(target) {
          if (window.addEventListener) {
            target.addEventListener('DOMMouseScroll', _onWheel, false);
            target.addEventListener('mousewheel', _onWheel, false);
          } else {
            document.attachEvent("onmousewheel", _onWheel);
          }
        }

        function getBarHeight() {
          // calculate scrollbar height and make sure it is not too small
          barHeight = Math.max(me.outerHeight() / me[0].scrollHeight * me.outerHeight(), minBarHeight);
          bar.css({
            height: barHeight + 'px'
          }); // hide scrollbar if content is not long enough

          var display = barHeight == me.outerHeight() ? 'none' : 'block';
          bar.css({
            display: display
          });
        }

        function showBar() {
          // recalculate bar height
          getBarHeight();
          clearTimeout(queueHide); // when bar reached top or bottom

          if (percentScroll == ~~percentScroll) {
            //release wheel
            releaseScroll = o.allowPageScroll; // publish approporiate event

            if (lastScroll != percentScroll) {
              var msg = ~~percentScroll == 0 ? 'top' : 'bottom';
              me.trigger('slimscroll', msg);
            }
          } else {
            releaseScroll = false;
          }

          lastScroll = percentScroll; // show only when required

          if (barHeight >= me.outerHeight()) {
            //allow window scroll
            releaseScroll = true;
            return;
          }

          bar.stop(true, true).fadeIn('fast');

          if (o.railVisible) {
            rail.stop(true, true).fadeIn('fast');
          }
        }

        function hideBar() {
          // only hide when options allow it
          if (!o.alwaysVisible) {
            queueHide = setTimeout(function () {
              if (!(o.disableFadeOut && isOverPanel) && !isOverBar && !isDragg) {
                bar.fadeOut('slow');
                rail.fadeOut('slow');
              }
            }, 1000);
          }
        }
      }); // maintain chainability

      return this;
    }
  });
  $.fn.extend({
    slimscroll: $.fn.slimScroll
  });
})(jQuery);

/***/ }),

/***/ "./resources/js/main.js":
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

jQuery(document).ready(function ($) {
  'use strict'; // ============================================================== 
  // Notification list
  // ============================================================== 

  if ($(".notification-list").length) {
    $('.notification-list').slimScroll({
      height: '250px'
    });
  } // ============================================================== 
  // Menu Slim Scroll List
  // ============================================================== 


  if ($(".menu-list").length) {
    $('.menu-list').slimScroll({});
  } // ============================================================== 
  // Sidebar scrollnavigation 
  // ============================================================== 


  if ($(".sidebar-nav-fixed a").length) {
    $('.sidebar-nav-fixed a') // Remove links that don't actually link to anything
    .click(function (event) {
      // On-page links
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        // Figure out element to scroll to
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']'); // Does a scroll target exist?

        if (target.length) {
          // Only prevent default if animation is actually gonna happen
          event.preventDefault();
          $('html, body').animate({
            scrollTop: target.offset().top - 90
          }, 1000, function () {
            // Callback after animation
            // Must change focus!
            var $target = $(target);
            $target.focus();

            if ($target.is(":focus")) {
              // Checking if the target was focused
              return false;
            } else {
              $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable

              $target.focus(); // Set focus again
            }

            ;
          });
        }
      }

      ;
      $('.sidebar-nav-fixed a').each(function () {
        $(this).removeClass('active');
      });
      $(this).addClass('active');
    });
  } // ============================================================== 
  // tooltip
  // ============================================================== 


  if ($('[data-toggle="tooltip"]').length) {
    $('[data-toggle="tooltip"]').tooltip();
  } // ==============================================================
  // popover
  // ============================================================== 


  if ($('[data-toggle="popover"]').length) {
    $('[data-toggle="popover"]').popover();
  } // ==============================================================
  // Chat List Slim Scroll
  // ============================================================== 


  if ($('.chat-list').length) {
    $('.chat-list').slimScroll({
      color: 'false',
      width: '100%'
    });
  } // ============================================================== 
  // dropzone script
  // ============================================================== 
  //     if ($('.dz-clickable').length) {
  //            $(".dz-clickable").dropzone({ url: "/file/post" });
  // }

});
jQuery(document).on({
  ajaxStart: function ajaxStart() {
    if (!jQuery('body').hasClass('noLoading')) {
      jQuery('body').addClass("loading");
    }
  },
  ajaxStop: function ajaxStop() {
    jQuery('body').removeClass("loading");
  }
});
jQuery.ajaxSetup({
  beforeSend: function beforeSend(xhr) {
    csrf_token = window.token;
    xhr.setRequestHeader('X-CSRF-TOKEN', csrf_token);
  },
  error: function error(xhr, textStatus, _error) {
    // Validation Exception
    if (xhr.status === 422) {
      messages = [];
      message = xhr.responseJSON.errors;

      for (x in message) {
        messages.push("<li>" + message[x][0] + "</li>");
      }

      svaigi.showMessage('<ul style="list-style-position:outside;list-style-type:disc;display:block;">' + messages.join("") + '</ul>', 'error');
      return;
    }
    /*
            // unauthorized
            if (xhr.status === 401) {
                document.location = "/sessionEnded";
                return;
            }
    */


    if (xhr.status === 500 || xhr.status === 419) {
      svaigi.showMessage('Server Error, please contact System administrator', 'error');
    }

    return;
  },
  complete: function complete(xhr, textStatus, error) {
    if (xhr.responseJSON.noMessage) return;

    if (xhr.status === 200) {
      svaigi.showMessage(xhr.responseJSON.message || 'Changes have been made', xhr.responseJSON.status == true ? 'success' : 'error');
    }
  }
});
jQuery.ajaxPrefilter(function (options, originalOptions, jqXHR) {
  if (options.type.toLowerCase() === "post") {
    csrf_token = window.token;

    if (_typeof(options.data) == "object") {
      options.data.append('_token', encodeURIComponent(csrf_token));
    } else {
      options.data = options.data || "";
      options.data += options.data ? "&" : "";
      options.data += "_token=" + encodeURIComponent(csrf_token);
    }
  }
});

/***/ }),

/***/ "./resources/js/noty.js":
/*!******************************!*\
  !*** ./resources/js/noty.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(module) {var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*
  @package NOTY - Dependency-free notification library
  @version version: 3.2.0-beta
  @contributors https://github.com/needim/noty/graphs/contributors
  @documentation Examples and Documentation - https://ned.im/noty
  @license Licensed under the MIT licenses: http://www.opensource.org/licenses/mit-license.php
*/
!function (t, e) {
  "object" == ( false ? undefined : _typeof(exports)) && "object" == ( false ? undefined : _typeof(module)) ? module.exports = e() :  true ? !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_FACTORY__ = (e),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : undefined;
}(this, function () {
  return function (t) {
    function e(o) {
      if (n[o]) return n[o].exports;
      var i = n[o] = {
        i: o,
        l: !1,
        exports: {}
      };
      return t[o].call(i.exports, i, i.exports, e), i.l = !0, i.exports;
    }

    var n = {};
    return e.m = t, e.c = n, e.i = function (t) {
      return t;
    }, e.d = function (t, n, o) {
      e.o(t, n) || Object.defineProperty(t, n, {
        configurable: !1,
        enumerable: !0,
        get: o
      });
    }, e.n = function (t) {
      var n = t && t.__esModule ? function () {
        return t.default;
      } : function () {
        return t;
      };
      return e.d(n, "a", n), n;
    }, e.o = function (t, e) {
      return Object.prototype.hasOwnProperty.call(t, e);
    }, e.p = "", e(e.s = 6);
  }([function (t, e, n) {
    "use strict";

    function o(t, e, n) {
      var o = void 0;

      if (!n) {
        for (o in e) {
          if (e.hasOwnProperty(o) && e[o] === t) return !0;
        }
      } else for (o in e) {
        if (e.hasOwnProperty(o) && e[o] === t) return !0;
      }

      return !1;
    }

    function i(t) {
      t = t || window.event, void 0 !== t.stopPropagation ? t.stopPropagation() : t.cancelBubble = !0;
    }

    function r() {
      var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "",
          e = "noty_" + t + "_";
      return e += "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function (t) {
        var e = 16 * Math.random() | 0;
        return ("x" === t ? e : 3 & e | 8).toString(16);
      });
    }

    function s(t) {
      var e = t.offsetHeight,
          n = window.getComputedStyle(t);
      return e += parseInt(n.marginTop) + parseInt(n.marginBottom);
    }

    function u(t, e, n) {
      var o = arguments.length > 3 && void 0 !== arguments[3] && arguments[3];
      e = e.split(" ");

      for (var i = 0; i < e.length; i++) {
        document.addEventListener ? t.addEventListener(e[i], n, o) : document.attachEvent && t.attachEvent("on" + e[i], n);
      }
    }

    function a(t, e) {
      return ("string" == typeof t ? t : f(t)).indexOf(" " + e + " ") >= 0;
    }

    function c(t, e) {
      var n = f(t),
          o = n + e;
      a(n, e) || (t.className = o.substring(1));
    }

    function l(t, e) {
      var n = f(t),
          o = void 0;
      a(t, e) && (o = n.replace(" " + e + " ", " "), t.className = o.substring(1, o.length - 1));
    }

    function d(t) {
      t.parentNode && t.parentNode.removeChild(t);
    }

    function f(t) {
      return (" " + (t && t.className || "") + " ").replace(/\s+/gi, " ");
    }

    function h() {
      function t() {
        b.PageHidden = document[s], o();
      }

      function e() {
        b.PageHidden = !0, o();
      }

      function n() {
        b.PageHidden = !1, o();
      }

      function o() {
        b.PageHidden ? i() : r();
      }

      function i() {
        setTimeout(function () {
          Object.keys(b.Store).forEach(function (t) {
            b.Store.hasOwnProperty(t) && b.Store[t].options.visibilityControl && b.Store[t].stop();
          });
        }, 100);
      }

      function r() {
        setTimeout(function () {
          Object.keys(b.Store).forEach(function (t) {
            b.Store.hasOwnProperty(t) && b.Store[t].options.visibilityControl && b.Store[t].resume();
          }), b.queueRenderAll();
        }, 100);
      }

      var s = void 0,
          a = void 0;
      void 0 !== document.hidden ? (s = "hidden", a = "visibilitychange") : void 0 !== document.msHidden ? (s = "msHidden", a = "msvisibilitychange") : void 0 !== document.webkitHidden && (s = "webkitHidden", a = "webkitvisibilitychange"), a && u(document, a, t), u(window, "blur", e), u(window, "focus", n);
    }

    function p(t) {
      if (t.hasSound) {
        var e = document.createElement("audio");
        t.options.sounds.sources.forEach(function (t) {
          var n = document.createElement("source");
          n.src = t, n.type = "audio/" + m(t), e.appendChild(n);
        }), t.barDom ? t.barDom.appendChild(e) : document.querySelector("body").appendChild(e), e.volume = t.options.sounds.volume, t.soundPlayed || (e.play(), t.soundPlayed = !0), e.onended = function () {
          d(e);
        };
      }
    }

    function m(t) {
      return t.match(/\.([^.]+)$/)[1];
    }

    Object.defineProperty(e, "__esModule", {
      value: !0
    }), e.css = e.deepExtend = e.animationEndEvents = void 0;
    var v = "function" == typeof Symbol && "symbol" == _typeof(Symbol.iterator) ? function (t) {
      return _typeof(t);
    } : function (t) {
      return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : _typeof(t);
    };
    e.inArray = o, e.stopPropagation = i, e.generateID = r, e.outerHeight = s, e.addListener = u, e.hasClass = a, e.addClass = c, e.removeClass = l, e.remove = d, e.classList = f, e.visibilityChangeFlow = h, e.createAudioElements = p;

    var y = n(1),
        b = function (t) {
      if (t && t.__esModule) return t;
      var e = {};
      if (null != t) for (var n in t) {
        Object.prototype.hasOwnProperty.call(t, n) && (e[n] = t[n]);
      }
      return e.default = t, e;
    }(y);

    e.animationEndEvents = "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", e.deepExtend = function t(e) {
      e = e || {};

      for (var n = 1; n < arguments.length; n++) {
        var o = arguments[n];
        if (o) for (var i in o) {
          o.hasOwnProperty(i) && (Array.isArray(o[i]) ? e[i] = o[i] : "object" === v(o[i]) && null !== o[i] ? e[i] = t(e[i], o[i]) : e[i] = o[i]);
        }
      }

      return e;
    }, e.css = function () {
      function t(t) {
        return t.replace(/^-ms-/, "ms-").replace(/-([\da-z])/gi, function (t, e) {
          return e.toUpperCase();
        });
      }

      function e(t) {
        var e = document.body.style;
        if (t in e) return t;

        for (var n = i.length, o = t.charAt(0).toUpperCase() + t.slice(1), r = void 0; n--;) {
          if ((r = i[n] + o) in e) return r;
        }

        return t;
      }

      function n(n) {
        return n = t(n), r[n] || (r[n] = e(n));
      }

      function o(t, e, o) {
        e = n(e), t.style[e] = o;
      }

      var i = ["Webkit", "O", "Moz", "ms"],
          r = {};
      return function (t, e) {
        var n = arguments,
            i = void 0,
            r = void 0;
        if (2 === n.length) for (i in e) {
          e.hasOwnProperty(i) && void 0 !== (r = e[i]) && e.hasOwnProperty(i) && o(t, i, r);
        } else o(t, n[1], n[2]);
      };
    }();
  }, function (t, e, n) {
    "use strict";

    function o() {
      var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "global",
          e = 0,
          n = x;
      return E.hasOwnProperty(t) && (n = E[t].maxVisible, Object.keys(P).forEach(function (n) {
        P[n].options.queue !== t || P[n].closed || e++;
      })), {
        current: e,
        maxVisible: n
      };
    }

    function i(t) {
      E.hasOwnProperty(t.options.queue) || (E[t.options.queue] = {
        maxVisible: x,
        queue: []
      }), E[t.options.queue].queue.push(t);
    }

    function r(t) {
      if (E.hasOwnProperty(t.options.queue)) {
        var e = [];
        Object.keys(E[t.options.queue].queue).forEach(function (n) {
          E[t.options.queue].queue[n].id !== t.id && e.push(E[t.options.queue].queue[n]);
        }), E[t.options.queue].queue = e;
      }
    }

    function s() {
      var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "global";

      if (E.hasOwnProperty(t)) {
        var e = E[t].queue.shift();
        e && e.show();
      }
    }

    function u() {
      Object.keys(E).forEach(function (t) {
        s(t);
      });
    }

    function a(t) {
      var e = k.generateID("ghost"),
          n = document.createElement("div");
      n.setAttribute("id", e), k.css(n, {
        height: k.outerHeight(t.barDom) + "px"
      }), t.barDom.insertAdjacentHTML("afterend", n.outerHTML), k.remove(t.barDom), n = document.getElementById(e), k.addClass(n, "noty_fix_effects_height"), k.addListener(n, k.animationEndEvents, function () {
        k.remove(n);
      });
    }

    function c(t) {
      m(t);
      var e = '<div class="noty_body">' + t.options.text + "</div>" + d(t) + '<div class="noty_progressbar"></div>';
      t.barDom = document.createElement("div"), t.barDom.setAttribute("id", t.id), k.addClass(t.barDom, "noty_bar noty_type__" + t.options.type + " noty_theme__" + t.options.theme), t.barDom.innerHTML = e, b(t, "onTemplate");
    }

    function l(t) {
      return !(!t.options.buttons || !Object.keys(t.options.buttons).length);
    }

    function d(t) {
      if (l(t)) {
        var e = document.createElement("div");
        return k.addClass(e, "noty_buttons"), Object.keys(t.options.buttons).forEach(function (n) {
          e.appendChild(t.options.buttons[n].dom);
        }), t.options.buttons.forEach(function (t) {
          e.appendChild(t.dom);
        }), e.outerHTML;
      }

      return "";
    }

    function f(t) {
      t.options.modal && (0 === C && p(), e.DocModalCount = C += 1);
    }

    function h(t) {
      if (t.options.modal && C > 0 && (e.DocModalCount = C -= 1, C <= 0)) {
        var n = document.querySelector(".noty_modal");
        n && (k.removeClass(n, "noty_modal_open"), k.addClass(n, "noty_modal_close"), k.addListener(n, k.animationEndEvents, function () {
          k.remove(n);
        }));
      }
    }

    function p() {
      var t = document.querySelector("body"),
          e = document.createElement("div");
      k.addClass(e, "noty_modal"), t.insertBefore(e, t.firstChild), k.addClass(e, "noty_modal_open"), k.addListener(e, k.animationEndEvents, function () {
        k.removeClass(e, "noty_modal_open");
      });
    }

    function m(t) {
      if (t.options.container) return void (t.layoutDom = document.querySelector(t.options.container));
      var e = "noty_layout__" + t.options.layout;
      t.layoutDom = document.querySelector("div#" + e), t.layoutDom || (t.layoutDom = document.createElement("div"), t.layoutDom.setAttribute("id", e), t.layoutDom.setAttribute("role", "alert"), t.layoutDom.setAttribute("aria-live", "polite"), k.addClass(t.layoutDom, "noty_layout"), document.querySelector("body").appendChild(t.layoutDom));
    }

    function v(t) {
      t.options.timeout && (t.options.progressBar && t.progressDom && k.css(t.progressDom, {
        transition: "width " + t.options.timeout + "ms linear",
        width: "0%"
      }), clearTimeout(t.closeTimer), t.closeTimer = setTimeout(function () {
        t.close();
      }, t.options.timeout));
    }

    function y(t) {
      t.options.timeout && t.closeTimer && (clearTimeout(t.closeTimer), t.closeTimer = -1, t.options.progressBar && t.progressDom && k.css(t.progressDom, {
        transition: "width 0ms linear",
        width: "100%"
      }));
    }

    function b(t, e) {
      t.listeners.hasOwnProperty(e) && t.listeners[e].forEach(function (e) {
        "function" == typeof e && e.apply(t);
      });
    }

    function w(t) {
      b(t, "afterShow"), v(t), k.addListener(t.barDom, "mouseenter", function () {
        y(t);
      }), k.addListener(t.barDom, "mouseleave", function () {
        v(t);
      });
    }

    function g(t) {
      delete P[t.id], t.closing = !1, b(t, "afterClose"), k.remove(t.barDom), 0 !== t.layoutDom.querySelectorAll(".noty_bar").length || t.options.container || k.remove(t.layoutDom), (k.inArray("docVisible", t.options.titleCount.conditions) || k.inArray("docHidden", t.options.titleCount.conditions)) && D.decrement(), s(t.options.queue);
    }

    Object.defineProperty(e, "__esModule", {
      value: !0
    }), e.Defaults = e.Store = e.Queues = e.DefaultMaxVisible = e.docTitle = e.DocModalCount = e.PageHidden = void 0, e.getQueueCounts = o, e.addToQueue = i, e.removeFromQueue = r, e.queueRender = s, e.queueRenderAll = u, e.ghostFix = a, e.build = c, e.hasButtons = l, e.handleModal = f, e.handleModalClose = h, e.queueClose = v, e.dequeueClose = y, e.fire = b, e.openFlow = w, e.closeFlow = g;

    var _ = n(0),
        k = function (t) {
      if (t && t.__esModule) return t;
      var e = {};
      if (null != t) for (var n in t) {
        Object.prototype.hasOwnProperty.call(t, n) && (e[n] = t[n]);
      }
      return e.default = t, e;
    }(_),
        C = (e.PageHidden = !1, e.DocModalCount = 0),
        S = {
      originalTitle: null,
      count: 0,
      changed: !1,
      timer: -1
    },
        D = e.docTitle = {
      increment: function increment() {
        S.count++, D._update();
      },
      decrement: function decrement() {
        if (--S.count <= 0) return void D._clear();

        D._update();
      },
      _update: function _update() {
        var t = document.title;
        S.changed ? document.title = "(" + S.count + ") " + S.originalTitle : (S.originalTitle = t, document.title = "(" + S.count + ") " + t, S.changed = !0);
      },
      _clear: function _clear() {
        S.changed && (S.count = 0, document.title = S.originalTitle, S.changed = !1);
      }
    },
        x = e.DefaultMaxVisible = 5,
        E = e.Queues = {
      global: {
        maxVisible: x,
        queue: []
      }
    },
        P = e.Store = {};

    e.Defaults = {
      type: "alert",
      layout: "topRight",
      theme: "mint",
      text: "",
      timeout: !1,
      progressBar: !0,
      closeWith: ["click"],
      animation: {
        open: "noty_effects_open",
        close: "noty_effects_close"
      },
      id: !1,
      force: !1,
      killer: !1,
      queue: "global",
      container: !1,
      buttons: [],
      callbacks: {
        beforeShow: null,
        onShow: null,
        afterShow: null,
        onClose: null,
        afterClose: null,
        onClick: null,
        onHover: null,
        onTemplate: null
      },
      sounds: {
        sources: [],
        volume: 1,
        conditions: []
      },
      titleCount: {
        conditions: []
      },
      modal: !1,
      visibilityControl: !1
    };
  }, function (t, e, n) {
    "use strict";

    function o(t, e) {
      if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function");
    }

    Object.defineProperty(e, "__esModule", {
      value: !0
    }), e.NotyButton = void 0;

    var i = n(0),
        r = function (t) {
      if (t && t.__esModule) return t;
      var e = {};
      if (null != t) for (var n in t) {
        Object.prototype.hasOwnProperty.call(t, n) && (e[n] = t[n]);
      }
      return e.default = t, e;
    }(i);

    e.NotyButton = function t(e, n, i) {
      var s = this,
          u = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {};
      return o(this, t), this.dom = document.createElement("button"), this.dom.innerHTML = e, this.id = u.id = u.id || r.generateID("button"), this.cb = i, Object.keys(u).forEach(function (t) {
        s.dom.setAttribute(t, u[t]);
      }), r.addClass(this.dom, n || "noty_btn"), this;
    };
  }, function (t, e, n) {
    "use strict";

    function o(t, e) {
      if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function");
    }

    Object.defineProperty(e, "__esModule", {
      value: !0
    });

    var i = function () {
      function t(t, e) {
        for (var n = 0; n < e.length; n++) {
          var o = e[n];
          o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(t, o.key, o);
        }
      }

      return function (e, n, o) {
        return n && t(e.prototype, n), o && t(e, o), e;
      };
    }();

    e.Push = function () {
      function t() {
        var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "/service-worker.js";
        return o(this, t), this.subData = {}, this.workerPath = e, this.listeners = {
          onPermissionGranted: [],
          onPermissionDenied: [],
          onSubscriptionSuccess: [],
          onSubscriptionCancel: [],
          onWorkerError: [],
          onWorkerSuccess: [],
          onWorkerNotSupported: []
        }, this;
      }

      return i(t, [{
        key: "on",
        value: function value(t) {
          var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : function () {};
          return "function" == typeof e && this.listeners.hasOwnProperty(t) && this.listeners[t].push(e), this;
        }
      }, {
        key: "fire",
        value: function value(t) {
          var e = this,
              n = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : [];
          this.listeners.hasOwnProperty(t) && this.listeners[t].forEach(function (t) {
            "function" == typeof t && t.apply(e, n);
          });
        }
      }, {
        key: "create",
        value: function value() {
          console.log("NOT IMPLEMENTED YET");
        }
      }, {
        key: "isSupported",
        value: function value() {
          var t = !1;

          try {
            t = window.Notification || window.webkitNotifications || navigator.mozNotification || window.external && void 0 !== window.external.msIsSiteMode();
          } catch (t) {}

          return t;
        }
      }, {
        key: "getPermissionStatus",
        value: function value() {
          var t = "default";
          if (window.Notification && window.Notification.permissionLevel) t = window.Notification.permissionLevel;else if (window.webkitNotifications && window.webkitNotifications.checkPermission) switch (window.webkitNotifications.checkPermission()) {
            case 1:
              t = "default";
              break;

            case 0:
              t = "granted";
              break;

            default:
              t = "denied";
          } else window.Notification && window.Notification.permission ? t = window.Notification.permission : navigator.mozNotification ? t = "granted" : window.external && void 0 !== window.external.msIsSiteMode() && (t = window.external.msIsSiteMode() ? "granted" : "default");
          return t.toString().toLowerCase();
        }
      }, {
        key: "getEndpoint",
        value: function value(t) {
          var e = t.endpoint,
              n = t.subscriptionId;
          return n && -1 === e.indexOf(n) && (e += "/" + n), e;
        }
      }, {
        key: "isSWRegistered",
        value: function value() {
          try {
            return "activated" === navigator.serviceWorker.controller.state;
          } catch (t) {
            return !1;
          }
        }
      }, {
        key: "unregisterWorker",
        value: function value() {
          var t = this;
          "serviceWorker" in navigator && navigator.serviceWorker.getRegistrations().then(function (e) {
            var n = !0,
                o = !1,
                i = void 0;

            try {
              for (var r, s = e[Symbol.iterator](); !(n = (r = s.next()).done); n = !0) {
                r.value.unregister(), t.fire("onSubscriptionCancel");
              }
            } catch (t) {
              o = !0, i = t;
            } finally {
              try {
                !n && s.return && s.return();
              } finally {
                if (o) throw i;
              }
            }
          });
        }
      }, {
        key: "requestSubscription",
        value: function value() {
          var t = this,
              e = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0],
              n = this,
              o = this.getPermissionStatus(),
              i = function i(o) {
            "granted" === o ? (t.fire("onPermissionGranted"), "serviceWorker" in navigator ? navigator.serviceWorker.register(t.workerPath).then(function () {
              navigator.serviceWorker.ready.then(function (t) {
                n.fire("onWorkerSuccess"), t.pushManager.subscribe({
                  userVisibleOnly: e
                }).then(function (t) {
                  var e = t.getKey("p256dh"),
                      o = t.getKey("auth");
                  n.subData = {
                    endpoint: n.getEndpoint(t),
                    p256dh: e ? window.btoa(String.fromCharCode.apply(null, new Uint8Array(e))) : null,
                    auth: o ? window.btoa(String.fromCharCode.apply(null, new Uint8Array(o))) : null
                  }, n.fire("onSubscriptionSuccess", [n.subData]);
                }).catch(function (t) {
                  n.fire("onWorkerError", [t]);
                });
              });
            }) : n.fire("onWorkerNotSupported")) : "denied" === o && (t.fire("onPermissionDenied"), t.unregisterWorker());
          };

          "default" === o ? window.Notification && window.Notification.requestPermission ? window.Notification.requestPermission(i) : window.webkitNotifications && window.webkitNotifications.checkPermission && window.webkitNotifications.requestPermission(i) : i(o);
        }
      }]), t;
    }();
  }, function (t, e, n) {
    (function (e, o) {
      /*!
      * @overview es6-promise - a tiny implementation of Promises/A+.
      * @copyright Copyright (c) 2014 Yehuda Katz, Tom Dale, Stefan Penner and contributors (Conversion to ES6 API by Jake Archibald)
      * @license   Licensed under MIT license
      *            See https://raw.githubusercontent.com/stefanpenner/es6-promise/master/LICENSE
      * @version   4.1.1
      */
      !function (e, n) {
        t.exports = n();
      }(0, function () {
        "use strict";

        function t(t) {
          var e = _typeof(t);

          return null !== t && ("object" === e || "function" === e);
        }

        function i(t) {
          return "function" == typeof t;
        }

        function r(t) {
          z = t;
        }

        function s(t) {
          U = t;
        }

        function u() {
          return void 0 !== R ? function () {
            R(c);
          } : a();
        }

        function a() {
          var t = setTimeout;
          return function () {
            return t(c, 1);
          };
        }

        function c() {
          for (var t = 0; t < I; t += 2) {
            (0, X[t])(X[t + 1]), X[t] = void 0, X[t + 1] = void 0;
          }

          I = 0;
        }

        function l(t, e) {
          var n = arguments,
              o = this,
              i = new this.constructor(f);
          void 0 === i[tt] && A(i);
          var r = o._state;
          return r ? function () {
            var t = n[r - 1];
            U(function () {
              return P(r, i, t, o._result);
            });
          }() : S(o, i, t, e), i;
        }

        function d(t) {
          var e = this;
          if (t && "object" == _typeof(t) && t.constructor === e) return t;
          var n = new e(f);
          return g(n, t), n;
        }

        function f() {}

        function h() {
          return new TypeError("You cannot resolve a promise with itself");
        }

        function p() {
          return new TypeError("A promises callback cannot return that same promise.");
        }

        function m(t) {
          try {
            return t.then;
          } catch (t) {
            return it.error = t, it;
          }
        }

        function v(t, e, n, o) {
          try {
            t.call(e, n, o);
          } catch (t) {
            return t;
          }
        }

        function y(t, e, n) {
          U(function (t) {
            var o = !1,
                i = v(n, e, function (n) {
              o || (o = !0, e !== n ? g(t, n) : k(t, n));
            }, function (e) {
              o || (o = !0, C(t, e));
            }, "Settle: " + (t._label || " unknown promise"));
            !o && i && (o = !0, C(t, i));
          }, t);
        }

        function b(t, e) {
          e._state === nt ? k(t, e._result) : e._state === ot ? C(t, e._result) : S(e, void 0, function (e) {
            return g(t, e);
          }, function (e) {
            return C(t, e);
          });
        }

        function w(t, e, n) {
          e.constructor === t.constructor && n === l && e.constructor.resolve === d ? b(t, e) : n === it ? (C(t, it.error), it.error = null) : void 0 === n ? k(t, e) : i(n) ? y(t, e, n) : k(t, e);
        }

        function g(e, n) {
          e === n ? C(e, h()) : t(n) ? w(e, n, m(n)) : k(e, n);
        }

        function _(t) {
          t._onerror && t._onerror(t._result), D(t);
        }

        function k(t, e) {
          t._state === et && (t._result = e, t._state = nt, 0 !== t._subscribers.length && U(D, t));
        }

        function C(t, e) {
          t._state === et && (t._state = ot, t._result = e, U(_, t));
        }

        function S(t, e, n, o) {
          var i = t._subscribers,
              r = i.length;
          t._onerror = null, i[r] = e, i[r + nt] = n, i[r + ot] = o, 0 === r && t._state && U(D, t);
        }

        function D(t) {
          var e = t._subscribers,
              n = t._state;

          if (0 !== e.length) {
            for (var o = void 0, i = void 0, r = t._result, s = 0; s < e.length; s += 3) {
              o = e[s], i = e[s + n], o ? P(n, o, i, r) : i(r);
            }

            t._subscribers.length = 0;
          }
        }

        function x() {
          this.error = null;
        }

        function E(t, e) {
          try {
            return t(e);
          } catch (t) {
            return rt.error = t, rt;
          }
        }

        function P(t, e, n, o) {
          var r = i(n),
              s = void 0,
              u = void 0,
              a = void 0,
              c = void 0;

          if (r) {
            if (s = E(n, o), s === rt ? (c = !0, u = s.error, s.error = null) : a = !0, e === s) return void C(e, p());
          } else s = o, a = !0;

          e._state !== et || (r && a ? g(e, s) : c ? C(e, u) : t === nt ? k(e, s) : t === ot && C(e, s));
        }

        function T(t, e) {
          try {
            e(function (e) {
              g(t, e);
            }, function (e) {
              C(t, e);
            });
          } catch (e) {
            C(t, e);
          }
        }

        function O() {
          return st++;
        }

        function A(t) {
          t[tt] = st++, t._state = void 0, t._result = void 0, t._subscribers = [];
        }

        function M(t, e) {
          this._instanceConstructor = t, this.promise = new t(f), this.promise[tt] || A(this.promise), F(e) ? (this.length = e.length, this._remaining = e.length, this._result = new Array(this.length), 0 === this.length ? k(this.promise, this._result) : (this.length = this.length || 0, this._enumerate(e), 0 === this._remaining && k(this.promise, this._result))) : C(this.promise, q());
        }

        function q() {
          return new Error("Array Methods must be provided an Array");
        }

        function j(t) {
          return new M(this, t).promise;
        }

        function N(t) {
          var e = this;
          return new e(F(t) ? function (n, o) {
            for (var i = t.length, r = 0; r < i; r++) {
              e.resolve(t[r]).then(n, o);
            }
          } : function (t, e) {
            return e(new TypeError("You must pass an array to race."));
          });
        }

        function L(t) {
          var e = this,
              n = new e(f);
          return C(n, t), n;
        }

        function H() {
          throw new TypeError("You must pass a resolver function as the first argument to the promise constructor");
        }

        function W() {
          throw new TypeError("Failed to construct 'Promise': Please use the 'new' operator, this object constructor cannot be called as a function.");
        }

        function Q(t) {
          this[tt] = O(), this._result = this._state = void 0, this._subscribers = [], f !== t && ("function" != typeof t && H(), this instanceof Q ? T(this, t) : W());
        }

        function V() {
          var t = void 0;
          if (void 0 !== o) t = o;else if ("undefined" != typeof self) t = self;else try {
            t = Function("return this")();
          } catch (t) {
            throw new Error("polyfill failed because global object is unavailable in this environment");
          }
          var e = t.Promise;

          if (e) {
            var n = null;

            try {
              n = Object.prototype.toString.call(e.resolve());
            } catch (t) {}

            if ("[object Promise]" === n && !e.cast) return;
          }

          t.Promise = Q;
        }

        var B = void 0;
        B = Array.isArray ? Array.isArray : function (t) {
          return "[object Array]" === Object.prototype.toString.call(t);
        };

        var F = B,
            I = 0,
            R = void 0,
            z = void 0,
            U = function U(t, e) {
          X[I] = t, X[I + 1] = e, 2 === (I += 2) && (z ? z(c) : Z());
        },
            Y = "undefined" != typeof window ? window : void 0,
            K = Y || {},
            G = K.MutationObserver || K.WebKitMutationObserver,
            $ = "undefined" == typeof self && void 0 !== e && "[object process]" === {}.toString.call(e),
            J = "undefined" != typeof Uint8ClampedArray && "undefined" != typeof importScripts && "undefined" != typeof MessageChannel,
            X = new Array(1e3),
            Z = void 0;

        Z = $ ? function () {
          return function () {
            return e.nextTick(c);
          };
        }() : G ? function () {
          var t = 0,
              e = new G(c),
              n = document.createTextNode("");
          return e.observe(n, {
            characterData: !0
          }), function () {
            n.data = t = ++t % 2;
          };
        }() : J ? function () {
          var t = new MessageChannel();
          return t.port1.onmessage = c, function () {
            return t.port2.postMessage(0);
          };
        }() : void 0 === Y ? function () {
          try {
            var t = n(9);
            return R = t.runOnLoop || t.runOnContext, u();
          } catch (t) {
            return a();
          }
        }() : a();
        var tt = Math.random().toString(36).substring(16),
            et = void 0,
            nt = 1,
            ot = 2,
            it = new x(),
            rt = new x(),
            st = 0;
        return M.prototype._enumerate = function (t) {
          for (var e = 0; this._state === et && e < t.length; e++) {
            this._eachEntry(t[e], e);
          }
        }, M.prototype._eachEntry = function (t, e) {
          var n = this._instanceConstructor,
              o = n.resolve;

          if (o === d) {
            var i = m(t);
            if (i === l && t._state !== et) this._settledAt(t._state, e, t._result);else if ("function" != typeof i) this._remaining--, this._result[e] = t;else if (n === Q) {
              var r = new n(f);
              w(r, t, i), this._willSettleAt(r, e);
            } else this._willSettleAt(new n(function (e) {
              return e(t);
            }), e);
          } else this._willSettleAt(o(t), e);
        }, M.prototype._settledAt = function (t, e, n) {
          var o = this.promise;
          o._state === et && (this._remaining--, t === ot ? C(o, n) : this._result[e] = n), 0 === this._remaining && k(o, this._result);
        }, M.prototype._willSettleAt = function (t, e) {
          var n = this;
          S(t, void 0, function (t) {
            return n._settledAt(nt, e, t);
          }, function (t) {
            return n._settledAt(ot, e, t);
          });
        }, Q.all = j, Q.race = N, Q.resolve = d, Q.reject = L, Q._setScheduler = r, Q._setAsap = s, Q._asap = U, Q.prototype = {
          constructor: Q,
          then: l,
          catch: function _catch(t) {
            return this.then(null, t);
          }
        }, Q.polyfill = V, Q.Promise = Q, Q;
      });
    }).call(e, n(7), n(8));
  }, function (t, e) {}, function (t, e, n) {
    "use strict";

    function o(t) {
      if (t && t.__esModule) return t;
      var e = {};
      if (null != t) for (var n in t) {
        Object.prototype.hasOwnProperty.call(t, n) && (e[n] = t[n]);
      }
      return e.default = t, e;
    }

    function i(t, e) {
      if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function");
    }

    Object.defineProperty(e, "__esModule", {
      value: !0
    });

    var r = function () {
      function t(t, e) {
        for (var n = 0; n < e.length; n++) {
          var o = e[n];
          o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(t, o.key, o);
        }
      }

      return function (e, n, o) {
        return n && t(e.prototype, n), o && t(e, o), e;
      };
    }();

    n(5);

    var s = n(4),
        u = function (t) {
      return t && t.__esModule ? t : {
        default: t
      };
    }(s),
        a = n(0),
        c = o(a),
        l = n(1),
        d = o(l),
        f = n(2),
        h = n(3),
        p = function () {
      function t() {
        var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
        return i(this, t), this.options = c.deepExtend({}, d.Defaults, e), d.Store[this.options.id] ? d.Store[this.options.id] : (this.id = this.options.id || c.generateID("bar"), this.closeTimer = -1, this.barDom = null, this.layoutDom = null, this.progressDom = null, this.showing = !1, this.shown = !1, this.closed = !1, this.closing = !1, this.killable = this.options.timeout || this.options.closeWith.length > 0, this.hasSound = this.options.sounds.sources.length > 0, this.soundPlayed = !1, this.listeners = {
          beforeShow: [],
          onShow: [],
          afterShow: [],
          onClose: [],
          afterClose: [],
          onClick: [],
          onHover: [],
          onTemplate: []
        }, this.promises = {
          show: null,
          close: null
        }, this.on("beforeShow", this.options.callbacks.beforeShow), this.on("onShow", this.options.callbacks.onShow), this.on("afterShow", this.options.callbacks.afterShow), this.on("onClose", this.options.callbacks.onClose), this.on("afterClose", this.options.callbacks.afterClose), this.on("onClick", this.options.callbacks.onClick), this.on("onHover", this.options.callbacks.onHover), this.on("onTemplate", this.options.callbacks.onTemplate), this);
      }

      return r(t, [{
        key: "on",
        value: function value(t) {
          var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : function () {};
          return "function" == typeof e && this.listeners.hasOwnProperty(t) && this.listeners[t].push(e), this;
        }
      }, {
        key: "show",
        value: function value() {
          var e = this;
          if (this.showing || this.shown) return this;
          !0 === this.options.killer ? t.closeAll() : "string" == typeof this.options.killer && t.closeAll(this.options.killer);
          var n = d.getQueueCounts(this.options.queue);
          if (n.current >= n.maxVisible || d.PageHidden && this.options.visibilityControl) return d.addToQueue(this), d.PageHidden && this.hasSound && c.inArray("docHidden", this.options.sounds.conditions) && c.createAudioElements(this), d.PageHidden && c.inArray("docHidden", this.options.titleCount.conditions) && d.docTitle.increment(), this;
          if (d.Store[this.id] = this, d.fire(this, "beforeShow"), this.showing = !0, this.closing) return this.showing = !1, this;

          if (d.build(this), d.handleModal(this), this.options.force ? this.layoutDom.insertBefore(this.barDom, this.layoutDom.firstChild) : this.layoutDom.appendChild(this.barDom), this.hasSound && !this.soundPlayed && c.inArray("docVisible", this.options.sounds.conditions) && c.createAudioElements(this), c.inArray("docVisible", this.options.titleCount.conditions) && d.docTitle.increment(), this.shown = !0, this.closed = !1, d.hasButtons(this) && Object.keys(this.options.buttons).forEach(function (t) {
            var n = e.barDom.querySelector("#" + e.options.buttons[t].id);
            c.addListener(n, "click", function (n) {
              c.stopPropagation(n), e.options.buttons[t].cb(e);
            });
          }), this.progressDom = this.barDom.querySelector(".noty_progressbar"), c.inArray("click", this.options.closeWith) && (c.addClass(this.barDom, "noty_close_with_click"), c.addListener(this.barDom, "click", function (t) {
            c.stopPropagation(t), d.fire(e, "onClick"), e.close();
          }, !1)), c.addListener(this.barDom, "mouseenter", function () {
            d.fire(e, "onHover");
          }, !1), this.options.timeout && c.addClass(this.barDom, "noty_has_timeout"), this.options.progressBar && c.addClass(this.barDom, "noty_has_progressbar"), c.inArray("button", this.options.closeWith)) {
            c.addClass(this.barDom, "noty_close_with_button");
            var o = document.createElement("div");
            c.addClass(o, "noty_close_button"), o.innerHTML = "×", this.barDom.appendChild(o), c.addListener(o, "click", function (t) {
              c.stopPropagation(t), e.close();
            }, !1);
          }

          return d.fire(this, "onShow"), null === this.options.animation.open ? this.promises.show = new u.default(function (t) {
            t();
          }) : "function" == typeof this.options.animation.open ? this.promises.show = new u.default(this.options.animation.open.bind(this)) : (c.addClass(this.barDom, this.options.animation.open), this.promises.show = new u.default(function (t) {
            c.addListener(e.barDom, c.animationEndEvents, function () {
              c.removeClass(e.barDom, e.options.animation.open), t();
            });
          })), this.promises.show.then(function () {
            var t = e;
            setTimeout(function () {
              d.openFlow(t);
            }, 100);
          }), this;
        }
      }, {
        key: "stop",
        value: function value() {
          return d.dequeueClose(this), this;
        }
      }, {
        key: "resume",
        value: function value() {
          return d.queueClose(this), this;
        }
      }, {
        key: "setTimeout",
        value: function (t) {
          function e(e) {
            return t.apply(this, arguments);
          }

          return e.toString = function () {
            return t.toString();
          }, e;
        }(function (t) {
          if (this.stop(), this.options.timeout = t, this.barDom) {
            this.options.timeout ? c.addClass(this.barDom, "noty_has_timeout") : c.removeClass(this.barDom, "noty_has_timeout");
            var e = this;
            setTimeout(function () {
              e.resume();
            }, 100);
          }

          return this;
        })
      }, {
        key: "setText",
        value: function value(t) {
          var e = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
          return this.barDom && (this.barDom.querySelector(".noty_body").innerHTML = t), e && (this.options.text = t), this;
        }
      }, {
        key: "setType",
        value: function value(t) {
          var e = this,
              n = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];

          if (this.barDom) {
            c.classList(this.barDom).split(" ").forEach(function (t) {
              "noty_type__" === t.substring(0, 11) && c.removeClass(e.barDom, t);
            }), c.addClass(this.barDom, "noty_type__" + t);
          }

          return n && (this.options.type = t), this;
        }
      }, {
        key: "setTheme",
        value: function value(t) {
          var e = this,
              n = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];

          if (this.barDom) {
            c.classList(this.barDom).split(" ").forEach(function (t) {
              "noty_theme__" === t.substring(0, 12) && c.removeClass(e.barDom, t);
            }), c.addClass(this.barDom, "noty_theme__" + t);
          }

          return n && (this.options.theme = t), this;
        }
      }, {
        key: "close",
        value: function value() {
          var t = this;
          return this.closed ? this : this.shown ? (d.fire(this, "onClose"), this.closing = !0, null === this.options.animation.close || !1 === this.options.animation.close ? this.promises.close = new u.default(function (t) {
            t();
          }) : "function" == typeof this.options.animation.close ? this.promises.close = new u.default(this.options.animation.close.bind(this)) : (c.addClass(this.barDom, this.options.animation.close), this.promises.close = new u.default(function (e) {
            c.addListener(t.barDom, c.animationEndEvents, function () {
              t.options.force ? c.remove(t.barDom) : d.ghostFix(t), e();
            });
          })), this.promises.close.then(function () {
            d.closeFlow(t), d.handleModalClose(t);
          }), this.closed = !0, this) : (d.removeFromQueue(this), this);
        }
      }], [{
        key: "closeAll",
        value: function value() {
          var t = arguments.length > 0 && void 0 !== arguments[0] && arguments[0];
          return Object.keys(d.Store).forEach(function (e) {
            t ? d.Store[e].options.queue === t && d.Store[e].killable && d.Store[e].close() : d.Store[e].killable && d.Store[e].close();
          }), this;
        }
      }, {
        key: "clearQueue",
        value: function value() {
          var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "global";
          return d.Queues.hasOwnProperty(t) && (d.Queues[t].queue = []), this;
        }
      }, {
        key: "overrideDefaults",
        value: function value(t) {
          return d.Defaults = c.deepExtend({}, d.Defaults, t), this;
        }
      }, {
        key: "setMaxVisible",
        value: function value() {
          var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : d.DefaultMaxVisible,
              e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "global";
          return d.Queues.hasOwnProperty(e) || (d.Queues[e] = {
            maxVisible: t,
            queue: []
          }), d.Queues[e].maxVisible = t, this;
        }
      }, {
        key: "button",
        value: function value(t) {
          var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : null,
              n = arguments[2],
              o = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {};
          return new f.NotyButton(t, e, n, o);
        }
      }, {
        key: "version",
        value: function value() {
          return "3.2.0-beta";
        }
      }, {
        key: "Push",
        value: function value(t) {
          return new h.Push(t);
        }
      }, {
        key: "Queues",
        get: function get() {
          return d.Queues;
        }
      }, {
        key: "PageHidden",
        get: function get() {
          return d.PageHidden;
        }
      }]), t;
    }();

    e.default = p, "undefined" != typeof window && c.visibilityChangeFlow(), t.exports = e.default;
  }, function (t, e) {
    function n() {
      throw new Error("setTimeout has not been defined");
    }

    function o() {
      throw new Error("clearTimeout has not been defined");
    }

    function i(t) {
      if (l === setTimeout) return setTimeout(t, 0);
      if ((l === n || !l) && setTimeout) return l = setTimeout, setTimeout(t, 0);

      try {
        return l(t, 0);
      } catch (e) {
        try {
          return l.call(null, t, 0);
        } catch (e) {
          return l.call(this, t, 0);
        }
      }
    }

    function r(t) {
      if (d === clearTimeout) return clearTimeout(t);
      if ((d === o || !d) && clearTimeout) return d = clearTimeout, clearTimeout(t);

      try {
        return d(t);
      } catch (e) {
        try {
          return d.call(null, t);
        } catch (e) {
          return d.call(this, t);
        }
      }
    }

    function s() {
      m && h && (m = !1, h.length ? p = h.concat(p) : v = -1, p.length && u());
    }

    function u() {
      if (!m) {
        var t = i(s);
        m = !0;

        for (var e = p.length; e;) {
          for (h = p, p = []; ++v < e;) {
            h && h[v].run();
          }

          v = -1, e = p.length;
        }

        h = null, m = !1, r(t);
      }
    }

    function a(t, e) {
      this.fun = t, this.array = e;
    }

    function c() {}

    var l,
        d,
        f = t.exports = {};
    !function () {
      try {
        l = "function" == typeof setTimeout ? setTimeout : n;
      } catch (t) {
        l = n;
      }

      try {
        d = "function" == typeof clearTimeout ? clearTimeout : o;
      } catch (t) {
        d = o;
      }
    }();
    var h,
        p = [],
        m = !1,
        v = -1;
    f.nextTick = function (t) {
      var e = new Array(arguments.length - 1);
      if (arguments.length > 1) for (var n = 1; n < arguments.length; n++) {
        e[n - 1] = arguments[n];
      }
      p.push(new a(t, e)), 1 !== p.length || m || i(u);
    }, a.prototype.run = function () {
      this.fun.apply(null, this.array);
    }, f.title = "browser", f.browser = !0, f.env = {}, f.argv = [], f.version = "", f.versions = {}, f.on = c, f.addListener = c, f.once = c, f.off = c, f.removeListener = c, f.removeAllListeners = c, f.emit = c, f.prependListener = c, f.prependOnceListener = c, f.listeners = function (t) {
      return [];
    }, f.binding = function (t) {
      throw new Error("process.binding is not supported");
    }, f.cwd = function () {
      return "/";
    }, f.chdir = function (t) {
      throw new Error("process.chdir is not supported");
    }, f.umask = function () {
      return 0;
    };
  }, function (t, e) {
    var n;

    n = function () {
      return this;
    }();

    try {
      n = n || Function("return this")() || (0, eval)("this");
    } catch (t) {
      "object" == (typeof window === "undefined" ? "undefined" : _typeof(window)) && (n = window);
    }

    t.exports = n;
  }, function (t, e) {}]);
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../node_modules/webpack/buildin/module.js */ "./node_modules/webpack/buildin/module.js")(module)))

/***/ }),

/***/ "./resources/js/svaigi.js":
/*!********************************!*\
  !*** ./resources/js/svaigi.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

svaigi = {
  showMessage: function showMessage(message, messageType, messageTimeout, messageLayout) {
    if (!message) {
      return;
    }

    if (typeof messageTimeout === "undefined") {
      messageTimeout = 3000;
    }

    if (typeof messageType === "undefined") {
      messageType = "info";
    }

    if (typeof messageLayout === "undefined") {
      messageLayout = "bottomRight";
    }

    err = new Noty({
      theme: "bootstrap-v4",
      type: messageType,
      layout: messageLayout,
      text: message,
      timeout: messageTimeout
    }).show();
  }
};
module.exports = svaigi;

/***/ }),

/***/ 0:
/*!***********************************!*\
  !*** multi ./resources/js/app.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ya/projects/marine/resources/js/app.js */"./resources/js/app.js");


/***/ })

/******/ });