(function() {
    var FieldListener, Nod, NodMsg,
        __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

    FieldListener = (function() {

        function FieldListener($el, vars) {
            this.$el = $el;
            this.createGetValue = __bind(this.createGetValue, this);

            this.runCheck = __bind(this.runCheck, this);

            this.delayedCheck = __bind(this.delayedCheck, this);

            this.events = __bind(this.events, this);

            this.checker = vars[0], this.delay = vars[1];
            this.delayId = "";
            this.getVal = this.createGetValue(this.$el);
            this.events();
            this.$el.status = true;
        }

        FieldListener.prototype.events = function() {
            this.$el.on('keyup', this.delayedCheck);
            this.$el.on('blur', this.runCheck);
            return this.$el.on('change', this.runCheck);
        };

        FieldListener.prototype.delayedCheck = function() {
            clearTimeout(this.delayId);
            return this.delayId = setTimeout(this.runCheck, this.delay);
        };

        FieldListener.prototype.runCheck = function() {
            var isCorrect;
            isCorrect = this.checker(this.getVal());
            if (this.$el.status !== isCorrect) {
                this.$el.status = isCorrect;
                return this.$el.trigger('toggle');
            }
        };

        FieldListener.prototype.createGetValue = function($el) {
            if ($el.attr('type') === 'checkbox') {
                return function() {
                    return $el.is(':checked');
                };
            } else {
                return function() {
                    return $.trim($el.val());
                };
            }
        };

        return FieldListener;

    })();

    (function($) {
        return $.fn.nod = function(fields, settings) {
            new Nod(this, fields, settings);
            return this;
        };
    })(jQuery);

    Nod = (function() {

        function Nod(form, fields, options) {
            this.form = form;
            this.fields = fields;
            this.createEls = __bind(this.createEls, this);

            this.toggleSubmitBtn = __bind(this.toggleSubmitBtn, this);

            this.toggleGroupClass = __bind(this.toggleGroupClass, this);

            this.toggle = __bind(this.toggle, this);

            this.massCheck = __bind(this.massCheck, this);

            this.events = __bind(this.events, this);

            this.get = $.extend({
                'delay': 700,
                'disableSubmitBtn': true,
                'helpSpanDisplay': 'help-inline',
                'groupClass': 'error',
                'submitBtnSelector': '[type=submit]',
                'metricsSplitter': ':',
                'errorPosClasses': ['.help-inline', '.add-on', 'button', '.input-append'],
                'broadcastError': false,
                'errorClass': 'nod_msg',
                'groupSelector': '.control-group'
            }, options);
            this.err = ["Arguments for each field must have three parts: ", "Couldn't find any form: ", "Couldn't find any Submit button: ", "The selector in 'same-as' isn't working", "I don't know "];
            if (!this.fields) {
                return;
            }
            this.els = this.createEls();
            this.submit = this.form.find(this.get.submitBtnSelector);
            this.checkIfElementsExist(this.form, this.submit, this.disableSubmitBtn);
            this.events();
        }

        Nod.prototype.checkIfElementsExist = function(form, submit, disableSubmitBtn) {
            if (!form.selector || !form.length) {
                throw this.err[1] + form;
            }
            if (!submit.length && disableSubmitBtn) {
                throw this.err[2] + submit;
            }
        };

        Nod.prototype.events = function() {
            var $el, _i, _len, _ref, _results;
            this.form.on('submit', this.massCheck);
            _ref = this.els;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                $el = _ref[_i];
                _results.push($el.on('toggle', this.toggle));
            }
            return _results;
        };

        Nod.prototype.massCheck = function(ev) {
            var $el, _i, _len, _ref, _results;
            _ref = this.els;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                $el = _ref[_i];
                $el.trigger('change');
                if (!$el.status) {
                    _results.push(ev.preventDefault());
                } else {
                    _results.push(void 0);
                }
            }
            return _results;
        };

        Nod.prototype.toggle = function(ev) {
            this.toggleGroupClass($(ev.currentTarget));
            if (this.get.disableSubmitBtn) {
                return this.toggleSubmitBtn();
            }
        };

        Nod.prototype.toggleGroupClass = function($target) {
            var $group, errCls;
            $group = $target.parents(this.get.groupSelector);
            errCls = $group.find('.' + this.get.errorClass);
            if (errCls.length) {
                return $group.addClass(this.get.groupClass);
            } else {
                return $group.removeClass(this.get.groupClass);
            }
        };

        Nod.prototype.toggleSubmitBtn = function() {
            var $el, d, _i, _len, _ref, _results;
            d = 'disabled';
            this.submit.removeClass(d).removeAttr(d);
            _ref = this.els;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                $el = _ref[_i];
                if (!$el.status) {
                    _results.push(this.submit.addClass(d).attr(d, d));
                } else {
                    _results.push(void 0);
                }
            }
            return _results;
        };

        Nod.prototype.createEls = function() {
            var $el, el, els, field, listenVars, nodMsgVars, _i, _j, _len, _len1, _ref, _ref1;
            els = [];
            _ref = this.fields;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                field = _ref[_i];
                if (field.length !== 3) {
                    throw this.err[0] + field;
                }
                nodMsgVars = [field[2], this.get.helpSpanDisplay, this.get.errorClass, this.get.errorPosClasses, this.get.broadcastError];
                listenVars = [this.makeChecker(field[1]), this.get.delay];
                _ref1 = $(field[0]);
                for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
                    el = _ref1[_j];
                    $el = $(el);
                    els.push($el);
                    new NodMsg($el, nodMsgVars);
                    new FieldListener($el, listenVars);
                }
            }
            return els;
        };

        Nod.prototype.makeChecker = function(m) {
            var arg, sec, type, _ref;
            if (!!(m && m.constructor && m.call && m.apply)) {
                return function(v) {
                    return m(v);
                };
            }
            if (m instanceof RegExp) {
                return function(v) {
                    return m.test(v);
                };
            }
            _ref = $.map(m.split(this.get.metricsSplitter), $.trim), type = _ref[0], arg = _ref[1], sec = _ref[2];
            if (type === 'same-as' && $(arg).length !== 1) {
                throw new Error(this.err[3]);
            }
            switch (type) {
                case 'presence':
                    return function(v) {
                        return !!v;
                    };
                case 'exact':
                    return function(v) {
                        return v === arg;
                    };
                case 'not':
                    return function(v) {
                        return v !== arg;
                    };
                case 'same-as':
                    return function(v) {
                        return v === $(arg).val();
                    };
                case 'min-length':
                    return function(v) {
                        return v.length >= arg;
                    };
                case 'max-length':
                    return function(v) {
                        return v.length <= arg;
                    };
                case 'exact-length':
                    return function(v) {
                        return v.length === arg;
                    };
                case 'between':
                    return function(v) {
                        return v.length >= arg && v.length <= sec;
                    };
                case 'integer':
                    return function(v) {
                        return !v || /^\s*\d+\s*$/.test(v);
                    };
                case 'float':
                    return function(v) {
                        return !v || /^[-+]?[0-9]+(\.[0-9]+)?$/.test(v);
                    };
                case 'email':
                    return function(v) {
                        return !v || /^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$/.test(v);
                    };
                default:
                    throw this.err[4] + type;
            }
        };

        return Nod;

    })();

    NodMsg = (function() {

        function NodMsg($el, vars) {
            var msgArg;
            this.$el = $el;
            this.createShowMsg = __bind(this.createShowMsg, this);

            this.toggle = __bind(this.toggle, this);

            this.events = __bind(this.events, this);

            msgArg = {};
            msgArg.msg = vars[0], msgArg.display = vars[1], msgArg.cls = vars[2], this.pos_classes = vars[3], this.broadcastError = vars[4];
            this.$msg = this.createMsg(msgArg);
            this.showMsg = this.createShowMsg();
            this.events();
        }

        NodMsg.prototype.events = function() {
            return this.$el.on('toggle', this.toggle);
        };

        NodMsg.prototype.createMsg = function(arg) {
            return $('<span/>', {
                'html': arg.msg,
                'class': arg.display + ' ' + arg.cls
            });
        };

        NodMsg.prototype.toggle = function() {
            if (this.$el.status) {
                return this.$msg.remove();
            } else {
                this.showMsg();
                if (this.broadcastError) {
                    return this.broadcast();
                }
            }
        };

        NodMsg.prototype.createShowMsg = function() {
            var pos;
            if (this.$el.attr('type') === 'checkbox') {
                return function() {
                    return this.$el.parent().append(this.$msg);
                };
            } else {
                pos = this.findPos(this.$el);
                return function() {
                    return pos.after(this.$msg);
                };
            }
        };

        NodMsg.prototype.findPos = function($el) {
            if (this.elHasClass('parent', $el)) {
                return this.findPos($el.parent());
            }
            if (this.elHasClass('next', $el)) {
                return this.findPos($el.next());
            }
            return $el;
        };

        NodMsg.prototype.elHasClass = function(dir, $el) {
            var s, _i, _len, _ref;
            _ref = this.pos_classes;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                s = _ref[_i];
                if ($el[dir](s).length) {
                    return true;
                }
            }
            return false;
        };

        NodMsg.prototype.broadcast = function() {
            var data;
            data = {
                'el': this.$el,
                'msg': this.$msg.html()
            };
            return $(window).trigger('nod_error_fired', data);
        };

        return NodMsg;

    })();

}).call(this);