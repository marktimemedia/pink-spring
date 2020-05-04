// Add custom color to color picker, or let client pick their own

acf.add_filter('color_picker_args', function( args, field ){

  args.palettes = [custom_colors.springcolor1, custom_colors.springcolor2, custom_colors.springcolor3, custom_colors.springcolor4, custom_colors.white, custom_colors.neutrallightest, custom_colors.neutrallighter, custom_colors.neutrallight,custom_colors.neutralmid, custom_colors.neutraldark, custom_colors.neutraldarker, custom_colors.neutraldarkest]
  // return colors

    // return
    return args;

});
