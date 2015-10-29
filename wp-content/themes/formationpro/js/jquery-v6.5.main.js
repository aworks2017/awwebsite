// page init
jQuery(function() {
	initCustomForms();
	initFormValidate();
	initValidation();
	initEditTable();
	jQuery('input, textarea').placeholder();

	initCampaignFields();

	// allow unckech radios in a row
	jQuery("input[type='radio']").click(function(){
		var radio = jQuery(this);
		var radio_name = radio.attr('name');
		var radio_stat = radio.attr('radio_stat');
		jQuery( "input[name='"+radio_name+"']" ).each(function( index ) {
			if(jQuery(this)!=radio) jQuery(this).removeAttr('radio_stat');
		});

		if(radio_stat=='on'){
			radio.attr('radio_stat','off');
			radio.prop('checked', false);
		}else{
			radio.attr('radio_stat','on');
		}
	});


});

function initCampaignFields(){
	var default_email = jQuery('[name="default_email"]');
	var emails = jQuery('input[data-rel="edit-field2"]');
	var emails_final = jQuery('input[data-rel="edit-field2-final"]');

	var inputs = jQuery('input[data-rel="edit-field1"]');

	inputs.on('keyup', setDefaultEmail);

	inputs.on('keydown', setDefaultEmail);

	inputs.on('paste', onPaste);

	inputs.indexOf = function(needle){
		for (var i = 0; i < this.length; i++){
			if (this[i] == needle) return i;
		}
	}

	function onPaste(){
		var i = inputs.indexOf(this);

		 if (window.clipboardData) {
				setTimeout(function(){
				temp=window.clipboardData.getData('text');
				tempLoop=temp.split(/\s+/);
				while ((value = tempLoop.shift()) && inputs[i]){
					inputs[i].value = value;
					setDefaultEmail.call(inputs[i]);
					i++;
				}
			}, 1);
		 }else
		 {
			setTimeout(function(){
			var value, values = inputs[i].value.split(/\s+/);
			while ((value = values.shift()) && inputs[i]){
				inputs[i].value = value;
				setDefaultEmail.call(inputs[i]);
				i++;
			}
			}, 1);
		}
	}

	function setDefaultEmail(){

		if ( jQuery.trim(jQuery(this).val())!='')		//assign default value only if campaign id is given
		{
			var i = inputs.indexOf(this);
			var email = emails[i];
			if (!email.value) {
				email.value = default_email.val();
			}
		}
	}
}

// initialize custom form elements
function initCustomForms() {
	/* global jcf */
	jcf.replaceAll();
}

function initFormValidate() {
	var activeClass = 'active-form';

	jQuery('.request-from-area').each(function() {
		var form = jQuery(this);
		var emailField = form.find('.email');
		var regEmail = /^([a-zA-Z0-9_\.\-])+\@centro.netjQuery/;

		function onSubmit() {
			if (regEmail.test(emailField.val())) {
				form.addClass(activeClass);
			} else {
				form.removeClass(activeClass);
			}
		}

		emailField.on('keyup', onSubmit);
		jQuery(window).on('keyupTrigger', onSubmit);
	});
}

