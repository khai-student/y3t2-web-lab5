<?php
spl_autoload_register(function ($class_name) {
    include '../classes/' . $class_name . '.php';
});

function InsertNewItem() {
    
$db = new Database();

    $title = 'Yamaha SVC110 электровиолончель';
    $description = 'виолончель ученическая, размер 3/4, верхняя дека - ель, низ и бока - клен, в комплекте - сумка, смычок, канифоль';
    $section = 'cellos';
    $imgFilename = 'image.jpg';
    $properties = [ 
        'Размер' => '4/4',
        'Цена' => '33550 Грн.'
        ];

    $sql = "INSERT INTO public.item (fk_section_id, title, description)
  SELECT
    section.id,
    '".$db->RealEscapeString($title)."',
    '".$db->RealEscapeString($description)."'
  FROM public.section
  WHERE LOWER(section.name) = LOWER('".$db->RealEscapeString($section)."');";
        if ($db->Insert($sql) == TRUE) {
            echo 'Success.';
        }
        else {
            echo 'Item insert failed.';
            die();
        } 

    $imgData = file_get_contents($imgFilename);
        $sql = "INSERT INTO public.image (fk_item_id, path, data)
  SELECT
    item.id,
    '".$db->RealEscapeString($imgFilename)."',
    '".$db->RealEscapeString($imgData)."'
  FROM public.item
  WHERE item.title = '".$db->RealEscapeString($title)."';";
        if ($db->Insert($sql) == TRUE) {
            echo 'Success.';
        }
        else {
            echo 'Image insert failed.';
            die();
        } 

    foreach ($properties as $property => $value) {
        $sql = "INSERT INTO public.property (fk_item_id, property, value)
  SELECT
    item.id,
    '".$db->RealEscapeString($property)."',
    '".$db->RealEscapeString($value)."'
  FROM public.item
  WHERE item.title = '".$db->RealEscapeString($title)."';";
         if ($db->Insert($sql) == TRUE) {
            echo 'Success.';
        }
        else {
            echo 'Property "'.$property.'" insert failed.<br>';
            die();
        } 
    }
    die();
}

// InsertNewItem();

function ShowBodyPage($section_name, $back)
{
    $db = new Database();

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
