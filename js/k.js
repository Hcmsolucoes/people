var app = {
    get : function(url){
        return $.ajax(url, {
            type: "GET",
        });
    },
    post : function(url, data, type){
        url = url;
        return $.ajax({
            url            : url,
            type           : "POST",
            dataType       : type,
            data           : data || null
        });
    }
}