// edit table init
function initEditTable() {
	var inactiveClass = 'inactive';
	var errorClass = 'error-validate';
	var successClass = 'success-validate';

	jQuery('.table-section').each(function() {
		var holder = jQuery(this);
		var editBlock = holder.find('.user-info-area');		//data-entry-form
		var allFields = editBlock.find(':input');
		var form = holder.find('.ajax-form');

		//console.log('pp'+e.type);
		var successMsg = form.find('.success-message');

	//Data-entry-form Modification area
		holder.on('keyup click keydown', '.request-sheet tbody tr', function(e) {
			var currRow = jQuery(this);
			var fields = currRow.find(':input');

			if(e.which != 13)	//pressing enter in the datasheet was clearing the success message..
			{
				holder.removeClass(inactiveClass).data('currRow', currRow);
				successMsg.hide();
				form.removeClass(successClass);
			}

			function setState(field,eventType) {

				var editField = editBlock.find('[data-rel=' + field.data('rel') + ' ]');

				if (field.is(':radio')) {

						//console.log('Coming='+eventType.type);

					/*sad remove errors from datasheet's radios and enable them */

						//field.click(function(){
						/*
						field.on('click keyup', function(event) {

							//console.log('Coming2='+event.type);
							var currFieldTemp=field;
							var rowFieldTemp=holder.data('currRow').find('[data-rel=' + currFieldTemp.data('rel') + ' ]');

							var rowFieldTemp=holder.data('currRow').find('[name=' + currFieldTemp.attr('name') + ' ]');
							var currentRadioParentTemp = rowFieldTemp.closest('.jcf-radio');
							currentRadioParentTemp.removeClass('radio-error');
							currentRadioParentTemp.addClass('jcf-unchecked');

						});
						*/

					if (field.prop('checked') === true) {
						editField.prop('checked', true);
					} else {
						editField.prop('checked', false);
					}

					var allRadios = editField.closest('.checkbox-list').find(':radio');
					allRadios.each(function() {
						jcf.refresh(jQuery(this));
					});

				} else {
						editField.val(field.val());
						//jQuery(window).trigger('keydownTrigger');
						jQuery(window).trigger('keyupTrigger');
				}
			} //end of setstate

			fields.each(function() {
				setState(jQuery(this));
			});

	//DataSheet Modification area
			fields.on('click keyup', function(event) {
					if(event.type=='click')	//enable the radio button of current row
					{
						var tempField=jQuery(this);
						if (tempField.is(':radio')) {
							var currFieldTemp=tempField;

							var rowFieldTemp=holder.data('currRow').find('[data-rel=' + currFieldTemp.data('rel') + ' ]');
							allRadiosTemp2=tempField.closest('tr').find(':radio');
							var rowFieldTemp=holder.data('currRow').find('[name=' + currFieldTemp.attr('name') + ' ]');

							allRadiosTemp2.each(function() {
								if(currFieldTemp.attr('name')==jQuery(this).attr('name'))
								{
									jQuery(this).parent().addClass('jcf-checked');
									jQuery(this).parent().removeClass('radio-error');
								}
								jcf.refresh(jQuery(this));
							});
						}
					}
				setState(jQuery(this));
			});

		});

	//Data-entry-form Modification area
		allFields.on('click keyup', function() {
			var currField = jQuery(this);
			var rowField = holder.data('currRow').find('[data-rel=' + currField.data('rel') + ' ]');

			if (currField.is(':radio')) {
				if (currField.prop('checked') === true) {
					rowField.prop('checked', true);
				} else {
					rowField.prop('checked', false);
				}

				var allRadios = rowField.closest('tr').find(':radio');

				allRadios.each(function() {

					/*sad remove errors from datasheet's radios and enable them */
						 var currFieldTemp = jQuery(this);
						 var rowFieldTemp=holder.data('currRow').find('[data-rel=' + currFieldTemp.data('rel') + ' ]');
						 var currentRadioParentTemp = rowFieldTemp.closest('.jcf-radio');
						 currentRadioParentTemp.removeClass('radio-error');

					jcf.refresh(jQuery(this));
				});
			} else {

				rowField.val(currField.val());		//assign Inputted data-entry form's CampaignId to Row's campaignID

				//sad assign default email value to corresponding row only if campaign id is inputted for data-entry-form
					if ( jQuery.trim(currField.val())!='')
					{
						var emailField=rowField.closest('td').next('td').find(':text'); // current row
						if(emailField.attr('data-param')=='email')
						{
							if(jQuery.trim(emailField.val())=='')
							{
								var default_email_temp = jQuery('[name="default_email"]');
								emailField.val(default_email_temp.val());
							}
						}
					}

				jQuery(window).trigger('keyupTrigger');
			}
		});

		form.each(function() {

			function submitHandler(e) {

			/** mylogic */
			   counter=0; /*var submitSuccessTemp=1; var submitSuccessRadioTemp=1; var submitSuccessTextTemp=1;*/

				var submitSuccessRadioTemp = true;
					if (!submitSuccessRadioTemp) {
						e.preventDefault();
					}

					var submitSuccessTextTemp = true;
					if (!submitSuccessTextTemp) {
						e.preventDefault();
					}

					var fieldsAllEmpty=true;
					if (!fieldsAllEmpty) {
						e.preventDefault();
					}

			   jQuery('.request-sheet tbody tr').each(function(){

						var currRowAgain = jQuery(this);
						var fieldsAgain = currRowAgain.find(':input');

						// logic to check if any of the element is inputted	So in the next step , we will check only inputted row one by one
								var fieldsAgainTemp = currRowAgain.find(':input');
								var fieldsEmpty=true;

								jQuery.each( fieldsAgainTemp, function( index, value ){
									var currentElementTemp=jQuery(this);
									if (currentElementTemp.is(':text') && currentElementTemp.val()!='') {
										fieldsEmpty=false;fieldsAllEmpty=false;
									}else if (currentElementTemp.is(':radio') && jQuery('[name='+currentElementTemp.attr('name')+']').is(":checked")) {
										fieldsEmpty=false;fieldsAllEmpty=false;
									}
								});

				/**sad1 Highlight the data sheet inputs if not inputted correctly **/

						if(!fieldsEmpty)	// proceed only for the row if user has Inputted any of the element ie. campaignID, Requestor or any radio button of that row
						{
							fieldsAgain.each(function() {		/**sad1 check all fields of current row **/
								var currentElement=jQuery(this);

								//To-Do: Enable again the radio button

								if (currentElement.is(':radio')) {

									var radioName=currentElement.attr('name');
									var checkedVal=jQuery('[name='+radioName+']:checked');
									var currentRadio=jQuery('[name='+radioName+']');
									var currentRadioParent = currentRadio.closest('.jcf-radio');

									if(currentRadioParent.find(':radio:checked').length==0)
									{
										//form.data('submitSuccessRadioTemp',false);


										submitSuccessRadioTemp=false;
										//console.log(submitSuccessRadioTemp+'counter='+counter);
									}

									if(!currentRadio.is(":checked")) //check if none of radio button from that row is checked
									{
										currentRadioParent.addClass('radio-error');			//highlight the radio
										// To-Do:	set successFlag to false so not to submit the form
									}
									else
									{
										currentRadioParent.removeClass('radio-error');
									}
								}																		// edit-field6 is Notes
								else if (currentElement.is(':text') && currentElement.attr('data-rel')!="edit-field6" && currentElement.hasClass('required-email')) {  //highlight the textbox

									var currentTextParent = currentElement.closest('td');
									var regEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+jQuery/;
									if(!regEmail.test(currentElement.val()) || jQuery.trim(currentElement.val())=="")
									{

										currentTextParent.addClass('textbox-error');			//highlight the text column
										submitSuccessTextTemp=false;
									}
									else{
										currentTextParent.removeClass('textbox-error');			//Unhighlight the text column
									}
								}
								else if (currentElement.is(':text') && currentElement.attr('data-rel')!="edit-field6") {  //highlight the textbox

									var currentTextParent = currentElement.closest('td');

									if(jQuery.trim(currentElement.val())=="")
									{
										currentTextParent.addClass('textbox-error');			//highlight the text column
										submitSuccessTextTemp=false;
									}
									else{
										currentTextParent.removeClass('textbox-error');			//Unhighlight the text column
									}
								}
							 });	/**sad2 check all fields of current row **/
						}

				/**sad2 Highlight the data sheet inputs if not inputted correctly **/
					counter=counter+1;
				});

			/** mylogic */

					//console.log(submitSuccessRadioTemp+'==='+submitSuccessTextTemp);
					//return false;

					if( submitSuccessRadioTemp && submitSuccessTextTemp && !fieldsAllEmpty )
					{
						//form = holder.find('.ajax-form');
						form.removeClass(errorClass);	//show data-entry-form errors
						if (form.data('successFlag')) {

								//reset or empty the required controls
									/*jQuery(':input','.ajax-form')
									  .removeClass('jcf-checked')
									  .removeAttr('checked')
									  .removeAttr('selected')
									  .not(':button, :submit, :reset, :hidden, .success-message')
									  .val('');

									jQuery('span').removeClass('jcf-checked');
								  */
								form.removeClass(errorClass).addClass(successClass);	//sad Fix: 3rd issue
								e.preventDefault();

								sendData({
									url: form.attr('action'),
									data: form.serialize(),
									type: form.attr('method') || 'POST',
									message: successMsg,
									form: form
								});


								setTimeout(function() {
									      window.location.assign("/menu");
									    }, 1000);

						} else {

							form.removeClass(successClass).addClass(errorClass);
						}
					}else
					{
						form.addClass(errorClass);	//show data-entry-form errors
						return false;
					}
			}

			form.on('submit', submitHandler);
		});
	});

	function sendData(options) {
		console.log(options);
		//jQuery.post("centro.php", {data: options.data}, function(result){
       //     options.message.show();
		//	options.form.removeClass(errorClass).addClass(successClass);
       // });
		jQuery.ajax({
			url: /*options.url*/"",
			data: 'ajax=1' + options.data ? '&' + options.data : '',
			type: options.method || 'POST',
			success: function() {
				options.message.show();
				options.form.removeClass(errorClass).addClass(successClass);
			}
		});

	}
}

