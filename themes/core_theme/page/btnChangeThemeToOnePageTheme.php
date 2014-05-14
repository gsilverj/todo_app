<!-- Simply a link to append 'task' to the url. -->
<!--    To make this actually function as a theme changer, you would have to change the Core_IndexController(), -->
<!--        add a method and tell the XML config (or a session variable) to the desired theme name. Core_XMLConfig -->
<!--        currently does not have the functionality to alter(write) an .xml file however, so that would need to  -->
<!--        be modified as well if you are planning on taking that route. -->
<a href="<?php echo Core_XMLConfig::getBaseUrl() . 'task'?>"> <input class="btn-primary" type="button" value="Change To Current Config Theme ?"/> </a>