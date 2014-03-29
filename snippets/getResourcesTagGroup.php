<?php
/*
getResourcesTagGroup

Params
groupStart - To output before every group
groupEnd   - To output after every group
groupItems - Items per group

Created from a mix up of stuff found at 
http://forums.modx.com/thread/69754/getresources---group-results 
and some imagination
*/
$output = '';
if(!isset($scriptProperties['outputSeparator'])) {
    $scriptProperties['outputSeparator'] = '||';
}

$rows = $modx->runSnippet('getResourcesTag', $scriptProperties);
$rows = explode($scriptProperties['outputSeparator'],$rows);

$grouping = 0;
foreach ($rows as $i => $row) {
    if ($grouping == 0){
        $output .= "\n".$groupStart."\n";
    }
        
    $output .= $row;
    $grouping++;
    
    if ($grouping == $groupItems){
        $output .= "\n".$groupEnd."\n";
        $grouping = 0;
    }
}

// If last group was not closed
// this assumes that groupEnd contaings an ending of a HTML element that should be closed
if ($grouping != 0){
    $output .= "\n".$groupEnd."\n";
}
 
return $output;