// form validation function
function initValidation() {
	var errorClass = 'error';
	var successClass = 'success';
	var regEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+jQuery/;
	var regPhone = /^[0-9]+jQuery/;

	jQuery('form.validate-form').each(function() {
		var form = jQuery(this).attr('novalidate', 'novalidate');
		var successFlag = true;
		var inputs = form.find('input, textarea, select');

		// form validation function
		function validateForm(e) {
			successFlag = true;

			inputs.each(checkField);

			if (!successFlag) {
				e.preventDefault();
			}

			form.data('successFlag', successFlag);
		}

		// check field
		function checkField(i, obj) {

			var currentObject = jQuery(obj);
			var currentParent = currentObject.closest('.validate-row');

			// not empty fields
			if (currentObject.hasClass('required')) {
				setState(currentParent, currentObject, !currentObject.val().length || currentObject.val() === currentObject.prop('defaultValue'));
			}
			// correct email fields

			if(jQuery.trim(currentObject.val())!="")
			{
				if(currentObject.hasClass('required-email')) {
					setState(currentParent, currentObject, !regEmail.test(currentObject.val()));
				}
			}

			// correct number fields
			if (currentObject.hasClass('required-number')) {
				setState(currentParent, currentObject, !regPhone.test(currentObject.val()));
			}
			// something selected
			if (currentObject.hasClass('required-select')) {
				setState(currentParent, currentObject, currentObject.get(0).selectedIndex === 0);
			}
			// radio field
			if (currentParent.hasClass('required-radio')) {
				//console.log('currentParent='+currentParent.val()+'==='+currentObject.val())
				setState(currentParent, currentObject, !currentParent.find(':radio:checked').length);
			}
		}

		// set state
		function setState(hold, field, error) {
			hold.removeClass(errorClass).removeClass(successClass);

			if (error) {

				hold.addClass(errorClass);	//show data-entry-form errors

				field.one('focus', function() {
					hold.removeClass(errorClass).removeClass(successClass);
				});

				successFlag = false;

			} else {
				hold.addClass(successClass);
			}
		}
		// form event handlers
		form.submit(validateForm);
	});
}

