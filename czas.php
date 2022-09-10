<!DOCTYPE html>
<html>
<body>

<?php
function time_elapsed_string($ptime)
{
    // Past time as MySQL DATETIME value
    $ptime = strtotime($ptime);

    // Current time as MySQL DATETIME value
    $csqltime = date('Y-m-d H:i:s');

    // Current time as Unix timestamp
    $ctime = strtotime($csqltime); 

    // Elapsed time
    $etime = $ctime - $ptime;

    // If no elapsed time, return 0
    if ($etime < 1){
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'rok',
                 30 * 24 * 60 * 60  =>  'miesiąc',
                      24 * 60 * 60  =>  'dzień',
                           60 * 60  =>  'godzinę',
                                60  =>  'minutę',
                                 1  =>  'sekundę'
    );

    $a_plural = array( 'rok'   => 'lat(a)',
                       'miesiąc'  => 'miesiące',
                       'dzień'    => 'dni',
                       'godzinę'   => 'godzin(y)',
                       'minutę' => 'minut(y)',
                       'sekundę' => 'sekund(y)'
    );

    foreach ($a as $secs => $str){
        // Divide elapsed time by seconds
        $d = $etime / $secs;
        if ($d >= 1){
            // Round to the next lowest integer 
            $r = floor($d);
            // Calculate time to remove from elapsed time
            $rtime = $r * $secs;
            // Recalculate and store elapsed time for next loop
            if(($etime - $rtime)  < 0){
                $etime -= ($r - 1) * $secs;
            }
            else{
                $etime -= $rtime;
            }
            // Create string to return
            $estring = $estring . $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ';
        }
    }
    return $estring . ' temu.';
}

    echo 'Stream przedłużany rozpoczął się ' . time_elapsed_string('2022-09-08 00:22:35');
?>

</body>
</html>
