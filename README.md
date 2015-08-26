# MaterialWP

This is a starter Material Design WordPress Theme based off the Bootstrap framework.

[View Demo](http://materialwp.com)


## Getting Started

Upload the theme to your WordPress Directory in the wp-content/themes/ directory

## Credits

The Material Design WordPress Theme was started in 2014 by [Brad Williams](http://twitter.com/braginteractive/).

Without the following projects/people this theme wouldn't be possible:

- http://fezvrasta.github.io/bootstrap-material-design/
- http://underscores.me/
- http://getbootstrap.com

##Changing Colors
Basic colors changes can be made in the WordPress Customizer ( Appearance -> Customize -> Colors).

If you need to further customize the theme, it is recommended that you first create a child theme so you will be able to update the theme in the future. You can read how to create a WordPress Child theme [here](http://codex.wordpress.org/Child_Themes).

###Option 1
Use CSS to target the element you would like to change... 

###Option 2
Edit the theme PHP files. For example, the color of the sidebar widget areas use a class to set the color. To edit this class, look in the functions.php file and find the function that registers the sidebar widget. Within this function you will see a class called "panel-warning", change this class to edit the color. Refer to the Varitations section [here](https://github.com/FezVrasta/bootstrap-material-design) to find all the different colors.

## Documentation, FAQs, and More

If you’re interested in helping or have any questions, please [let me know](http://braginteractive.com/contact-us).


## Material Design Themes
Check out other Material Design WordPress themes and templates over at [MaterialDesignThemes.com](http://materialdesignthemes.com)


## Releases

0.0.3
- add bower
- remove unyson

0.0.1 - 0.0.2
- Intial releases
