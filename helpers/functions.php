<?php

#-----------------------------------------------------------------#
#
#	Here we have all the HELPER functions for the theme
#	Please be extremely cautious editing this file,
#	When things go wrong, they intend to go wrong in a big way.
#	You have been warned!
#
#-----------------------------------------------------------------#


foreach ( glob( get_template_directory() . "/helpers/*.inc.php" ) as $filename)
{
    include $filename;
}