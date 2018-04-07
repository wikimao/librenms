<?php
/*
 * LibreNMS
 *
 * Copyright (c) 2016 Aaron Daniels <aaron@daniels.id.au>
 *
 * This program is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.  Please see LICENSE.txt at the top level of
 * the source code distribution for details.
 */

use LibreNMS\Authentication\Auth;

if (!Auth::user()->hasGlobalAdmin()) {
    $status = array('status' =>1, 'message' => 'ERROR: You need to be admin to delete services');
} else {
    if (!is_numeric($vars['service_id'])) {
        $status = array('status' =>1, 'message' => 'No Service has been selected');
    } else {
        if (delete_service($vars['service_id'])) {
            $status = array('status' =>0, 'message' => 'Service: <i>'.$vars['service_id'].', has been deleted.</i>');
        } else {
            $status = array('status' =>1, 'message' => 'Service: <i>'.$vars['service_id'].', has NOT been deleted.</i>');
        }
    }
}
header('Content-Type: application/json');
echo _json_encode($status);