/*! http://mths.be/placeholder v2.0.7 by @mathias */
;(function(window, document, jQuery) {

	// Opera Mini v7 doesn’t support placeholder although its DOM seems to indicate so
	var isOperaMini = Object.prototype.toString.call(window.operamini) == '[object OperaMini]';
	var isInputSupported = 'placeholder' in document.createElement('input') && !isOperaMini;
	var isTextareaSupported = 'placeholder' in document.createElement('textarea') && !isOperaMini;
	var prototype = jQuery.fn;
	var valHooks = jQuery.valHooks;
	var propHooks = jQuery.propHooks;
	var hooks;
	var placeholder;

	if (isInputSupported && isTextareaSupported) {

		placeholder = prototype.placeholder = function() {
			return this;
		};

		placeholder.input = placeholder.textarea = true;

	} else {

		placeholder = prototype.placeholder = function() {
			var jQuerythis = this;
			jQuerythis
				.filter((isInputSupported ? 'textarea' : ':input') + '[placeholder]')
				.not('.placeholder')
				.bind({
					'focus.placeholder': clearPlaceholder,
					'blur.placeholder': setPlaceholder
				})
				.data('placeholder-enabled', true)
				.trigger('blur.placeholder');
			return jQuerythis;
		};

		placeholder.input = isInputSupported;
		placeholder.textarea = isTextareaSupported;

		hooks = {
			'get': function(element) {
				var jQueryelement = jQuery(element);

				var jQuerypasswordInput = jQueryelement.data('placeholder-password');
				if (jQuerypasswordInput) {
					return jQuerypasswordInput[0].value;
				}

				return jQueryelement.data('placeholder-enabled') && jQueryelement.hasClass('placeholder') ? '' : element.value;
			},
			'set': function(element, value) {
				var jQueryelement = jQuery(element);

				var jQuerypasswordInput = jQueryelement.data('placeholder-password');
				if (jQuerypasswordInput) {
					return jQuerypasswordInput[0].value = value;
				}

				if (!jQueryelement.data('placeholder-enabled')) {
					return element.value = value;
				}
				if (value == '') {
					element.value = value;
					// Issue #56: Setting the placeholder causes problems if the element continues to have focus.
					if (element != safeActiveElement()) {
						// We can't use `triggerHandler` here because of dummy text/password inputs :(
						setPlaceholder.call(element);
					}
				} else if (jQueryelement.hasClass('placeholder')) {
					clearPlaceholder.call(element, true, value) || (element.value = value);
				} else {
					element.value = value;
				}
				// `set` can not return `undefined`; see http://jsapi.info/jquery/1.7.1/val#L2363
				return jQueryelement;
			}
		};

		if (!isInputSupported) {
			valHooks.input = hooks;
			propHooks.value = hooks;
		}
		if (!isTextareaSupported) {
			valHooks.textarea = hooks;
			propHooks.value = hooks;
		}

		jQuery(function() {
			// Look for forms
			jQuery(document).delegate('form', 'submit.placeholder', function() {
				// Clear the placeholder values so they don't get submitted
				var jQueryinputs = jQuery('.placeholder', this).each(clearPlaceholder);
				setTimeout(function() {
					jQueryinputs.each(setPlaceholder);
				}, 10);
			});
		});

		// Clear placeholder values upon page reload
		jQuery(window).bind('beforeunload.placeholder', function() {
			jQuery('.placeholder').each(function() {
				this.value = '';
			});
		});

	}

	function args(elem) {
		// Return an object of element attributes
		var newAttrs = {};
		var rinlinejQuery = /^jQuery\d+jQuery/;
		jQuery.each(elem.attributes, function(i, attr) {
			if (attr.specified && !rinlinejQuery.test(attr.name)) {
				newAttrs[attr.name] = attr.value;
			}
		});
		return newAttrs;
	}

	function clearPlaceholder(event, value) {
		var input = this;
		var jQueryinput = jQuery(input);
		if (input.value == jQueryinput.attr('placeholder') && jQueryinput.hasClass('placeholder')) {
			if (jQueryinput.data('placeholder-password')) {
				jQueryinput = jQueryinput.hide().next().show().attr('id', jQueryinput.removeAttr('id').data('placeholder-id'));
				// If `clearPlaceholder` was called from `jQuery.valHooks.input.set`
				if (event === true) {
					return jQueryinput[0].value = value;
				}
				jQueryinput.focus();
			} else {
				input.value = '';
				jQueryinput.removeClass('placeholder');
				input == safeActiveElement() && input.select();
			}
		}
	}

	function setPlaceholder() {
		var jQueryreplacement;
		var input = this;
		var jQueryinput = jQuery(input);
		var id = this.id;
		if (input.value == '') {
			if (input.type == 'password') {
				if (!jQueryinput.data('placeholder-textinput')) {
					try {
						jQueryreplacement = jQueryinput.clone().attr({ 'type': 'text' });
					} catch(e) {
						jQueryreplacement = jQuery('<input>').attr(jQuery.extend(args(this), { 'type': 'text' }));
					}
					jQueryreplacement
						.removeAttr('name')
						.data({
							'placeholder-password': jQueryinput,
							'placeholder-id': id
						})
						.bind('focus.placeholder', clearPlaceholder);
					jQueryinput
						.data({
							'placeholder-textinput': jQueryreplacement,
							'placeholder-id': id
						})
						.before(jQueryreplacement);
				}
				jQueryinput = jQueryinput.removeAttr('id').hide().prev().attr('id', id).show();
				// Note: `jQueryinput[0] != input` now!
			}
			jQueryinput.addClass('placeholder');
			jQueryinput[0].value = jQueryinput.attr('placeholder');
		} else {
			jQueryinput.removeClass('placeholder');
		}
	}

	function safeActiveElement() {
		// Avoid IE9 `document.activeElement` of death
		// https://github.com/mathiasbynens/jquery-placeholder/pull/99
		try {
			return document.activeElement;
		} catch (err) {}
	}

}(this, document, jQuery));

