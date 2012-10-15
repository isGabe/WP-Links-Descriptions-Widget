WordPress Custom Menu Widget With Link Descriptions
===================================================

A very simple WordPress plugin that extends the Custom Menu widget to include link descriptions.

This is a very simple plugin. I heard through the grapevine that WordPress will probably be ditching the Links deature in version 3.5. I realized that the built in Custom Menu widget could be used to do the usual function of allowing me to post links in the sidebar. However I quickly discovered that by default there is no way to display link descriptions, and that the only way to do this is to create a custom menu walker. 

Not very user friendly! So I decided to whip up a little plugin to make it easier for myself and others to use and reuse.

All I did was:

* Found a [simple bit of code](http://wordpress.stackexchange.com/a/14039/15190) that takes the default menu walker and extends it to incldue the link description. See the [first comment on that link](http://wordpress.stackexchange.com/questions/14037/menu-items-description-custom-walker-for-wp-nav-menu#comment45449_14039).
* Copied the code for the WordPress Cusotm Menu widget from /wp-includes/defualt-widgets.php
* Put the walker and that code into a plugin

The result is a plugin that gives you a new widget that looks just like the deault WordPress Custom Menu widget, but that will display the link descriptions.

Instructions:

1. Follow the normal plugin install process:

either install via your WP dashboard, or download the .zip file, extract the files and upload them to your /wp-content/plugins folder, then activate the plugin in your dashboard

2. Look for the Custom Menu With Descriptions widget in your widgets panel.
3. You can either add an existing menu or register a new menu in your theme. See [WordPress documentation](http://codex.wordpress.org/Function_Reference/register_nav_menus) or consult [the oracle](http://www.google.com/#q=wordpress+register+menu) for information on how to do this.
4. Add descriptions to your menu links. [Example](https://raw.github.com/TheF-Stop/WP-Links-Descriptions-Widget/master/examples/menu-link-descriptions.jpg). You may have to enable descriptions in screen options. [Screen options example](https://github.com/TheF-Stop/WP-Links-Descriptions-Widget/blob/master/examples/screen-options.jpg?raw=true). [Enabling descriptions example](https://github.com/TheF-Stop/WP-Links-Descriptions-Widget/blob/master/examples/screen-options.jpg?raw=true)
5. The plugin wraps descriptions with `<span class="link-description"></span>` , so you can style them accordingly in your CSS. There is no CSS included with the plugins, so this will be up to you.
6. That's it.

