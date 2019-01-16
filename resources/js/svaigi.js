svaigi = {
    showMessage: function (message, messageType, messageTimeout, messageLayout) {
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