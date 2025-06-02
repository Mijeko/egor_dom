let DevelopFormApi = function () {
    this.request = function (url, formData, headers, events) {
        fetch(url, {
            method: 'POST',
            body: formData,
            headers: headers
        })
            .then(response => response.json())
            .then(data => {
                if (typeof events.afterSend === 'function') {
                    events.afterSend(data);
                }
            });
    }
}