<?php
/**
 * Asides
 *
 * Copyright 2011 by Romain Tripault // Melting Media <romain@melting-media.com>
 *
 * Asides is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Asides is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Asides; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package asides
 */
/**
 * Create an aside chunk
 *
 * @package asides
 * @subpackage processors
 */
$alreadyExists = $modx->getObject('modChunk', array(
    'name' => $_POST['name'],
));
if ($alreadyExists) {
    $modx->error->addField('name', $modx->lexicon('asides.aside_err_ae'));
}

if ($modx->error->hasError()) {
    return $modx->error->failure();
}

$aside = $modx->newObject('modChunk');
$aside->set('category', $modx->getOption('asides.categoryId'));
$aside->fromArray($_POST);
// adding PS (even if null) @TODO: set a description + type (textarea)
$aside->setProperties(array(
                           'before' => $scriptProperties['before'],
                           'after' => $scriptProperties['after'],
));

if ($aside->save() == false) {
    return $modx->error->failure($modx->lexicon('asides.aside_err_save'));
}

return $modx->error->success('', $aside);