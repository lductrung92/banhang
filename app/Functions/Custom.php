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
                echo $item->name;
                echo '</option>';
                unset($categories[$key]);
                showOptionCategories($categories, $item->id, $char.'--&nbsp;');
            } else {
                
                echo '<option value="'.$item->id.'">';
                echo $char . $item->name;
                unset($categories[$key]);
                showOptionCategories($categories, $item->id, $char.'--&nbsp;');
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
            echo '<li class="sortableListsOpen" id="item-'. $item->id .'" data-module="'. $item->id .'"><div>'.$item->name . '</div>';
             
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showListCategories($categories, $item->id, $char.'|---');
            echo '</li>';
        }
        if($parent_id !== 0) echo '</ul>';
    }
    
}

?>