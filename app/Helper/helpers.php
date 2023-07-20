<?php
    function irisan($arr1,$arr2)
    {
        $c=-1;
        unset($arrhsl);
        $arrhsl = array();
        for ($i=0;$i<count($arr1);$i++)
        {
            for ($j=0;$j<count($arr2);$j++)
            {
                if ($arr1[$i] == $arr2[$j])
                {
                    $c++;
                    $arrhsl[$c] = $arr1[$i];
                }
            }
        }
        return $arrhsl;
    }
