var Y = new YUI();
Y.log("Loading base.js", "info", "HAUS");


/**
 * Create the Console
 */
if (!Y.UA.mobile) {
    YUI({
        filter: 'raw',
        useBrowserConsole: false
    }).use("console", "console-filters", "dd-plugin", function (Y) {
    
        Y.one('#ControlPanel').insert('<div class="ControlButton" id="ToggleConsole" title="Console"></div>', 1);
             
        var yconsole = new Y.Console({
            logSource: Y.Global,
            visible: false  // hidden at instantiation
        }).plug(Y.Plugin.ConsoleFilters)
          .plug(Y.Plugin.Drag, { handles: ['.yui3-console-hd'] })
          .render();
        
        Y.log("Console Started", "info", "HAUS");
    
        //Set up the button listeners
        function toggle(e,cnsl) {
            if (cnsl.get('visible')) {
                cnsl.hide();
            }
            else {
                cnsl.show();
                cnsl.syncUI(); // to handle any UI changes queued while hidden.
            }
        }
        
        Y.on('click', toggle, '#ToggleConsole', null, yconsole);
    
        Y.log("Console loaded", "info", "HAUS");
    });
}

/**
 * Create a Debug screen
 */
YUI().use('node', function(Y) {
    
    function tglDebug(e) {
        if (Y.one("#Debug").hasClass("show")) {
            Y.log("Hiding Debug", "info");
            Y.one("#Debug").replaceClass("show", "hide");
            Y.one("#ToggleDebug").replaceClass("show", "hide");
        }
        else {
            Y.log("Showing Debug", "info");
            Y.one("#Debug").replaceClass("hide", "show");
            Y.one("#ToggleDebug").replaceClass("hide", "show");
        }
    }
    Y.on('click', tglDebug, '#ToggleDebug');

    Y.log("Debug loaded", "info", "HAUS");
});

/**
 * Create a Settings screen
 */
YUI().use('node', function(Y) {
    
    function tglSettings(e) {
        if (Y.one("#Settings").hasClass("show")) {
            Y.log("Hiding Settings", "info");
            Y.one("#Settings").replaceClass("show", "hide");
            Y.one("#ToggleSettings").replaceClass("show", "hide");
        }
        else {
            Y.log("Showing Settings", "info");
            Y.one("#Settings").replaceClass("hide", "show");
            Y.one("#ToggleSettings").replaceClass("hide", "show");
        }
    }
    Y.on('click', tglSettings, '#ToggleSettings');

    Y.log("Settings loaded", "info", "HAUS");
});

/**
 * Create a Help screen
 */
YUI().use('node', function(Y) {
    
    function tglHelp(e) {
        if (Y.one("#Help").hasClass("show")) {
            Y.log("Hiding Help", "info");
            Y.one("#Help").replaceClass("show", "hide");
        }
        else {
            Y.log("Showing Help", "info");
            Y.one("#Help").replaceClass("hide", "show");
        }
    }
    Y.on('click', tglHelp, '#ToggleHelp');
    
    Y.log("Help loaded", "info", "HAUS");
});


YUI().use('node', function(Y) {
    Y.on('click', function(e) {
        devcfg = e.currentTarget.next('.SubMenu');
        if( devcfg.hasClass("show")) {
                Y.log("Hiding SubMenu", "info");
                devcfg.replaceClass("show", "hide");
            }
            else {
                Y.log("Showing SubMenu", "info");
                devcfg.replaceClass("hide", "show");
            }
    }, '#Devices .Menu .MenuTitle');

    Y.on('click', function(e) {
        devcfg = e.currentTarget.next('.DeviceConfig');
        if( devcfg.hasClass("show")) {
                Y.log("Hiding Device", "info");
                devcfg.replaceClass("show", "hide");
            }
            else {
                Y.log("Showing Device", "info");
                devcfg.replaceClass("hide", "show");
            }
    }, '#Devices .Device .DeviceTitle');
});


Y.log("base.js loaded", "info", "HAUS");