/*!
 * JavaScript Custom Forms
 *
 * Copyright 2014 PSD2HTML - http://psd2html.com/jcf
 * Released under the MIT license (LICENSE.txt)
 *
 * Version: 1.1.0
 */
;(function(root, factory) {
	'use strict';
	if (typeof define === 'function' && define.amd) {
		define(['jquery'], factory);
	} else if (typeof exports === 'object') {
		module.exports = factory(require('jquery'));
	} else {
		root.jcf = factory(jQuery);
	}
}(this, function(jQuery) {
	'use strict';

	// private variables
	var customInstances = [];

	// default global options
	var commonOptions = {
		optionsKey: 'jcf',
		dataKey: 'jcf-instance',
		rtlClass: 'jcf-rtl',
		focusClass: 'jcf-focus',
		pressedClass: 'jcf-pressed',
		disabledClass: 'jcf-disabled',
		hiddenClass: 'jcf-hidden',
		resetAppearanceClass: 'jcf-reset-appearance',
		unselectableClass: 'jcf-unselectable'
	};

	// detect device type
	var isTouchDevice = ('ontouchstart' in window) || window.DocumentTouch && document instanceof window.DocumentTouch,
		isWinPhoneDevice = /Windows Phone/.test(navigator.userAgent);
	commonOptions.isMobileDevice = !!(isTouchDevice || isWinPhoneDevice);

	// create global stylesheet if custom forms are used
	var createStyleSheet = function() {
		var styleTag = jQuery('<style>').appendTo('head'),
			styleSheet = styleTag.prop('sheet') || styleTag.prop('styleSheet');

		// crossbrowser style handling
		var addCSSRule = function(selector, rules, index) {
			if (styleSheet.insertRule) {
				styleSheet.insertRule(selector + '{' + rules + '}', index);
			} else {
				styleSheet.addRule(selector, rules, index);
			}
		};

		// add special rules
		addCSSRule('.' + commonOptions.hiddenClass, 'position:absolute !important;left:-9999px !important;height:1px !important;width:1px !important;margin:0 !important;border-width:0 !important;-webkit-appearance:none;-moz-appearance:none;appearance:none');
		addCSSRule('.' + commonOptions.rtlClass + '.' + commonOptions.hiddenClass, 'right:-9999px !important; left: auto !important');
		addCSSRule('.' + commonOptions.unselectableClass, '-webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-tap-highlight-color: rgba(0,0,0,0);');
		addCSSRule('.' + commonOptions.resetAppearanceClass, 'background: none; border: none; -webkit-appearance: none; appearance: none; opacity: 0; filter: alpha(opacity=0);');

		// detect rtl pages
		var html = jQuery('html'), body = jQuery('body');
		if (html.css('direction') === 'rtl' || body.css('direction') === 'rtl') {
			html.addClass(commonOptions.rtlClass);
		}

		// handle form reset event
		html.on('reset', function() {
			setTimeout(function() {
				api.refreshAll();
			}, 0);
		});

		// mark stylesheet as created
		commonOptions.styleSheetCreated = true;
	};

	// simplified pointer events handler
	(function() {
		var pointerEventsSupported = navigator.pointerEnabled || navigator.msPointerEnabled,
			touchEventsSupported = ('ontouchstart' in window) || window.DocumentTouch && document instanceof window.DocumentTouch,
			eventList, eventMap = {}, eventPrefix = 'jcf-';

		// detect events to attach
		if (pointerEventsSupported) {
			eventList = {
				pointerover: navigator.pointerEnabled ? 'pointerover' : 'MSPointerOver',
				pointerdown: navigator.pointerEnabled ? 'pointerdown' : 'MSPointerDown',
				pointermove: navigator.pointerEnabled ? 'pointermove' : 'MSPointerMove',
				pointerup: navigator.pointerEnabled ? 'pointerup' : 'MSPointerUp'
			};
		} else {
			eventList = {
				pointerover: 'mouseover',
				pointerdown: 'mousedown' + (touchEventsSupported ? ' touchstart' : ''),
				pointermove: 'mousemove' + (touchEventsSupported ? ' touchmove' : ''),
				pointerup: 'mouseup' + (touchEventsSupported ? ' touchend' : '')
			};
		}

		// create event map
		jQuery.each(eventList, function(targetEventName, fakeEventList) {
			jQuery.each(fakeEventList.split(' '), function(index, fakeEventName) {
				eventMap[fakeEventName] = targetEventName;
			});
		});

		// jQuery event hooks
		jQuery.each(eventList, function(eventName, eventHandlers) {
			eventHandlers = eventHandlers.split(' ');
			jQuery.event.special[eventPrefix + eventName] = {
				setup: function() {
					var self = this;
					jQuery.each(eventHandlers, function(index, fallbackEvent) {
						if (self.addEventListener) self.addEventListener(fallbackEvent, fixEvent, false);
						else self['on' + fallbackEvent] = fixEvent;
					});
				},
				teardown: function() {
					var self = this;
					jQuery.each(eventHandlers, function(index, fallbackEvent) {
						if (self.addEventListener) self.removeEventListener(fallbackEvent, fixEvent, false);
						else self['on' + fallbackEvent] = null;
					});
				}
			};
		});

		// check that mouse event are not simulated by mobile browsers
		var lastTouch = null;
		var mouseEventSimulated = function(e) {
			var dx = Math.abs(e.pageX - lastTouch.x),
				dy = Math.abs(e.pageY - lastTouch.y),
				rangeDistance = 25;

			if (dx <= rangeDistance && dy <= rangeDistance) {
				return true;
			}
		};

		// normalize event
		var fixEvent = function(e) {
			var origEvent = e || window.event,
				touchEventData = null,
				targetEventName = eventMap[origEvent.type];

			e = jQuery.event.fix(origEvent);
			e.type = eventPrefix + targetEventName;

			if (origEvent.pointerType) {
				switch (origEvent.pointerType) {
					case 2: e.pointerType = 'touch'; break;
					case 3: e.pointerType = 'pen'; break;
					case 4: e.pointerType = 'mouse'; break;
					default: e.pointerType = origEvent.pointerType;
				}
			} else {
				e.pointerType = origEvent.type.substr(0, 5); // "mouse" or "touch" word length
			}

			if (!e.pageX && !e.pageY) {
				touchEventData = origEvent.changedTouches ? origEvent.changedTouches[0] : origEvent;
				e.pageX = touchEventData.pageX;
				e.pageY = touchEventData.pageY;
			}

			if (origEvent.type === 'touchend') {
				lastTouch = { x: e.pageX, y: e.pageY };
			}
			if (e.pointerType === 'mouse' && lastTouch && mouseEventSimulated(e)) {
				return;
			} else {
				return (jQuery.event.dispatch || jQuery.event.handle).call(this, e);
			}
		};
	}());

	// custom mousewheel/trackpad handler
	(function() {
		var wheelEvents = ('onwheel' in document || document.documentMode >= 9 ? 'wheel' : 'mousewheel DOMMouseScroll').split(' '),
			shimEventName = 'jcf-mousewheel';

		jQuery.event.special[shimEventName] = {
			setup: function() {
				var self = this;
				jQuery.each(wheelEvents, function(index, fallbackEvent) {
					if (self.addEventListener) self.addEventListener(fallbackEvent, fixEvent, false);
					else self['on' + fallbackEvent] = fixEvent;
				});
			},
			teardown: function() {
				var self = this;
				jQuery.each(wheelEvents, function(index, fallbackEvent) {
					if (self.addEventListener) self.removeEventListener(fallbackEvent, fixEvent, false);
					else self['on' + fallbackEvent] = null;
				});
			}
		};

		var fixEvent = function(e) {
			var origEvent = e || window.event;
			e = jQuery.event.fix(origEvent);
			e.type = shimEventName;

			// old wheel events handler
			if ('detail'      in origEvent) { e.deltaY = -origEvent.detail;      }
			if ('wheelDelta'  in origEvent) { e.deltaY = -origEvent.wheelDelta;  }
			if ('wheelDeltaY' in origEvent) { e.deltaY = -origEvent.wheelDeltaY; }
			if ('wheelDeltaX' in origEvent) { e.deltaX = -origEvent.wheelDeltaX; }

			// modern wheel event handler
			if ('deltaY' in origEvent) {
				e.deltaY = origEvent.deltaY;
			}
			if ('deltaX' in origEvent) {
				e.deltaX = origEvent.deltaX;
			}

			// handle deltaMode for mouse wheel
			e.delta = e.deltaY || e.deltaX;
			if (origEvent.deltaMode === 1) {
				var lineHeight = 16;
				e.delta *= lineHeight;
				e.deltaY *= lineHeight;
				e.deltaX *= lineHeight;
			}

			return (jQuery.event.dispatch || jQuery.event.handle).call(this, e);
		};
	}());

	// extra module methods
	var moduleMixin = {
		// provide function for firing native events
		fireNativeEvent: function(elements, eventName) {
			jQuery(elements).each(function() {
				var element = this, eventObject;
				if (element.dispatchEvent) {
					eventObject = document.createEvent('HTMLEvents');
					eventObject.initEvent(eventName, true, true);
					element.dispatchEvent(eventObject);
				} else if (document.createEventObject) {
					eventObject = document.createEventObject();
					eventObject.target = element;
					element.fireEvent('on' + eventName, eventObject);
				}
			});
		},
		// bind event handlers for module instance (functions beggining with "on")
		bindHandlers: function() {
			var self = this;
			jQuery.each(self, function(propName, propValue) {
				if (propName.indexOf('on') === 0 && jQuery.isFunction(propValue)) {
					// dont use jQuery.proxy here because it doesn't create unique handler
					self[propName] = function() {
						return propValue.apply(self, arguments);
					};
				}
			});
		}
	};

	// public API
	var api = {
		modules: {},
		getOptions: function() {
			return jQuery.extend({}, commonOptions);
		},
		setOptions: function(moduleName, moduleOptions) {
			if (arguments.length > 1) {
				// set module options
				if (this.modules[moduleName]) {
					jQuery.extend(this.modules[moduleName].prototype.options, moduleOptions);
				}
			} else {
				// set common options
				jQuery.extend(commonOptions, moduleName);
			}
		},
		addModule: function(proto) {
			// add module to list
			var Module = function(options) {
				// save instance to collection
				options.element.data(commonOptions.dataKey, this);
				customInstances.push(this);

				// save options
				this.options = jQuery.extend({}, commonOptions, this.options, options.element.data(commonOptions.optionsKey), options);

				// bind event handlers to instance
				this.bindHandlers();

				// call constructor
				this.init.apply(this, arguments);
			};

			// set proto as prototype for new module
			Module.prototype = proto;

			// add mixin methods to module proto
			jQuery.extend(proto, moduleMixin);
			if (proto.plugins) {
				jQuery.each(proto.plugins, function(pluginName, plugin) {
					jQuery.extend(plugin.prototype, moduleMixin);
				});
			}

			// override destroy method
			var originalDestroy = Module.prototype.destroy;
			Module.prototype.destroy = function() {
				this.options.element.removeData(this.options.dataKey);

				for (var i = customInstances.length - 1; i >= 0; i--) {
					if (customInstances[i] === this) {
						customInstances.splice(i, 1);
						break;
					}
				}

				if (originalDestroy) {
					originalDestroy.apply(this, arguments);
				}
			};

			// save module to list
			this.modules[proto.name] = Module;
		},
		getInstance: function(element) {
			return jQuery(element).data(commonOptions.dataKey);
		},
		replace: function(elements, moduleName, customOptions) {
			var self = this,
				instance;

			if (!commonOptions.styleSheetCreated) {
				createStyleSheet();
			}

			jQuery(elements).each(function() {
				var moduleOptions,
					element = jQuery(this);

				instance = element.data(commonOptions.dataKey);
				if (instance) {
					instance.refresh();
				} else {
					if (!moduleName) {
						jQuery.each(self.modules, function(currentModuleName, module) {
							if (module.prototype.matchElement.call(module.prototype, element)) {
								moduleName = currentModuleName;
								return false;
							}
						});
					}
					if (moduleName) {
						moduleOptions = jQuery.extend({ element: element }, customOptions);
						instance = new self.modules[moduleName](moduleOptions);
					}
				}
			});
			return instance;
		},
		refresh: function(elements) {
			jQuery(elements).each(function() {
				var instance = jQuery(this).data(commonOptions.dataKey);
				if (instance) {
					instance.refresh();
				}
			});
		},
		destroy: function(elements) {
			jQuery(elements).each(function() {
				var instance = jQuery(this).data(commonOptions.dataKey);
				if (instance) {
					instance.destroy();
				}
			});
		},
		replaceAll: function(context) {
			var self = this;
			jQuery.each(this.modules, function(moduleName, module) {
				jQuery(module.prototype.selector, context).each(function() {
					if (this.className.indexOf('jcf-ignore') < 0) {
						self.replace(this, moduleName);
					}
				});
			});
		},
		refreshAll: function(context) {
			if (context) {
				jQuery.each(this.modules, function(moduleName, module) {
					jQuery(module.prototype.selector, context).each(function() {
						var instance = jQuery(this).data(commonOptions.dataKey);
						if (instance) {
							instance.refresh();
						}
					});
				});
			} else {
				for (var i = customInstances.length - 1; i >= 0; i--) {
					customInstances[i].refresh();
				}
			}
		},
		destroyAll: function(context) {
			if (context) {
				jQuery.each(this.modules, function(moduleName, module) {
					jQuery(module.prototype.selector, context).each(function(index, element) {
						var instance = jQuery(element).data(commonOptions.dataKey);
						if (instance) {
							instance.destroy();
						}
					});
				});
			} else {
				while (customInstances.length) {
					customInstances[0].destroy();
				}
			}
		}
	};

	return api;
}));

