"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_layouts_admin_userView_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/layouts/admin/userView.vue?vue&type=script&lang=js":
/*!*****************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/layouts/admin/userView.vue?vue&type=script&lang=js ***!
  \*****************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _common_apiService__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../common/apiService */ "./resources/js/layouts/common/apiService.js");
/* harmony import */ var _store_url__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../store/url */ "./resources/js/layouts/store/url.js");
/* harmony import */ var vue_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vue-router */ "./node_modules/vue-router/dist/vue-router.esm-bundler.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, "_invoke", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, "_invoke", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var methodName = context.method, method = delegate.iterator[methodName]; if (undefined === method) return context.delegate = null, "throw" === methodName && delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method) || "return" !== methodName && (context.method = "throw", context.arg = new TypeError("The iterator does not provide a '" + methodName + "' method")), ContinueSentinel; var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) keys.push(key); return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }




/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  setup: function setup() {
    var search = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
      search: ""
    });
    var form = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
      sex: "",
      department_id: "",
      position: "",
      age: "",
      permanent_address: "",
      temporary_address: "",
      cccd: "",
      date_range: "",
      issued_by: "",
      tax_code: "",
      leave_days: ""
    });
    var user = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)([]);
    var filename = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)("");
    var fileInput = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var file = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var headers = _common_apiService__WEBPACK_IMPORTED_MODULE_1__["default"].setHeader();
    var router = (0,vue_router__WEBPACK_IMPORTED_MODULE_3__.useRouter)();
    var departments = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)([]);
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)( /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
      var id, res, response, data;
      return _regeneratorRuntime().wrap(function _callee$(_context) {
        while (1) switch (_context.prev = _context.next) {
          case 0:
            _context.prev = 0;
            id = router.currentRoute.value.params.id;
            _context.next = 4;
            return _common_apiService__WEBPACK_IMPORTED_MODULE_1__["default"].getParameter(_store_url__WEBPACK_IMPORTED_MODULE_2__.GET_USER, id, {
              headers: headers
            });
          case 4:
            res = _context.sent;
            _context.next = 7;
            return _common_apiService__WEBPACK_IMPORTED_MODULE_1__["default"].get(_store_url__WEBPACK_IMPORTED_MODULE_2__.DEPARTMENT_GETS, {
              headers: headers
            });
          case 7:
            response = _context.sent;
            departments.value = response.data[0];
            if (res) {
              data = res.data.data;
              user.value = data;
              filename.value = "../../../storage/" + data.avatar;
              Object.assign(form, {
                sex: data.sex,
                department_id: data.department_id,
                position: data.position,
                age: data.age.substring(0, 10),
                permanent_address: data.permanent_address,
                temporary_address: data.temporary_address,
                cccd: data.cccd,
                date_range: data.date_range.substring(0, 10),
                issued_by: data.issued_by,
                tax_code: data.tax_code,
                phone: data.phone,
                project: data.project,
                leave_days: data.leave_days
              });
            }
            _context.next = 14;
            break;
          case 12:
            _context.prev = 12;
            _context.t0 = _context["catch"](0);
          case 14:
          case "end":
            return _context.stop();
        }
      }, _callee, null, [[0, 12]]);
    })));
    var updateProfile = /*#__PURE__*/function () {
      var _ref2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2() {
        var id, formData, updateUser;
        return _regeneratorRuntime().wrap(function _callee2$(_context2) {
          while (1) switch (_context2.prev = _context2.next) {
            case 0:
              _context2.prev = 0;
              id = router.currentRoute.value.params.id;
              formData = new FormData();
              formData.append("image_data", file.value);
              _context2.next = 6;
              return _common_apiService__WEBPACK_IMPORTED_MODULE_1__["default"].putMember(_store_url__WEBPACK_IMPORTED_MODULE_2__.API_UPDATE_MEMBER, id, form, {
                headers: headers
              });
            case 6:
              updateUser = _context2.sent;
              if (updateUser != null) {
                alert("Update successful!");
              }
              _context2.next = 12;
              break;
            case 10:
              _context2.prev = 10;
              _context2.t0 = _context2["catch"](0);
            case 12:
            case "end":
              return _context2.stop();
          }
        }, _callee2, null, [[0, 10]]);
      }));
      return function updateProfile() {
        return _ref2.apply(this, arguments);
      };
    }();
    return {
      search: search,
      form: form,
      user: user,
      updateProfile: updateProfile,
      filename: filename,
      fileInput: fileInput,
      departments: departments
    };
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/layouts/admin/userView.vue?vue&type=template&id=1ef3ed14":
/*!*********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/layouts/admin/userView.vue?vue&type=template&id=1ef3ed14 ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "col-sm-12"
};
var _hoisted_2 = {
  "class": "panel"
};
var _hoisted_3 = {
  "class": "panel-container"
};
var _hoisted_4 = {
  "class": "panel-content"
};
var _hoisted_5 = {
  "class": "form-group"
};
var _hoisted_6 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "col-md-12"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "translation_missing"
}, "Avatar")])], -1 /* HOISTED */);
var _hoisted_7 = {
  "class": "form-row"
};
var _hoisted_8 = {
  "class": "col-sm-6"
};
var _hoisted_9 = ["src"];
var _hoisted_10 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("br", null, null, -1 /* HOISTED */);
var _hoisted_11 = {
  "class": "form-group"
};
var _hoisted_12 = {
  "class": "col-md-4"
};
var _hoisted_13 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Tên")], -1 /* HOISTED */);
var _hoisted_14 = {
  "class": "frame-wrap d-flex"
};
var _hoisted_15 = {
  "class": "form-check"
};
var _hoisted_16 = {
  "class": "form-check-label",
  "for": "flexRadioDefault2"
};
var _hoisted_17 = {
  "class": "form-group"
};
var _hoisted_18 = {
  "class": "col-md-4"
};
var _hoisted_19 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Giới tính")], -1 /* HOISTED */);
var _hoisted_20 = {
  "class": "frame-wrap d-flex"
};
var _hoisted_21 = {
  "class": "form-check",
  style: {
    "margin-right": "20px"
  }
};
var _hoisted_22 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-check-label",
  "for": "flexRadioDefault1"
}, "Nam", -1 /* HOISTED */);
var _hoisted_23 = {
  "class": "form-check"
};
var _hoisted_24 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-check-label",
  "for": "flexRadioDefault2"
}, "Nữ ", -1 /* HOISTED */);
var _hoisted_25 = {
  "class": "form-group"
};
var _hoisted_26 = {
  "class": "col-md-2"
};
var _hoisted_27 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "form-gruop"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Bộ phận")], -1 /* HOISTED */);
var _hoisted_28 = ["value"];
var _hoisted_29 = {
  "class": "col-md-2"
};
var _hoisted_30 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "form-gruop"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Vị trí")], -1 /* HOISTED */);
var _hoisted_31 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<option selected=\"selected\" value=\"ceo\">CEO</option><option value=\"dl\">Division Leader</option><option value=\"sgl\">Support Group Leader</option><option value=\"tl\">Technical Leader</option><option value=\"vdl\">Vice Division Leader</option><option value=\"tld\">Team Leader</option><option value=\"dev\">Developer</option><option value=\"comtor\">Comtor</option><option value=\"tester\">Tester</option><option value=\"hr\">Human Resources</option><option value=\"acc\">Accountant</option><option value=\"ad\">Admin</option><option value=\"incom\">Internal Communication</option><option value=\"intern\">Intern</option><option value=\"fl\">Freelancer</option>", 15);
var _hoisted_46 = [_hoisted_31];
var _hoisted_47 = {
  "class": "col-md-4"
};
var _hoisted_48 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "form-gruop"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Ngày sinh")], -1 /* HOISTED */);
var _hoisted_49 = {
  "class": "form-group"
};
var _hoisted_50 = {
  "class": "col-md-6"
};
var _hoisted_51 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "form-gruop"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Địa chỉ thường trú")], -1 /* HOISTED */);
var _hoisted_52 = {
  "class": "col-md-6"
};
var _hoisted_53 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "form-gruop"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Địa chỉ tạm trú")], -1 /* HOISTED */);
var _hoisted_54 = {
  "class": "form-group"
};
var _hoisted_55 = {
  "class": "col-md-6"
};
var _hoisted_56 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "form-gruop"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Số CCCD")], -1 /* HOISTED */);
var _hoisted_57 = {
  "class": "col-md-6"
};
var _hoisted_58 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "form-gruop"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Ngày cấp")], -1 /* HOISTED */);
var _hoisted_59 = {
  "class": "form-group"
};
var _hoisted_60 = {
  "class": "col-md-6"
};
var _hoisted_61 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "form-gruop"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Số diện thoại")], -1 /* HOISTED */);
var _hoisted_62 = {
  "class": "col-md-6"
};
var _hoisted_63 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "form-gruop"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Project")], -1 /* HOISTED */);
var _hoisted_64 = {
  "class": "form-group"
};
var _hoisted_65 = {
  "class": "col-md-6"
};
var _hoisted_66 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "form-gruop"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Nơi cấp")], -1 /* HOISTED */);
var _hoisted_67 = {
  "class": "col-md-6"
};
var _hoisted_68 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "form-gruop"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Mã số thuế")], -1 /* HOISTED */);
var _hoisted_69 = {
  "class": "form-group"
};
var _hoisted_70 = {
  "class": "col-md-6"
};
var _hoisted_71 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "form-gruop"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-label"
}, "Số ngày phép")], -1 /* HOISTED */);
var _hoisted_72 = {
  style: {
    "padding-bottom": "40px"
  }
};
var _hoisted_73 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "col-md-1"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
  type: "submit",
  "class": "btn btn-success waves-effect waves-themed",
  style: {}
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
  "class": "fal fa-save"
}), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Lưu ")])], -1 /* HOISTED */);
var _hoisted_74 = {
  "class": "col-md-3"
};
var _hoisted_75 = {
  key: 0,
  "class": "btn btn-success waves-effect waves-themed",
  type: "button",
  "data-toggle": "tooltip",
  "data-placement": "top"
};
var _hoisted_76 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  style: {
    "color": "white"
  }
}, "Thêm tài sản sử dụng", -1 /* HOISTED */);

