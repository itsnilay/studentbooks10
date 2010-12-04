<?php

    function showOptionsDrop($array, $sdefault){
        $string = '';
        foreach($array as $k => $v){
            $string .= '<option value="'.$k.'"';
            if ($sdefault==$k)
                $string .= ' selected="selected"';
            $string .= '>'.$v.'</option>'."\n";

            echo $k;
        }
        return $string;
    }

    function printAddressForm($prefix, $postData)
    {
        echo '<p><label for="address1" class="label">Address 1: </label><input id="address1" type="text" name="'.$prefix.'address1" size="15" maxlength="75" value="';
        if (isset($postData[$prefix.'address1']))
            echo $postData[$prefix.'address1'];
        echo '" /></p>';

        echo '<p><label for="address2" class="label">Address 2: </label><input id="address2" type="text" name="'.$prefix.'address2" size="15" maxlength="75" value="';
        if (isset($postData[$prefix.'address2']))
            echo $postData[$prefix.'address2'];
        echo '" /></p>';

        echo '<p><label for="city" class="label">City: </label><input id="city" type="text" name="'.$prefix.'city" size="15" maxlength="75" value="';
        if (isset($postData[$prefix.'city']))
            echo $postData[$prefix.'city'];
        echo '" /></p>';

        //create states array
        $states_arr = array('AL'=>"Alabama",'AK'=>"Alaska",'AZ'=>"Arizona",'AR'=>"Arkansas",'CA'=>"California",'CO'=>"Colorado",'CT'=>"Connecticut",'DE'=>"Delaware",'DC'=>"District Of Columbia",'FL'=>"Florida",'GA'=>"Georgia",'HI'=>"Hawaii",'ID'=>"Idaho",'IL'=>"Illinois", 'IN'=>"Indiana", 'IA'=>"Iowa",  'KS'=>"Kansas",'KY'=>"Kentucky",'LA'=>"Louisiana",'ME'=>"Maine",'MD'=>"Maryland", 'MA'=>"Massachusetts",'MI'=>"Michigan",'MN'=>"Minnesota",'MS'=>"Mississippi",'MO'=>"Missouri",'MT'=>"Montana",'NE'=>"Nebraska",'NV'=>"Nevada",'NH'=>"New Hampshire",'NJ'=>"New Jersey",'NM'=>"New Mexico",'NY'=>"New York",'NC'=>"North Carolina",'ND'=>"North Dakota",'OH'=>"Ohio",'OK'=>"Oklahoma", 'OR'=>"Oregon",'PA'=>"Pennsylvania",'RI'=>"Rhode Island",'SC'=>"South Carolina",'SD'=>"South Dakota",'TN'=>"Tennessee",'TX'=>"Texas",'UT'=>"Utah",'VT'=>"Vermont",'VA'=>"Virginia",'WA'=>"Washington",'WV'=>"West Virginia",'WI'=>"Wisconsin",'WY'=>"Wyoming");

        echo '<p><label for="state" class="label">State: </label><select name="'.$prefix.'state"><option value="0">Choose a state</option>';
        if (isset($postData[$prefix.'state']))
            echo showOptionsDrop($states_arr, $postData[$prefix.'state']);
        else
            echo showOptionsDrop($states_arr, "X");
        echo '</select></p>';

        echo '<p><label for="zip" class="label">Zip: </label><input id="zip" type="text" name="'.$prefix.'zip" size="15" maxlength="10" value="';
        if (isset($postData[$prefix.'zip']))
            echo $postData[$prefix.'zip'];
        echo '" /></p>';
    }
?>