/*!
 * JavaScript Custom Forms : Radio Module
 *
 * Copyright 2014 PSD2HTML - http://psd2html.com/jcf
 * Released under the MIT license (LICENSE.txt)
 *
 * Version: 1.1.0
 */
;(function(jQuery) {
	'use strict';

	jcf.addModule({
		name: 'Radio',
		selector: 'input[type="radio"]',
		options: {
			wrapNative: true,
			checkedClass: 'jcf-checked',
			uncheckedClass: 'jcf-unchecked',
			labelActiveClass: 'jcf-label-active',
			fakeStructure: '<span class="jcf-radio"><span></span></span>'
		},
		matchElement: function(element) {
			return element.is(':radio');
		},
		init: function() {
			this.initStructure();
			this.attachEvents();
			this.refresh();
		},
		initStructure: function() {
			// prepare structure
			this.doc = jQuery(document);
			this.realElement = jQuery(this.options.element);
			this.fakeElement = jQuery(this.options.fakeStructure).insertAfter(this.realElement);
			this.labelElement = this.getLabelFor();

			if (this.options.wrapNative) {
				// wrap native radio inside fake block
				this.realElement.prependTo(this.fakeElement).css({
					position: 'absolute',
					opacity: 0
				});
			} else {
				// just hide native radio
				this.realElement.addClass(this.options.hiddenClass);
			}
		},
		attachEvents: function() {
			// add event handlers
			this.realElement.on({
				focus: this.onFocus,
				click: this.onRealClick
			});
			this.fakeElement.on('click', this.onFakeClick);
			this.fakeElement.on('jcf-pointerdown', this.onPress);
		},
		onRealClick: function(e) {
			// redraw current radio and its group (setTimeout handles click that might be prevented)
			var self = this;
			this.savedEventObject = e;
			setTimeout(function() {
				self.refreshRadioGroup();
			}, 0);
		},
		onFakeClick: function(e) {
			// skip event if clicked on real element inside wrapper
			if (this.options.wrapNative && this.realElement.is(e.target)) {
				return;
			}

			// toggle checked class
			if (!this.realElement.is(':disabled')) {
				delete this.savedEventObject;
				this.currentActiveRadio = this.getCurrentActiveRadio();
				this.stateChecked = this.realElement.prop('checked');
				this.realElement.prop('checked', true);
				this.fireNativeEvent(this.realElement, 'click');
				if (this.savedEventObject && this.savedEventObject.isDefaultPrevented()) {
					this.realElement.prop('checked', this.stateChecked);
					this.currentActiveRadio.prop('checked', true);
				} else {
					this.fireNativeEvent(this.realElement, 'change');
				}
				delete this.savedEventObject;
			}
		},
		onFocus: function() {
			if (!this.pressedFlag || !this.focusedFlag) {
				this.focusedFlag = true;
				this.fakeElement.addClass(this.options.focusClass);
				this.realElement.on('blur', this.onBlur);
			}
		},
		onBlur: function() {
			if (!this.pressedFlag) {
				this.focusedFlag = false;
				this.fakeElement.removeClass(this.options.focusClass);
				this.realElement.off('blur', this.onBlur);
			}
		},
		onPress: function(e) {
			if (!this.focusedFlag && e.pointerType === 'mouse') {
				this.realElement.focus();
			}
			this.pressedFlag = true;
			this.fakeElement.addClass(this.options.pressedClass);
			this.doc.on('jcf-pointerup', this.onRelease);
		},
		onRelease: function(e) {
			if (this.focusedFlag && e.pointerType === 'mouse') {
				this.realElement.focus();
			}
			this.pressedFlag = false;
			this.fakeElement.removeClass(this.options.pressedClass);
			this.doc.off('jcf-pointerup', this.onRelease);
		},
		getCurrentActiveRadio: function() {
			return this.getRadioGroup(this.realElement).filter(':checked');
		},
		getRadioGroup: function(radio) {
			// find radio group for specified radio button
			var name = radio.attr('name'),
				parentForm = radio.parents('form');

			if (name) {
				if (parentForm.length) {
					return parentForm.find('input[name="' + name + '"]');
				} else {
					return jQuery('input[name="' + name + '"]:not(form input)');
				}
			} else {
				return radio;
			}
		},
		getLabelFor: function() {
			var parentLabel = this.realElement.closest('label'),
				elementId = this.realElement.prop('id');

			if (!parentLabel.length && elementId) {
				parentLabel = jQuery('label[for="' + elementId + '"]');
			}
			return parentLabel.length ? parentLabel : null;
		},
		refreshRadioGroup: function() {
			// redraw current radio and its group
			this.getRadioGroup(this.realElement).each(function() {
				jcf.refresh(this);
			});
		},
		refresh: function() {
			// redraw current radio button
			var isChecked = this.realElement.is(':checked'),
				isDisabled = this.realElement.is(':disabled');

			this.fakeElement.toggleClass(this.options.checkedClass, isChecked)
							.toggleClass(this.options.uncheckedClass, !isChecked)
							.toggleClass(this.options.disabledClass, isDisabled);

			if (this.labelElement) {
				this.labelElement.toggleClass(this.options.labelActiveClass, isChecked);
			}
		},
		destroy: function() {
			// restore structure
			if (this.options.wrapNative) {
				this.realElement.insertBefore(this.fakeElement).css({
					position: '',
					width: '',
					height: '',
					opacity: '',
					margin: ''
				});
			} else {
				this.realElement.removeClass(this.options.hiddenClass);
			}

			// removing element will also remove its event handlers
			this.fakeElement.off('jcf-pointerdown', this.onPress);
			this.fakeElement.remove();

			// remove other event handlers
			this.doc.off('jcf-pointerup', this.onRelease);
			this.realElement.off({
				blur: this.onBlur,
				focus: this.onFocus,
				click: this.onRealClick
			});
		}
	});

}(jQuery));
