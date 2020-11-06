function active_plugin(event) {
     
    "use strict";

    event.preventDefault();

    var kemet_active_plugin = event.target,
        status = kemet_active_plugin.getAttribute("data-status"),
        activate_url = '',
        install_url = '',
        deactivate_url = '';

    if(status == 'activate'){

        activate_url = kemet_active_plugin.getAttribute("data-url-activate");
        activate(activate_url);

    } else if (status == 'install'){

        activate_url = kemet_active_plugin.getAttribute("data-url-activate");
        install_url = kemet_active_plugin.getAttribute("data-url-install");
        install_and_activate(install_url);

    }else{

        deactivate_url = kemet_active_plugin.getAttribute("data-url-deactivate");
        deactivate(deactivate_url);

    }

    function deactivate(url) {
        let xhr = new XMLHttpRequest();

        // request state change event
        xhr.onreadystatechange = function () {

            kemet_active_plugin.setAttribute("style", "color:#444; background-color: #e5e5e5; border-color: #444;");
            kemet_active_plugin.innerHTML = '<span class="dashicons dashicons-update"></span> Deactivating..';
            // request completed?
            if (xhr.readyState !== 4) return;

            if (xhr.status === 200) {
                location.replace("admin.php?page=kmt-framework")
            }
            else {
                // request error
                console.log('HTTP error', xhr.status, xhr.statusText);
            }
        };
        xhr.open("GET", url, true);
        xhr.send();
    } 

    function activate(url){
        let xhr = new XMLHttpRequest();

        // request state change event
        xhr.onreadystatechange = function () {

            kemet_active_plugin.setAttribute("style", "color:#444; background-color: #e5e5e5; border-color: #444;");
            kemet_active_plugin.innerHTML = '<span class="dashicons dashicons-update"></span> Activating..';
            // request completed?
            if (xhr.readyState !== 4) return;

            if (xhr.status === 200) {
                location.replace("admin.php?page=kmt-framework");
            }
            else {
                // request error
                console.log('HTTP error', xhr.status, xhr.statusText);
            }
        };
        xhr.open("GET", url, true);
        xhr.send();
    } 
    
    function install_and_activate(url) {

        let xhr = new XMLHttpRequest();

        // request state change event
        xhr.onreadystatechange = function () {
            kemet_active_plugin.setAttribute("style", "color:#444; background-color: #e5e5e5; border-color: #444;");
            kemet_active_plugin.innerHTML = '<span class="dashicons dashicons-update"></span> Installing..';
            // request completed?
            if (xhr.readyState !== 4) return;

            if (xhr.status === 200) {
                activate(activate_url);
            }
            else {
                // request error
                console.log('HTTP error', xhr.status, xhr.statusText);
            }
        };
        xhr.open("GET", url, true);
        xhr.send();
        
    }
    
}
