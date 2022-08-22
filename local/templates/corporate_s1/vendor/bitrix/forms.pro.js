window.RecaptchaID = [];

function NextypeFormsProComponentInit(parameters)
{
    if (parameters.formId !== undefined) {
        window[parameters.formId] = new NextypeFormsProComponent(parameters);
    }
}

function NextypeFormsProComponent(parameters)
{
    this.init(parameters);
}

NextypeFormsProComponent.prototype = {

    signedParamsString: '',
    params: {},
    siteId: '',
    ajaxUrl: '',
    templateFolder: '',
    formId: '',
    popupId: '',

    init: function (parameters)
    {
        this.params = parameters.params || {};
        this.signedParamsString = parameters.signedParamsString || '';
        this.siteId = parameters.siteID || '';
        this.ajaxUrl = parameters.ajaxUrl || '';
        this.templateFolder = parameters.templateFolder || '';
        this.formId = parameters.formId || '';
        this.popupId = parameters.popupId || '';
        this.obPopup = false;

        this.renderForm();
        this.bindEvents();

        return this;
    },

    renderForm: function () {
        if (this.params.CAPTCHA == "RECAPTCHA" && this.params.RECAPTCHA_ID != "") {

            if (window.RecaptchaID.indexOf(this.params.RECAPTCHA_ID) == -1)
                window.RecaptchaID.push(this.params.RECAPTCHA_ID);

            window['timerRecaptcha'] = setTimeout(BX.proxy(function () {
                if (typeof window.grecaptcha.render == 'function') {
                    
                    for (var i = 0; i < window.RecaptchaID.length; i++) {
                        if (BX(window.RecaptchaID[i]) != null && BX(window.RecaptchaID[i]).innerHTML == "") {
                            window.grecaptcha.render(window.RecaptchaID[i], {
                                'sitekey': this.params.RECAPTCHA_CODE
                            });
                        }
                    }
                    clearTimeout(window['timerRecaptcha']);
                }
            }, this), 200);

        }

    },

    bindEvents: function() {

        BX.bind(BX(this.formId), 'submit', BX.proxy(this.submitForm, this));
        
        if (this.params.VIEW_TYPE == "POPUP" && this.popupId != "") {
            this.obPopup = BX(this.popupId);

            var self = this;
            BX.findChild(document.body, {attribute: {'data-close-popup': this.popupId}}, true, true).forEach(function (target) {
                BX.bind(target, 'click', BX.proxy(self.popupClose, self));
            });

            BX.findChild(document.body, {attribute: {'data-open-popup': this.popupId}}, true, true).forEach(function (target) {
                BX.bind(target, 'click', BX.proxy(self.popupOpen, self));
            });

        }
    },

    submitForm: function (event) {

        var fd = new FormData(document.getElementById(this.formId));
        
        fd.append('SITE_ID', this.siteId);
        fd.append('signedParamsString', this.signedParamsString);
        var self = this;

        $.ajax({
                    url: this.ajaxUrl,
                    processData: false,
                    contentType: false,
                    data: fd,
                    type: 'post',
                    success: function (result) {
                        BX.adjust(BX(self.formId), {
                            html: result
                        });

                        self.renderForm();
                    }
                });

        

        return BX.PreventDefault(event);
    },

    popupClose: function () {
        if (this.obPopup !== undefined) {
            BX.removeClass(this.obPopup, 'open');
        }
    },

    popupOpen: function () {
        BX.addClass(this.obPopup, 'open');
    }
};
