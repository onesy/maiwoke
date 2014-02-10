<?php
/**
 * 视图要走这里哦.
 */
extract(Cemvc_App_ViewBase::$assign, EXTR_OVERWRITE);
include web_root . DIRECTORY_SEPARATOR . 'Site' . DIRECTORY_SEPARATOR . Cemvc_App_ViewBase::$view_route;
