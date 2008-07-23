<?php
/*
+---------------------------------------------------------------------------+
| OpenX v${RELEASE_MAJOR_MINOR}                                                                |
| =======${RELEASE_MAJOR_MINOR_DOUBLE_UNDERLINE}                                                                |
|                                                                           |
| Copyright (c) 2003-2008 OpenX Limited                                     |
| For contact details, see: http://www.openx.org/                           |
|                                                                           |
| This program is free software; you can redistribute it and/or modify      |
| it under the terms of the GNU General Public License as published by      |
| the Free Software Foundation; either version 2 of the License, or         |
| (at your option) any later version.                                       |
|                                                                           |
| This program is distributed in the hope that it will be useful,           |
| but WITHOUT ANY WARRANTY; without even the implied warranty of            |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
| GNU General Public License for more details.                              |
|                                                                           |
| You should have received a copy of the GNU General Public License         |
| along with this program; if not, write to the Free Software               |
| Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA |
+---------------------------------------------------------------------------+
$Id$
*/

###START_STRIP_DELIVERY
/**
 * Dependencies between the plugins - used to set the order in which the components
 * are executed by delivery engine when calling components to log the data.
 */
$GLOBALS['_MAX']['pluginsDependencies']['deliveryDataPrepare:ox_page_info:ox_page_info'] = array(
    'deliveryDataPrepare:ox_core:ox_core',
);
###END_STRIP_DELIVERY

function Plugins_deliveryDataPrepare_ox_page_info_ox_page_info()
{
    if (!empty($_GET['loc'])) {
        $pageInfo = parse_url($_GET['loc']);
    } elseif (!empty($_SERVER['HTTP_REFERER'])) {
        $pageInfo = parse_url($_SERVER['HTTP_REFERER']);
    } elseif (!empty($GLOBALS['loc'])) {
        $pageInfo = parse_url($GLOBALS['loc']);
    }
    if (!empty($pageInfo['scheme'])) {
        $pageInfo['scheme'] = ($pageInfo['scheme'] == 'https') ? 1 : 0;
    }
    if (isset($GLOBALS['_MAX']['CHANNELS'])) {
        $pageInfo['channel_ids'] = $GLOBALS['_MAX']['CHANNELS'];
    }
    $GLOBALS['_MAX']['deliveryData']['pageInfo'] = $pageInfo;
}

function Plugins_deliveryDataPrepare_ox_page_info_ox_page_info_Delivery_logRequest()
{
    Plugins_deliveryDataPrepare_ox_page_info_ox_page_info();
}

function Plugins_deliveryDataPrepare_ox_page_info_ox_page_info_Delivery_logImpression()
{
    Plugins_deliveryDataPrepare_ox_page_info_ox_page_info();
}

function Plugins_deliveryDataPrepare_ox_page_info_ox_page_info_Delivery_logClick()
{
    Plugins_deliveryDataPrepare_ox_page_info_ox_page_info();
}

?>