<?php
spl_autoload_register(function ($class_name) {
    include '../classes/' . $class_name . '.php';
});

function ShowBodyPage($section_name, $back)
{
    $db = new Database();

//     echo $db->Select("SELECT value FROM public.property WHERE fk_item_id = 1;")[2]['value'];
//     die();
//         $prop = 'Материал';
//         $value = 'Никель';
//         $sql = "INSERT INTO public.property (fk_item_id, property, value) VALUES
//   (1, '".$db->RealEscapeString($prop)."', '".$db->RealEscapeString($value)."'),
//   (2, '".$db->RealEscapeString($prop)."', '".$db->RealEscapeString($value)."'),
//   (3, '".$db->RealEscapeString($prop)."', '".$db->RealEscapeString($value)."'),
//   (4, '".$db->RealEscapeString($prop)."', '".$db->RealEscapeString($value)."'),
//   (5, '".$db->RealEscapeString($prop)."', '".$db->RealEscapeString($value)."'),
//   (6, '".$db->RealEscapeString($prop)."', '".$db->RealEscapeString($value)."'),
//   (7, '".$db->RealEscapeString($prop)."', '".$db->RealEscapeString($value)."');";
//         if ($db->Insert($sql) == TRUE) {
//             echo 'Success.';
//         }
//         else {
//             echo 'Insert failed.';
//         } 
// return;

    if ($section_name == "" || $section_name == null) {
        return;
    }

    $items = $db->Select(
    "SELECT
        item.id AS 'id',
        item.title AS 'title',
        item.description AS 'description'
        FROM public.item
        WHERE
        item.fk_section_id = (SELECT section.id FROM public.section WHERE
        LOWER(section.name) = LOWER('".$db->RealEscapeString($section_name)."'));"
    );

    echo '
    <div class="portfolio">
        <h3>
            <span>'.ucfirst($section_name).'</span>
        </h3>
        ';

    if ($items == null || count($items) == 0)
    {
        echo '<div><h1>No items.</h1></div>';
        return;
    }
    // displaying
    echo '<ul>';
    foreach ($items as $index => $item) {
        echo '
        <li>
            <a href="../body-page.php?r=php/advancedInfo.php&data='.$item['id'].'">
                <img src="../php/imageGetter.php?item_id='.$item['id'].'" alt="There should be an image">
            </a> 
            <span>'.$item['title'].'</span>
            <a href="../body-page.php?r=php/advancedInfo.php&data='.$item['id'].'&back='.$section_name.'">Read Details</a>
        </li>
        ';
    }
    echo '</ul></div>';

}
