/**
 * Created by credondo on 11/11/13.
 */
var Util = ({
    removeAccents: function (strAccents) {
        var strAccents = strAccents.split('');
        var strAccentsOut = new Array();
        var strAccentsLen = strAccents.length;
        var accents = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž';
        var accentsOut = "AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz";
        for (var y = 0; y < strAccentsLen; y++) {
            if (accents.indexOf(strAccents[y]) != -1) {
                strAccentsOut[y] = accentsOut.substr(accents.indexOf(strAccents[y]), 1);
            } else
                strAccentsOut[y] = strAccents[y];
        }
        strAccentsOut = strAccentsOut.join('');
        return strAccentsOut;
    },

    makeSlug: function(text) {
        text = Util.removeAccents(text);
        return text
            .toLowerCase()
            .replace(/[^a-zA-Z0-9\s]/g,"")
            .replace(/\s/g,'-');
    },

    /**
     * Gets the actual date in the format mm/dd/yyyy
     * @return {String} the actual date
     */
    GetActualDate: function () {
        var myDate = new Date();
        var displayDate = (myDate.getMonth() + 1) + '/' + (myDate.getDate()) + '/' + myDate.getFullYear();
        return displayDate;
    }
});