<?php 

function showOptionCategories($categories, $parent_id = 0, $char = '')
{
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->pid == $parent_id)
        {
            if($item->pid === 0) {
                echo '<option style="font-weight: bold;" value="'.$item->id.'">';
                echo htmlspecialchars($item->name);
                echo '</option>';
                unset($categories[$key]);
                showOptionCategories($categories, $item->id, $char.'-- ');
            } else {
                
                echo '<option value="'.$item->id.'">';
                echo htmlspecialchars($char . $item->name);
                unset($categories[$key]);
                showOptionCategories($categories, $item->id, $char.'-- ');
                echo '</option>';
            }
        }
    }
}


function showListCategories($categories, $parent_id = 0, $char = '')
{
    $cate_child = array();
    foreach ($categories as $key => $item)
    {
        if ($item->pid == $parent_id)
        {
            $cate_child[] = $item;
            unset($categories[$key]);
        }
    }
     
    if ($cate_child)
    {
        if($parent_id !== 0) echo '<ul>';
        foreach ($cate_child as $key => $item)
        {
            // Hiển thị tiêu đề chuyên mục
            echo '<li class="sortableListsOpen" id="item-'. $item->id .'" data-module="'. $item->id .'"><div>'.htmlspecialchars($item->name) . '</div>';
             
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showListCategories($categories, $item->id, $char.'|---');
            echo '</li>';
        }
        if($parent_id !== 0) echo '</ul>';
    }
    
}

function showOptionCateChilds($categories, $idChecked = null) 
{
    for($i = 0; $i < count($categories); $i++){
        if($categories[$i]['id'] === $idChecked)
            echo '<option value="' . $categories[$i]['id'] . '" selected>';
        else
            echo '<option value="' . $categories[$i]['id'] . '">';
        echo htmlspecialchars($categories[$i]['name']);
        echo '</option>'; 
    }
}

function changeTitle($str, $strSymbol = ' ', $case = MB_CASE_LOWER)
{// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
    $str = trim($str);
    if ($str == "") return "";
    $str = str_replace('"', '', $str);
    $str = str_replace("'", '', $str);
    $str = stripUnicode($str);
    $str = mb_convert_case($str, $case, 'utf-8');
    $str = preg_replace('/[\W|_]+/', $strSymbol, $str);
    return str_replace(' ', '-', trim($str));
}

function stripUnicode($str)
{
    if (!$str) return '';
    //$str = str_replace($a, $b, $str);
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ä|Æ|Ā|Ą|Ǻ|Ǎ',
        'ae' => 'ǽ',
        'AE' => 'Ǽ',
        'c' => 'ć|ç|ĉ|ċ|č',
        'C' => 'Ć|Ĉ|Ĉ|Ċ|Č',
        'd' => 'đ|ď',
        'D' => 'Đ|Ď',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ĕ|Ę|Ė',
        'f' => 'ƒ',
        'F' => '',
        'g' => 'ĝ|ğ|ġ|ģ',
        'G' => 'Ĝ|Ğ|Ġ|Ģ',
        'h' => 'ĥ|ħ',
        'H' => 'Ĥ|Ħ',
        'i' => 'í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Ǐ|Į|İ',
        'ij' => 'ĳ',
        'IJ' => 'Ĳ',
        'j' => 'ĵ',
        'J' => 'Ĵ',
        'k' => 'ķ',
        'K' => 'Ķ',
        'l' => 'ĺ|ļ|ľ|ŀ|ł',
        'L' => 'Ĺ|Ļ|Ľ|Ŀ|Ł',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ö|Ø|Ǿ|Ǒ|Ō|Ŏ|Ő',
        'Oe' => 'œ',
        'OE' => 'Œ',
        'n' => 'ñ|ń|ņ|ň|ŉ',
        'N' => 'Ñ|Ń|Ņ|Ň',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ŭ|Ü|Ů|Ű|Ų|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
        's' => 'ŕ|ŗ|ř',
        'R' => 'Ŕ|Ŗ|Ř',
        's' => 'ß|ſ|ś|ŝ|ş|š',
        'S' => 'Ś|Ŝ|Ş|Š',
        't' => 'ţ|ť|ŧ',
        'T' => 'Ţ|Ť|Ŧ',
        'w' => 'ŵ',
        'W' => 'Ŵ',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ŷ',
        'z' => 'ź|ż|ž',
        'Z' => 'Ź|Ż|Ž',

    );
    foreach ($unicode as $khongdau => $codau) {
        $arr = explode("|", $codau);
        $str = str_replace($arr, $khongdau, $str);
    }
    return $str;
}


?>