function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_router_link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("router-link");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", {
    "class": "form-horizontal",
    onSubmit: _cache[14] || (_cache[14] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
      return $setup.updateProfile && $setup.updateProfile.apply($setup, arguments);
    }, ["prevent"])),
    enctype: "multipart/form-data",
    style: {
      "padding": "20px 0px 20px 20px"
    }
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [_hoisted_6, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
    src: $setup.filename,
    alt: "Avatar Image",
    style: {
      "width": "250px",
      "height": "auto",
      "margin-bottom": "20px"
    }
  }, null, 8 /* PROPS */, _hoisted_9), _hoisted_10])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [_hoisted_13, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_16, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.user.name), 1 /* TEXT */)])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_17, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [_hoisted_19, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_20, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_21, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "radio",
    name: "flexRadioDefault",
    id: "flexRadioDefault1",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $setup.form.sex = $event;
    }),
    value: "Nam"
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.form.sex]]), _hoisted_22]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "radio",
    name: "flexRadioDefault",
    id: "flexRadioDefault2",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $setup.form.sex = $event;
    }),
    value: "Nữ"
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.form.sex]]), _hoisted_24])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_25, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [_hoisted_27, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": "form-control",
    "aria-label": "Default select example",
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $setup.form.department_id = $event;
    })
  }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.departments, function (option) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: option.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(option.name), 9 /* TEXT, PROPS */, _hoisted_28);
  }), 256 /* UNKEYED_FRAGMENT */))], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $setup.form.department_id]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [_hoisted_30, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": "form-control",
    "aria-label": "Default select example",
    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
      return $setup.form.position = $event;
    })
  }, _hoisted_46, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $setup.form.position]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_47, [_hoisted_48, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control datetimepicker",
    type: "date",
    required: "",
    "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
      return $setup.form.age = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.form.age]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_49, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [_hoisted_51, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "class": "form-control",
    required: "",
    "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
      return $setup.form.permanent_address = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.form.permanent_address]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_52, [_hoisted_53, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "class": "form-control",
    required: "",
    "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
      return $setup.form.temporary_address = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.form.temporary_address]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_54, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_55, [_hoisted_56, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "class": "form-control",
    required: "",
    "onUpdate:modelValue": _cache[7] || (_cache[7] = function ($event) {
      return $setup.form.cccd = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.form.cccd]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_57, [_hoisted_58, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control datetimepicker",
    type: "date",
    required: "",
    "onUpdate:modelValue": _cache[8] || (_cache[8] = function ($event) {
      return $setup.form.date_range = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.form.date_range]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_59, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_60, [_hoisted_61, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "class": "form-control",
    required: "",
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $setup.form.phone = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.form.phone]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_62, [_hoisted_63, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    required: "",
    "onUpdate:modelValue": _cache[10] || (_cache[10] = function ($event) {
      return $setup.form.project = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.form.project]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_64, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_65, [_hoisted_66, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "class": "form-control",
    required: "",
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $setup.form.issued_by = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.form.issued_by]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_67, [_hoisted_68, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "class": "form-control",
    required: "",
    "onUpdate:modelValue": _cache[12] || (_cache[12] = function ($event) {
      return $setup.form.tax_code = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.form.tax_code]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_69, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_70, [_hoisted_71, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "number",
    "class": "form-control",
    required: "",
    "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
      return $setup.form.leave_days = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.form.leave_days]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_72, [_hoisted_73, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_74, [$setup.user.id ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", _hoisted_75, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
    to: {
      name: 'asset-user',
      params: {
        id: $setup.user.id
      }
    }
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [_hoisted_76];
    }),
    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["to"])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])], 32 /* HYDRATE_EVENTS */)])])])]);
}

