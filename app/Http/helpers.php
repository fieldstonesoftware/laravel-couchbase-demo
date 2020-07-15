<?php

// Flash Message Helpers
function flashERR($sMessage){
    session()->flash('alert-danger', $sMessage);
}

function flashWARN($sMessage){
    session()->flash('alert-warning', $sMessage);
}

function flashSUCCESS($sMessage){
    session()->flash('alert-success', $sMessage);
}

function flashINFO($sMessage){
    session()->flash('alert-info', $sMessage);
}


function myDefaultPHPDateFormat($fIncludeDay = true, $fIncludeYear=true){
    $fmt = '';
    $fmt.= $fIncludeDay ? 'D' : '';
    $fmt.= ' M j';
    $fmt.= $fIncludeYear ? ', Y' : '';
    return $fmt;
}

function myDefaultPHPTimeFormat(){
    return 'g:i a';
}

function myDefaultPHPDateTimeFormat($fIncludeDay = true, $fIncludeYear=true){
    return myDefaultPHPDateFormat($fIncludeDay, $fIncludeYear)
        .' '.myDefaultPHPTimeFormat();
}
