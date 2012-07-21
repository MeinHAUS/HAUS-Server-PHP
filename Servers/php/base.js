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
    
        Y.one('#ControlPanel').insertBefore('<div class="ControlButton" id="ToggleConsole"></div>', Y.one('#ToggleSettings'));
             
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
 * Create the ControlPanel
 */
YUI().use('node', function(Y) {

    Y.log("ControlePanel loaded", "info", "HAUS");
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


Y.log("base.js loaded", "info", "HAUS");