/***/ }),

/***/ "./resources/js/layouts/common/apiService.js":
/*!***************************************************!*\
  !*** ./resources/js/layouts/common/apiService.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "axiosClient": () => (/* binding */ axiosClient),
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _jwtService__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./jwtService */ "./resources/js/layouts/common/jwtService.js");
/* harmony import */ var _config__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./config */ "./resources/js/layouts/common/config.js");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
var _AppService;
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }




var axiosClient = axios__WEBPACK_IMPORTED_MODULE_0___default().create({
  baseURL: _config__WEBPACK_IMPORTED_MODULE_2__.API_URL
});
var AppService = (_AppService = {
  setHeader: function setHeader() {
    return Headers = {
      Authorization: "Bearer ".concat(JSON.parse(_jwtService__WEBPACK_IMPORTED_MODULE_1__["default"].getToken()))
    };
  },
  getTypeParameter: function getTypeParameter() {
    var url = window.location.href;
    var params = new URLSearchParams(window.location.search);
    var type = params.get("type");
    return type;
  },
  get: function get(resource, params) {
    return axiosClient.get("".concat(resource), params);
  },
  getParameter: function getParameter(resource, slug, params) {
    return axiosClient.get("".concat(resource, "/").concat(slug), params);
  },
  getNotWork: function getNotWork(resource, year, month, header) {
    return axiosClient.get("".concat(resource, "/").concat(year, "/").concat(month), header);
  },
  post: function post(resource, data) {
    return axiosClient.post("".concat(resource), data);
  },
  postAuth: function postAuth(resource, data, header) {
    return axiosClient.post("".concat(resource), data, header);
  },
  putAvatar: function putAvatar(resource, data, header) {
    return axiosClient.put("".concat(resource), data, header);
  },
  put: function put(resource, slug, header) {
    return axiosClient.put("".concat(resource, "/").concat(slug), header);
  },
  putMember: function putMember(resource, slug, form, header) {
    return axiosClient.put("".concat(resource, "/").concat(slug), form, header);
  },
  putStatus: function putStatus(resource, slug, status, header) {
    return axiosClient.put("".concat(resource, "/").concat(slug), status, header);
  }
}, _defineProperty(_AppService, "putStatus", function putStatus(resource, slug, status, header) {
  return axiosClient.put("".concat(resource, "/").concat(slug), status, header);
}), _defineProperty(_AppService, "patch", function patch(resource, slug, status, header) {
  return axiosClient.patch("".concat(resource, "/").concat(slug), status, header);
}), _defineProperty(_AppService, "delete", function _delete(resource, slug, header) {
  return axiosClient["delete"]("".concat(resource, "/").concat(slug), header);
}), _defineProperty(_AppService, "setDeadline", function setDeadline(contacts, assignee) {
  var timestamp = (0,vue__WEBPACK_IMPORTED_MODULE_3__.ref)("");
  var deadline = (0,vue__WEBPACK_IMPORTED_MODULE_3__.ref)("");
  var now = Date.now();
  contacts.value.forEach(function (element) {
    timestamp.value = element.created_at;
    var oneDay = 24 * 60 * 60 * 1000;
    var threeDays = 3 * oneDay;
    var date = new Date(timestamp.value);
    var expiredAt = date.getTime() + threeDays;

    //so sanh time  with now
    if (expiredAt < now) {
      element.deadline = "het han";
      element.assignee = assignee;
    } else {
      var newDate = new Date(expiredAt);
      var year = newDate.getFullYear();
      var month = newDate.getMonth() + 1; // Vì tháng được đếm từ 0 đến 11, ta cộng thêm 1
      var day = newDate.getDate();
      var hours = newDate.getHours();
      deadline.value = hours + "h " + day + "-" + month + "-" + year;
      //set contacts
      element.assignee = assignee;
      element.deadline = deadline.value;
    }
  });
}), _defineProperty(_AppService, "changeDepartment", function changeDepartment(users, departments) {
  var changes = {
    d1: "Division1",
    d2: "Division1",
    d3: "Division1"
  };
  users.forEach(function (item) {
    departments.forEach(function (department) {
      if (item.department_id === department.id) {
        item.department = department.name;
      }
    });
  });
  return users;
}), _defineProperty(_AppService, "changeStatusUser", function changeStatusUser(users, user) {
  users.forEach(function (item) {
    if (item.id === user.id) {
      item.status = user.status;
    }
  });
  return users;
}), _defineProperty(_AppService, "changeStatus", function changeStatus(contacts) {
  var changes = {
    1: "Chờ duyệt",
    2: "Xác nhận",
    3: "Đồng ý",
    4: "Từ chối",
    5: "Hủy"
  };
  var color = {
    1: "#66FFCC",
    2: "#CCFF00",
    3: "#62fc03",
    4: "#FF9966",
    5: "#FF6600"
  };
  contacts.forEach(function (item) {
    var _changes$item$status, _color$item$status;
    item.statuses = (_changes$item$status = changes[item.status]) !== null && _changes$item$status !== void 0 ? _changes$item$status : "Chờ duyệt";
    item.color = (_color$item$status = color[item.status]) !== null && _color$item$status !== void 0 ? _color$item$status : "#66FFCC";
  });
  return contacts;
}), _defineProperty(_AppService, "changeTypeRequest", function changeTypeRequest(contacts) {
  var changes = {
    1: "request thường",
    2: "request bù"
  };
  contacts.forEach(function (item) {
    var _changes$item$type;
    item.type = (_changes$item$type = changes[item.type]) !== null && _changes$item$type !== void 0 ? _changes$item$type : "pending";
  });
  return contacts;
}), _defineProperty(_AppService, "changeContent", function changeContent(contacts, assets) {
  var changes = {
    days_on: "Nghỉ phép có lương",
    days_off: "Nghỉ phép không lương",
    over_time: "Làm thêm giờ",
    take_device_out: "Mang thiết bị về nhà",
    forgot_to_check: "Cập nhật thời gian làm việc",
    device_recall: "Thu hồi thiết bị",
    special_take_leave: "Nghỉ việc riêng có lương"
  };
  if (assets === null) {
    var _changes$contacts$con;
    contacts.contents = (_changes$contacts$con = changes[contacts.content]) !== null && _changes$contacts$con !== void 0 ? _changes$contacts$con : "";
  } else {
    var _changes$contacts$con2;
    var content = assets.name + " " + assets.code;
    var contents = (_changes$contacts$con2 = changes[contacts.content]) !== null && _changes$contacts$con2 !== void 0 ? _changes$contacts$con2 : "";
    var set = contents + "-" + content;
    contacts.contents = set;
  }
  return contacts;
}), _defineProperty(_AppService, "getTimeCheck", function getTimeCheck(res, checks, color) {
  // TODO: checkIn

  // TODO: checkout
  color.check_in = "#1dc9b7";
  color.check_out = "#1dc9b7";

  // FIXME: loi nay
  var time_in = res.time_in;
  var date = new Date(time_in);
  var checkIn = String(date.getHours()).padStart(2, "0") + ":" + String(date.getMinutes()).padStart(2, "0");
  if (date.getHours() >= 9 && date.getMinutes() >= 1 || date.getHours() > 9) {
    color.check_in = "#fd3995";
  }
  checks.check_in = checkIn;
  if (res.time_out !== null) {
    var time_out = res.time_out;
    var date_out = new Date(time_out);
    if (date_out.getHours() < 17 || date_out.getHours() <= 17 && date_out.getMinutes() <= 30) {
      color.check_out = "#fd3995";
    }
    var checkout = String(date_out.getHours()).padStart(2, "0") + ":" + String(date_out.getMinutes()).padStart(2, "0");
    checks.check_out = checkout;
  }
}), _defineProperty(_AppService, "holiday", function holiday() {
  var holiday = {
    "2023-01-01": "Tết Dương Lịch",
    "2023-01-02": "Nghỉ Tết Dương Lịch",
    "2023-01-21": "Tết Nguyên Đán",
    "2023-01-22": "Tết Nguyên Đán",
    "2023-01-23": "Tết Nguyên Đán",
    "2023-01-24": "Tết Nguyên Đán",
    "2023-01-25": "Tết Nguyên Đán",
    "2023-01-26": "Tết Nguyên Đán",
    "2023-01-27": "Tết Nguyên Đán",
    "2023-04-29": "Giỗ Tổ Hùng Vương",
    "2023-04-30": "Ngày Thống nhất đất nước",
    "2023-05-01": "Ngày Quốc tế Lao động",
    "2023-05-02": "Nghỉ Giỗ Tổ Hùng Vương",
    "2023-05-03": "Nghỉ Ngày Thống nhất",
    "2023-09-02": "Ngày Quốc khánh",
    "2023-09-04": "Nghỉ Ngày Quốc khánh"
  };
  return holiday;
}), _defineProperty(_AppService, "now", function now() {
  var currentDate = new Date();
  var month = (currentDate.getMonth() + 1).toString().padStart(2, "0");
  var year = currentDate.getFullYear();
  var day = currentDate.getDate().toString().padStart(2, "0");
  return year + "-" + month + "-" + day;
}), _defineProperty(_AppService, "checkButton", function checkButton(timeKeep, showCheckOutButton, off, holiday, dataKeys) {
  var today = new Date().getDay();
  var now = AppService.now();
  if (today === 6 || today === 0 || Object.keys(holiday).includes(now)) {
    off.value = true;
  }
  if (timeKeep.data[timeKeep.data.length - 1].time_in !== null) {
    showCheckOutButton.value = false;
  }
  if (timeKeep.data[timeKeep.data.length - 1].time_in !== null && timeKeep.data[timeKeep.data.length - 1].time_out !== null) {
    off.value = true;
  }
  if (dataKeys.length === 0) {
    off.value = false;
    showCheckOutButton.value = true;
  }
}), _defineProperty(_AppService, "Onchange", function Onchange(event, active) {
  if (event.target.value === "days_on" || event.target.value === "days_off") {
    active.value = "days_on";
  }
  if (event.target.value === "forgot_to_check") {
    active.value = "";
    active.value = "forgot_to_check";
  }
  if (event.target.value === "over_time") {
    active.value = "";
    active.value = "over_time";
  }
  if (event.target.value === "special_take_leave") {
    active.value = "";
    active.value = "special_take_leave";
  }
  if (event.target.value === "take_device_out") {
    active.value = "";
    active.value = "take_device_out";
  }
  if (event.target.value === "device_recall") {
    active.value = "";
    active.value = "device_recall";
  }
  return active.value;
}), _AppService);
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (AppService);

