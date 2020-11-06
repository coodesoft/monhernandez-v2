/**
 * Customizer controls
 *
 * @package Kemet
 */

(function ($) {

    'use strict';

    /* Internal shorthand */
    var api = wp.customize;
    
	/**
	 * Helper class for the main Customizer interface.
	 *
	 * @class Kemet_Customizer
	 */
    var Kemet_Customizer = {

        controls: {},

		/**
		 * Initializes the logic for showing and hiding controls
		 * when a setting changes.
		 *
		 * @access private
		 * @method init
		 */
        init: function () {
            var $this = this;
            $this.checkDependency();
            
            api.bind('change', function ( setting, data ) {
                var has_dependents = $this.hasDependentControls(setting.id);

                if (has_dependents) {
                    $this.checkDependency();
                }
            });
        },

        /**
         * 
         * Check if control in dependency array
         */
        hasDependentControls: function (control_id) {

            var check = false;

            $.each(kemet.config, function (index, val) {

                if (!_.isUndefined(val.conditions)) {

                    var conditions = val.conditions;

                    $.each(conditions, function (index, val) {

                        var control = val[0];

                        if (control_id == control) {
                            check = true;
                            return;
                        }
                    });

                } else {

                    var control = val[0];

                    if (control_id == control) {
                        check = true;
                        return;
                    }
                }

            });

            return check;

        },

		/**
		 * Check Control Dependency.
		 *
		 * @access private
		 * @method checkDependency
		 */
        checkDependency: function () {
            var $this = this;
            var values = api.get();
            $this.checked_controls = {};

            _.each(values, function (value, id) {
                var control = api.control(id);

                $this.checkVisibility( control, id );
                
            });
        },

		/**
		 * Check Control Visibility
		 *
		 * @access private
		 * @method checkControlVisibility
		 */
        checkVisibility: function (control, id) {
            var $this = this;
            var values = api.get();

            // If control has dependency defined
            if ( 'undefined' != typeof kemet.config[id] ) {
                var check = false;
                var dependency = kemet.config[id];
                
                if ('undefined' !== typeof dependency ) {
                    check = $this.checkConditions(dependency.conditions, values);
                    
                    this.checked_controls[id] = check;

                    if (!check) {
                        control.container.addClass('kmt-hide');
                    } else {
                        control.container.removeClass('kmt-hide');
                    }
                }
            }
        },

		/**
		 * Checks Dependency Condtions
		 *
		 * @access private
		 * @method checkConditions
		 */
        checkConditions: function (conditions, values) {
            var control = this;
            var check = false;

            if ( _.isArray( conditions ) ) {

                $.each( conditions, function ( index, value ) {

                    var control_id = value[0];
                    var condition = value[1];
                    var conditon_val2 = value[2];
                    var operator = !_.isUndefined(value[3]) ? value[3] : '||';
                    var conditon_val1 = !_.isUndefined( values[control_id] ) ? values[control_id] : '';
                    
                    var checker = control.checkCondition(conditon_val1, condition, conditon_val2);
                    
                    switch (operator) {
                        case '||':
                            check = (checker || check) ? true : false;
                            break;
                        case '&&':
                            check = (checker && check) ? true : false;
                            break;    
                    }

                }); 
            }

            return check;
        },

        /**
		 * Check Condition
		 *
		 * @access private
		 * @method checkCondition
		 */
        checkCondition: function (value1, cond, value2) {
            var checker = false;
            switch (cond) {
                case '===':
                    checker = (value1 === value2) ? true : false;
                    break;
                case '>':
                    checker = (value1 > value2) ? true : false;
                    break;
                case '<':
                    checker = (value1 < value2) ? true : false;
                    break;
                case '<=':
                    checker = (value1 <= value2) ? true : false;
                    break;
                case '>=':
                    checker = (value1 >= value2) ? true : false;
                    break;
                case '!=':
                    checker = (value1 != value2) ? true : false;
                    break;
                case 'empty':
                    var _v = _.clone(value1);
                    if (_.isObject(_v) || _.isArray(_v)) {
                        _.each(_v, function (v, i) {
                            if (_.isEmpty(v)) {
                                delete _v[i];
                            }
                        });

                        checker = _.isEmpty(_v) ? true : false;
                    } else {
                        checker = _.isNull(_v) || _v == '' ? true : false;
                    }
                    break;
                case 'notEmpty':
                    var _v = _.clone(value1);
                    if (_.isObject(_v) || _.isArray(_v)) {
                        _.each(_v, function (v, i) {
                            if (_.isEmpty(v)) {
                                delete _v[i];
                            }
                        })
                    }
                    checker = _.isEmpty(_v) ? false : true;
                    break;
                case 'inarray':
                    if (_.isArray(value1)) {
                        if ($.inArray(value2, value1) !== -1) {
                            checker = true;
                        }
                    }
                    break;
                default:
                    if (_.isArray(value2)) {
                        if (!_.isEmpty(value2) && !_.isEmpty(value1)) {
                            checker = _.contains(value2, value1);
                        } else {
                            checker = false;
                        }
                    } else {
                        checker = (value1 == value2) ? true : false;
                    }
            }

            return checker;
        },
    };

    $(function () { Kemet_Customizer.init(); });


})(jQuery);