/***/ }),

/***/ "./resources/js/layouts/common/config.js":
/*!***********************************************!*\
  !*** ./resources/js/layouts/common/config.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "API_URL": () => (/* binding */ API_URL),
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var API_URL = 'http://localhost:8080/';
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (API_URL);

/***/ }),

/***/ "./resources/js/layouts/store/url.js":
/*!*******************************************!*\
  !*** ./resources/js/layouts/store/url.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "API_ACTIVE_USER": () => (/* binding */ API_ACTIVE_USER),
/* harmony export */   "API_ASSETS_NEW": () => (/* binding */ API_ASSETS_NEW),
/* harmony export */   "API_AVATAR": () => (/* binding */ API_AVATAR),
/* harmony export */   "API_CHANGE_PASSWORD": () => (/* binding */ API_CHANGE_PASSWORD),
/* harmony export */   "API_CREATE_REQUEST": () => (/* binding */ API_CREATE_REQUEST),
/* harmony export */   "API_CREATE_TIME_KEEP": () => (/* binding */ API_CREATE_TIME_KEEP),
/* harmony export */   "API_DELETE_USER": () => (/* binding */ API_DELETE_USER),
/* harmony export */   "API_GET_ASSETS": () => (/* binding */ API_GET_ASSETS),
/* harmony export */   "API_GET_ASSETS_ID": () => (/* binding */ API_GET_ASSETS_ID),
/* harmony export */   "API_GET_NOT_WORK": () => (/* binding */ API_GET_NOT_WORK),
/* harmony export */   "API_GET_TIME_KEEP": () => (/* binding */ API_GET_TIME_KEEP),
/* harmony export */   "API_GET_TIME_KEEP_BY_DAY": () => (/* binding */ API_GET_TIME_KEEP_BY_DAY),
/* harmony export */   "API_LOGIN": () => (/* binding */ API_LOGIN),
/* harmony export */   "API_LOGOUT": () => (/* binding */ API_LOGOUT),
/* harmony export */   "API_MY_ACCOUNT": () => (/* binding */ API_MY_ACCOUNT),
/* harmony export */   "API_REGISTER": () => (/* binding */ API_REGISTER),
/* harmony export */   "API_REQUEST": () => (/* binding */ API_REQUEST),
/* harmony export */   "API_REQUEST_DELETE": () => (/* binding */ API_REQUEST_DELETE),
/* harmony export */   "API_REQUEST_STATUS": () => (/* binding */ API_REQUEST_STATUS),
/* harmony export */   "API_REQUEST_UPDATE": () => (/* binding */ API_REQUEST_UPDATE),
/* harmony export */   "API_UPDATE_ACCOUNT": () => (/* binding */ API_UPDATE_ACCOUNT),
/* harmony export */   "API_UPDATE_MEMBER": () => (/* binding */ API_UPDATE_MEMBER),
/* harmony export */   "API_UPDATE_TIME_KEEP": () => (/* binding */ API_UPDATE_TIME_KEEP),
/* harmony export */   "API_USER_CREATE": () => (/* binding */ API_USER_CREATE),
/* harmony export */   "API_USER_MNG": () => (/* binding */ API_USER_MNG),
/* harmony export */   "APP_URL": () => (/* binding */ APP_URL),
/* harmony export */   "AllUser": () => (/* binding */ AllUser),
/* harmony export */   "CHANGE_PASSWORD": () => (/* binding */ CHANGE_PASSWORD),
/* harmony export */   "DEPARTMENT": () => (/* binding */ DEPARTMENT),
/* harmony export */   "DEPARTMENT_EDIT": () => (/* binding */ DEPARTMENT_EDIT),
/* harmony export */   "DEPARTMENT_GETS": () => (/* binding */ DEPARTMENT_GETS),
/* harmony export */   "DEPARTMENT_NEW": () => (/* binding */ DEPARTMENT_NEW),
/* harmony export */   "GET_REQUEST": () => (/* binding */ GET_REQUEST),
/* harmony export */   "GET_USER": () => (/* binding */ GET_USER),
/* harmony export */   "HOME": () => (/* binding */ HOME),
/* harmony export */   "HOME_CALENDAR": () => (/* binding */ HOME_CALENDAR),
/* harmony export */   "LOGIN": () => (/* binding */ LOGIN),
/* harmony export */   "MEMBER": () => (/* binding */ MEMBER),
/* harmony export */   "PATH_IMAGE": () => (/* binding */ PATH_IMAGE),
/* harmony export */   "PROFILE": () => (/* binding */ PROFILE),
/* harmony export */   "REQUEST": () => (/* binding */ REQUEST),
/* harmony export */   "SEARCH": () => (/* binding */ SEARCH),
/* harmony export */   "STATUS_2": () => (/* binding */ STATUS_2)
/* harmony export */ });
var APP_URL = "http://localhost:8080/";
var HOME = APP_URL + "home";
var HOME_CALENDAR = APP_URL + "home/calendar";
var LOGIN = APP_URL + "login";
var REQUEST = APP_URL + "home/request";
var GET_REQUEST = APP_URL + "api/users/request/get";
var GET_USER = APP_URL + "api/users/get-user";
var DEPARTMENT = APP_URL + "home/department";
var MEMBER = APP_URL + "home/member";
var SEARCH = APP_URL + "api/users/search";
var AllUser = APP_URL + "api/users/gets";
var PROFILE = APP_URL + "home/edit/profile";
var CHANGE_PASSWORD = APP_URL + "change-password";
var API_LOGIN = "api/auth/login";
var API_LOGOUT = "api/auth/logout";
var API_REGISTER = "api/auth/register";
var API_CHANGE_PASSWORD = "api/auth/change-password";
var API_MY_ACCOUNT = "api/users/my-account";
var API_DELETE_USER = "api/users/delete/users";
var API_ACTIVE_USER = "api/users/active/users";
var API_REQUEST = "api/users/request";
var API_USER_CREATE = "api/users/request/user-create";
var API_USER_MNG = "api/users/request/manager";
var API_REQUEST_STATUS = "api/users/member/request";
var API_CREATE_REQUEST = "api/users/request/new";
var API_REQUEST_DELETE = "api/users/request/delete";
var API_REQUEST_UPDATE = "api/users/request/update";
var STATUS_2 = "home/member/request/?type=pending";
var PATH_IMAGE = "../../../../storage/";
var API_AVATAR = "api/users/update/avatar";
var API_UPDATE_ACCOUNT = "api/users/update/my-account";
var API_UPDATE_MEMBER = "api/users/update/user";
var API_CREATE_TIME_KEEP = "api/users/time-keep/new";
var API_UPDATE_TIME_KEEP = "api/users/time-keep/update";
var API_GET_TIME_KEEP = "api/users/time-keep/get";
var API_GET_TIME_KEEP_BY_DAY = "api/users/time-keep/getByDay";
var API_GET_NOT_WORK = "api/users/time-keep/getNotWork";
var API_ASSETS_NEW = "api/users/assets/new";
var API_GET_ASSETS = "api/users/assets/get";
var API_GET_ASSETS_ID = "api/users/assets/get";
var DEPARTMENT_NEW = "api/users/department/new";
var DEPARTMENT_GETS = "api/users/department/get";
var DEPARTMENT_EDIT = "api/users/department/edit";

/***/ }),

/***/ "./resources/js/layouts/admin/userView.vue":
/*!*************************************************!*\
  !*** ./resources/js/layouts/admin/userView.vue ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _userView_vue_vue_type_template_id_1ef3ed14__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./userView.vue?vue&type=template&id=1ef3ed14 */ "./resources/js/layouts/admin/userView.vue?vue&type=template&id=1ef3ed14");
/* harmony import */ var _userView_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./userView.vue?vue&type=script&lang=js */ "./resources/js/layouts/admin/userView.vue?vue&type=script&lang=js");
/* harmony import */ var _var_www_html_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_var_www_html_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_userView_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_userView_vue_vue_type_template_id_1ef3ed14__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/layouts/admin/userView.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/layouts/admin/userView.vue?vue&type=script&lang=js":
/*!*************************************************************************!*\
  !*** ./resources/js/layouts/admin/userView.vue?vue&type=script&lang=js ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_userView_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_userView_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./userView.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/layouts/admin/userView.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/layouts/admin/userView.vue?vue&type=template&id=1ef3ed14":
/*!*******************************************************************************!*\
  !*** ./resources/js/layouts/admin/userView.vue?vue&type=template&id=1ef3ed14 ***!
  \*******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_userView_vue_vue_type_template_id_1ef3ed14__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_userView_vue_vue_type_template_id_1ef3ed14__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./userView.vue?vue&type=template&id=1ef3ed14 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/layouts/admin/userView.vue?vue&type=template&id=1ef3ed14");


/***/ })

}]);